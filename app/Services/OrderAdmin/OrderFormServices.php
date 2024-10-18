<?php

namespace App\Services\OrderAdmin;

use App\Models\{Order, Payment, Product, ProductColor, ProductSize, Refund, Role, User};


/**
 * @package App\Services\OrderAdmin
 */
class OrderFormServices
{
    public function handleFormCreate()
    {
        return [
            'products'      => Product::query()->select('id', 'name', 'price_regular', 'price_sale')->get(),
            'sizes'         => ProductSize::query()->pluck('name', 'id')->all(),
            'colors'        => ProductColor::query()->pluck('name', 'id')->all(),
            'users'         => User::query()->pluck('name', 'id')->all(),
            'roles'         => Role::query()->pluck('name', 'id')->all(),
            'statusOrder'   => Order::STATUS_ORDER,
            'statusPayment' => Order::STATUS_PAYMENT,
        ];
    }
    public function handleFormEdit()
    {
        return [
            'users'         => User::query()->pluck('name', 'id')->all(),
            'roles'         => Role::query()->pluck('name', 'id')->all(),
            'statusOrder'   => Order::STATUS_ORDER,
            'statusPayment' => Order::STATUS_PAYMENT,
            'paymentStatus' => Payment::STATUS,
            'refundStatus'  => Refund::STATUS,
        ];
    }
}
