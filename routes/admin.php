<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AizUploadController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\WebsiteController;
use App\Http\Controllers\Admin\Bannercontroller;
use App\Http\Controllers\Admin\OccasionController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\BusinessSettingsController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\PartnersController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\IndustriesController;


Route::group(['middleware' => ['guest']], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AuthController::class, 'login']);
    
});

Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/', [AdminController::class, 'admin_dashboard'])->name('admin.dashboard');
    Route::get('/cache-cache', [AdminController::class, 'clearCache'])->name('cache.clear');

    Route::resource('roles', RoleController::class);
    Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('/roles/destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::resource('staffs', StaffController::class);
    Route::get('/staffs/destroy/{id}', [StaffController::class, 'destroy'])->name('staffs.destroy');

    Route::post('/banners/get_form', [Bannercontroller::class, 'get_form'])->name('banners.get_form');
    Route::get('/banners/destroy/{banner}', [Bannercontroller::class, 'destroy'])->name('banners.destroy');
    Route::resource('banners', Bannercontroller::class)->except(['show', 'destroy']);
    Route::get('/banners/edit/{id}', [Bannercontroller::class, 'edit'])->name('banners.edit');

    Route::get('/enquiries-contact', [PageController::class, 'enquiries'])->name('enquiries.contact');
    // website setting
    Route::group(['prefix' => 'website'], function () {
        Route::get('/footer', [WebsiteController::class, 'footer'])->name('website.footer');

        Route::get('/menu', [WebsiteController::class, 'menu'])->name('website.menu');
        Route::post('/menu', [WebsiteController::class, 'menuUpdate']);

        Route::get('/header', [WebsiteController::class, 'header'])->name('website.header');
        
        Route::post('/home-slider/update-status', [HomeSliderController::class, 'updateStatus'])->name('home-slider.update-status');
        Route::get('/home-slider/delete/{id}', [HomeSliderController::class, 'destroy'])->name('home-slider.delete');
        Route::resource('home-slider', HomeSliderController::class);

        Route::resource('custom-pages', PageController::class);
        Route::get('/pages', [PageController::class, 'index'])->name('website.pages');
        Route::get('/custom-pages/edit/{id}', [PageController::class, 'edit'])->name('custom-pages.edit');
        Route::get('/custom-pages/destroy/{id}', [PageController::class, 'destroy'])->name('custom-pages.destroy');
        Route::post('/page/delete_image', [PageController::class, 'delete_image'])->name('page.delete_image');

        // Partners
        Route::resource('partners', PartnersController::class)->except('show');
        Route::get('/partners/delete/{id}', [PartnersController::class, 'destroy'])->name('partners.delete');

        Route::get('/industries/all', [IndustriesController::class, 'index'])->name('industries.index');
        Route::get('/industries/create', [IndustriesController::class, 'create'])->name('industries.create');
        Route::post('/industries/store/', [IndustriesController::class, 'store'])->name('industries.store');
        Route::get('/industries/edit/{id}', [IndustriesController::class, 'edit'])->name('industries.edit');
        Route::post('/industries/update/{id}', [IndustriesController::class, 'update'])->name('industries.update');
        Route::post('/industries/status', [IndustriesController::class, 'updateStatus'])->name('industries.status');
        Route::get('/industries/delete/{id}', [IndustriesController::class, 'destroy'])->name('industries.delete');

    });

    // Brands
    Route::resource('brands', BrandController::class);
    Route::get('/brands/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit');
    Route::post('/brands/status', [BrandController::class, 'updateStatus'])->name('brands.status');

    // uploaded files
    Route::any('/uploaded-files/file-info', [AizUploadController::class, 'file_info'])->name('uploaded-files.info');
    Route::resource('/uploaded-files', AizUploadController::class);
    Route::get('/uploaded-files/destroy/{id}', [AizUploadController::class, 'destroy'])->name('uploaded-files.destroy');
    Route::post('/aiz-uploader', [AizUploadController::class, 'show_uploader']);
    Route::post('/aiz-uploader/upload', [AizUploadController::class, 'upload']);
    Route::get('/aiz-uploader/get_uploaded_files', [AizUploadController::class, 'get_uploaded_files']);
    Route::post('/aiz-uploader/get_file_by_ids', [AizUploadController::class, 'get_preview_files']);
    Route::get('/aiz-uploader/download/{id}', [AizUploadController::class, 'attachment_download'])->name('download_attachment');

    // Categories
    Route::get('/generate-slug', [CategoryController::class, 'generateSlug'])->name('generate-slug');
    Route::resource('categories', CategoryController::class)->except(['destroy']);
    Route::get('/categories/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::post('/categories/status', [CategoryController::class, 'updateStatus'])->name('categories.status');

    Route::get('/products/all', [ProductController::class, 'all_products'])->name('products.all');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products/store/', [ProductController::class, 'store'])->name('products.store');
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::post('/products/add-attributes', [ProductController::class, 'get_attribute_values'])->name('products.add-attributes');
    Route::get('/products/admin/{id}/edit', [ProductController::class, 'admin_product_edit'])->name('products.edit');
    Route::post('/products/todays_deal', [ProductController::class, 'updateTodaysDeal'])->name('products.todays_deal');
    Route::post('/products/published', [ProductController::class, 'updatePublished'])->name('products.published');
    Route::post('/products/approved', [ProductController::class, 'updateProductApproval'])->name('products.approved');
    Route::post('/products/featured', [ProductController::class, 'updateFeatured'])->name('products.featured');
    Route::post('/bulk-product-delete', [ProductController::class, 'bulk_product_delete'])->name('bulk-product-delete');
    Route::post('/products/delete-variant-image', [ProductController::class, 'delete_variant_image'])->name('products.delete_varient_image');
    Route::post('/products/delete-thumbnail', [ProductController::class, 'delete_thumbnail'])->name('products.delete_thumbnail');
    Route::post('/products/delete_gallery', [ProductController::class, 'delete_gallery'])->name('products.delete_gallery');
    Route::get('/products/delete/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    Route::post('/business-settings/update', [BusinessSettingsController::class, 'update'])->name('business_settings.update');

    // Manage services

    Route::get('/service/all', [ServiceController::class, 'index'])->name('service.index');
    Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/service/store/', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/service/edit/{id}', [ServiceController::class, 'edit'])->name('service.edit');
    Route::post('/service/update/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::post('/service/status', [ServiceController::class, 'updateStatus'])->name('service.status');
    Route::get('/service/delete/{id}', [ServiceController::class, 'destroy'])->name('service.delete');


    //Manage faq categories
    Route::get('/faq_categories/all', [FaqCategoryController::class, 'index'])->name('faq_categories.index');
    Route::get('/faq_categories/create', [FaqCategoryController::class, 'create'])->name('faq_categories.create');
    Route::post('/faq_categories/store/', [FaqCategoryController::class, 'store'])->name('faq_categories.store');
    Route::get('/faq_categories/edit/{id}', [FaqCategoryController::class, 'edit'])->name('faq_categories.edit');
    Route::post('/faq_categories/update/{id}', [FaqCategoryController::class, 'update'])->name('faq_categories.update');
    Route::post('/faq_categories/status', [FaqCategoryController::class, 'updateStatus'])->name('faq_categories.status');
    Route::get('/faq_categories/delete/{id}', [FaqCategoryController::class, 'destroy'])->name('faq_categories.delete');

    Route::get('/faqs/edit/{id}', [FaqCategoryController::class, 'getAllCategoryFaqs'])->name('faqs.edit');
    Route::post('/faqs/update', [FaqCategoryController::class, 'updateFaq'])->name('faqs.update');

    // Manage Blogs
    
    Route::get('/blogs/all', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store/', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::post('/blog/status', [BlogController::class, 'updateStatus'])->name('blog.status');
    Route::get('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
});