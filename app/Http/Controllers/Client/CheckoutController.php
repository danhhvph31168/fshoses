<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderCreateClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CheckoutRequest;
use App\Models\{Order, OrderItem, Payment, User, Vnpay};
use App\Services\OrderClient\VnpayServices;
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(public VnpayServices $vnpayServices) {}

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

                if (User::where('email', $request->user_email)->exists()) {

                    $checkStatus = User::where('email', $request->user_email)->where('status', 1)->first();

                    if ($checkStatus == false) {
                        $user = User::where('email', $request->user_email)->first();
                    } else {
                        return back()->with('info', 'This email already has an account, please login to purchase.');
                    }
                } else {
                    $user = User::query()->create([
                        'name'  => $request->user_name,
                        'email' => $request->user_email,
                        'phone' => $request->user_phone,
                        'address' => $request->user_address,
                        'role_id' => 1,
                        'status'  => false,
                    ]);
                }

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
                    'payments_method'    => Payment::PAYMENTS_METHOD_CASH
                ]);
            }

            if ($request->payment_method == Payment::PAYMENTS_METHOD_VNPAY) {
                $payment = Payment::query()->create([
                    'order_id'          => $order->id,
                    'payments_method'    => Payment::PAYMENTS_METHOD_VNPAY
                ]);
            }

            OrderCreateClient::dispatch($order);

            DB::commit();

            session()->forget('cart');

            if ($request->payment_method == Payment::PAYMENTS_METHOD_VNPAY) {
                $order = $order->id;
                $payment = $payment->id;
                $this->vnpayServices->vnpay($request, $order, $payment);
            }

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
    public function vnpayReturn(Request $request, $order, $payment)
    {
        Vnpay::query()->create([
            'order_id'          => $order,
            'vnp_Amount'        => $request->vnp_Amount,
            'vnp_BankCode'      => $request->vnp_BankCode,
            'vnp_BankTranNo'    => $request->vnp_BankTranNo,
            'vnp_CardType'      => $request->vnp_CardType,
            'vnp_OrderInfo'     => $request->vnp_OrderInfo,
            'vnp_PayDate'       => $request->vnp_PayDate,
            'vnp_ResponseCode'  => $request->vnp_ResponseCode,
            'vnp_TmnCode'       => $request->vnp_TmnCode,
            'vnp_TransactionNo' => $request->vnp_TransactionNo,
            'vnp_TxnRef'        => $request->vnp_TxnRef,
            'vnp_SecureHash'    => $request->vnp_SecureHash,
            'vnp_TransactionStatus' => $request->vnp_TransactionStatus,
        ]);

        Payment::query()->where('id', $payment)->update([
            'status' => Payment::STATUS_COMPLETED
        ]);

        session()->forget('cart');

        return redirect()->route('orderSuccess')->with('success', 'Order successful');
    }
}
