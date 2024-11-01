<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Cart;
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




    public function checkoutForm()
    {
        $cart = session('cart', []); // Lấy giỏ hàng từ session
        return view('home/checkout', compact('cart'));
    }
}
