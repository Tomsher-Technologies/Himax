<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\Page;
use App\Models\PageTranslations;
use App\Models\PageSeos;
use App\Models\Banner;
use App\Models\Brand;
use App\Models\HomeSlider;
use App\Models\Partners;
use App\Models\BusinessSetting;
use App\Models\Subscriber;
use App\Models\Contacts;
use App\Models\Service;
use App\Models\HomePoints;
use App\Models\Industries;
use App\Models\Blog;
use App\Mail\ContactEnquiry;
use App\Rules\Recaptcha;
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
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\WebHomeProductsCollection;
use Storage;
use Mail;
use DB;
use Hash;
use Cache;

class FrontendController extends Controller
{

    public function loadSEO($model)
    {
        SEOTools::setTitle($model['title']);
        OpenGraph::setTitle($model['title']);
        TwitterCard::setTitle($model['title']);

        SEOMeta::setTitle($model['meta_title'] ?? $model['title']);
        SEOMeta::setDescription($model['meta_description']);
        SEOMeta::addKeyword($model['keywords']);

        OpenGraph::setTitle($model['og_title']);
        OpenGraph::setDescription($model['og_description']);
        OpenGraph::setUrl(URL::full());
        OpenGraph::addProperty('locale', 'en_US');
        
        JsonLd::setTitle($model['meta_title']);
        JsonLd::setDescription($model['meta_description']);
        JsonLd::setType('Page');

        TwitterCard::setTitle($model['twitter_title']);
        TwitterCard::setSite("@aldourigroup");
        TwitterCard::setDescription($model['twitter_description']);

        SEOTools::jsonLd()->addImage(URL::to(asset('assets/img/favicon.svg')));
    }

    public function loadDynamicSEO($model)
    {
        SEOTools::setTitle($model->title);
        OpenGraph::setTitle($model->title);
        TwitterCard::setTitle($model->title);

        SEOMeta::setTitle($model->seo_title ?? $model->title);
        SEOMeta::setDescription($model->seo_description);
        SEOMeta::addKeyword($model->keywords);

        OpenGraph::setTitle($model->og_title);
        OpenGraph::setDescription($model->og_description);
        OpenGraph::setUrl(URL::full());
        OpenGraph::addProperty('locale', 'en_US');
           
        JsonLd::setTitle($model->seo_title);
        JsonLd::setDescription($model->seo_description);
        JsonLd::setType('Page');

        TwitterCard::setTitle($model->twitter_title);
        TwitterCard::setSite("@aldourigroup");
        TwitterCard::setDescription($model->twitter_description);

        SEOTools::jsonLd()->addImage(URL::to(asset('assets/img/favicon.svg')));
    }
    public function home()
    {
        $page = Page::with('page_translations')->where('type','home')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);

     
        $data['home_categories'] = Cache::rememberForever('home_categories', function () {
            $categories = get_setting('home_categories');
            if ($categories) {
                $details = Category::whereIn('id', json_decode($categories))->where('is_active', 1)
                    ->get();
                return $details;
            }
        });

        $data['featured_services'] = Cache::remember('featured_services', 3600, function () {
            $service_ids = get_setting('featured_services');
            if ($service_ids) {
                $services =  Service::where('status', 1)->whereIn('id', json_decode($service_ids))->with('points')->get();
                return $services;
            }
        });

        $data['featured_products'] = Cache::remember('featured_products', 3600, function () {
            $product_ids = get_setting('featured_products');
            if ($product_ids) {
                $products =  Product::where('published', 1)->whereIn('id', json_decode($product_ids))->with('brand')->get();
                return $products;
            }
        });

        $data['points'] = HomePoints::all();
        $data['industries'] = Industries::where('status',1)->orderBy('sort_order','ASC')->get();
        $data['brands'] = Brand::where('is_active',1)->whereIn('id', json_decode(get_setting('home_brands')))->orderBy('name','ASC')->get();
        $data['blogs'] = Blog::where('status',1)->orderBy('blog_date','desc')->limit(4)->get();
       
        $data['sliders'] =  HomeSlider::where('status',1)->orderBy('sort_order','asc')->get();

