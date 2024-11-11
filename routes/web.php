<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Auth\AuthenController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MessageSuccessResetController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\CheckoutController;
use App\Http\Controllers\Client\ProductController;
use App\Http\Controllers\Client\ReviewController;

// product
Route::get('/', function () {
    $products = Product::query()->latest('id')->limit(4)->get();
    $categories = Category::query()->get();

    return view('home', compact('products', 'categories'));
})->name('home');

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
Route::get('order-success', [CheckoutController::class, 'orderSuccess'])->name('orderSuccess');

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

// mail
Route::get('click-to-forgot',               [AuthenController::class, 'clickToForgot'])->name('clickToForgot');
Route::post('handle-send-mail-forgot',      [AuthenController::class, 'handleSendMailForgot'])->name('handleSendMailForgot');
Route::get('click-in-email-forgot/{id}/{token}',    [AuthenController::class, 'clickInEmailForgot'])->name('clickInEmailForgot');
Route::post('handle-forgot-pass/{id}/{token}',      [AuthenController::class, 'handleForgotPass'])->name('handleForgotPass');
Route::get('handle-forgot-pass',                    [MessageSuccessResetController::class, 'messageSuccessReset'])->name('messageSuccessReset');

// profile
Route::middleware(['profile', 'auth:sanctum'])->group(function () {

    Route::get('profile/{id}',  [AccountController::class, 'showFormUpdateProfile'])->name('showFormUpdateProfile');
    Route::put('profile',       [AccountController::class, 'handleUpdateProfile'])->name('handleUpdateProfile');

    Route::get('change-password',   [AccountController::class, 'showFormChangePassword'])->name('showFormChangePassword');
    Route::post('change-password',  [AccountController::class, 'handleChangePassword'])->name('handleChangePassword');

    Route::post('add-comment',                      [ReviewController::class, 'handleAddComment'])->name('handleAddComment');
    Route::delete('destroy-comment/{comment_id}',   [ReviewController::class, 'handleDestroyComment'])->name('destroyComment');
});
