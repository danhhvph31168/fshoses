<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\OrderHistoryController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MessageSuccessResetController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\Product\ProductController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Account\OrderSearchController;
use App\Http\Controllers\SearchController;

// product
Route::get('/',                 [ProductController::class, 'index'])->name('client.home');
Route::get('/brand/{brd}',      [ProductController::class, 'listProductByBrand'])->name('client.productByBrand');
Route::get('/category/{cate}',  [ProductController::class, 'listProductByCategory'])->name('client.productByCategory');
Route::get('/products',         [ProductController::class, 'getAllProducts'])->name('client.product-list');

// Route::get('product-detail/{slug}', [ProductController::class, 'productDetail'])->name('productDetail');
Route::get('search-order',  [OrderSearchController::class, 'showFormSearchOrder'])->name('showFormSearchOrder');
Route::post('search-order', [OrderSearchController::class, 'handleSearchOrder'])->name('handleSearchOrder');
Route::put('order/search/cancel/{slug}', [OrderSearchController::class, 'cancelOrderSearch'])->name('orders.search.cancel');

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {

        Route::get('google',            [GoogleController::class, 'redirectToGoogle'])->name('google');
        Route::get('google/callback',   [GoogleController::class, 'handleGoogleCallback']);

        Route::get('register',  [AuthenController::class, 'showFormRegister'])->name('showFormRegister');
        Route::post('register', [AuthenController::class, 'handleRegister'])->name('handleRegister');

        Route::get('login',     [AuthenController::class, 'showFormLogin'])->name('showFormLogin');
        Route::post('login',    [AuthenController::class, 'handleLogin'])->name('handleLogin');

        Route::post('logout',   [AuthenController::class, 'logout'])->name('logout');
    });

// mail
Route::get('click-to-forgot',           [AuthenController::class, 'clickToForgot'])->name('clickToForgot');
Route::post('handle-send-mail-forgot',  [AuthenController::class, 'handleSendMailForgot'])->name('handleSendMailForgot');
Route::get('click-in-email-forgot/{id}/{token}',    [AuthenController::class, 'clickInEmailForgot'])->name('clickInEmailForgot');
Route::post('handle-forgot-pass/{id}/{token}',      [AuthenController::class, 'handleForgotPass'])->name('handleForgotPass');
Route::get('handle-forgot-pass', [MessageSuccessResetController::class, 'messageSuccessReset'])->name('messageSuccessReset');

// profile
Route::middleware(['auth'])->group(function () {
    Route::get('profile', [AccountController::class, 'showFormUpdateProfile'])->name('showFormUpdateProfile');
    Route::put('profile', [AccountController::class, 'handleUpdateProfile'])->name('handleUpdateProfile');

    Route::get('change-password',   [AccountController::class, 'showFormChangePassword'])->name('showFormChangePassword');
    Route::post('change-password',  [AccountController::class, 'handleChangePassword'])->name('handleChangePassword');

    Route::post('add-comment',                      [ReviewController::class, 'handleAddComment'])->name('handleAddComment');
    Route::delete('destroy-comment/{comment_id}',   [ReviewController::class, 'handleDestroyComment'])->name('destroyComment');

    Route::get('order-history',     [OrderHistoryController::class, 'getListOrderHistory'])->name('getListOrderHistory');
});

Route::get('order-item/{slug}', [OrderHistoryController::class, 'getDetailOrderItem'])->name('getDetailOrderItem');
Route::post('order/{slug}/cancel', [OrderHistoryController::class, 'cancelOrder'])->name('orders.cancel');
Route::get('product-detail/{slug}', [ProductController::class, 'productDetail'])->name('productDetail');

// cart
Route::get('cart',          [CartController::class, 'index'])->name('cart.list');
Route::post('cart/add',     [CartController::class, 'add'])->name('cart.add');
Route::get('/cart-update',  [CartController::class, 'updateCart'])->name('cart.update');
Route::get('cart/delete',   [CartController::class, 'delete'])->name('cart.delete');
Route::delete('cart/deleteItem/{id}', [CartController::class, 'deleteItem'])->name('cart.delItem');

// checkout
Route::get('check-out',     [CheckoutController::class, 'checkOut'])->name('check-out');
Route::post('addOrder',     [CheckoutController::class, 'addOrder'])->name('addOrder');
Route::get('order-success/{sku}', [CheckoutController::class, 'orderSuccess'])->name('orderSuccess');
Route::get('vnpayReturn/{order}/{payment}',   [CheckoutController::class, 'vnpayReturn'])->name('vnpayReturn');

// auth
Route::prefix('auth')
    ->name('auth.')
    ->group(function () {

        Route::get('register',  [AuthenController::class, 'showFormRegister'])->name('showFormRegister');
        Route::post('register', [AuthenController::class, 'handleRegister'])->name('handleRegister');

        Route::get('login',     [AuthenController::class, 'showFormLogin'])->name('showFormLogin');
        Route::post('login',    [AuthenController::class, 'handleLogin'])->name('handleLogin');

        Route::post('logout',   [AuthenController::class, 'logout'])->name('logout');
    });

//search
Route::get('/search', [SearchController::class, 'search'])->name('search');

//search categories
Route::get('/search-products', [SearchController::class, 'searchProducts'])->name('search.products');
