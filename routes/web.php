<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    $products = Product::query()->latest('id')->limit(4)->get();

    $categories = Category::query()->get();
    
    return view('home', compact('products', 'categories'));
})->name('home');
