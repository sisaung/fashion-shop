<?php

use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FitController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\ProductTypeController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\WishlistController;
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
        Route::get('/get-product-types/{id}', [ProductTypeController::class, 'getProductTypes']);
        Route::resource('fit',FitController::class);
        Route::get('/get-fits/{id}', [FitController::class, 'getFits']);

        Route::resource('size',SizeController::class);
        // Route::controller(ProductController::class)->group(function () {

        //     Route::resource('product',ProductController::class);
        //     Route::get('/product/{id}/edit/manage-image','uploadProductImage')->name('product.manage-image');
        // });

        Route::resource('product', ProductController::class);

        // Route::get('/product/{id}/show/manage-image',[ProductImageController::class,'index'])->name('manage-image.index');
        Route::get('/product/{id}/edit/manage-image',[ProductImageController::class,'edit'])->name('manage-image.edit');
        Route::post('/product/{id}/edit/manage-image',[ProductImageController::class,'store'])->name('manage-image.store');
        Route::delete('/product/{id}/edit/manage-image',[ProductImageController::class,'destroy'])->name('manage-image.destroy');


        // stock
        Route::get('/product/{id}/edit/manage-stock',[StockController::class,'create'])->name('manage-stock.create');
        Route::post('/product/{id}/edit/manage-stock',[StockController::class,'store'])->name('manage-stock.store');


        Route::resource('coupon',CouponController::class);
        Route::resource('customer',CustomerController::class)->only(['index','show']);
        Route::resource('order',OrderController::class)->only(['index','show']);

        Route::resource('review',ReviewController::class)->only(['index','show','destroy']);
        Route::patch('/review/{id}/show', [ReviewController::class, 'showReview'])->name('review.show-review');

        Route::resource('wishlist',WishlistController::class)->only(['index','show']);


        // profile
        Route::controller(AdminProfileController::class)->prefix('admin-profile')->group(function () {

            Route::get('/', 'index')->name('admin-profile.index');

            Route::post('/change-profile-image', 'changeProfileImage')->name('admin-profile.change-profile-image');

            Route::get('/change-name', 'changeNameIndex')->name('admin-profile.change-name-index');
            Route::post('/change-name', 'changeName')->name('admin-profile.change-name');

            Route::get('/change-password', 'changePasswordIndex')->name('admin-profile.change-password-index');
            Route::post('/change-password', 'changePassword')->name('admin-profile.change-password');


            Route::post('/', 'update')->name('admin-profile.update');
        });


    });
});





Route::get('test', [TestController::class, 'index']);