        return view('frontend.home',compact('page','data','lang'));
    }

    public function about()
    {
        $page = Page::where('type','about_us')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        // DB::enableQueryLog();
        $brands = Brand::where('is_active',1)->whereIn('id', json_decode(get_setting('about_brands')))->orderBy('name','ASC')->get();
        // dd(DB::getQueryLog());
        $this->loadSEO($seo);
        return view('frontend.about',compact('page','lang','brands'));
    }

    public function terms()
    {
        $page = Page::where('type','terms')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.terms',compact('page','lang'));
    }

    public function privacy()
    {
        $page = Page::where('type','privacy_policy')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.privacy_policy',compact('page','lang'));
    }


    public function contact()
    {
        $page = Page::where('type','contact_us')->first();
        $lang = getActiveLanguage();
        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        return view('frontend.contact_us', compact('page','lang'));
    }

    public function submitContactForm(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string',
            'message' => 'required|string|max:1000',
            'g-recaptcha-response' => ['required', new Recaptcha()],
        ],[
            'g-recaptcha-response.required' => 'reCAPTCHA verification failed. Please try again.'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $con                = new Contacts;
        $con->name          = $request->name;
        $con->email         = $request->email;
        $con->phone         = $request->phone;
        $con->subject       = $request->subject;
        $con->message       = $request->message;
        $con->save();
        
        // Send an email (optional)
        Mail::to(env('MAIL_ADMIN'))->queue(new ContactEnquiry($con));

        return response()->json(['success' => true, 'message' => '<div class="alert alert-success w-50">Thank you for getting in touch. Our team will contact you shortly.</div>']);
    }

    public function changeLanguage(Request $request)
    {
       
        Session::put('locale', $request->locale);
        App::setLocale($request->locale);
    }

    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ],[
            'email.required' => trans('messages.enter_email'),
            'email.email' => trans('messages.enter_valid_email'),
            'email.unique' => trans('messages.email_already_subscribed'),
        ]);

        Subscriber::create(['email' => $request->email]);

        return response()->json(['success' => true ,'message' => trans('messages.newsletter_success')]);
    }

    public function servicesList(){

        $page = Page::where('type','service_listing')->first();
        $lang = getActiveLanguage();

        $services = Service::where('status',1)->orderBy('name','asc')->get();

        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);

        return view('frontend.services',compact('page','services', 'lang'));
    }

    public function serviceDetails($slug){
        $lang = getActiveLanguage();
        $page = Page::where('type','service_details')->first();
        $service = $publishedProducts = '';
        if($slug !=  ''){
            $service = Service::where('status',1)->where('slug', $slug)->first();
            if($service){
                $seo = [
                    'title'                 => $service->getTranslation('name', $lang),
                    'meta_title'            => $service->getTranslation('meta_title', $lang),
                    'meta_description'      => $service->getTranslation('meta_description', $lang),
                    'keywords'              => $service->getTranslation('meta_keywords', $lang),
                    'og_title'              => $service->getTranslation('og_title', $lang),
                    'og_description'        => $service->getTranslation('og_description', $lang),
                    'twitter_title'         => $service->getTranslation('twitter_title', $lang),
                    'twitter_description'   => $service->getTranslation('twitter_description', $lang),
                ];
                $this->loadSEO($seo);

                $publishedProducts = $service->products()->where('published', 1)->get();
            }
        }
        return view('frontend.service_details', compact('lang','service','page','publishedProducts'));
    }

    public function blogsList(){
        $lang = getActiveLanguage();
        $page = Page::where('type','news')->first();

        $seo = [
            'title'                 => $page->getTranslation('title', $lang),
            'meta_title'            => $page->getTranslation('meta_title', $lang),
            'meta_description'      => $page->getTranslation('meta_description', $lang),
            'keywords'              => $page->getTranslation('keywords', $lang),
            'og_title'              => $page->getTranslation('og_title', $lang),
            'og_description'        => $page->getTranslation('og_description', $lang),
            'twitter_title'         => $page->getTranslation('twitter_title', $lang),
            'twitter_description'   => $page->getTranslation('twitter_description', $lang),
        ];
        
        $this->loadSEO($seo);
        $blogs = Blog::where('status', 1)->orderBy('blog_date', 'desc')->paginate(12);

        return view('frontend.blogs',compact('page','lang','blogs'));
    }

    public function blogDetails($slug){
        $lang = getActiveLanguage();
        $page = Page::where('type','news_details')->first();
        $blog = $recentBlogs = '' ;
        if($slug !=  ''){
            $blog = Blog::where('status',1)->where('slug', $slug)->first();
            if($blog){
                $seo = [
                    'title'                 => $blog->name,
                    'meta_title'            => $blog->meta_title,
                    'meta_description'      => $blog->meta_description,
                    'keywords'              => $blog->keywords,
                    'og_title'              => $blog->og_title,
                    'og_description'        => $blog->og_description,
                    'twitter_title'         => $blog->twitter_title,
                    'twitter_description'   => $blog->twitter_description,
                ];
                $this->loadSEO($seo);

                $recentBlogs = Blog::where('id', '!=', $blog->id)
                                    ->orderBy('blog_date', 'desc')
                                    ->take(10)
                                    ->get();
            }
        }

        return view('frontend.blog_details', compact('lang','blog','page','recentBlogs'));
    }
}
