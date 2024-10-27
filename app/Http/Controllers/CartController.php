<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Helper\Cart;
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
        $cart->add($product, $quantity);

        return redirect()->route('cart.index');
    }

    // public function add(Request $request)
    // {
    //     $product = Product::query()->findOrFail(\request('product_id'));

    //     $productVariant = ProductVariant::query()
    //         ->with(['color', 'size'])
    //         ->where([
    //             'product_id' => \request('product_id'),
    //             'product_size_id' => \request('product_size_id'),
    //             'product_color_id' => \request('product_color_id'),
    //         ])
    //         ->firstOrFail();

    //     if (!isset(session('cart')[$productVariant->id])) {

    //         $data = $product->toArray() + $productVariant->toArray();

    //         $data['quantity'] = \request('quantity');

    //         session()->put('cart.' . $productVariant->id, $data);
    //     } else {

    //         $data = session('cart')[$productVariant->id];

    //         $data['quantity'] += \request('quantity');

    //         session()->put('cart.' . $productVariant->id, $data);
    //     }

    //     return redirect()->route('cart.list');
    // }
    public function deleteItem($id)
    {
        $cart = session('cart');

        foreach ($cart as $key => $value) {
            if ($value['id'] == $id) {
                unset($cart[$key]);
            }
        }

        session()->put('cart', $cart);
    }
    public function updateCart(Request $request, $id)
    {
        $cart = session('cart');

        foreach ($cart as $item) {
            $item['quantity'] = $request->query('quantity');
        }
        Log::info($cart);

        session()->put('cart', $cart);
    }
}