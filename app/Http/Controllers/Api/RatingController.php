<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Product;
use Illuminate\Http\Request;

class RatingController extends Controller
{

    public function index()
    {
        $ratings = Rating::all(); // Lấy tất cả đánh giá
        return response()->json(['data' => $ratings], 200);
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'order_id' => 'required|integer|exists:orders,id',
            'product_id' => 'required|integer|exists:products,id',
            'value' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        // Kiểm tra xem đánh giá đã tồn tại cho user, order và product đó chưa
        $existingRating = Rating::where('user_id', $validatedData['user_id'])
            ->where('order_id', $validatedData['order_id'])
            ->where('product_id', $validatedData['product_id'])
            ->first();
//aaaa
        if ($existingRating) {
            return response()->json(['message' => 'Tài khoản đã đánh giá cho sản phẩm trong đơn hàng này.'], 400);
        }

        // Nếu chưa có đánh giá, tạo đánh giá mới
        $rating = Rating::create($validatedData);

        return response()->json($rating, 201);
    }
    public function calculateAverageRating($productId)
    {
        // Tìm sản phẩm theo ID
        $product = Product::findOrFail($productId);
        $ratings = $product->ratings;
        if ($ratings->isEmpty()) {
            $average = 0;
        } else {
            $average = $ratings->avg('value');
        }
        return response()->json([
            'product_id' => $productId,
            'average_rating' => $average
        ]);
    }
}
