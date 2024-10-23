<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function productDetail(Request $request)
    {
        // Tìm sản phẩm theo ID, hoặc trả về lỗi nếu không tìm thấy
        $product = Product::findOrFail($request->id);

        // Trả về JSON
        // return response()->json([
        //     'status' => 'success',
        //     'data' => $product
        // ]);

        // Nếu bạn sử dụng view, trả về view với dữ liệu sản phẩm
        return view('product.detail', compact('product'));
    }
}
