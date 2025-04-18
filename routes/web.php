<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ForgotPasswordController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about_us');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact-us', [FrontendController::class, 'submitContactForm'])->name('contact.send');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/product-detail/{slug}/{sku}', [ProductController::class, 'productDetails'])->name('product-detail');

Route::post('/product-enquiry', [ProductController::class, 'storeProductEnquiry'])->name('product.enquiry');

Route::get('/services', [FrontendController::class, 'servicesList'])->name('services.index');
Route::get('/service/{slug}', [FrontendController::class, 'serviceDetails'])->name('service-detail');

Route::post('/subscribe', [FrontendController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/blogs', [FrontendController::class, 'blogsList'])->name('blogs.index');
Route::get('/blog-detail/{slug}', [FrontendController::class, 'blogDetails'])->name('blog-detail');

Route::get('/category/{category_slug}', [SearchController::class, 'listingByCategory'])->name('products.category');




