<?php

namespace App\Http\Controllers\Client;

use App\Models\Coupon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Events\OrderCreateClient;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth, DB};
use App\Services\OrderClient\VnpayServices;
use App\Http\Requests\Client\CheckoutRequest;
use App\Services\OrderClient\AddOrderServices;
use App\Services\OrderClient\AddVnpayServices;
use App\Models\{Order, OrderItem, Payment, ProductColor, User, Vnpay};

class CheckoutController extends Controller
{
    public function __construct(
        public VnpayServices $vnpayServices,
        public AddVnpayServices $addVnpayServices,
        public AddOrderServices $addOrderServices
    ) {}

    // public function checkOut(User $user)
    // {
    //     $cart = session('cart');

    //     $totalAmount = 0;
    //     if (session()->has('cart')) {

    //         foreach ($cart as $item) {
    //             $price = $item['price_regular'] * ((100 - $item['price_sale']) / 100);
    //             $totalAmount += $item['quatity'] * ($price ?: $item['price_regular']);
    //         }
    //     } else {
    //         $cart = [];
    //     }

    //     return view('client.checkout', compact('cart', 'totalAmount', 'price'));
    // }

    public function checkOut()
    {
        if (!empty(session('cart'))) {
            $cart = session('cart');

            $totalAmount = session('totalAmount');

            return view('client.checkout', compact('cart', 'totalAmount'));
        } else {
            return back()->with('error', 'Your cart is empty!');
        }
    }

    public function addOrder(CheckoutRequest $request)
    {
        try {
            DB::beginTransaction();

            [$totalAmount, $dataItem]  = $this->addOrderServices->dataOrderItem();

            if (Auth::check() == false) {
                $order = $this->addOrderServices->notLogin($request, $totalAmount);
            } else {
                $order = $this->addOrderServices->loggedIn($request, $totalAmount);
            }

            foreach ($dataItem as $item) {
                $item['order_id'] = $order->id;
                OrderItem::query()->create($item);
            }

            if ($request->payment_method == Payment::PAYMENTS_METHOD_CASH) {
                Payment::query()->create([
                    'order_id'           => $order->id,
                    'payments_method'    => Payment::PAYMENTS_METHOD_CASH
                ]);
            }

            if ($request->payment_method == Payment::PAYMENTS_METHOD_VNPAY) {
                $payment = Payment::query()->create([
                    'order_id'           => $order->id,
                    'payments_method'    => Payment::PAYMENTS_METHOD_VNPAY
                ]);
            }

            DB::commit();

            session()->forget('cart');

            if ($request->payment_method == Payment::PAYMENTS_METHOD_VNPAY) {
                $order = $order->id;
                $payment = $payment->id;
                $this->vnpayServices->vnpay($request, $order, $payment);
            }

            // Giảm số lượng coupon còn lại trong cơ sở dữ liệu
            $coupon = Coupon::findByCode(session('coupon')['code']);

            $coupon->decrement('quantity', 1);

            return redirect()->route('orderSuccess', ['sku' => $order->sku_order])->with('success', 'Order successful');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            DB::rollBack();
            return back()->with('error', 'Lỗi đặt hàng: ' . $th->getMessage());
        }
    }

    public function orderSuccess($sku)

    {
        $order = Order::where('sku_order', $sku)->firstOrFail();

        return view('client.order-success', compact('order'));
    }

    public function vnpayReturn(Request $request, $order, $payment)
    {
        $order2 = Order::query()->where('id', $order)->first();

        $this->addVnpayServices->addVnPay($request, $order, $payment);

        OrderCreateClient::dispatch($order2);

        return redirect()->route('orderSuccess')->with('success', 'Order successful');
    }
}
