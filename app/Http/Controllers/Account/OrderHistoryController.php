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

    public function searchOrders(Request $request)
{
    // Validate input
    $request->validate([
        'status_order' => 'nullable|string|in:pending,confirmed,processing,shipping,delivered,canceled,refunded',
    ]);

    $statusOrder = $request->input('status_order');

    try {
        // Lấy đơn hàng của người dùng hiện tại
        $orders = Auth::user()->orders()
            ->when($statusOrder, function ($query, $statusOrder) {
                return $query->where('status_order', $statusOrder);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Trả về dữ liệu JSON nếu request là AJAX
        if ($request->ajax()) {
            return response()->json([
                'html' => view('client.orders._order_table', compact('orders'))->render(),
                'pagination' => $orders->links('pagination::bootstrap-4')->toHtml(),
            ]);
        }

        // Trả về view bình thường nếu không phải AJAX (trường hợp fallback)
        return view('client.orders.list-order', compact('orders'));

    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}
}