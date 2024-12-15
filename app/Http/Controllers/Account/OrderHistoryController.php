<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    public function getListOrderHistory()
    {
        $orders = Auth::user()->orders()->orderBy('created_at', 'DESC')->paginate(10);
        return view("client.orders.list-order", compact("orders"));
    }

    // public function searchOrders(Request $request)
    // {
    //     // Validate input
    //     $request->validate([
    //         'status_order' => 'nullable|string|in:pending,confirmed,processing,shipping,delivered,canceled,refunded',
    //     ]);
    //     $statusOrder = $request->input('status_order');
    //     try {
    //         // Lấy đơn hàng của người dùng hiện tại
    //         $orders = Auth::user()->orders()
    //             ->when($statusOrder, function ($query, $statusOrder) {
    //                 return $query->where('status_order', $statusOrder);
    //             })
    //             ->orderBy('created_at', 'desc')
    //             ->paginate(10);

    //         // Trả về dữ liệu JSON nếu request là AJAX
    //         if ($request->ajax()) {
    //             return response()->json([
    //                 'html' => view('client.orders.order-table', compact('orders'))->render(),
    //                 'pagination' => $orders->links('pagination::bootstrap-4')->toHtml(),
    //             ]);
    //         }

    //         // Trả về view bình thường nếu không phải AJAX (trường hợp fallback)
    //         return view('client.orders.list-order', compact('orders'));
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    public function searchOrders(Request $request)
    {

        $request->validate([
            'status_order' => 'nullable|string|in:pending,confirmed,processing,shipping,delivered,canceled,refunded',
        ]);


        $statusOrder = $request->input('status_order', '');

        try {
            $orders = Auth::user()->orders()
                ->when($statusOrder, function ($query, $statusOrder) {
                    return $query->where('status_order', $statusOrder);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(5)
                ->appends($request->except('page'));

            if ($request->ajax()) {
                return response()->json([
                    'html' => view('client.orders.order-table', compact('orders'))->render(),
                    'pagination' => $orders->links('pagination::bootstrap-4')->toHtml(),
                ]);
            }

            return view('client.orders.list-order', [
                'orders' => $orders,
                'statusOrder' => $statusOrder,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function getDetailOrderItem($slug)
    {
        $order = Order::where('sku_order', $slug)->with([
            "orderItems.productVariant.product",
            "orderItems.productVariant.color",
            "orderItems.productVariant.size",
            'coupon',
        ])->first();

        $orderId = $order->id;

        $products = Product::whereHas('productVariants.orderItems.order', function ($query) use ($orderId) {
            $query->where('id', $orderId);
        })->with(['productVariants.orderItems' => function ($query) use ($orderId) {
            $query->whereHas('order', function ($q) use ($orderId) {
                $q->where('id', $orderId);
            });
        }])->get();

        if (!$order) {
            return view("page-error.404");
        }

        foreach ($products as $key => $product) {
            $user = auth()->user();

            $checkReviewed = false;

            if ($user) {
                $checkReviewed = Rating::where('order_id', $order->id)
                    ->where('product_id', $product->id)
                    ->where('user_id', $user->id)
                    ->exists();
            }
        }

        return view("client.orders.detail-order", compact("order", "products", "checkReviewed"));
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
}
