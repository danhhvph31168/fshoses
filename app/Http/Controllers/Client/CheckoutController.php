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
use Illuminate\Contracts\Database\Eloquent\Builder;

class CheckoutController extends Controller
{
    public function __construct(
        public VnpayServices $vnpayServices,
        public AddVnpayServices $addVnpayServices,
        public AddOrderServices $addOrderServices
    ) {}


    public function checkOut()
    {
        if (!empty(session('cart'))) {

            $cart = session('cart');

            $totalAmount = 0;

            foreach ($cart as $item) {
                if ($item['quatity'] > $item['quantity']) {

                    return  back()
                        ->with('info', "The quantity has exceeded the quantity in stock. There are {$item['quantity']} products left.");
                }
                $price = $item['price_regular'] * ((100 - $item['price_sale']) / 100);

                $totalAmount += $item['quatity'] * ($price ?: $item['price_regular']);
            }
            // dd($totalAmount);

            $currentDate = now();

            $coupons = Coupon::Where('minimum_order_value', '<=', $totalAmount)
                ->where('start_date', '<=', $currentDate)
                ->where('end_date', '>=', $currentDate)
                ->get();

            return view('client.checkout', compact('cart', 'totalAmount', 'coupons'));
        } else {

            return back()->with('error', 'Your cart is empty!');
        }
    }


    public function addOrder(CheckoutRequest $request)
    {
        try {
            DB::beginTransaction();      
            
            $totalAmount = session('totalAmount');

            if (session('coupon')) {
                if (session('coupon')['type'] == "percent") {
                    $totalAmount =  $totalAmount * ((100 - session('coupon')['value']) / 100);
                } else {
                    $totalAmount = $totalAmount - session('coupon')['value'];
                }
            }           
            session()->put('totalAmount',$totalAmount);
            // dd($totalAmount);            

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

            // - kho
            foreach ($order->orderItems as $item) {
                $quantity = $item->productVariant->quantity - $item->quantity;
                $item->productVariant->update(['quantity' => $quantity]);
            }


            // dd(session('coupon'));
            if (session('coupon')) {
                $coupon = Coupon::findByCode(session('coupon')['code']);
                $coupon->decrement('quantity', 1);
            }

            DB::commit();

            if ($request->payment_method == Payment::PAYMENTS_METHOD_VNPAY) {
                $order = $order->id;
                $payment = $payment->id;
                $this->vnpayServices->vnpay($request, $order, $payment);
            } else {
                OrderCreateClient::dispatch($order);
            }

            session()->forget('cart');
            session()->forget('coupon');

            return redirect()->route('orderSuccess', ['sku' => $order->sku_order])->with('success', 'Order successful');
        } catch (\Throwable $th) {

            DB::rollBack();
            return back()->with('error', 'Lỗi đặt hàng: ' . $th->getMessage());
        }
    }


    public function removeCoupon(Request $request)
    {
        // Xóa mã giảm giá khỏi session
        if ($request->session()->has('coupon')) {
            $request->session()->forget('coupon');
        }

        // Có thể thêm thông báo hoặc xử lý bổ sung nếu cần
        return response()->json([
            'success' => true,
            'message' => 'Mã giảm giá đã được hủy.',
        ]);
    }

    public function orderSuccess($sku)

    {
        $order = Order::where('sku_order', $sku)->firstOrFail();

        return view('client.order-success', compact('order'));
    }

    public function vnpayReturn(Request $request, $order, $payment)
    {
        $order2 = Order::query()->where('id', $order)->first();

        if ($request->vnp_TransactionStatus == 02) {
            foreach ($order2->orderItems as $item) {
                $item->delete();
            }
            $order2->payment->delete();
            $order2->delete();
            if (!Auth::check()) {
                $order2->user->delete();
            }
            return redirect()->route('check-out');
        }

        $this->addVnpayServices->addVnPay($request, $order, $payment);

        OrderCreateClient::dispatch($order2);

        return redirect()->route('orderSuccess', $order2->sku_order)->with('success', 'Order successful');
    }
}
