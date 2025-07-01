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
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderedCustomerController;
use App\Http\Controllers\ShopCategoryController;
use App\Http\Controllers\ShopOrderController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserReviewController;
use App\Http\Middleware\MustBeAdmin;
use Illuminate\Auth\Middleware\Authenticate;
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
        Route::resource('fit', FitController::class);
        Route::get('/get-fits/{id}', [FitController::class, 'getFits']);

        Route::resource('size', SizeController::class);
        // Route::controller(ProductController::class)->group(function () {

        //     Route::resource('product',ProductController::class);
        //     Route::get('/product/{id}/edit/manage-image','uploadProductImage')->name('product.manage-image');
        // });

        Route::resource('product', ProductController::class);

        // Route::get('/product/{id}/show/manage-image',[ProductImageController::class,'index'])->name('manage-image.index');
        Route::get('/product/{id}/edit/manage-image', [ProductImageController::class, 'edit'])->name('manage-image.edit');
        Route::post('/product/{id}/edit/manage-image', [ProductImageController::class, 'store'])->name('manage-image.store');
        Route::delete('/product/{id}/edit/manage-image', [ProductImageController::class, 'destroy'])->name('manage-image.destroy');


        // stock
        Route::get('/product/{id}/edit/manage-stock', [StockController::class, 'create'])->name('manage-stock.create');
        Route::post('/product/{id}/edit/manage-stock', [StockController::class, 'store'])->name('manage-stock.store');


        Route::resource('coupon', CouponController::class);
        Route::resource('customer', CustomerController::class)->only(['index', 'show']);


        Route::resource('order', OrderController::class)->only(['index', 'show']);

        Route::post('/order/{id}/confirm', [OrderController::class, 'confirmOrder'])->name('order.confirm');
        Route::post('/order/{id}/deliver', [OrderController::class, 'deliverOrder'])->name('order.deliver');
        Route::post('/order/{id}/complete', [OrderController::class, 'completeOrder'])->name('order.complete');
        Route::post('/order/{id}/cancel', [OrderController::class, 'cancelOrder'])->name('order.cancel');




        Route::resource('review', ReviewController::class)->only(['index', 'show', 'destroy']);
        Route::patch('/review/{id}/show', [ReviewController::class, 'showReview'])->name('review.show-review');

        Route::resource('wishlist', WishlistController::class)->only(['index', 'show']);


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


//public

Route::get('/shop', [ShopCategoryController::class,'index'])->name('shop.index');
Route::get('/shop/get', [ShopCategoryController::class, 'getShop'])->name('shop.getShop');
Route::get('/shop-product/{slug}', [ShopCategoryController::class, 'show'])->name('shop.show');


Route::get('/shop/get-brand', [ShopCategoryController::class, 'getBrand'])->name('shop.getBrand');
Route::get('/shop/filter-brand', [ShopCategoryController::class, 'filterShopProduct'])->name('shop.filterShopProduct');
Route::get('/shop/get-product-category', [ShopCategoryController::class, 'getProductCategory'])->name('shop.getProductCategory');
Route::get('/shop/filter-product-category', [ShopCategoryController::class, 'filterShopProduct'])->name('shop.filterProductCategory');

Route::get('/shop/get-product-type', [ShopCategoryController::class, 'getProductType'])->name('shop.getProductType');
Route::get('/shop/get-product-fit/{productTypeId}', [ShopCategoryController::class, 'getProductFit'])->name('shop.getProductFit');
Route::get('/shop/get-product-size/{productTypeId}', [ShopCategoryController::class, 'getProductSize'])->name('shop.getProductSize');

Route::get('/cart',[CartController::class,'index'])->name('cart.index');


Route::middleware(['auth',Authenticate::class])->group(function () {
    Route::get('/order-confirmation',[ShopOrderController::class,'index'])->name('order-confirmation.index');
    Route::post('/confirm-order',[ShopOrderController::class,'store'])->name('confirm-order.store');
    Route::get('/coupon-check',[ShopOrderController::class,'checkCoupon'])->name('coupon-check.index');
    Route::get('/delivery-address',[ShopOrderController::class,'getDeliveryAddress'])->name('delivery-address.index');

   Route::resource('address', UserProfileController ::class);

   Route::get('/account/orders',[ShopOrderController::class,'getOrders'])->name('account.orders');
   Route::get('/account/orders/{orderNumber}',[ShopOrderController::class,'showOrder'])->name('account.showOrder');
   Route::patch('/account/orders-cancel/{id}',[ShopOrderController::class,'cancelOrder'])->name('account.cancelOrder');
   Route::get('/account/profile-information',[ShopOrderController::class,'showProfileInformation'])->name('account.showProfileInformation');
   Route::post('/account/profile-information/change-profile',[UserProfileController::class,'changeProfileImage'])->name('account.changeProfileImage');
   Route::patch('/account/profile-information/change-name',[UserProfileController::class,'changeName'])->name('account.changeName');

   Route::get('/account/address',[UserProfileController::class,'addressIndex'])->name('account.addressIndex');
   Route::post('/account/address/store',[UserProfileController::class,'storeAdress'])->name('account.storeAdress');
   Route::delete('/account/address/delete/{id}',[UserProfileController::class,'destroyAddress'])->name('account.destroyAddress');
   Route::put('/account/address/update/{id}',[UserProfileController::class,'updateAddress'])->name('account.updateAddress');



   Route::post('/review-store/{productId}',[UserReviewController::class,'store'])->name('review.store');

   Route::post('/store-wishlist',[WishlistController::class,'store'])->name('wishlist.store');
   Route::get('/get-wishlist',[WishlistController::class,'getWishList'])->name('wishlist.getWishlist');
    Route::get('/wishlist',[WishlistController::class,'showWishlistShow'])->name('wishlist.showWishlistShow');
    Route::delete('/wishlist/{productId}',[WishlistController::class,'destroy'])->name('wishlist.destroy');
    Route::delete('/wishlist-destroy/{productId}',[WishlistController::class,'destroyWishlist'])->name('wishlist.destroyWishlist');



   Route::post('/store-customer',[OrderedCustomerController::class,'store'])->name('customer.store');
});

Route::get('/get-review/{productId}',[UserReviewController::class,'getshopReview'])->name('review.getReview');

Route::get('test', [TestController::class, 'index']);
