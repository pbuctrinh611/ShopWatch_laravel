<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\LoginController;
use App\Http\Controllers\API\Admin\HomeController;

use App\Http\Controllers\API\User\UserLoginController;
use App\Http\Controllers\API\User\UserRegisterController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Admin')->group(function () {
    Route::prefix('admin')->group(function () {
        //Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.show_login');
        Route::post('/login', [LoginController::class, 'login'])->name('admin.login');
        //Route::get('/logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
            Route::get('/home', [HomeController::class, 'home'])->name('admin.home');
        });
    });
});

Route::namespace('User')->group(function () {
    Route::post('/login', [UserLoginController::class, 'login'])->name('user.login');
    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::post('/logout', [UserLoginController::class, 'logout'])->name('user.logout');
    });
});
