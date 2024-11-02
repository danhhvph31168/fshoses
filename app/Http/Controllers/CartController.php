<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        return view("home.cart", compact('cart'));
    }
    public function add(Request $request, Cart $cart)
    {
        $product = Product::find($request->id);
        $quantity = $request->quantity;
        $cart->add($product, $quantity);


        return redirect()->route('cart.index');
    }
    public function deleteItem($id)
    {
        $cart = session('cart');

        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($cart[$key]);
            }
        }

        session()->put('cart', $cart);
    }
    public function updateCart(Request $request, $id)
    {
        $cart = session('cart');

        foreach ($cart as $item) {
            $item['quantity'] = $request->query('quantity');
        }
        Log::info($cart);

        session()->put('cart', $cart);
    }

    public function applyCoupon(Request $request)
    {


        $cart = new Cart();
        $couponCode = $request->input('code');
        $coupon = Coupon::findByCode($couponCode);

        if (!$coupon) {
            return response()->json(['message' => 'Coupon không hợp lệ!'], 400);
        }

        $currentDate = now();
        if ($currentDate < $coupon->start_date || $currentDate > $coupon->end_date) {
            return response()->json(['message' => 'Coupon không còn hiệu lực trong thời gian này!'], 400);
        }
        if ($coupon->quantity <= 0) {
            return response()->json(['message' => 'Coupon đã hết số lượng!'], 400);
        }

        // Kiểm tra người dùng
        $userId = auth()->id();
        $hasUsedCoupon = CouponUsage::where('user_id', $userId)->where('coupon_id', $coupon->id)->exists();

        if ($hasUsedCoupon) {
            return response()->json(['message' => 'Bạn đã sử dụng coupon này rồi!'], 400);
        }

        $finalPrice = $cart->getFinalPrice($coupon);

        // Giảm số lượng coupon còn lại trong cơ sở dữ liệu
        $coupon->decrement('quantity', 1);

        // Thay vì redirect, trả về phản hồi JSON với giá cuối cùng
        return response()->json([
            'finalPrice' => $finalPrice,
            'message' => 'Coupon áp dụng thành công!',
        ], 200);
    }
}
