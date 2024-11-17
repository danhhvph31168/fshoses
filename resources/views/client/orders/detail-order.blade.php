@extends('client.layouts.master')

@section('title')
    Chi tiết đơn hàng
@endsection
@section('css')
    <link rel="shortcut icon" href="{{ asset('theme/admin/assets/images/favicon.ico') }}">
    <!-- Layout config Js -->
    <script src="{{ asset('theme/admin/assets/js/layout.js') }}"></script>

    <!-- Icons Css -->
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('theme/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .footer {
            background-color: black !important;
            margin-top: 80px;
            padding-top: 50px;
            max-width: 100% !important;
            position: relative !important;
            left: 0;
        }

        .footer .container {
            max-width: 100% !important;
            background-color: black !important;
        }

        .footer .row {

            position: relative;
            padding-top: 50px;
            padding-left: 50px;
            padding-right: 50px;
        }

        .footer .footer__about {
            padding-left: 50px;
        }

        .footer .footer__widget {
            padding-right: 50px;
        }
    </style>
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-xl-9">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Order: {{ $order->sku_order }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap align-middle table-borderless mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Product Details</th>
                                        <th scope="col">Item Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col" class="text-end">Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($order->orderItems as $item)
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        <img src="{{ $item->productVariant->product->img_thumbnail }}"
                                                            alt="" class="img-fluid d-block">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15"><a href="apps-ecommerce-product-details.html"
                                                                class="link-primary">{{ $item->productVariant->product->name }}</a>
                                                        </h5>
                                                        <p class="text-muted mb-0">Color: <span
                                                                class="fw-medium">{{ $item->productVariant->color->name }}</span>
                                                        </p>
                                                        <p class="text-muted mb-0">Size: <span
                                                                class="fw-medium">{{ $item->productVariant->size->name }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">${{ $item->price }}</td>
                                            <td class="text-center">{{ $item->quantity }}</td>
                                            <td class="fw-medium text-end">
                                                ${{ number_format($item->quantity * $item->price, 0, '.', ',') }}
                                            </td>
                                        @endforeach
                                    </tr>

                                    <tr class="border-top border-top-dashed">
                                        <td colspan="3"></td>
                                        <td colspan="2" class="fw-medium p-0">
                                            <table class="table table-borderless mb-0">

                                                <tbody>
                                                    <tr>
                                                        <td>Sub Total :</td>
                                                        <td class="text-end"> ${{ number_format($item->quantity * $item->price, 0, '.', ',') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount <span class="text-muted">(VELZON15)</span> : :</td>
                                                        <td class="text-end">-$53.99</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>
                                                        <td class="text-end">$65.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Estimated Tax :</td>
                                                        <td class="text-end">$44.99</td>
                                                    </tr>
                                                    <tr class="border-top border-top-dashed">
                                                        <th scope="row">Total (USD) :</th>
                                                        <th class="text-end">$415.96</th>
                                                    </tr>
                                                </tbody>

                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end card-->
                <div class="card">
                    <div class="card-header">
                        <div class="d-sm-flex align-items-center">
                            <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                            <div class="flex-shrink-0 mt-2 mt-sm-0">

                                <a href="javascript:void(0);" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"><i
                                        class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="profile-timeline">
                            <div class="accordion accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingOne">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                            href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle">
                                                        <i class="ri-shopping-bag-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span
                                                            class="fw-normal">{{ $order->created_at->format('D, d M Y') }}</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body ms-2 ps-5 pt-0">
                                            <h6 class="mb-1">An order has been placed.</h6>
                                            <p class="text-muted">{{ $order->created_at->format('D, d M Y - h:iA') }}</p>

                                            <h6 class="mb-1">Seller has processed your order.</h6>
                                            <p class="text-muted mb-0">{{ $order->updated_at->format('D, d M Y - h:iA') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingTwo">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                            href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle">
                                                        <i class="mdi mdi-gift-outline"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-1 fw-semibold">Packed - <span
                                                            class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body ms-2 ps-5 pt-0">
                                            <h6 class="mb-1">Your Item has been picked up by courier partner</h6>
                                            <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingThree">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                            href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-success rounded-circle">
                                                        <i class="ri-truck-line"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span
                                                            class="fw-normal">Thu, 16 Dec 2021</span></h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    <div id="collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body ms-2 ps-5 pt-0">
                                            <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                            <h6 class="mb-1">Your item has been shipped.</h6>
                                            <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingFour">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                            href="#collapseFour" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-light text-success rounded-circle">
                                                        <i class="ri-takeaway-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="accordion-item border-0">
                                    <div class="accordion-header" id="headingFive">
                                        <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                            href="#collapseFile" aria-expanded="false">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 avatar-xs">
                                                    <div class="avatar-title bg-light text-success rounded-circle">
                                                        <i class="mdi mdi-package-variant"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--end accordion-->
                        </div>
                    </div>
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            <div class="col-xl-3">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <h5 class="card-title flex-grow-1 mb-0"><i
                                    class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics Details
                            </h5>

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop"
                                colors="primary:#405189,secondary:#0ab39c" style="width:80px;height:80px"></lord-icon>
                            <h5 class="fs-16 mt-2">RQK Logistics</h5>
                            <p class="text-muted mb-0">ID: {{ $order->sku_order }}</p>
                        </div>
                    </div>
                </div>
                <!--end card-->
                @if (Auth::check())
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0">Customer Details</h5>
                                <div class="flex-shrink-0">
                                    <a href="javascript:void(0);" class="link-secondary">View Profile</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0 vstack gap-3">
                                <li>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ $order->user->avatar }}" alt=""
                                                class="avatar-sm rounded">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h6 class="fs-14 mb-1">{{ $order->user->name }}</h6>
                                            <p class="text-muted mb-0">Customer</p>
                                        </div>
                                    </div>
                                </li>
                                <li><i
                                        class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->user->email }}
                                </li>
                                <li><i
                                        class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->user->phone }}
                                </li>
                                <li>
                                    <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user->address }}
                                </li>
                            </ul>
                        </div>
                    </div>
                @endif
                <!--end card-->
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Shipping
                            Address</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                            <li class="fw-medium fs-14">
                                <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                {{ $order->user_name }}
                            </li>
                            <li>
                                <i class="mdi mdi-phone text-muted fs-16 align-middle me-1"></i> {{ $order->user_phone }}
                            </li>
                            <li>
                                <i class="mdi mdi-email text-muted fs-16 align-middle me-1"></i> {{ $order->user_email }}
                            </li>
                            <li>
                                <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                {{ $order->user_address }}
                            </li>
                        </ul>

                    </div>
                </div>
                <!--end card-->

                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                            Payment Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">
                                    <i class="ri-wallet-line me-2 align-middle text-muted fs-16"></i> Payment Method:
                                </p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 fw-bold">{{ $order->payment->payments_method }}</p>
                            </div>
                        </div>


                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <p class="text-muted mb-0">
                                    <i class="ri-money-dollar-circle-line me-2 align-middle text-muted fs-16"></i> Total
                                    Amount:
                                </p>
                            </div>
                            <div class="flex-grow-1 ms-2">
                                <p class="mb-0 fw-bold">{{ $order->total_amount }}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end card-->
            </div>
        </div>
    </div>
    <!-- Shopping Cart Section End -->
@endsection
@section('scripts')
    <script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/plugins.js') }}"></script>
@endsection
