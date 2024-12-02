<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Brand, Category, Order};
use App\Services\OrderAdmin\OrderFormServices;
use App\Services\OrderAdmin\OrderServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';

    public function __construct(public OrderServices $orderServices, public OrderFormServices $orderFormServices) {}

    public function index()
    {
        $data = Order::query()->with(['user', 'role'])->latest('id')->paginate(10);

        if ($key = request()->key) {
            $data = Order::query()->with(['user', 'role'])->latest('id')
                ->where('sku_order', 'like', '%' . $key . '%')
                ->orwhere('user_name', 'like', '%' . $key . '%')
                ->paginate(5);
        }
        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }

    public function edit($id)
    {
        $order = Order::query()->with(['user', 'role', 'orderItems', 'payment'])->findOrFail($id);

        $dataOrderItem = [];
        foreach ($order->orderItems as $orderItems) {
            $dataOrderItem[] = [
                'product'   => $orderItems->productVariant->product,
                'size'      => $orderItems->productVariant->size,
                'color'     => $orderItems->productVariant->color,
                'quantity'  => $orderItems->quantity,
            ];
        }

        $dataProductVariant = [];
        foreach ($dataOrderItem as $key => $value) {
            $dataProductVariant[] = $value;
        }

        $data = $this->orderFormServices->handleFormEdit();

        return view(self::PATH_VIEW . __FUNCTION__, compact('order', 'data', 'dataProductVariant'));
    }

    public function update($id)
    {
        try {
            DB::beginTransaction();

            $order = Order::query()->findOrFail($id);

            if (!($order->status_order == Order::STATUS_ORDER_CANCELED || $order->status_order == Order::STATUS_ORDER_DELIVERED)) {
                $order->update([
                    'status_order'   => request('status_order'),
                    'status_payment' => request('status_payment'),
                ]);
            }

            $payment = $order->payment;

            $payment->update([
                'status' => request('payment_status'),
            ]);

            // Log::info($order);

            // $log = DB::table('telescope_entries')->where('type', 'log')->get()
            //     ->map(function ($log) {
            //         $log->decoded_content = json_decode($log->content, true); // Giải mã content
            //         return $log;
            //     });;

            DB::commit();

            return back()->with('success', 'Đặt hàng thành công');
        } catch (\Throwable $th) {

            dd($th->getMessage());

            return back()->with('error', 'Lỗi đặt hàng: ' . $th->getMessage());
        }
    }
    public function search(Request $request)
{
    $status = $request->input('status_order');

    // Nếu status_order rỗng hoặc null, lấy tất cả đơn hàng
    $query = Order::query();

    if (!empty($status)) {
        $query->where('status_order', $status);
    }

    // Lấy dữ liệu với phân trang, mỗi trang 10 mục
    $data = $query->latest('id')->paginate(10);

    // Kiểm tra nếu không có dữ liệu
    if ($data->isEmpty()) {
        return response()->json([
            'html' => '<tr><td colspan="7" class="text-center">No orders found.</td></tr>',
            'pagination' => ''
        ]);
    }

    // Trả về HTML của bảng và phân trang
    $html = view('admin.orders._order_table', compact('data'))->render();
    $pagination = $data->links()->render();

    return response()->json([
        'html' => $html,
        'pagination' => $pagination
    ]);
}
}