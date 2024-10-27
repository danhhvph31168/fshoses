<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use Illuminate\Http\Request;

class ProductController extends Controller

{
    public function index()
    {
        $products = Product::all();

        return view('home.dashboard', compact('products'));
    }


    public function cart()
    {
        return view('cart');
    }

    public function addToCart($product_id)
    {
        $product = Product::findOrFail($product_id);
        $cart = session()->get('cart', []);
        if (isset($cart[$product_id])) {
            $cart[$product_id]['quantity']++;
        } else {
            $cart[$product_id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Sản phẩm đã được thêm vào giỏ hàng');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart');
        if ($cart && isset($cart[$request->id]) && $request->quantity) {
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cập nhật thành công');
        } else {
            session()->flash('error', 'Cập nhật thất bại');
        }
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        if ($cart && isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
            session()->flash('success', 'Xóa sản phẩm thành công');
        } else {
            session()->flash('error', 'Xóa sản phẩm thất bại');
        }
    }


    public function productDetail($id)
    {
        $product = Product::query()->with(['variants', 'galleries'])->where('id', $id)->first();
        $colors = ProductColor::query()->pluck('name', 'id')->all();
        $sizes = ProductSize::query()->pluck('name', 'id')->all();
        return view('product.detail', compact('product', 'colors', 'sizes'));
    }
}