<?php

namespace App\Http\Controllers\Admin;

use App\Events\RefundCreate;
use App\Http\Controllers\Controller;
use App\Models\{Order, Refund, User};
use Illuminate\Http\Request;

class RefundController extends Controller
{
    const PATH_VIEW = 'admin.refunds.';
    public function index()
    {
        $data = Refund::query()->with(['user', 'order'])->latest('id')->get();

        $status = Refund::STATUS;

        $orders = Order::query()->get();

        $users = User::query()->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data', 'status', 'orders', 'users'));
    }

    public function store(Request $request)
    {
        $refund = $request->validate([
            'order_id'  => 'required',
            'reason'    => 'required|max:255',
            'status'    => 'required',
        ]);

        $order = Order::query()->find($refund['order_id']);

        if ($refund['status'] == Refund::STATUS_COMPLETED) {
            $order->update([
                'status_order' => Order::STATUS_ORDER_CANCELED,
            ]);
        }

        $refund = Refund::query()->create([
            'order_id'  => $refund['order_id'],
            'user_id'   => $order->user_id,
            'reason'    => $refund['reason'],
            'status'    => $refund['status'],
        ]);

        if ($refund->status == Refund::STATUS_COMPLETED) {
            RefundCreate::dispatch($refund);
        }

        return back();
    }

    public function update($id)
    {
        $refund = Refund::query()->findOrFail($id);

        $refund->update([
            'status' => request('status')
        ]);

        if ($refund->status == Refund::STATUS_COMPLETED) {
            Order::query()->find($refund->order->id)->update([
                'status_order' => Order::STATUS_ORDER_CANCELED,
            ]);

            RefundCreate::dispatch($refund);
        }

        return back();
    }
}
