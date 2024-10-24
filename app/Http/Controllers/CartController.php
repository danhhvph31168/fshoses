<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function list()
    {
        $cart = session('cart');

        $total = 0;
        if (session()->has('cart')) {
            foreach ($cart as $item) {
                $total += $item['quantity'] * ($item['price_sale'] ?: $item['price_regular']);
            }
        } else {
            $cart = [];
        }

        return view('client.cart-list', compact('totalAmount', 'cart'));
    }
    public function addToCart(Request $request)
    {
        $product = Product::query()->findOrFail(\request('product_id'));

        $productVariant = ProductVariant::query()
            ->with(['color', 'size'])
            ->where([
                'product_id' => \request('product_id'),
                'product_size_id' => \request('product_size_id'),
                'product_color_id' => \request('product_color_id'),
            ])
            ->firstOrFail();

        if (!isset(session('cart')[$productVariant->id])) {

            $data = $product->toArray() + $productVariant->toArray();

            $data['quantity'] = \request('quantity');

            session()->put('cart.' . $productVariant->id, $data);
        } else {

            $data = session('cart')[$productVariant->id];

            $data['quantity'] += \request('quantity');

            session()->put('cart.' . $productVariant->id, $data);
        }

        return redirect()->route('cart.list');
    }
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
