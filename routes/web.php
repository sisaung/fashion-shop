<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FitController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\MustBeAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


Route::controller(AuthController::class)->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', 'showLogin')->name('login');
        Route::post('login', 'login')->name('login.post');
        Route::get('register', 'showRegister')->name('register');
        Route::post('register', 'register')->name('register.post');
    });
    Route::post('logout', 'logout')->name('logout')->middleware('auth');
});

Route::middleware(['auth', MustBeAdmin::class])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::prefix('dashboard')->group(function () {

        Route::resource('brand', BrandController::class);
        Route::resource('product-category', ProductCategoryController::class);
        Route::resource('product-type', ProductTypeController::class);
        Route::resource('fit',FitController::class);
    });
});

//test

Route::get('test', [TestController::class, 'index']);
