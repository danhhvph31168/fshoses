<?php

namespace App\Http\Controllers\Client\Cart;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Cart;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Cart $cart)
    {
        return view("Cart.cart", compact('cart'));
    }
    public function add(Request $request, Cart $cart)
    {
        $product = Product::find($request->id);
        $quantity = $request->quantity;
        $img_thumbnail = $request->img_thumbnail;
        $cart->add($product, $quantity, $img_thumbnail);
        return redirect()->route('cart.index');
    }
    public function delete($id)
    {
        $cart = session('cart');

        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($cart[$key]);
            }
        }
        session()->put('cart', $cart);
        return redirect()->route('cart.index');
    }
    public function updateCart(Request $request)
    {
        // Kiểm tra id và quantity để đảm bảo chúng hợp lệ
        $request->validate([
            'id' => 'required|integer',
            'quantity' => 'required|integer|min:1',
        ]);

        // Lấy id và quantity từ request
        $id = $request->input('id');
        $quantity = $request->input('quantity');

        // Lấy giỏ hàng từ session và kiểm tra xem sản phẩm có tồn tại không
        $cart = session('cart', []);
        if (!isset($cart[$id])) {
            return response()->json(['error' => 'Item not found in cart'], 400);
        }

        // Cập nhật số lượng và tính lại tổng giá cho sản phẩm đó
        $cart[$id]['quantity'] = $quantity;
        $cart[$id]['total_price'] = $cart[$id]['price'] * $quantity;
        // Lưu giỏ hàng đã cập nhật vào session
        session()->put('cart', $cart);
        //Tính tổng giá giỏ hàng
        $totalCart = 0;
        foreach ($cart as $item) {
            $totalCart += $item['price'] * $item['quantity'];
        }

        // Trả về kết quả cho AJAX
        return response()->json([
            'data' => [
                'price' => $cart[$id]['total_price'],
                "total_cart" => $totalCart
            ]
        ], 200);
    }
    public function applyCoupon(Request $request)
    {
        // Lấy mã giảm giá từ yêu cầu người dùng
        $couponCode = $request->input('coupon_code');

        // Kiểm tra mã giảm giá trong cơ sở dữ liệu
        $coupon = Coupon::where('name', $couponCode)->first(); // Thay 'code' bằng 'name'

        if (!$coupon) {
            // Phản hồi nếu mã giảm giá không hợp lệ
            return response()->json([
                'success' => false,
                'message' => 'Coupon code is invalid',
            ]);
        }
        $cart = session('cart', [
            'items' => [],      // danh sách sản phẩm
            'total_price' => 0  // tổng giá ban đầu của giỏ hàng
        ]);
        // Tính toán giảm giá
        $discountAmount = $coupon->value; // Sử dụng trường 'value' thay cho 'discount_amount'
        $totalPrice = $cart['total_price']; // Lấy tổng giá hiện tại của giỏ hàng từ session

        // Đảm bảo tổng giá mới không âm
        $newTotal = max(0, $totalPrice - $discountAmount);

        // Cập nhật lại giỏ hàng trong session với tổng giá mới
        $cart['total_price'] = $newTotal;
        session(['cart' => $cart]);
        // Trả về phản hồi JSON với tổng giá đã cập nhật
        return response()->json([
            'success' => true,
            'total_price' => $newTotal,
        ]);
    }
}