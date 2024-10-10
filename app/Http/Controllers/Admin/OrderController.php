<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductSize;
use App\Models\ProductVariant;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    const PATH_VIEW = 'admin.orders.';
    public function index()
    {
        $data = Order::query()->with(['user', 'role'])->latest('id')->get();

        return view(self::PATH_VIEW . __FUNCTION__, compact('data'));
    }
    public function create()
    {
        $products   = Product::query()->select('id', 'name', 'price_regular', 'price_sale')->get();
        $sizes      = ProductSize::query()->pluck('name', 'id')->all();
        $colors     = ProductColor::query()->pluck('name', 'id')->all();
        $users      = User::query()->pluck('name', 'id')->all();
        $roles      = Role::query()->pluck('name', 'id')->all();
        $statusOrder = Order::STATUS_ORDER;
        $statusPayment = Order::STATUS_PAYMENT;

        return view(self::PATH_VIEW . __FUNCTION__, compact('products', 'sizes', 'colors', 'users', 'roles', 'statusOrder', 'statusPayment'));
    }

    public function store(Request $request)
    {
        // dd($request->all());

        try {

            DB::transaction(function () {

                $products = request(key: 'product');

                $totalAmout = 0;

                $productVariantID = [];

                foreach ($products as $key => $value) {
                    $product = Product::query()->findOrFail($value['id']);

                    $priceSale = $product->price_sale;

                    $totalAmout += $priceSale * $value['quatity'];

                    $productVariant = ProductVariant::query()
                        ->with(['size', 'color'])
                        ->where([
                            'product_id'        => $value['id'],
                            'product_size_id'   => $value['size'],
                            'product_color_id'  => $value['color'],
                        ])->firstOrFail();

                    if (empty($productVariant->id)) {
                        continue;
                    } else {
                        $productVariantID[] = [
                            'id'        => $productVariant->id,
                            'quantity'  => $value['quatity'],
                            'price'     => $priceSale,
                        ];
                    }
                }

                $user = User::query()->findOrFail(request('user_id'));

                $order = Order::query()->create([
                    'user_id'       => request('user_id'),
                    'role_id'       => request('role_id'),
                    'sku_order'     => request('sku_order'),
                    'user_name'     => empty(request('user_name')) ? $user->name : request('user_name'),
                    'user_email'    => empty(request('user_email')) ? $user->email : request('user_email'),
                    'user_phone'    => empty(request('user_phone')) ? $user->phone : request('user_phone'),
                    'user_address'  => empty(request('user_address')) ? $user->address : request('user_address'),
                    'user_note'     => request('user_note'),
                    'status_order'  => request('status_order'),
                    'status_payment' => request('status_payment'),
                    'total_amount'  => $totalAmout,
                ]);

                foreach ($productVariantID as $key => $value) {
                    OrderItem::query()->create([
                        'order_id'           => $order->id,
                        'product_variant_id' => $value['id'],
                        'quantity'           => $value['quantity'],
                        'price'              => $value['price'],
                    ]);
                }
            });

            return redirect()->route('admin.dashboard')->with('success', 'Đặt hàng thành công');
        } catch (\Exception $th) {

            dd($th->getMessage());

            return back()->with('error', 'Lỗi đặt hàng');
        }
    }
}
