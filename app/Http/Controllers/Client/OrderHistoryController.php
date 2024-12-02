<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
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
    public function searchOrders(Request $request)
    {
        $statusOrder = $request->input('status_order');
        $orders = Order::query()
            ->when($statusOrder, function ($query, $statusOrder) {
                return $query->where('status_order', $statusOrder);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    
        // Kiểm tra đầu ra
        if ($request->ajax()) {
            return response()->json([
                'html' => view('client.orders._order_table', compact('orders'))->render(),
                'pagination' => $orders->links('pagination::bootstrap-4')->toHtml()
            ]);
        }
    
        return response()->json(['error' => 'Invalid request'], 400);
    }
}