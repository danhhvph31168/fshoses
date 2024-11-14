@extends('client.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection

@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Order Detail</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('home') }}">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Order Detail</span>
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
               
                    <div class="col-lg-6">
                        <div class="shopping__cart__table">
                            <div class="breadcrumb__text">
                                <h4>Thông tin khách hàng</h4>
                            </div>
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <td class="fw-bold">Họ và tên :</td>
                                        <td>{{ $order->user->name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Số điện thoại :</td>
                                        <td>{{ $order->user->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">Địa chỉ :</td>
                                        <td>{{ $order->user->address }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
             
                <div class="col-lg-6">
                    <div class="shopping__cart__table">
                        <div class="breadcrumb__text">
                            <h4>Thông tin giao hàng</h4>
                        </div>
                        <table class="table table-hover">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Họ và tên :</td>
                                    <td>{{ $order->user_name }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Số điện thoại :</td>
                                    <td>{{ $order->user_phone }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Địa chỉ :</td>
                                    <td>{{ $order->user_address }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col"class="text-center">Quantity</th>
                                    <th scope="col"class="text-center">Color</th>
                                    <th scope="col"class="text-center">Size</th>
                                    <th scope="col"class="text-center">Total Amount</th>
                                </tr>
                            </thead>
                            @foreach ($order->orderItems as $item)
                                <tbody>
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <img src="{{ $item->productVariant->product->img_thumbnail }}"
                                                    alt="" width="90px" height="90px">
                                            </div>
                                            <div class="product__cart__item__text">
                                                <h6>{{ $item->productVariant->product->name }}</h6>
                                                <h5>${{ $item->price }}</h5>
                                            </div>
                                        </td>
                                        <td class="cart__price text-center">
                                            {{ $item->quantity }}
                                        </td>
                                        <td class="cart__price text-center">{{ $item->productVariant->color->name }}</td>
                                        <td class="cart__price text-center">{{ $item->productVariant->size->name }}</td>
                                        <td class="cart__price text-center">
                                            ${{ number_format($item->quantity * $item->price, 0, '.', ',') }}</td>
                                    </tr>

                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
