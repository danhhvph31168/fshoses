<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
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
        ])->first();

        if (!$order) {
            return view("page-error.404");
        }
        // dd  ($order);
        return view("client.orders.detail-order", compact("order"));
    }
}
