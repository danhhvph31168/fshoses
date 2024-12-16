<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->get('query');

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
            })->orderByDesc('id')->where('is_active', '1');
        }

        if ($request->has('category') && !empty($request->category)) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->whereIn('id', (array)$request->category);
            })->orderByDesc('id')->where('is_active', '1');
        }

        if ($request->min_price) {
            $query->where(function ($q) use ($request) {
                $q->whereRaw('price_regular * (1 - price_sale / 100) >= ?', [(float)$request->min_price])
                    ->orWhere(function ($q) use ($request) {
                        $q->whereNull('price_sale')
                            ->where('price_regular', '>=', (float)$request->min_price);
                    });
            });
        }

        $products = $query->with('brand', 'category')->orderByDesc('id')->where('is_active', '1')->paginate(6);

        $highestPrice = Product::max('price_regular');
        $maxPrice = $highestPrice ? $highestPrice + 500000 : 500000;

        $html = view('client.partials.products', compact('products'))->render();

        return response()->json([
            'html' => $html,
            'maxPrice' => $maxPrice,
            'pagination' => $products->links('pagination::bootstrap-5')->toHtml(),
        ]);
    }
}
