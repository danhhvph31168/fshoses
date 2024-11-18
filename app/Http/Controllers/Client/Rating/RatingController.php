<?php

namespace App\Http\Controllers\Client\Rating;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::all(); // Lấy tất cả đánh giá
        return view('ratings.index', ['ratings' => $ratings]); // Trả về view với danh sách đánh giá
    }
    public function create($orderId)
    {
        // Lấy đơn hàng để từ đó lấy sản phẩm
        $order = Order::with('orderItems.productVariant.product')->findOrFail($orderId);
        $userId = auth()->id();
        $existingRatings = Rating::where('user_id', $userId)
            ->where('order_id', $orderId)
            ->pluck('product_variant_id');

        return view('client.ratings.create', compact('order','existingRatings'));
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer|exists:users,id',
            'order_id' => 'required|integer|exists:orders,id',
            'product_variant_id' => 'required|integer|exists:product_variants,id',
            'value' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        // Kiểm tra xem đã có đánh giá cho user, order và product đó chưa
        $existingRating = Rating::where('user_id', $validatedData['user_id'])
            ->where('order_id', $validatedData['order_id'])
            ->where('product_variant_id', $validatedData['product_variant_id'])
            ->first();

        if ($existingRating) {
            return redirect()->back()->withErrors(['message' => 'Tài khoản đã đánh giá cho sản phẩm trong đơn hàng này.']);
        }

        // Nếu chưa có đánh giá, tạo đánh giá mới
        $rating = Rating::create($validatedData);

        return redirect()->back()->with('message', 'Đánh giá đã được lưu thành công!');
    }

    public function calculateAverageRating($productId)
    {
        $product = Product::findOrFail($productId);
        $ratings = $product->ratings;
        $average = $ratings->isEmpty() ? 0 : $ratings->avg('value');

        return view('products.show', [
            'product' => $product,
            'average_rating' => $average
        ]);
    }
}
