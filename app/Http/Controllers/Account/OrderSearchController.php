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
        // Dữ liệu đã được validate
        $sku_order = $request->input('sku_order');
        $user_phone = $request->input('user_phone');

        // Tra cứu đơn hàng
        $order = Order::where('sku_order', $sku_order)
            ->where('user_phone', $user_phone)
            ->first();

        if (!$order) {
            // Nếu không tìm thấy, trả về view với thông báo lỗi
            return back()->with(['error' => 'Không tìm thấy đơn hàng với thông tin đã cung cấp.']);
        }

        // Nếu tìm thấy, trả về view hiển thị thông tin đơn hàng
        return view('orders.result', compact('order'));
    }
}
