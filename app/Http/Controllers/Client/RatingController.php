<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Product;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function index()
    {
        $ratings = Rating::all(); // Lấy tất cả đánh giá
        return view('ratings.index', ['ratings' => $ratings]); // Trả về view với danh sách đánh giá
    }

    public function create($productId, $orderId)
    {
        $product = Product::findOrFail($productId);

        return view('client.ratings.create', compact('product'));
    }


    public function store(Request $request, Product $product, Order $order, Rating $ratings)
    {
        // dd($request->all());
        if (!$request->value) {
            toastr()->error('value is required');
        }

        $request->validate([
            'value' => 'required|numeric|min:1|max:5',
            'comment' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        // Kiểm tra xem đã có đánh giá cho user, order và product đó chưa
        $existingRating = Rating::where('order_id', $request->order_id)
            ->where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();
            
        if ($existingRating) {
            return redirect()->back()->with(['error', 'Tài khoản đã đánh giá cho sản phẩm trong đơn hàng này.']);
        }

        // Nếu chưa có đánh giá, tạo đánh giá mới
        Rating::create([
            'user_id' => $request->user_id,
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'value' => $request->value,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Thank you for reviewing the product');
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
