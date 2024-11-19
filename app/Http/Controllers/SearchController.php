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
}