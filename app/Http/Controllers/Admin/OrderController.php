<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Events\{OrderCanceled, OrderDelivered};
use App\Models\{Order, Payment, User};
use App\Services\OrderAdmin\{OrderFormServices, OrderServices};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB};

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';

    public function __construct(public OrderServices $orderServices, public OrderFormServices $orderFormServices) {}

    public function index(Request $request)
    {
        $query = Order::query()->with(['user', 'role'])->latest('id');

        $statusOrder = $request->input('status_order');
        $staff = $request->input('staff');

        if ($statusOrder) {
            $query->where('status_order', $statusOrder);
        }

        if ($staff) {
            if ($request->staff == 'unprocessed') {
                $query->where('staff_id', null);
            } else {
                $query->where('staff_id', $staff);
            }
        }

        $data = $query->get();

        $status = $this->orderFormServices->handleFormEdit();

        $staff = User::whereHas('role', function ($query) {
            $query->where('name', 'staff')->orWhere('name', 'admin');
        })->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'status', 'staff'));
    }
    public function edit($id)
    {
        $order = Order::query()->with(['user', 'role', 'orderItems', 'payment'])->findOrFail($id);

        $data = $this->orderFormServices->handleFormEdit();

        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'data'));
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

                // payment
                if ($order->payment->status == Payment::STATUS_PAID) {
                    $request->validate([
                        'payment_status' => 'required|in:' . Payment::STATUS_PAID,
                    ]);
                }

                if ($order->payment->status == Payment::STATUS_FAILED) {
                    $request->validate([
                        'payment_status' => 'required|in:' . Payment::STATUS_FAILED . ',' . Payment::STATUS_PAID,
                    ]);
                }

                $payment = $order->payment;
                $payment->update([
                    'status' => request('payment_status'),
                ]);

                $order->update([
                    'status_order' => Order::STATUS_ORDER_CANCELED,
                ]);

                foreach ($order->orderItems as $item) {
                    $quantity = $item->productVariant->quantity + $item->quantity;
                    $item->productVariant->update(['quantity' => $quantity]);
                }

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

                if ($request->status_order == Order::STATUS_ORDER_DELIVERED) {
                    if ($order->payment->status == Payment::STATUS_PAID) {
                        $order->update([
                            'staff_id'       => Auth::user()->id,
                            'status_order'   => request('status_order'),
                        ]);
                    } else {
                        return back()->with('info', 'Orders must be paid successfully to change status.');
                    }
                } else {
                    $order->update([
                        'staff_id'       => Auth::user()->id,
                        'status_order'   => request('status_order'),
                    ]);
                }
            }

            // mail
            if ($order->status_order == Order::STATUS_ORDER_CANCELED) {
                OrderCanceled::dispatch($order);
            }

            if ($order->status_order == Order::STATUS_ORDER_DELIVERED) {
                OrderDelivered::dispatch($order);
            }

            DB::commit();

            return back()->with('success', 'Update successful');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
