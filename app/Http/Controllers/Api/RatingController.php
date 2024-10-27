<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        // Lấy tất cả đánh giá
        $ratings = Rating::all();
        return response()->json(
            ['data' => $ratings,
        ],200);
    }

    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        $orderId = $request->input('order_id');
        $productId = $request->input('product_id');
        $value = $request->input('value');
        $comment = $request->input('comment');

        // Kiểm tra xem đánh giá đã tồn tại cho user, order và product đó chưa
        $existingRating = Rating::where('user_id', $userId)
            ->where('order_id', $orderId)
            ->where('product_id', $productId)
            ->first();

        if ($existingRating) {
            return response()->json(['message' => 'Tài khoản đã đánh giá cho sản phẩm trong order này'], 400);
        }

        // Nếu chưa có đánh giá, tạo đánh giá mới
        $rating = new Rating();
        $rating->user_id = $userId;
        $rating->order_id = $orderId;
        $rating->product_id = $productId;
        $rating->value = $value;
        $rating->comment = $comment;
        $rating->save();

        return response()->json($rating, 201);
    }

}


