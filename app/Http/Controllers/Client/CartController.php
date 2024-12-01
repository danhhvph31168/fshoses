<?php

namespace App\Http\Controllers\Client;

use App\Models\Product;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart');
        $colors = ProductColor::query()->get();
        $sizes = ProductColor::query()->get();

        $totalAmount = 0;
        $discount = session('discount', 0);

        if (session()->has('cart')) {
            foreach ($cart as $item) {
                $price = $item['price_regular'] * ((100 - $item['price_sale']) / 100);
                $totalAmount += $item['quatity'] * ($price ?: $item['price_regular']);
            }
        } else {
            $cart = [];
        }

        $totalAmount = $totalAmount - $discount;

        session(['totalAmount' => $totalAmount]);

        return view('client.cart-list', compact('totalAmount', 'cart',  'discount', 'colors', 'sizes'));
    }

    public function add(Request $request)
    {
        $product = Product::query()->findOrFail(\request('product_id'));

        if (!$request->product_size || !$request->product_color) {
            return back()->with('error', 'Select Product Size and Color please!');
        }

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

        foreach (session('cart') as $key => $item) {
            if ($item['quatity'] > $item['quantity']) {
                session()->put("cart.{$key}.quatity", $item['quantity']);
                return  back()
                    ->with('info', "The quantity has exceeded the quantity in stock. There are {$item['quantity']} products left.");
            }
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

        $price = $cart[$variant_id]['price_regular'] * ((100 -  $cart[$variant_id]['price_sale']) / 100);

        $totalAmount =  $price  * $quatity;

        session()->put('cart', $cart);

        $totalCart = 0;

        foreach (session('cart') as $item) {
            $totalCart += ($item['price_regular'] * ((100 -  $item['price_sale']) / 100)) * $item['quatity'];
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
