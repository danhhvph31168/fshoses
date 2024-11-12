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
        $orders = Auth::user()
            ->orders()
            ->with([
                'orderItems.productVariant.product',
                'orderItems.productVariant.size',
                'orderItems.productVariant.color'
            ])->orderBy('id', 'DESC')->paginate(5);
        return view("client.orders.list-order", compact("orders"));
    }
    public function getDetailOrderItem($slug)
    {
        $order = Order::query()->where('sku_order',$slug)->with([
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
