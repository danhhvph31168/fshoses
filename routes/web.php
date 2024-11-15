<?php

use App\Http\Controllers\Auth\AuthenController;
use App\Http\Controllers\Client\Product\ProductController;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


// Route::get('/', function () {

//     // $products = Product::query()->with('category', 'brand')->latest('id')->get();

//     // $categories = Category::query()->get();

//     // $brands = Brand::query()->get();

//     return view('client.home');
// })->name('home');

Route::get('/', [ProductController::class, 'index'])->name('client.home');

Route::get('/brand/{brd}',  [ProductController::class, 'listProductByBrand'])->name('client.productByBrand');
Route::get('/category/{cate}',  [ProductController::class, 'listProductByCategory'])->name('client.productByCategory');


Route::get('auth/login', [AuthenController::class, 'showFormLogin'])->name('login');
Route::post('auth/login', [AuthenController::class, 'handleLogin']);

Route::get('auth/register', [AuthenController::class, 'showFormRegister'])->name('register');
Route::post('auth/register', [AuthenController::class, 'handleRegister']);

Route::post('auth/logout', [AuthenController::class, 'logout'])->name('logout');
