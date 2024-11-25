<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\SearchOrderRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderSearchController extends Controller
{
    public function showFormSearchOrder()
    {
        return view("client.orders.form-search-order");
    }
    public function handleSearchOrder(SearchOrderRequest $request)
    {
        $order = Order::where('sku_order', $request->sku_order)
            ->where('user_phone', $request->user_phone)
            ->first();

        if (!$order) {
            return view("page-error.404");
        }

        return view('client.orders.list-order-search', compact('order'));
    }
    public function cancelOrderSearch(Request $request, $slug)
    {
        $request->validate([
            'reason_sea' => ['required', 'regex:/^(?!\s*$).+/'],
            'other_reason' => 'required',
        ]);
        dd($request->all());

        $order = Order::where('sku_order', $slug)->first();

        // dd($order);
        if (!$order) {
            return view('page-error.404');
        }

        $data = [
            'status_order' => 'canceled',
            'cancel_reason' => $request->reason,
        ];
        $order->update($data);
        // dd($order);
        return redirect()->back()->with('info', 'Order was canceled successfully.');
    }
}
