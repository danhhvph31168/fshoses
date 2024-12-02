<?php

namespace App\Http\Controllers\Admin;

use App\Events\OrderCanceled;
use App\Events\OrderDelivered;
use App\Http\Controllers\Controller;
use App\Models\{Brand, Category, Order, Payment};
use App\Services\OrderAdmin\OrderFormServices;
use App\Services\OrderAdmin\OrderServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\MessageBag;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';

    public function __construct(public OrderServices $orderServices, public OrderFormServices $orderFormServices) {}

    public function index()
    {
        $data = Order::query()->with(['user', 'role'])->latest('id')->get();

        if ($key = request()->key) {
            $data = Order::query()->with(['user', 'role'])->latest('id')
                ->where('sku_order', 'like', '%' . $key . '%')
                ->orwhere('user_name', 'like', '%' . $key . '%')
                ->paginate(5);
        }
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function edit($id)
    {
        $order = Order::query()->with(['user', 'role', 'orderItems', 'payment'])->findOrFail($id);

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

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $order = Order::query()->findOrFail($id);

            if ($order->status_order == Order::STATUS_ORDER_CANCELED || $request->status_order == Order::STATUS_ORDER_CANCELED) {
                foreach ($order->orderItems as $item) {
                    $quantity = $item->productVariant->quantity + $item->quantity;
                    $item->productVariant->update(['quantity' => $quantity]);
                }
            }

            // status order
            if (!($order->status_order == Order::STATUS_ORDER_CANCELED || $order->status_order == Order::STATUS_ORDER_DELIVERED)) {

                if ($order->status_order == Order::STATUS_ORDER_CONFIRMED) {
                    $request->validate([
                        'status_order' => 'required|in:' . Order::STATUS_ORDER_CONFIRMED . ',' . Order::STATUS_ORDER_PREPARING_GOODS . ',' . Order::STATUS_ORDER_SHIPPING . ',' . Order::STATUS_ORDER_DELIVERED . ',' . Order::STATUS_ORDER_CANCELED,
                    ]);
                }

                if ($order->status_order == Order::STATUS_ORDER_PREPARING_GOODS) {
                    $request->validate([
                        'status_order' => 'required|in:' . Order::STATUS_ORDER_PREPARING_GOODS . ',' . Order::STATUS_ORDER_SHIPPING . ',' . Order::STATUS_ORDER_DELIVERED . ',' . Order::STATUS_ORDER_CANCELED,
                    ]);
                }

                if ($order->status_order == Order::STATUS_ORDER_SHIPPING) {
                    $request->validate([
                        'status_order' => 'required|in:' . Order::STATUS_ORDER_SHIPPING . ',' . Order::STATUS_ORDER_DELIVERED . ',' . Order::STATUS_ORDER_CANCELED,
                    ]);
                }

                $order->update([
                    'staff_id'       => Auth::user()->id,
                    'status_order'   => request('status_order'),
                ]);

                // status payment
                if (!($order->status_payment == Order::STATUS_PAYMENT_REFUNDED)) {
                    if ($order->status_payment == Order::STATUS_PAYMENT_PENDING) {
                        $request->validate([
                            'status_payment' => 'required|in:' . Order::STATUS_PAYMENT_PENDING . ',' . Order::STATUS_PAYMENT_PAID . ',' . Order::STATUS_PAYMENT_FAILED . ',' . Order::STATUS_PAYMENT_REFUNDED,
                        ]);
                    }

                    if ($order->status_payment == Order::STATUS_PAYMENT_PAID) {
                        $request->validate([
                            'status_payment' => 'required|in:' . Order::STATUS_PAYMENT_REFUNDED . ',' . Order::STATUS_PAYMENT_PAID,
                        ]);
                    }

                    if ($order->status_payment == Order::STATUS_PAYMENT_FAILED) {
                        $request->validate([
                            'status_payment' => 'required|in:' . Order::STATUS_PAYMENT_PAID . ',' . Order::STATUS_PAYMENT_FAILED,
                        ]);
                    }

                    $order->update([
                        'status_payment' => request('status_payment'),
                    ]);
                }

                if ($request->status_payment == Order::STATUS_PAYMENT_REFUNDED) {
                    $order->update([
                        'status_order' => Order::STATUS_ORDER_CANCELED,
                    ]);

                    foreach ($order->orderItems as $item) {
                        $quantity = $item->productVariant->quantity + $item->quantity;
                        $item->productVariant->update(['quantity' => $quantity]);
                    }
                }
            }

            // mail
            if ($order->status_order == Order::STATUS_ORDER_CANCELED) {
                OrderCanceled::dispatch($order);
            }

            if ($order->status_order == Order::STATUS_ORDER_DELIVERED) {
                OrderDelivered::dispatch($order);
            }

            // payment
            if (!($order->payment->status == Payment::STATUS_REFUNDED)) {
                if ($order->payment->status == Payment::STATUS_COMPLETED) {
                    $request->validate([
                        'payment_status' => 'required|in:' . Payment::STATUS_COMPLETED . ',' . Payment::STATUS_REFUNDED,
                    ]);
                }

                if ($order->payment->status == Payment::STATUS_FAILED) {
                    $request->validate([
                        'payment_status' => 'required|in:' . Payment::STATUS_FAILED . ',' . Payment::STATUS_COMPLETED,
                    ]);
                }

                $payment = $order->payment;

                $payment->update([
                    'status' => request('payment_status'),
                ]);
            }

            if ($request->payment_status == Payment::STATUS_REFUNDED) {
                $order->update([
                    'status_order' => Order::STATUS_ORDER_CANCELED,
                    'status_payment' => Order::STATUS_PAYMENT_REFUNDED,
                ]);

                foreach ($order->orderItems as $item) {
                    $quantity = $item->productVariant->quantity + $item->quantity;
                    $item->productVariant->update(['quantity' => $quantity]);
                }
            }



            DB::commit();

            return back()->with('success', 'Update successful');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
