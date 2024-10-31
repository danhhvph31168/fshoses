<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Review;

class ProductController extends Controller
{

    public function productDetail($id)
    {
        $product = Product::query()->with(['variants', 'category'])->find($id);
        $product->galleries =  $product->galleries()->limit(4)->get();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        $comments = Review::where('product_id', $id)->orderBy('id', 'DESC')->get();
        // Lấy các sản phẩm liên quan dựa trên danh mục của sản phẩm hiện tại
        $relatedProducts = Product::with(['galleries', 'variants'])->where('category_id', $product->category_id)->where('id', '<>', $id)->limit(4)->get();
        return view('product.product-detail', compact('product', 'colors', 'sizes', 'comments', 'relatedProducts'));
    }
}
