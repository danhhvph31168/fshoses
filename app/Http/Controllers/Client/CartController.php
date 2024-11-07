<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart');

        $totalAmount = 0;
        if (session()->has('cart')) {
            foreach ($cart as $item) {
                $totalAmount += $item['quatity'] * ($item['price_sale'] ?: $item['price_regular']);
            }
        } else {
            $cart = [];
        }

        return view('client.cart-list', compact('totalAmount', 'cart'));
    }
    public function add(Request $request)
    {
        $product = Product::query()->findOrFail(\request('product_id'));

        $productVariant = ProductVariant::query()
            ->with(['color', 'size'])
            ->where([
                'product_id' => \request('product_id'),
                'product_size_id' => \request('product_size'),
                'product_color_id' => \request('product_color'),
            ])
            ->firstOrFail();

        // dd($productVariant->id);

        if (!isset(session('cart')[$productVariant->id])) {

            $data = $product->toArray() + $productVariant->toArray();

            $data['quatity'] = \request('quatity');

            session()->put('cart.' . $productVariant->id, $data);
        } else {

            $data = session('cart')[$productVariant->id];

            $data['quatity'] += \request('quatity');

            session()->put('cart.' . $productVariant->id, $data);
        }

        // dd(session('cart'));

        return redirect()->route('cart.list');
    }
}
