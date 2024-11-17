<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Order};
use App\Services\OrderAdmin\OrderFormServices;
use App\Services\OrderAdmin\OrderServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';

    public function __construct(public OrderServices $orderServices, public OrderFormServices $orderFormServices) {}
    
    public function index()
    {
        $data = Order::query()->with(['user', 'role'])->get();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function create()
    {
        $data = $this->orderFormServices->handleFormCreate();
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () {

                [$totalAmout, $productVariantID]  = $this->orderServices->handleProductVariant();

                $order = $this->orderServices->createOrder($totalAmout);

                $this->orderServices->createOrderItem($productVariantID, $order);

                $this->orderServices->createPayment($order);
            });

            return back()->with('success', 'Đặt hàng thành công');
        } catch (\Exception $th) {

            dd($th->getMessage());

            return back()->with('error', 'Lỗi đặt hàng: ' . $th->getMessage());
        }
    }

    public function edit($id)
    {
        $order = Order::query()->with(['user', 'role', 'orderItems', 'payment', 'refund'])->findOrFail($id);

        $dataOrderItem = [];
        foreach ($order->orderItems as $orderItems) {
            $dataOrderItem[] = [
                'product'   => $orderItems->productVariant->product,
                'size'      => $orderItems->productVariant->size,
                'color'     => $orderItems->productVariant->color,
                'quantity'  => $orderItems->quantity,
            ];
        }

        $dataProductVariant = [];
        foreach ($dataOrderItem as $key => $value) {
            $dataProductVariant[] = $value;
        }

        $data = $this->orderFormServices->handleFormEdit();

        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'data', 'dataProductVariant'));
    }

    public function update($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::query()->findOrFail($id);
            if (!($order->status_order == Order::STATUS_ORDER_CANCELED || $order->status_order == Order::STATUS_ORDER_DELIVERED)) {
                $order->update([
                    'status_order'   => request('status_order'),
                    'status_payment' => request('status_payment'),
                ]);
            }

            $payment = $order->payment;
            $payment->update([
                'status' => request('payment_status'),
            ]);

            DB::commit();

            return back()->with('success', 'Đặt hàng thành công');
        } catch (\Exception $th) {

            dd($th->getMessage());

            return back()->with('error', 'Lỗi đặt hàng: ' . $th->getMessage());
        }
    }
}
