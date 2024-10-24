<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;


class ProductController extends Controller
{

    public function productDetail($id)
    {
        $product = Product::query()->with(['variants', 'galleries', 'category'])->where('id', $id)->first();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
    
        return view('product.detail', compact('product', 'colors', 'sizes'));
    }
    
}
