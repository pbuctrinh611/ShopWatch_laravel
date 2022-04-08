<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\HomeController;

use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserHomeController;


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

        Route::middleware('admin')->group(function() {
            Route::get('/home', [HomeController::class, 'home'])->name('admin.home');
        });
    });
});

Route::namespace('User')->group(function() {
    Route::middleware('checkStatus')->group(function() {
        Route::get('/', [UserHomeController::class, 'index'])->name('user.index');
        Route::get('/login', [UserLoginController::class, 'loginForm'])->name('user.show_login');
        Route::post('/login', [UserLoginController::class, 'login'])->name('user.login');
        Route::get('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
    });
});