@extends('client.layouts.master')

@section('title')
Danh sách đặt hàng
@endsection

@section('content')
<form class="navbar-form navbar-left form-search">
    <div class="form-group" style="width: 250px;
                                        position: relative;">
        <input type="text" class="form-control input-search-ajax" placeholder="Search">
        <div class=" search-ajax-result1" style="position: absolute;
                                                                background-color: black;
                                                                padding: 10px; width: 100%;">
            <div class="media">
                <a href="pull-left" href="#">
                    <img class="media-object1"
                        src="https://extrim-prod.s3.ap-southeast-1.amazonaws.com/Huong_dan_cach_chup_anh_giay_dep_chuan_studio_cho_shop_giay_3_cd0b2738b6.jpg"
                        alt="Image" width="50px">

                </a>
                <div class="media-body">
                    <h4 class="media-heading"><a href="" style="font-size: 14px; ">Media
                            heading</a>
                    </h4>
                    <p style="margin: 0; font-size: 11px; font-style: italic;">mota</p>
                </div>
            </div>
        </div>
    </div>
</form>
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
                                        style="color: #e53637">
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

            </div>
        </div>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection