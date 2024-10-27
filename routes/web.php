<?php

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

Route::get('/', function () {

    $products = Product::query()->latest('id')->limit(4)->get();

    $categories = Category::query()->get();
    
    return view('home', compact('products', 'categories'));
})->name('home');


Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');