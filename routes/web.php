<?php

use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;
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
});

