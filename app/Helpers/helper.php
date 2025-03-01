<?php

use App\Models\BusinessSetting;
use App\Utility\CategoryUtility;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Page;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Request;

// use DB;

function getMenu($id)
{
    // Cache::forget('menu_6');
    return Cache::rememberForever('menu_' . $id,  function () use ($id) {
        $menu = Menu::get($id);
        $menu_real = array();
        foreach ($menu as $key => $m) {
            $menu_real[$key] = $m;
            if ($m['img_1']) {
                $menu_real[$key]['img_1_src'] = uploaded_asset($m['img_1']);
            }
            if ($m['img_2']) {
                $menu_real[$key]['img_2_src'] = uploaded_asset($m['img_2']);
            }
            if ($m['img_3']) {
                $menu_real[$key]['img_3_src'] = uploaded_asset($m['img_3']);
            }

            if ($m['brands'] !== null) {
                $brand_ids = explode(',', $m['brands']);
                $brands = Brand::whereIn('id', $brand_ids)->select(['id', 'name', 'logo', 'slug'])->with('logoImage', function ($query) {
                    return $query->select(['id', 'file_name']);
                })->get();

                $menu_real[$key]['brands'] = $brands;
            }
        }
        return $menu_real;
    });
}


if (!function_exists('getBaseURL')) {
    function getBaseURL()
    {
        $root = '//' . $_SERVER['HTTP_HOST'];
        $root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

        return $root;
    }
}


if (!function_exists('getFileBaseURL')) {
    function getFileBaseURL()
    {
        if (env('FILESYSTEM_DRIVER') == 's3') {
            return env('AWS_URL') . '/';
        } else {
            return app('url')->asset('storage') . '/';
            // return getBaseURL();
        }
    }
}

//filter products based on vendor activation system
if (!function_exists('filter_products')) {
    function filter_products($products)
    {
        $verified_sellers = verified_sellers_id();
        if (get_setting('vendor_system_activation') == 1) {
            return $products->where('approved', '1')->where('published', '1')->where('auction_product', 0)->orderBy('created_at', 'desc')->where(function ($p) use ($verified_sellers) {
                $p->where('added_by', 'admin')->orWhere(function ($q) use ($verified_sellers) {
                    $q->whereIn('user_id', $verified_sellers);
                });
            });
        } else {
            return $products->where('published', '1')->where('auction_product', 0)->where('added_by', 'admin');
        }
    }
}


if (!function_exists('get_setting')) {
    function get_setting($key, $default = null, $lang = false)
    {
        $settings = Cache::remember('business_settings', 86400, function () {
            return BusinessSetting::all();
        });

        if ($lang == false) {
            $setting = $settings->where('type', $key)->first();
        } else {
            $setting = $settings->where('type', $key)->where('lang', $lang)->first();
            $setting = !$setting ? $settings->where('type', $key)->first() : $setting;
        }
        return $setting == null ? $default : $setting->value;
    }
}

if (!function_exists('static_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function static_asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}

//return file uploaded via uploader
if (!function_exists('uploaded_asset')) {
    function uploaded_asset($id)
    {
        if ($id && ($asset = \App\Models\Upload::find($id)) != null) {
            return $asset->external_link == null ? storage_asset($asset->file_name) : $asset->external_link;
        }

        return app('url')->asset('assets/img/placeholder.jpg');
    }
}



//highlights the selected navigation on admin panel
if (!function_exists('areActiveRoutes')) {
    function areActiveRoutes(array $routes, $output = "active")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }
    }
}

if (!function_exists('storage_asset')) {
    /**
     * Generate an asset path for the application.
     *
     * @param string $path
     * @param bool|null $secure
     * @return string
     */
    function storage_asset($path, $secure = null)
    {
        return app('url')->asset('storage/' . $path, $secure);
    }
}

