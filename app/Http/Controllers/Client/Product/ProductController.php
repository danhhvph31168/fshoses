<?php

namespace App\Http\Controllers\Client\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\Review;

class ProductController extends Controller
{

    public function productDetail($slug)
    {
        $product = Product::query()->with(['variants', 'category'])->where('slug', $slug)->first(); 
        
        // Kiểm tra sản phẩm có tồn tại hay không
        if (!$product) {
            abort(404); 
        }
          // Lấy 4 hình ảnh của sản phẩm galleries
        $product->galleries =  $product->galleries()->limit(4)->get();

        // Lấy danh sách màu sắc và kích thước
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();

        // Lấy các bình luận cho sản phẩm
        $comments = Review::where('product_id', $product->id)->orderBy('id', 'DESC')->get();
        // Lấy các sản phẩm liên quan dựa trên danh mục của sản phẩm hiện tại
        $relatedProducts = Product::with(['galleries', 'variants'])->where('category_id', $product->category_id)->where('id', '<>',$product->id)->limit(4)->get();
        return view('client.products.product-detail', compact('product', 'colors', 'sizes', 'comments', 'relatedProducts'));
    }
}
