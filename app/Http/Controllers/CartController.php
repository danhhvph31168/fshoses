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
            $currentDate = now(); // Ngày hiện tại
            if ($currentDate < $coupon->start_date || $currentDate > $coupon->end_date) {
                return redirect()->back()->withErrors(['code' => 'Coupon không còn hiệu lực trong thời gian này!']);
            }
            if ($coupon->quantity <= 0) {
                return redirect()->back()->withErrors(['code' => 'Coupon đã hết số lượng!']);
            }
            //kiểm tra người dùng
            // $userId = auth()->id(); // Lấy ID người dùng hiện tại
            // $hasUsedCoupon = CouponUsage::where('user_id', $userId)->where('coupon_id', $coupon->id)->exists();

            // if ($hasUsedCoupon) {
            //     return redirect()->back()->withErrors(['code' => 'Bạn đã sử dụng coupon này rồi!']);
            // }
            $finalPrice = $cart->getFinalPrice($coupon); // Tính giá cuối cùng
            // Giảm số lượng coupon còn lại trong cơ sở dữ liệu
            $coupon->decrement('quantity', 1);
            // Xử lý hiển thị giá cuối cùng, lưu coupon vào session, v.v.
            return redirect()->back()->with('finalPrice', $finalPrice);
        } else {
            return redirect()->back()->withErrors(['code' => 'Coupon không hợp lệ!']);
        }
    }
}
