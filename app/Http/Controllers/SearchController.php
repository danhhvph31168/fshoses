<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        // Tìm kiếm trong bảng Product
        $results = Product::where('name', 'LIKE', "{$query}%") ->take(5) ->get(['name', 'slug' , 'price_regular', 'img_thumbnail']);

        return response()->json($results);
    }

    public function searchProducts(Request $request)
{
    // Query cơ bản
    $query = Product::query();

    // Lọc theo brand
    if ($request->brand) {
        $query->whereHas('brand', function ($q) use ($request) {
            $q->whereIn('name', $request->brand);
        });
    }

    // Lọc theo category
    if ($request->category) {
        $query->whereHas('category', function ($q) use ($request) {
            $q->whereIn('name', $request->category);
        });
    }

    // Lọc theo giá
    if ($request->min_price && $request->max_price) {
        $query->whereBetween('price_regular', [$request->min_price, $request->max_price]);
    }

    // Lấy dữ liệu
    $products = $query->with('brand', 'category')->get();

    // Render lại view sản phẩm
    $html = view('client.partials.products', compact('products'))->render();

    return response()->json(['html' => $html]);
}
}
