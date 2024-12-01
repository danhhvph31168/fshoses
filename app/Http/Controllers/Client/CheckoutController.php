<?php

namespace App\Http\Controllers\Client;

use App\Events\OrderCreateClient;
use App\Http\Controllers\Controller;
use App\Http\Requests\Client\CheckoutRequest;
use App\Models\{Order, OrderItem, Payment, User,Coupon,CouponUsage, Vnpay};
use App\Services\OrderClient\AddOrderServices;
use App\Services\OrderClient\AddVnpayServices;
use App\Services\OrderClient\VnpayServices;
use Illuminate\Support\Facades\{Auth, DB};
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(
        public VnpayServices $vnpayServices,
        public AddVnpayServices $addVnpayServices,
        public AddOrderServices $addOrderServices
    ) {}

    public function checkOut()
    {

        $cart = session('cart');

        $totalAmount = session('totalAmount');


        return view('client.checkout', compact('cart', 'totalAmount'));
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

            if (session()->has('coupon')) {
                $coupons = session('coupon'); // Giả sử coupon là một mảng

                // Tìm coupon trong database
                $code = [$coupons['code']]; // Thay đổi với model coupon của bạn
                $coupon = Coupon::findByCode($code);
                $coupon->decrement('quantity', 1);

                CouponUsage::create([
                    'user_id' => Auth::id(), // ID của người dùng đã đăng nhập
                    'coupon_id' => $coupon->id,
                ]);

            }
            OrderCreateClient::dispatch($order);

            DB::commit();
            session()->forget('coupon');
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
        // $coupon = session('coupon');
        //     if (session()->has('coupon')){
        //         foreach ($coupon as $item) {
        //             $code = [$item['code']];
        //             $coupon = Coupon::findByCode($code);
        //             $coupon->decrement('quantity', 1);
        //         }

        //     }
        //     session()->forget('coupon');
        return view('client.order-success');
    }

    public function vnpayReturn(Request $request, $order, $payment)
    {
        $this->addVnpayServices->addVnPay($request, $order, $payment);

        return redirect()->route('orderSuccess')->with('success', 'Order successful');
    }
}
