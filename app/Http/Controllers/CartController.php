<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('home.cart');
    }
    public function add(Product $product, Request $req)
    {
        $quantity = $req->quantity ? floor($req->quantity) : 1;
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng hay chưa
        if (isset($cart[$product->id])) {
            // Nếu đã tồn tại, chỉ cần tăng số lượng
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            // Nếu chưa có trong giỏ, thêm sản phẩm vào giỏ hàng
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price_sale ? $product->price_sale : $product->price,
                'quantity' => $quantity,
                'image' => $product->img_thumbnail // Hoặc đường dẫn đến hình ảnh sản phẩm
            ];
        }
        dd($cart);
        // Lưu giỏ hàng vào session
        session()->put('cart', $cart);
    }
    public function update(Product $product, Request $req) {}
    public function delete(Product $product) {}
    public function clear() {}
}
