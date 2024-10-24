<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;

class CartController extends Controller
{
    public function addToCart(Request $request, $productId)
    {
        // Kiểm tra dữ liệu đầu vào
        // $request->validate([
        //     'product_id' => 'required|integer|exists:products,id',
        //     'quantity' => 'required|integer|min:1',
        //     'price' => 'required|numeric|min:0'
        // ]);


        $quantity = $request->input('quantity');
        // $price = $request->input('price');
        // Kiểm tra nếu người dùng đã đăng nhập
        if (auth()->check()) {
            $user = auth()->user();

            // Kiểm tra xem người dùng đã có giỏ hàng chưa
            $cart = Cart::firstOrCreate([
                'user_id' => $user->id,
            ]);

            // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
            $cartItem = $cart->items()->where('product_id', $productId)->first();

            if ($cartItem) {
                // Nếu có, cập nhật số lượng
                $cartItem->quantity += $quantity;
                $cartItem->save();
            } else {
                // Nếu không có, thêm mới sản phẩm vào giỏ hàng
                $cart->items()->create([
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => Product::find($productId)->price, // Giả sử có bảng products
                ]);
            }
        } else {
            // Nếu người dùng chưa đăng nhập, lưu vào session
            $cart = session()->get('cart', []);

            // Kiểm tra nếu sản phẩm đã tồn tại trong session
            if (isset($cart[$productId])) {
                $cart[$productId]['quantity'] += $quantity;
            } else {
                $product = Product::find($productId); // Lấy thông tin sản phẩm từ DB
              
                $cart[$productId] = [
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'name' => $product->name,
                ];
            }

            // Lưu lại giỏ hàng vào session
            session()->put('cart', $cart);
        }
        return redirect()->route('home.dashboard')->with('success', 'Product added to cart!');
    }

    public function showCart()
    {
        // Nếu người dùng đã đăng nhập, hiển thị giỏ hàng từ cơ sở dữ liệu
        if (auth()->check()) {
            $user = auth()->user();
            $cart = Cart::with('items')->where('user_id', $user->id)->first();
        } else {
            // Nếu chưa đăng nhập, hiển thị giỏ hàng từ session
            $cart = session()->get('cart', []);
        }

        return view('cart.index', compact('cart'));
    }
}
