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
    $quantity = $request->query('quantity');
    $id = $request->query('id');

    $totalPrice = 0;
    $cart = session('cart', []); 

    if (isset($cart[$id])) {
        $cart[$id]['quantity'] = $quantity;

        $totalPrice = $cart[$id]['price'] * $quantity;
    }

    session()->put('cart', $cart);
    $totalCart = 0;
    foreach ($cart as $item) {
        $totalCart += $item['price'] * $item['quantity'];
    }

    Log::info($cart);

    return response()->json([
        'success' => true,
        'cart' => $cart,
        'message' => 'Cart updated successfully.',
        "data" => [
            "quantity" => (int)$quantity,
            "price" => $totalPrice * (int)($quantity), // price for the updated item
            "totalCart" => $totalCart 
        ]
    ]);
}

    

    public function checkoutForm()
    {
        $cart = session('cart', []); // Lấy giỏ hàng từ session
        return view('home/checkout', compact('cart'));
    }
}