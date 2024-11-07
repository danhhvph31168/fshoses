<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Auth\AuthenController;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MessageSuccessResetController;
use App\Http\Controllers\Client\Product\ProductController;
use App\Http\Controllers\Review\ReviewController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('product-detail/{slug}', [ProductController::class, 'productDetail'])->name('productDetail');

// Route::get('/', [UserController::class, 'dashboard'])
//     ->name('home.dashboard');

Route::prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('register', [AuthenController::class, 'showFormRegister'])->name('showFormRegister');
        Route::post('register', [AuthenController::class, 'handleRegister'])->name('handleRegister');

        Route::get('login', [AuthenController::class, 'showFormLogin'])->name('showFormLogin');
        Route::post('login', [AuthenController::class, 'handleLogin'])->name('handleLogin');

        Route::post('logout', [AuthenController::class, 'logout'])->name('logout');
        // ->middleware('auth:sanctum');
    });

Route::get('click-to-forgot', [AuthenController::class, 'clickToForgot'])->name('clickToForgot');
Route::post('handle-send-mail-forgot', [AuthenController::class, 'handleSendMailForgot'])->name('handleSendMailForgot');
Route::get('click-in-email-forgot/{id}/{token}', [AuthenController::class, 'clickInEmailForgot'])->name('clickInEmailForgot');
Route::post('handle-forgot-pass/{id}/{token}', [AuthenController::class, 'handleForgotPass'])->name('handleForgotPass');
Route::get('handle-forgot-pass', [MessageSuccessResetController::class, 'messageSuccessReset'])->name('messageSuccessReset');


Route::middleware(['auth'])->group(function () {
    Route::get('profile/{id}', [AccountController::class, 'showFormUpdateProfile'])->name('showFormUpdateProfile');
    Route::put('profile', [AccountController::class, 'handleUpdateProfile'])->name('handleUpdateProfile');

    Route::get('change-password', [AccountController::class, 'showFormChangePassword'])->name('showFormChangePassword');
    Route::post('change-password', [AccountController::class, 'handleChangePassword'])->name('handleChangePassword');

    Route::post('add-comment/{product_id}', [ReviewController::class, 'handleAddComment'])->name('handleAddComment');
        Route::delete('destroy-comment/{product_id}', [ReviewController::class, 'handleDestroyComment'])->name('destroyComment');
    // Route::get('edit-comment/{product_id}', [ReviewController::class, 'showEditForm'])->name('editComment');
    // Route::post('update-comment/{product_id}', [ReviewController::class, 'handleUpdateComment'])->name('updateComment');

});

Route::get('/', function () {

    $products = Product::query()->latest('id')->limit(4)->get();

    $categories = Category::query()->get();
    
    return view('home', compact('products', 'categories'));
})->name('home');


