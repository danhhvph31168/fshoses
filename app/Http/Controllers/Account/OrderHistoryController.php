<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    /**
     * @return [type]
     */
    public function getListOrderHistory()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'DESC')->paginate(5);
        return view("client.orders.list-order", compact("orders"));
    }

    public function getDetailOrderItem($slug)
    {
        $order = Order::where('sku_order', $slug)->with([
            "orderItems.productVariant.product",
            "orderItems.productVariant.color",
            "orderItems.productVariant.size",
            'coupon',
        ])->first();

        if (!$order) {
            return view("errors.403");
        }

        return view("client.orders.detail-order", compact("order"));
    }


    public function cancelOrder(Request $request, $slug)
    {
        // dd($request->all());
        $request->validate([
            'cancel_reason' => 'required',
        ], [
            'cancel_reason.required' => 'Please select reason for canceling order!',
        ]);

        $order = Order::where('sku_order', $slug)->first();

        // dd($order);
        if (!$order) {
            return back();
        }

        $data = [
            'status_order' => 'canceled',
            'cancel_reason' => $request->cancel_reason,
        ];
        $order->update($data);
        // dd($order);
        return redirect()->back()->with('info', 'Order was canceled successfully.');
    }
}
