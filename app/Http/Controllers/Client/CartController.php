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
        $discount = session('discount',0);

        if (session()->has('cart')) {
            foreach ($cart as $item) {
                $totalAmount += $item['quatity'] * ($item['price_sale'] ?: $item['price_regular']);
            }
        } else {
            $cart = [];
        }
        $totalAmount = $totalAmount - $discount;
        
        return view('client.cart-list', compact('totalAmount', 'cart',  'discount'));
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

        if (!isset(session('cart')[$productVariant->id])) {

            $data = $product->toArray() + $productVariant->toArray();

            $data['quatity'] = \request('quatity');

            session()->put('cart.' . $productVariant->id, $data);
        } else {

            $data = session('cart')[$productVariant->id];

            $data['quatity'] += \request('quatity');

            session()->put('cart.' . $productVariant->id, $data);
        }

        return redirect()->route('cart.list');
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|integer',
            'quatity' => 'required|integer|min:1',
        ]);

        $variant_id = $request->variant_id;
        $quatity = $request->quatity;

        $cart = session('cart');
        $cart[$variant_id]['quatity'] = $quatity;

        $totalAmount = $cart[$variant_id]['price_sale'] * $quatity;

        session()->put('cart', $cart);

        $totalCart = 0;
        foreach (session('cart') as $item) {
            $totalCart += $item['price_sale'] * $item['quatity'];
        }

        return response()->json([
            'data' => [
                'totalAmount' => $totalAmount,
                "totalCart" => $totalCart
            ]
        ], 200);
    }

    public function deleteItem($id)
    {
        $cart = session('cart');
        foreach ($cart as $key => $value) {
            if ($key == $id) {
                unset($cart[$key]);
            }
        }
        session()->put('cart', $cart);

        return back();
    }

    public function delete()
    {
        session()->forget('cart');
        $cart = session('cart');
        session()->put('cart', $cart);

        return back();
    }
}
