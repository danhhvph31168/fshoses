@extends('client.layouts.master')

@section('title')
    List Orders
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
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Order History Section Begin -->
    <section class="shopping-cart spad" style="padding: 0; padding-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table rounded shadow-sm bg-white">
                        <table class="table table-hover align-middle">
                            <thead class="bg-gradient text-white"
                                style="background: linear-gradient(90deg, #ff7eb3, #ff758c);">
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                    <th>Status Order</th>
                                    <th>Status Payment</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isEmpty())
                                    <tr>
                                        <td colspan="7" class="text-danger fw-bold text-center">No orders have been
                                            placed yet!
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($orders as $item)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('getDetailOrderItem', $item->sku_order) }}"
                                                    class="text-danger fw-bold">
                                                    {{ $item->sku_order }}
                                                </a>
                                            </td>
                                            <td>{{ $item->created_at->toDateString() }}</td>
                                            <td>

                                                <span
                                                    class="badge rounded-pill 
                                                {{ $item->status_order === 'pending'
                                                    ? 'bg-warning text-dark'
                                                    : ($item->status_order === 'confirmed'
                                                        ? 'bg-success'
                                                        : ($item->status_order === 'processing'
                                                            ? 'bg-primary'
                                                            : ($item->status_order === 'shipping'
                                                                ? 'bg-info text-dark'
                                                                : ($item->status_order === 'delivered'
                                                                    ? 'bg-success text-light'
                                                                    : ($item->status_order === 'canceled'
                                                                        ? 'bg-secondary'
                                                                        : ($item->status_order === 'refunded'
                                                                            ? 'bg-light text-muted'
                                                                            : 'bg-danger')))))) }}">

                                                    {{ $item->status_order }}
                                                </span>
                                            </td>
                                            <td>
                                                <span
                                                    class="badge rounded-pill 
        {{ $item->status_payment === 'unpaid'
            ? 'bg-secondary'
            : ($item->status_payment === 'pending'
                ? 'bg-warning text-dark'
                : ($item->status_payment === 'paid'
                    ? 'bg-success'
                    : ($item->status_payment === 'refunded'
                        ? 'bg-info text-dark'
                        : 'bg-danger'))) }}">
                                                    {{ $item->status_payment }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($item->total_amount, 0, ',', '.') }} VNĐ</td>

                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <div class="p-3">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->



@endsection
