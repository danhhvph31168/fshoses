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
<style>
.breadcrumb__text h4 {
    font-size: 28px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.breadcrumb__links a {
    font-size: 14px;
    font-weight: 500;
    transition: color 0.3s;
}

.breadcrumb__links a:hover {
    color: #ffd3e6;
    text-decoration: underline;
}

/* Table Styling */
.table thead {
    color: white;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.table-hover tbody tr:hover {
    background-color: #ffe6f0;
}

.badge {
    padding: 0.5em 0.8em;
    font-size: 0.85rem;
    font-weight: 600;
    text-transform: capitalize;
}

/* Buttons */
.btn-danger {
    background-color: #ff7eb3;
    border-color: #ff758c;
    transition: background-color 0.3s, transform 0.2s;
}

.btn-danger:hover {
    background-color: #ff5173;
    transform: scale(1.05);
}
</style>