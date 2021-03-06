<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;


use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserRegisterController;
use App\Http\Controllers\User\UserMemberController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\UserBlogController;
use App\Http\Controllers\User\UserCartController;
use App\Http\Controllers\User\UserCheckoutController;
use App\Http\Controllers\User\UserOrderController;



use App\Http\Controllers\API\Admin\LoginController as AdminLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', function () {
    return view('welcome');
});

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.show_login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
        Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');

        Route::middleware('admin', 'checkStatus')->group(function() {
            Route::get('/home', [HomeController::class, 'home'])->name('admin.home');
           
            Route::get('/fetch-user', [UserController::class, 'fetchUser'])->name('admin.fetch_user');
            Route::prefix('user')->group(function() {
                Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
                Route::post('/store', [UserController::class, 'store'])->name('admin.user.store');
                Route::get('/edit/{id}', [UserController::class, 'edit'])->name('admin.user.edit');
                Route::put('/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
                Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('admin.user.delete');
                Route::put('/blocked/{id}', [UserController::class, 'blocked'])->name('admin.user.blocked');
                Route::put('/active/{id}', [UserController::class, 'active'])->name('admin.user.active');
            });

            Route::get('/fetch-product', [ProductController::class, 'fetchProduct'])->name('admin.fetch_product');
            Route::prefix('product')->group(function() {
                Route::get('/', [ProductController::class, 'index'])->name('admin.product.index');
                Route::post('/store', [ProductController::class, 'store'])->name('admin.product.store');
                Route::get('/edit', [ProductController::class, 'edit'])->name('admin.product.edit');
                Route::post('/update', [ProductController::class, 'update'])->name('admin.product.update');
                Route::put('/blocked', [ProductController::class, 'blocked'])->name('admin.product.blocked');
                Route::put('/active', [ProductController::class, 'active'])->name('admin.product.active');
                Route::delete('/delete', [ProductController::class, 'delete'])->name('admin.product.delete');
            });
        });

        Route::prefix('brand')->group(function () {
            Route::get('/index', [BrandController::class, 'index'])->name('admin.brand.index');
            Route::get('/create',[BrandController::class, 'showCreateForm'])->name('admin.brand.create');
            Route::post('/create',[BrandController::class,'create']);
            Route::get('/detail/{id}',[BrandController::class,'detail'])->name('admin.brand.detail');
            Route::put('/update/{id}', [BrandController::class,'update'])->name('admin.brand.update');
        });  
        
        Route::prefix('category')->group(function () {
            Route::get('/index', [CategoryController::class, 'index'])->name('admin.category.index');
            Route::get('/create',[CategoryController::class, 'showCreateForm'])->name('admin.category.create');
            Route::post('/create',[CategoryController::class,'create']);
            Route::get('/detail/{id}',[CategoryController::class,'detail'])->name('admin.category.detail');
            Route::put('/update/{id}', [CategoryController::class,'update'])->name('admin.category.update');
        });  
        
        Route::prefix('blog')->group(function () {
            Route::get('/index', [BlogController::class, 'index'])->name('admin.blog.index');
            Route::get('/search', [BlogController::class, 'search'])->name('admin.blog.search');
            Route::get('/create',[BlogController::class, 'showCreateForm'])->name('admin.blog.create');
            Route::post('/create',[BlogController::class,'create']);
            Route::get('/detail/{id}',[BlogController::class,'detail'])->name('admin.blog.detail');
            Route::put('/update/{id}', [BlogController::class,'update'])->name('admin.blog.update');
        });  
    });
});

Route::namespace('User')->group(function() {

    Route::get('/cart-count', [UserCartController:: class, 'cartCount'])->name('user.cart_count');
    Route::get('/fetch-cart__page', [UserCartController:: class, 'fetchCartPage'])->name('user.fetch-cart__page');
    Route::get('/fetch-mini__cart', [UserCartController:: class, 'fetchMiniCart'])->name('user.fetch-mini__cart');
    Route::prefix('cart')->group(function() {
        Route::get('/', [UserCartController:: class, 'showCart'])->name('user.show_cart');
        Route::post('/add', [UserCartController:: class, 'addCart'])->name('user.add_cart');
        Route::put('/update', [UserCartController:: class, 'updateCart'])->name('user.update_cart');
        Route::delete('/delete', [UserCartController:: class, 'deleteCart'])->name('user.delete_cart');
    });
   
    Route::middleware('checkStatus')->group(function() {
        Route::get('/', [UserHomeController::class, 'index'])->name('user.index');
        Route::get('/login', [UserLoginController::class, 'loginForm'])->name('user.show_login');
        Route::post('/login', [UserLoginController::class, 'login'])->name('user.login');
        Route::get('/register', [UserRegisterController::class, 'registerForm'])->name('user.show_register');
        Route::post('/register', [UserRegisterController::class, 'register'])->name('user.register');
        Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');

        Route::prefix('user')->group(function () {
            Route::get('/profile', [UserMemberController::class, 'showProfile'])->name('user.show_profile');
            Route::post('/update-profile', [UserMemberController::class, 'updateProfile'])->name('user.update_profile');
            Route::get('/password', [UserMemberController::class, 'showPassword'])->name('user.show_password');
            Route::post('/change-password', [UserMemberController::class, 'changePassword'])->name('user.change_password');
        });

        Route::get('fetch-product__page', [UserProductController::class, 'fetchProductPage'])->name('user.product.fetch-product__page');
        Route::get('fetch-product-detail__page', [UserProductController::class, 'fetchProductDetailPage'])->name('user.product.fetch-product-detail__page');
        Route::prefix('product')->group(function() {
            Route::get('/', [UserProductController::class, 'index'])->name('user.product.index');
            Route::get('/detail/{id}', [UserProductController::class, 'detail'])->name('user.product.detail');
        });

        Route::get('fetch-blog__page', [UserBlogController::class, 'fetchBlogPage'])->name('user.blog.fetch-blog__page');
        Route::prefix('blog')->group(function () {
            Route::get('/', [UserBlogController::class, 'index'])->name('user.blog.index');
        });

        Route::get('fetch-checkout__page', [UserCheckoutController::class, 'fetchCheckoutPage'])->name('user.checkout.fetch-checkout__page');
        Route::get('fetch-promotion__code', [UserCheckoutController::class, 'fetchPromotionCode'])->name('user.checkout.fetch-promotion__code');
        Route::prefix('checkout')->group(function () {
            Route::get('/', [UserCheckoutController::class, 'index'])->name('user.checkout');
            Route::post('/check-promotion', [UserCheckoutController::class, 'checkPromotion'])->name('user.check_promotion');
            Route::delete('/delete-promotion', [UserCheckoutController::class, 'deletePromotion'])->name('user.delete_promotion');
            Route::post('/add-order', [UserCheckoutController::class, 'addOrder'])->name('user.add_order');
        });

        Route::get('fetch-order-history__page', [UserOrderController::class, 'fetchOrderHistoryPage'])->name('user.order.order-history__page');
        Route::get('/order-history', [UserOrderController::class, 'index'])->name('user.order_history');
    });
});

