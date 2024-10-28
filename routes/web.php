<?php


use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\Client\AccountController;
use App\Http\Controllers\Client\ReviewController;
use App\Http\Controllers\Product\ProductController;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

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



// Route::get('product-detail/{id}', [ProductController::class, 'productDetail'])->name('productDetail');

// Route::get('/', [UserController::class, 'dashboard'])
//     ->name('home.dashboard');

// Route::prefix('auth')
//     ->name('auth.')
//     ->group(function () {
//         Route::get('register', [AuthenController::class, 'showFormRegister'])->name('showFormRegister');
//         Route::post('register', [AuthenController::class, 'handleRegister'])->name('handleRegister');

//         Route::get('login', [AuthenController::class, 'showFormLogin'])->name('showFormLogin');
//         Route::post('login', [AuthenController::class, 'handleLogin'])->name('handleLogin');

//         Route::post('logout', [AuthenController::class, 'logout'])->name('logout');
//         // ->middleware('auth:sanctum');
//     });

// Route::get('click-to-forgot', [AuthenController::class, 'clickToForgot'])->name('clickToForgot');
// Route::post('handle-send-mail-forgot', [AuthenController::class, 'handleSendMailForgot'])->name('handleSendMailForgot');
// Route::get('click-in-email-forgot/{id}/{token}', [AuthenController::class, 'clickInEmailForgot'])->name('clickInEmailForgot');
// Route::post('handle-forgot-pass/{id}/{token}', [AuthenController::class, 'handleForgotPass'])->name('handleForgotPass');

// Route::middleware(['profile', 'auth:sanctum'])->group(function () {
//     Route::get('profile', [AccountController::class, 'showFormUpdateProfile'])->name('showFormUpdateProfile');
//     Route::put('profile', [AccountController::class, 'handleUpdateProfile'])->name('handleUpdateProfile');

//     Route::get('change-password', [AccountController::class, 'showFormChangePassword'])->name('showFormChangePassword');
//     Route::post('change-password', [AccountController::class, 'handleChangePassword'])->name('handleChangePassword');

//     Route::post('add-comment/{product_id}', [ReviewController::class, 'handleAddComment'])->name('handleAddComment');
//     // Route::get(uri: 'update-comment/{user_id}/{product_id}', [CommentController::class, 'handleUpdateComment'])->name('handleUpdateComment');
//     // Route::post('add-comment/{user_id}/{product_id}', [CommentController::class, 'handleChangePassword'])->name('handleChangePassword');
// });

// Route::get('admin', [UserController::class, 'dashboard'])
//     ->name('admin.dashboard')
//     ->middleware(['auth']);

// Route::get('admin', [AdminController::class, 'dashboard'])
//     ->name('admin.dashboard')
//     ->middleware(['auth']);

Route::get('/', function () {

    $products = Product::query()->latest('id')->limit(4)->get();

    $categories = Category::query()->get();
    
    return view('home', compact('products', 'categories'));
})->name('home');


Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

