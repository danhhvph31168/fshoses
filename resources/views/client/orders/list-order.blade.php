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
                        <h4>Order history</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Order history</span>
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
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                    <th>Status Order</th>
                                    <th>Status Payment</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @if ($orders->isEmpty())
                                    <tr class="text-center fw-bold">
                                        <td colspan="7">
                                            <div class="text-danger">
                                                No orders have been placed yet!
                                            </div>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($orders as $item)
                                        <tr class=" text-center fw-bold">
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>
                                                <a href="{{ route('getDetailOrderItem', $item->sku_order) }}"
                                                    style="color: #007bff">
                                                    {{ $item->sku_order }}</a>
                                            </td>
                                            <td>
                                                <h6>{{ $item->created_at->toDateString() }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $item->status_order }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $item->status_payment }}</h6>
                                            </td>
                                            <td>{{ $item->total_amount }}</td>
                                            <td><a href="" class="badge badge-danger">Cancel order</a></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $orders->links() }}
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="#">Continue Shopping</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn">
                                <a href="#"><i class="fa fa-spinner"></i> Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Coupon code">
                        <button type="submit">Apply</button>
                    </form>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Subtotal <span>$ 169.50</span></li>
                        <li>Total <span>$ 169.50</span></li>
                    </ul>
                    <a href="#" class="primary-btn">Proceed to checkout</a>
                </div>
            </div> --}}
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
