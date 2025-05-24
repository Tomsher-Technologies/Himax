<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductStock;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageTranslations;
use App\Models\PageSeos;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\HomeSlider;
use App\Models\BusinessSetting;
use App\Models\ProductEnquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\JsonLdMulti;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\WebHomeProductsCollection;
use App\Http\Controllers\Frontend\FrontendController;
use App\Mail\ProductEnquiryMail;
use Storage;
use Validator;
use Mail;
use DB;
use Hash;
use Cache;
use Carbon\Carbon;

class ProductController extends Controller
{
    protected $frontendController;

    public function __construct(FrontendController $frontendController)
    {
        $this->frontendController = $frontendController;
    }

    public function index(Request $request)
    {
        $page = Page::where('type','product_listing')->first();
        $lang = getActiveLanguage();

        $limit = $request->has('limit') ? $request->limit : 10;
        $offset = $request->has('offset') ? $request->offset : 0;
        $category = $request->has('category') ? $request->category  : false;
        $brand = $request->has('brand') ? $request->brand  : false;
        $sort_search = '';
        // $sort_by = $request->has('sort_by') ? $request->sort_by : null;

        $product_query  = Product::wherePublished(1);
        if ($category) {
            $childIds = [];
            $category_ids = Category::whereHas('category_translations', function ($query) use ($category) {
                                        $query->where('slug', $category);
                                    })->where('is_active',1)->pluck('id')->toArray();

            $childIds[] = $category_ids;
            if(!empty($category_ids)){
                foreach($category_ids as $cId){
                    $childIds[] = getChildCategoryIds($cId);
                }
            }

            if(!empty($childIds)){
                $childIds = array_merge(...$childIds);
                $childIds = array_unique($childIds);
            }
            $product_query->whereIn('category_id', $childIds);
        }
        
        if ($brand) {
            $brand_ids = Brand::whereHas('brand_translations', function ($query) use ($brand) {
                                    $query->where('slug', $brand);
                                })->where('is_active', 1)->pluck('id')->toArray();

            $product_query->whereIn('brand_id', $brand_ids);
        }

        // if ($sort_by) {
        //     switch ($sort_by) {
        //         case 'latest':
        //             $product_query->latest();
        //             break;
        //         case 'oldest':
        //             $product_query->oldest();
        //             break;
        //         case 'name_asc':
        //             $product_query->orderBy('name', 'asc');
        //             break;
        //         case 'name_desc':
        //             $product_query->orderBy('name', 'desc');
        //             break;
        //         case 'price_high':
        //             $product_query->select('*', DB::raw("(SELECT MAX(price) from product_stocks WHERE product_id = products.id) as sort_price"));
        //             $product_query->orderBy('sort_price', 'desc');
        //             break;
        //         case 'price_low':
        //             $product_query->select('*', DB::raw("(SELECT MIN(price) from product_stocks WHERE product_id = products.id) as sort_price"));
        //             $product_query->orderBy('sort_price', 'asc');
        //             break;
        //         default:
        //             # code...
        //             break;
        //     }
        // }

        if ($request->search) {
            $sort_search = $request->search;
            $products = $product_query->where(function ($query) use($sort_search) {
                $query->orWhereHas('product_translations', function ($q) use ($sort_search) {
                    $q->where('tags', 'like', '%' . $sort_search . '%')->orWhere('name', 'like', '%' . $sort_search . '%');
                });
            });
        }

        $products = $product_query->paginate(20)->appends($request->query());


        $categories = Cache::rememberForever('categories', function () {
            $details = Category::where('parent_id',0)->where('is_active', 1)->orderBy('name','asc')->get();
            return $details;
        });

        $brands = Cache::rememberForever('brands', function () {
            $details = Brand::where('is_active', 1)->orderBy('name','asc')->get();
            return $details;
        });

        return view('frontend.products',compact('limit','page','products','offset', 'category','brand', 'lang','categories','brands','sort_search'));
    }

    public function productDetails(Request $request, $slug, $sku){
        $lang = getActiveLanguage();
        $page = Page::where('type','product_details')->first();
        $product = '';
        if($slug !=  '' && $sku !=''){
            $product = Product::where('published',1)
                                    ->where('slug', $slug)
                                    ->where('sku', $sku)
                                    ->first();
            if($product){
                $seo = [
                    'title'                 => $product->getTranslation('name', $lang),
                    'meta_title'            => $product->getSeoTranslation('meta_title', $lang),
                    'meta_description'      => $product->getSeoTranslation('meta_description', $lang),
                    'keywords'              => $product->getSeoTranslation('meta_keywords', $lang),
                    'og_title'              => $product->getSeoTranslation('og_title', $lang),
                    'og_description'        => $product->getSeoTranslation('og_description', $lang),
                    'twitter_title'         => $product->getSeoTranslation('twitter_title', $lang),
                    'twitter_description'   => $product->getSeoTranslation('twitter_description', $lang),
                ];
                
                $this->frontendController->loadSEO($seo);
            }
        }
        return view('frontend.product_details', compact('lang','product','page'));
    }

    public function storeProductEnquiry(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'message' => 'required|string|min:10|max:500',
            'product_id' => 'required|exists:products,id',
        ]);

        // Store enquiry in database
        ProductEnquiry::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'quantity' => $request->quantity ?? 0
        ]);

        $product = Product::find($request->product_id);
        $data = [
            'product_sku'   => $product->sku ?? '',
            'product_name'  => $product->getTranslation('name','en'),
            'category'      => $product->category->getTranslation('name','en'),
            'brand'         => $product->brand->getTranslation('name','en'),
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'message'       => $request->message,
            'quantity'      => $request->quantity
        ];

        // Send Email (Optional)
        Mail::to(env('MAIL_ADMIN'))->send(new ProductEnquiryMail($data));

        // Return JSON response
        return response()->json(['success' => true, 'message' => '<div class="alert alert-success">Your enquiry has been submitted successfully!</div>']);
    }

}
