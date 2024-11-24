<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Client\Product\ProductController;
use App\Http\Controllers\Client\{CartController, CheckoutController, ReviewController, SearchController};
use App\Http\Controllers\Account\{AccountController, OrderHistoryController, OrderSearchController};
use App\Http\Controllers\Auth\{AuthenController, GoogleController, MessageSuccessResetController};

// product
Route::get('/',                     [ProductController::class, 'index'])->name('client.home');
Route::get('product-detail/{slug}', [ProductController::class, 'productDetail'])->name('productDetail');

// page product
Route::get('/brand/{brd}',      [ProductController::class, 'listProductByBrand'])->name('client.productByBrand');
Route::get('/category/{cate}',  [ProductController::class, 'listProductByCategory'])->name('client.productByCategory');
Route::get('/products',         [ProductController::class, 'getAllProducts'])->name('client.product-list');

// orderSearch
Route::get('search-order',  [OrderSearchController::class, 'showFormSearchOrder'])->name('showFormSearchOrder');
Route::post('search-order', [OrderSearchController::class, 'handleSearchOrder'])->name('handleSearchOrder');

// auth
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

    Route::get('change-password', [AccountController::class, 'showFormChangePassword'])->name('showFormChangePassword');
    Route::post('change-password',[AccountController::class, 'handleChangePassword'])->name('handleChangePassword');

    Route::post('add-comment',                   [ReviewController::class, 'handleAddComment'])->name('handleAddComment');
    Route::delete('destroy-comment/{comment_id}',[ReviewController::class, 'handleDestroyComment'])->name('destroyComment');

    Route::get('order-history',     [OrderHistoryController::class, 'getListOrderHistory'])->name('getListOrderHistory');
    Route::get('order-item/{slug}', [OrderHistoryController::class, 'getDetailOrderItem'])->name('getDetailOrderItem');
});

// cart
Route::get('cart',          [CartController::class, 'index'])->name('cart.list');
Route::post('cart/add',     [CartController::class, 'add'])->name('cart.add');
Route::get('/cart-update',  [CartController::class, 'updateCart'])->name('cart.update');
Route::get('cart/delete',   [CartController::class, 'delete'])->name('cart.delete');
Route::delete('cart/deleteItem/{id}', [CartController::class, 'deleteItem'])->name('cart.delItem');

// checkout
Route::get('check-out',     [CheckoutController::class, 'checkOut'])->name('check-out');
Route::post('addOrder',     [CheckoutController::class, 'addOrder'])->name('addOrder');
Route::get('order-success', [CheckoutController::class, 'orderSuccess'])->name('orderSuccess');
Route::get('vnpayReturn/{order}/{payment}',   [CheckoutController::class, 'vnpayReturn'])->name('vnpayReturn');

//search
Route::get('/search',           [SearchController::class, 'search'])->name('search');
Route::get('/search-products',  [SearchController::class, 'searchProducts'])->name('search.products');
