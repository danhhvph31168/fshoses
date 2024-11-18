@extends('client.layouts.master')

@section('title')
Danh sách đặt hàng
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Order History</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('client.home') }}">Home</a>
                        <a href="./shop.html">Shop</a>
                        <span>Order History</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shopping__cart__table">
                    <table class="mb-4">
                        <thead>
                            <tr>
                                <th>Order Code</th>
                                <th>Order Date</th>
                                <th>Status Order</th>
                                <th>Status Payment</th>
                                <th>Total Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr class="fw-bold">
                                <td>
                                    <a href="{{ route('getDetailOrderItem', $order->sku_order) }}"
                                        style="color: #e53637">
                                        {{ $order->sku_order }}</a>
                                </td>
                                <td>
                                    <h6>{{ $order->created_at->toDateString() }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $order->status_order }}</h6>
                                </td>
                                <td>
                                    <h6>{{ $order->status_payment }}</h6>
                                </td>
                                <td>{{ $order->total_amount }}</td>
                                <td><a href="#" class="badge badge-danger">Cancel order</a></td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection