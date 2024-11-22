<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
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
            return view("page-error.404");
        }
        // dd  ($order);
        return view("client.orders.detail-order", compact("order"));
    }
    public function cancelOrder(Request $request, $slug)
    {
        // dd($request->all());
        $request->validate([
            'cancel_reason' => 'required',
        ], [
            'cancel_reason.required' => 'Please select reason for canceling order.', // Thông báo lỗi tùy chỉnh
        ]);
        dd(1);

        $order = Order::where('sku_order', $slug)->first();

        // dd($order);
        if (!$order) {
            return view('page-error.404');
        }

        $data = [
            'status_order' => 'canceled',
            'cancel_reason' => $request->cancel_reason,
        ];
        $order->update($data);
        // dd($order);

        if (!empty(session('searchOrder'))) {
            dd(1);
            return redirect()->route('viewOrderSearch')->with('info', 'Order was canceled successfully.');
        } else {
            dd(1);
            return redirect()->back()->with('info', 'Order was canceled successfully.');
        }
    }
}
