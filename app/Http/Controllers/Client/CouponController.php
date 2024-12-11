<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\CouponUsage;

class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $cart = session('cart');

        $totalAmount = 0;

        // Tính toán tổng giá trị đơn hàng
        if ($cart) {
            foreach ($cart as $item) {
                $price =  $item['price_regular'] * ((100 - $item['price_sale']) / 100);
                $totalAmount += $item['quatity'] * ($price ?: $item['price_regular']);
            }
        }

        $couponCode = $request->input('code');
        $coupon = Coupon::findByCode($couponCode);

        // $messages = [];
        if (trim($couponCode) == '') {
            return redirect()->route('check-out')->with('error', 'Please enter coupon code');
        }
        if (!$coupon) {
            return redirect()->route('check-out')->with('error', 'Coupon does not exist!!');
        }

        if (!$coupon->is_active) {
            return redirect()->route('check-out')->with('error', 'Coupon is no longer valid!');
        }

        $currentDate = now();
        if ($currentDate < $coupon->start_date || $currentDate > $coupon->end_date) {
            return redirect()->route('check-out')->with('error', 'Coupon is no longer valid!');
        }

        if ($coupon->quantity <= 0) {
            return redirect()->route('check-out')->with('error', 'Coupon is out of stock!');
        }

        // Kiểm tra người dùng
        $userId = auth()->id();
        $hasUsedCoupon = CouponUsage::where('user_id', $userId)->where('coupon_id', $coupon->id)->exists();
        if ($hasUsedCoupon) {
            return redirect()->route('check-out')->with('error', 'The discount code has been used!');
        }

        // Tính toán giảm giá
        $discount = $coupon->type === 'fixed' ? $coupon->value : ($totalAmount * $coupon->value / 100);

        // Lưu coupon vào session
        session(['coupon' => [
            'coupon_id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'quantity' => $coupon->quantity
        ]]);

        session([
            'discount' => $discount
        ]);

        session()->put('cart', $cart);


        // Chuyển hướng về view cart với thông báo thành công
        return redirect()->route('check-out')->with(['discount' => $discount]);
    }
}
