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
        if ($totalAmount < 1000000) {
            return redirect()->route('cart.list')->with('error', 'The discount code is only applicable for orders with a total value over 1,000,000 VND');
        }
        if (!$coupon) {
            // $messages[] = 'Coupon does not exist!!';
            // return redirect()->route('cart.list')->withErrors($messages);
            return redirect()->route('cart.list')->with('error', 'Coupon does not exist!!');
        }

        if (!$coupon->is_active) {
            // $messages[] = 'Coupon is no longer valid!';
            // return redirect()->route('cart.list')->withErrors($messages);
            return redirect()->route('cart.list')->with('error', 'Coupon is no longer valid!');
        }

        $currentDate = now();
        if ($currentDate < $coupon->start_date || $currentDate > $coupon->end_date) {
            // $messages[] = 'Coupon is no longer valid!';
            // return redirect()->route('cart.list')->withErrors($messages);
            return redirect()->route('cart.list')->with('error', 'Coupon is no longer valid!');
        }

        if ($coupon->quantity <= 0) {
            // $messages[] = 'Coupon is out of stock!';
            // return redirect()->route('cart.list')->withErrors($messages);
            return redirect()->route('cart.list')->with('error', 'Coupon is out of stock!');
        }

        // Tính toán giảm giá
        // $discount = $coupon->type === 'fixed' ? $coupon->value : ($totalAmount * $coupon->value / 100);

        if ($coupon) {
            $discount = $coupon->value;
            if ($coupon->type == 'percent') {
                $totalAmount = $totalAmount * ((100 - $discount) / 100);
            } else {
                $totalAmount = $totalAmount - $discount;
            }
        } else {
            $discount  = 0;
            $totalAmount = $totalAmount - $discount;
        }

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
        return redirect()->route('cart.list')->with(['discount' => $discount]);
    }
}
