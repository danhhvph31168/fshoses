<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\SearchOrderRequest;
use App\Models\Order;

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
            return redirect()->back()->with(['error' => 'Order not found in the system!']);
        }

        return view('client.orders.list-order-search', compact('order'));
    }
}
