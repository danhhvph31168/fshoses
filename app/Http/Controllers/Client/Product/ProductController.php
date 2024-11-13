<?php

namespace App\Http\Controllers\Client\Product;

use App\Models\Brand;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function product()
    {
        // $product = Product::query()->with(['variants', 'category', 'brand'])->latest('id')->limit(4);

        $products = Product::query()->with(['productVariants', 'category', 'brand'])->latest('id')->get();

        $categories = Category::query()->get();

        $brands = Brand::query()->get();

        return view('client.home', compact('products', 'categories', 'brands'));
    }

    public function productDetail($id)
    {
        $product = Product::query()->with(['variants', 'category'])->find($id);

        $product->galleries =  $product->galleries()->limit(4)->get();

        $colors = ProductColor::query()->pluck('name', 'id')->all();

        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        $brands = Brand::query()->pluck('name', 'id')->all();

        $comments = Review::where('product_id', $id)->orderBy('id', 'DESC')->get();

        // Lấy các sản phẩm liên quan dựa trên danh mục của sản phẩm hiện tại
        $relatedProducts = Product::with(['galleries', 'variants'])->where('category_id', $product->category_id)->where('id', '<>', $id)->limit(4)->get();

        return view('client.products.product-detail', compact('product', 'colors', 'sizes', 'comments', 'relatedProducts', 'brands'));
    }
}
