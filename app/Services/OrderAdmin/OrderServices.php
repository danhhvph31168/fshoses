<?php

namespace App\Services\OrderAdmin;

use App\Models\{Order, Product, OrderItem, Payment, ProductVariant, User};

/**
 * @package App\Services\OrderAdmin
 */
class OrderServices
{
    public function handleProductVariant()
    {
        $products = request(key: 'product');

        $totalAmout = 0;

        $productVariantID = [];

        foreach ($products as $key => $value) {
            $product = Product::query()->findOrFail($value['id']);

            $priceSale = $product->price_regular * ((100 - $product->price_sale) / 100);


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
        dd($priceSale . '-' . $totalAmout);

        return [$totalAmout, $productVariantID];
    }

    public function createOrder($totalAmout)
    {
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

        return $order;
    }

    public function createOrderItem($productVariantID, $order)
    {
        foreach ($productVariantID as $key => $value) {
            $orderItem = OrderItem::query()->create([
                'order_id'           => $order->id,
                'product_variant_id' => $value['id'],
                'quantity'           => $value['quantity'],
                'price'              => $value['price'],
            ]);
        }

        return $orderItem;
    }

    public function createPayment($order)
    {
        $payment = Payment::query()->create([
            'order_id'          => $order->id,
            'payment_method'    => request('outlined'),
            'status'            => request('payment_status'),
        ]);

        return $payment;
    }
}
