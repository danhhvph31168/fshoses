<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderCreateClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CheckoutRequest;
use App\Models\{Order, OrderItem, Payment, User};
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkOut()
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

        return view('client.checkout', compact('cart', 'totalAmount'));
    }

    public function addOrder(CheckoutRequest $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();

            $totalAmount = 0;
            $dataItem = [];
            foreach (session('cart') as $variantID => $item) {

                $totalAmount += $item['quatity'] * ($item['price_sale'] ?: $item['price_regular']);

                $dataItem[] = [
                    'product_variant_id' => $variantID,
                    'quantity'           => $item['quatity'],
                    'price'              => $item['price_sale'] ?: $item['price_regular'],
                ];
            }

            if (Auth::check() == false) {
                $user = User::query()->create([
                    'name'  => $request->user_name,
                    'email' => $request->user_email,
                    'phone' => $request->user_phone,
                    'address' => $request->user_address,
                    'role_id' => 1,
                    'status'  => 0,
                ]);

                $order = Order::query()->create([
                    'user_id'    => $user->id,
                    'role_id'    => 1,
                    'sku_order'  => 'DH-' . strtoupper(Str::random(6)),
                    'user_name'  => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_phone' => $request->user_phone,
                    'user_address' => $request->user_address,
                    'user_note'    => $request->user_note,
                    'total_amount' => $totalAmount,
                ]);
            } else {
                $order = Order::query()->create([
                    'user_id'    => Auth::user()->id,
                    'role_id'    => Auth::user()->role_id,
                    'sku_order'  => 'DH-' . strtoupper(Str::random(6)),
                    'user_name'  => $request->user_name,
                    'user_email' => $request->user_email,
                    'user_phone' => $request->user_phone,
                    'user_address' => $request->user_address,
                    'user_note'    => $request->user_note,
                    'total_amount' => $totalAmount,
                ]);
            }

            foreach ($dataItem as $item) {
                $item['order_id'] = $order->id;
                OrderItem::query()->create($item);
            }

            if ($request->payment_method == Payment::PAYMENTS_METHOD_CASH) {
                Payment::query()->create([
                    'order_id'          => $order->id,
                    'payment_method'    => Payment::PAYMENTS_METHOD_CASH
                ]);
            }

            OrderCreateClient::dispatch($order);

            DB::commit();

            session()->forget('cart');

            return redirect()->route('orderSuccess')->with('success', 'Order successful');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return back()->with('error', 'Lỗi đặt hàng: ' . $th->getMessage());
        }
    }

    public function orderSuccess()
    {
        return view('client.order-success');
    }
}
