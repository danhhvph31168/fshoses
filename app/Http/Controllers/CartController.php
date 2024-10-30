<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Coupon;
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
    $cart = new Cart(); // Hoặc lấy cart đã có từ session
    $couponCode = $request->input('code'); // Lấy mã coupon từ request
    $coupon = Coupon::findByCode($couponCode); // Tìm coupon

    if ($coupon) {

        $finalPrice = $cart->getFinalPrice($coupon); // Tính giá cuối cùng

        // Xử lý hiển thị giá cuối cùng, lưu coupon vào session, v.v.
        return redirect()->back()->with('finalPrice', $finalPrice);
    } else {
        return redirect()->back()->withErrors(['code' => 'Coupon không hợp lệ!']);
    }
}

}
