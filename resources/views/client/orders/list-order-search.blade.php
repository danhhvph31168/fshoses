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
    <section class="shopping-cart spad" style="padding: 0; padding-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table rounded shadow-sm bg-white">
                        <table class="table table-hover align-middle">
                            <thead class="bg-gradient text-white"
                                style="background: linear-gradient(90deg, #ff7eb3, #ff758c);">
                                <tr class="text-center">
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                    <th>Status Order</th>
                                    <th>Status Payment</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr class="text-center">
                                    <td>
                                        <a href="{{ route('getDetailOrderItem', $order->sku_order) }}"
                                            class="text-danger fw-bold">
                                            {{ $order->sku_order }}
                                        </a>
                                    </td>
                                    <td>{{ $order->created_at->toDateString() }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill 
                                                {{ $order->status_order === 'pending'
                                                    ? 'bg-warning text-dark'
                                                    : ($order->status_order === 'confirmed'
                                                        ? 'bg-success'
                                                        : ($order->status_order === 'processing'
                                                            ? 'bg-primary'
                                                            : ($order->status_order === 'shipping'
                                                                ? 'bg-info text-dark'
                                                                : ($order->status_order === 'delivered'
                                                                    ? 'bg-success text-light'
                                                                    : ($order->status_order === 'canceled'
                                                                        ? 'bg-secondary'
                                                                        : ($order->status_order === 'refunded'
                                                                            ? 'bg-light text-muted'
                                                                            : 'bg-danger')))))) }}">

                                            {{ $order->status_order }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill 
                                        {{ $order->status_payment === 'unpaid'
                                             ? 'bg-secondary'
                                         : ($order->status_payment === 'pending'
                                              ? 'bg-warning text-dark'
                                             : ($order->status_payment === 'paid'
                                                 ? 'bg-success'
                                                 : ($order->status_payment === 'refunded'
                                                      ? 'bg-info text-dark'
                                                        : 'bg-danger'))) }}">
                                            {{ $order->status_payment }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>

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
