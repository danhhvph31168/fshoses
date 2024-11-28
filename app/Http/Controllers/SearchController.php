<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

        // Kiểm tra đầu vào hợp lệ
        if (!$query || mb_strlen($query) < 3) {
            return response()->json(['error' => 'Vui lòng nhập ít nhất 3 ký tự'], 422);
        }

        $results = Product::where('name', 'LIKE', "{$query}%")
            ->take(5)
            ->get(['name', 'slug', 'price_regular', 'img_thumbnail']);

        return response()->json($results);
    }

    public function searchProducts(Request $request)
    {
        $query = Product::query();
    
        if ($request->has('brand') && !empty($request->brand)) {
            $query->whereHas('brand', function ($q) use ($request) {
                $q->whereIn('name', (array)$request->brand);
            });
        }
    
        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->whereIn('name', (array)$request->category);
            });
        }
    
        if ($request->min_price && $request->max_price) {
            $query->whereBetween('price_regular', [(float)$request->min_price, (float)$request->max_price]);
        }
    
        $products = $query->with('brand', 'category')->get();
        $highestPrice = Product::max('price_regular'); // Lấy giá lớn nhất từ toàn bộ sản phẩm
        $maxPrice = $highestPrice ? $highestPrice + 5000000 : 5000000;
    
        $html = view('client.partials.products', compact('products'))->render();
    
        return response()->json(['html' => $html, 'maxPrice' => $maxPrice]);
    }
}