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
        if (session()->has('cart')) {
            foreach ($cart as $item) {
                $totalAmount += $item['quatity'] * ($item['price_sale'] ?: $item['price_regular']);
            }
        } else {
            $cart = [];
        }

        $couponCode = $request->input('code');
        $coupon = Coupon::findByCode($couponCode);

        $messages = [];
        if (!$coupon) {
            $messages[] = 'Coupon does not exist!';
            return redirect()->route('cart.list')->withErrors($messages);
        }
        if ($coupon->minimum_order_value >= $totalAmount) {
            $messages[] = 'Coupon codes are not eligible!';
            return redirect()->route('cart.list')->withErrors($messages);
        }
        if (!$coupon->is_active) {
            $messages[] = 'Coupon is no longer valid!';
            return redirect()->route('cart.list')->withErrors($messages);
        }

        $currentDate = now();
        if ($currentDate < $coupon->start_date || $currentDate > $coupon->end_date) {
            $messages[] = 'Coupon is no longer valid!';
            return redirect()->route('cart.list')->withErrors($messages);
        }

        if ($coupon->quantity <= 0) {
            $messages[] = 'Coupon is out of stock!';
            return redirect()->route('cart.list')->withErrors($messages);
        }
        // Kiểm tra người dùng
        $userId = auth()->id();
        $hasUsedCoupon = CouponUsage::where('user_id', $userId)->where('coupon_id', $coupon->id)->exists();
        if ($hasUsedCoupon) {
            $messages[] = 'Bạn đã sử dụng coupon này rồi!';
            return redirect()->route('cart.list')->withErrors($messages);
        }
        // Tính toán giảm giá
        $discount = $coupon->type === 'fixed' ? $coupon->value * 1000 : ($totalAmount * $coupon->value / 100);

        // Giảm số lượng coupon còn lại trong cơ sở dữ liệu


        // Lưu coupon vào session
        session(['coupon' => [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'quantity' => $coupon->quantity,
        ]]);


        // Chuyển hướng về view cart với thông báo thành công
        return redirect()->route('cart.list')->with(['discount' => $discount]);
    }
}
