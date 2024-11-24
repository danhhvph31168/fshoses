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
                $totalAmount += $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']);
            }
        }

        $couponCode = $request->input('code');
        $coupon = Coupon::findByCode($couponCode);

        $messages = [];
        if (!$coupon) {
            $messages[] = 'Coupon không tồn tại!';
            return redirect()->route('cart.list')->withErrors($messages);
        }

        if (!$coupon->is_active) {
            $messages[] = 'Coupon không còn hiệu lực!';
            return redirect()->route('cart.list')->withErrors($messages);
        }

        $currentDate = now();
        if ($currentDate < $coupon->start_date || $currentDate > $coupon->end_date) {
            $messages[] = 'Coupon không còn hiệu lực!';
            return redirect()->route('cart.list')->withErrors($messages);
        }

        if ($coupon->quantity <= 0) {
            $messages[] = 'Coupon đã hết số lượng!';
            return redirect()->route('cart.list')->withErrors($messages);
        }
        // Tính toán giảm giá
        $discount = $coupon->type === 'fixed' ? $coupon->value * 1000 : ($totalAmount * $coupon->value / 100);

        // Giảm số lượng coupon còn lại trong cơ sở dữ liệu
        $coupon->decrement('quantity', 1);

        // Lưu coupon vào session
        session(['coupon' => [
            'type' => $coupon->type,
            'value' => $coupon->value,
        ]]);
        session(['discount' => $discount]);

        // Chuyển hướng về view cart với thông báo thành công
        return redirect()->route('cart.list')->with(['discount' => $discount]);
    }
}
