<?php

namespace App\Http\Controllers\Client\Coupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\CouponUsage;
class CouponController extends Controller
{
    public function applyCoupon(Request $request)
    {
        $cart = new Cart();
        $couponCode = $request->input('code');
        $coupon = Coupon::findByCode($couponCode);

        $messages = [];
        if (!$coupon->is_active) {
            $messages[] = 'Coupon không tồn tại!';
            return redirect()->route('cart.index')->withErrors($messages);
        }
        if (!$coupon) {
            $messages[] = 'Coupon không tồn tại!';
            return redirect()->route('cart.index')->withErrors($messages);
        }

        $currentDate = now();
        if ($currentDate < $coupon->start_date || $currentDate > $coupon->end_date) {
            $messages[] = 'Coupon không tồn tại!';
            return redirect()->route('cart.index')->withErrors($messages);
        }
        if ($coupon->quantity <= 0) {
            $messages[] = 'Coupon đã hết số lượng!';
            return redirect()->route('cart.index')->withErrors($messages);
        }

        // Kiểm tra người dùng
        $userId = auth()->id();
        $hasUsedCoupon = CouponUsage::where('user_id', $userId)->where('coupon_id', $coupon->id)->exists();

        if ($hasUsedCoupon) {
            $messages[] = 'Bạn đã sử dụng coupon này rồi!';
            return redirect()->route('cart.view')->withErrors($messages);
        }

        $finalPrice = $cart->getFinalPrice($coupon);

        // Giảm số lượng coupon còn lại trong cơ sở dữ liệu
        $coupon->decrement('quantity', 1);
        session(['coupon' => [
            'type' => $coupon->type, // Loại coupon: 'fixed' hoặc 'percentage'
            'value' => $coupon->value, // Giá trị giảm giá
        ]]);
        // Chuyển hướng về view cart với thông báo thành công
        return redirect()->route('cart.index')->with([
            'finalPrice' => $finalPrice,
            'message' => 'Coupon áp dụng thành công!',
        ]);
    }
}
