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
        // Tra cứu đơn hàng
        $order = Order::where('sku_order', $request->sku_order)
            ->where('user_phone', $request->user_phone)
            ->first();

        if (!$order) {
            // Nếu không tìm thấy, trả về view với thông báo lỗi
            return back()->with(['error' => 'No orders were found with the information provided.']);
        }

        // Nếu tìm thấy, trả về view hiển thị thông tin đơn hàng
        return view('client.orders.list-order-search', compact('order'));
    }
}