if (!function_exists('formatBytes')) {
    function formatBytes($bytes, $precision = 2)
    {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
        $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}

function getAllCategories()
{
    return Cache::rememberForever('categoriesTree', function () {
        return CategoryUtility::getSidebarCategoryTree();
    });
}

function cleanSKU($sku)
{
    $sku = str_replace(' ', '', $sku);
    $sku = preg_replace('/[^a-zA-Z0-9_-]/', '', $sku);
    return $sku;
}

if (!function_exists('get_product_image')) {
    function get_product_image($path, $size = 'full')
    {
        if ($path) {
            if ($size == 'full') {
                return app('url')->asset($path);
            } else {
                $fileName = pathinfo($path)['filename'];
                $ext   = pathinfo($path)['extension'];
                $dirname   = pathinfo($path)['dirname'];
                $r_path = "{$dirname}/" . $fileName . "_{$size}px" . ".{$ext}";
                return app('url')->asset($r_path);
            }
        }

        return app('url')->asset('admin_assets/assets/img/placeholder.jpg');
    }
}

function getSidebarCategoryTree()
{
    $all_cats = Category::select([
        'id',
        'parent_id',
        'name',
        'level',
        'slug',
        'icon'
    ])->with(['child','iconImage'])->withCount('products')->where('parent_id', 0)->where('is_active', 1)->orderBy('categories.name','ASC')->get();
    foreach( $all_cats as $categ){
        $categ->icon = ($categ->iconImage?->file_name) ? storage_asset($categ->iconImage->file_name) : app('url')->asset('admin_assets/assets/img/placeholder.jpg');
        unset($categ->iconImage);
    }

    return $all_cats;
}

function getChildCategoryIds($parentId)
    {
        // Get the parent category
        $parentCategory = Category::find($parentId);

        // If the parent category doesn't exist, return an empty array or handle as needed
        if (!$parentCategory) {
            return [];
        }

        // Recursively get all child category IDs
        $childIds = getChildCategoryIdsRecursive($parentCategory);

        return $childIds;
    }

    function getChildCategoryIdsRecursive($category)
    {
        $childIds = [];

        if($category->child){
            foreach ($category->child as $child) {
                $childIds[] = $child->id;
    
                // Recursively get child category IDs for the current child
                $childIds = array_merge($childIds, getChildCategoryIdsRecursive($child));
            }
        }
        

        return $childIds;
    }



function uploadImage($type, $imageUrl, $filename = null){
    $data_url = '';

    // try {
    $ext = $imageUrl->getClientOriginalExtension();
    
    if($type == 'page'){
        $path = 'pages/';
    }else{
        $path = 'others/';
    }
    
    $filename = $path . $filename . '.' . $ext;

    $imageContents = file_get_contents($imageUrl);

    // Save the original image in the storage folder
    Storage::disk('public')->put($filename, $imageContents);
    $data_url = Storage::url($filename);
    
    return $data_url;
}

function getDirection()
{
    if (getActiveLanguage() == 'ar') {
        return 'rtl';
    }
    return 'ltr';
}

function getActiveLanguage()
{
    if (Session::exists('locale')) {
        return Session::get('locale');
    }
    return 'en';
}


function getPageData($type){
    $page = Page::where('type',$type)->first();
    return $page;
}



function getProductSkuFromSlug($slug){
    $product = Product::where('slug', $slug)->first();
    return $product->sku ?? null;
}

function getCategoryHeader(){
    $data['header_categories'] = Cache::rememberForever('header_categories', function () {
        $categories = get_setting('header_categories');
        if ($categories) {
            $details = Category::whereIn('id', json_decode($categories))->where('is_active', 1)
                ->get();
            return $details;
        }
    });

    $data['header_occasions'] = [];

    $data['header_brands'] = Cache::rememberForever('header_brands', function () {
        $header_brands = get_setting('header_brands');
        if ($header_brands) {
            $details = Brand::whereIn('id', json_decode($header_brands))->where('is_active', 1)
                ->get();
            return $details;
        }
    });

    return $data;
}

function generateUniqueSKU()
{
    do {
        $sku = random_int(10000000, 99999999); // Generates an 8-digit number
    } while (Product::where('sku', $sku)->exists());

    return $sku;
}

function footerServices(){
    $service_ids = get_setting('footer_services');
    $services = [];
    if ($service_ids) {
        $services =  Service::where('status', 1)->whereIn('id', json_decode($service_ids))->orderBy('name','asc')->get();
    }
    return $services;
}

function footerCategories(){
    $category_ids = get_setting('footer_categories');
    $categories = [];
    if ($category_ids) {
        $categories =  Category::where('is_active', 1)->where('parent_id',0)->whereIn('id', json_decode($category_ids))->orderBy('name','asc')->get();
    }
    return $categories;
}
