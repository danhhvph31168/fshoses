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
    public function getDetailOrderItem($id)
    {
        $order = Order::find($id);
        if (!$order) {
            return abort(404);
        }

        return view("client.orders.detail-order");
    }
}
