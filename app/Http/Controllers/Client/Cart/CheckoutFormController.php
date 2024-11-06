<?php

namespace App\Http\Controllers\Client\Cart;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class CheckoutFormController extends Controller
{
    /**
     * Hiển thị form checkout.
     *
     * @return \Illuminate\View\View
     */
    public function checkoutForm()
    {
        // Lấy giỏ hàng từ session, và tạo một đối tượng Cart với các mục trong giỏ
        $cartItems = session('cart', []); // Lấy mảng từ session
        $cart = new Cart($cartItems); // Khởi tạo Cart với các mục
        $user = Auth::user();

        return view('cart/checkout', compact('cart', 'user'));
    }
    public function processCheckout(Request $request)
    {
        // Kiểm tra người dùng đã đăng nhập hay chưa
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để tiếp tục.');
        }
        // Validate dữ liệu từ form
        $validated = $request->validate([
            'last_name' => 'required|string|max:255',
            'address_line1' => 'required|string|max:255',
            'address_line2' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'user_note' => 'nullable|string',
        ]);

        // Tạo đơn hàng mới
        $order = Order::create([
            'user_id' => Auth::id(),
            'role_id' => Auth::user()->role_id, // hoặc lấy từ đâu đó, tuỳ vào logic hệ thống của bạn
            'sku_order' => 'ORD-' . Str::upper(Str::random(8)), // Tạo SKU ngẫu nhiên
            'user_name' => $request->last_name,
            'user_email' => $request->email,
            'user_phone' => $request->phone,
            'user_address' => $request->address_line1 . ', ' . $request->address_line2,
            'status_order' => 'pending',
            'status_payment' => 'unpaid',
            'total_amount' => $this->TotalAmount(session()->get('cart', [])),
            'user_note' => $request->user_note,
        ]);

        // Lưu các sản phẩm trong giỏ hàng vào bảng order_items
        foreach (session()->get('cart', []) as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                // 'product_variant_id' => $item['id'], // Hoặc lấy đúng ID sản phẩm trong giỏ hàng
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        // Xóa giỏ hàng khỏi session sau khi đặt hàng
        session()->forget('cart');

        return redirect()->route('home')->with('success', 'Đơn hàng của bạn đã được gửi thành công.');
    }
    protected function TotalAmount($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}