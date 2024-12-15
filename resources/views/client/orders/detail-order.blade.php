@extends('client.layouts.master')

@section('title')
    Order detail
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
        .container {
            max-width: 1400px;
        }

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

        // star
        .star-rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
            gap: 5px;
            position: relative;
        }

        .star-rating input {
            display: none;
        }

        .star-rating label {
            font-size: 2rem;
            color: #ddd;
            cursor: pointer;
            transition: color 0.2s ease-in-out;
            position: relative;
        }

        .star-rating label::before {
            content: '★';
            font-size: inherit;
        }

        .star-rating input:checked~label {
            color: #ffc107;
        }

        .star-rating input:hover~label,
        .star-rating label:hover~label {
            color: #ffcc00;
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
                            <a href="{{ route('client.home') }}">Home</a>
                            <a href="{{ route('getListOrderHistory') }}">Order History</a>
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
                            <h5 class="card-title flex-grow-1 mb-0 text-danger">Order: {{ $order->sku_order }}</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-nowrap align-middle table-borderless mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th scope="col">Product Details</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col" class="text-center">Total Amount</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($order->orderItems as $item)
                                        <tr class="">
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        <img src="{{ Storage::url($item->productVariant->product->img_thumbnail) }}"
                                                            alt="" height="100%" width="100%">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15">
                                                            <a href="{{ route('productDetail', $item->productVariant->product->slug) }}"
                                                                class="link-primary text-wrap w-100">{{ $item->productVariant->product->name }}</a>
                                                        </h5>
                                                        <p class="text-muted mb-0">Color:
                                                            <span class="fw-medium ms-2"
                                                                style="background: {{ $item->productVariant->color->name }}; padding:0px 10px"></span>
                                                        </p>
                                                        <p class="text-muted mb-0">Size: <span
                                                                class="fw-medium">{{ $item->productVariant->size->name }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                {{ number_format($item->price, 0, '.', '.') }}</td>
                                            <td class="text-center align-middle">{{ $item->quantity }}</td>
                                            <td class="fw-medium text-center align-middle">
                                                {{ number_format($item->quantity * $item->price, 0, '.', '.') }}
                                                @php
                                                    $total += $item->quantity * $item->price;
                                                @endphp
                                            </td>
                                            @if (!$checkReviewed)
                                                @if ($order->status_order == 'delivered')
                                                    <td class="text-center align-middle">
                                                        <a href="#" class="btn badge badge-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#reviewModal-{{ $item->id }}">Review</a>
                                                    </td>
                                                @endif
                                            @endif
                                        </tr>
                                        {{-- @dd($item->productVariant->product->id) --}}
                                        <div class="modal fade" id="reviewModal-{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="reviewModalLabel-{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="modal-title fs-5"
                                                            id="reviewModalLabel-{{ $item->id }}">Ratings and Reviews
                                                        </p>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="card card-rating mb-3">
                                                        <div class="row g-0">
                                                            <div class="col-md-4">
                                                                <img src="{{ Storage::url($item->productVariant->product->img_thumbnail) }}"
                                                                    class="img-fluid rounded-start w-100 h-auto"
                                                                    alt="Sản phẩm" />
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div
                                                                    class="card-body d-flex flex-column justify-content-center h-100">
                                                                    <h5 class="card-title text-truncate"
                                                                        style="max-width: 100%;">
                                                                        {{ $item->productVariant->product->name }}
                                                                    </h5>
                                                                    <p class="card-text text-muted mb-1">Price:
                                                                        {{ $item->price }}</p>
                                                                    <p class="card-text text-muted mb-1">Size:
                                                                        {{ $item->productVariant->size->name }}</p>
                                                                    <div class="d-flex align-items-center mb-1">
                                                                        <p class="card-text text-muted mb-0 me-2">Color:</p>
                                                                        <div
                                                                            style="
                                                                                width: 20px;
                                                                                height: 20px;
                                                                                border-radius: 50%;
                                                                                background-color: {{ $item->productVariant->color->name }};
                                                                                border: 1px solid #ddd;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <form action="{{ route('ratings.store') }}" method="POST">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" name="user_id"
                                                                value="{{ auth()->id() }}" />
                                                            <input type="hidden" name="order_id"
                                                                value="{{ $order->id }}" />
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $item->productVariant->product->id }}">
                                                            {{-- <input type="hidden" name="product_variant_id"
                                                                value="{{ $item->productVariant->id }}"> --}}

                                                            <div class="mb-3">
                                                                <label for="rating" class="form-label">Your
                                                                    rating:</label>
                                                                <div class="star-rating">
                                                                    <input type="radio" id="star5-{{ $item->id }}"
                                                                        name="value" value="5" />
                                                                    <label for="star5-{{ $item->id }}"
                                                                        title="Excellent"></label>

                                                                    <input type="radio" id="star4-{{ $item->id }}"
                                                                        name="value" value="4" />
                                                                    <label for="star4-{{ $item->id }}"
                                                                        title="Good"></label>

                                                                    <input type="radio" id="star3-{{ $item->id }}"
                                                                        name="value" value="3" />
                                                                    <label for="star3-{{ $item->id }}"
                                                                        title="Average"></label>

                                                                    <input type="radio" id="star2-{{ $item->id }}"
                                                                        name="value" value="2" />
                                                                    <label for="star2-{{ $item->id }}"
                                                                        title="Poor"></label>

                                                                    <input type="radio" id="star1-{{ $item->id }}"
                                                                        name="value" value="1" />
                                                                    <label for="star1-{{ $item->id }}"
                                                                        title="Very Poor"></label>
                                                                </div>
                                                            </div>

                                                            <div class="mb-4">
                                                                <label for="comment-{{ $item->id }}"
                                                                    class="form-label">Your review:</label>
                                                                <textarea class="form-control" id="comment-{{ $item->id }}" name="comment" rows="4"
                                                                    placeholder="Please share your thoughts about this product..." required></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit"
                                                                class="btn btn-rating btn-primary w-100">Send</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <tr class="border-top border-top-dashed">
                                        <td colspan="3">
                                            <textarea class="form-control bg-white" rows="3" disabled>{{ $order->user_note }}</textarea>
                                        </td>
                                        <td colspan="2" class="fw-medium p-0">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    @php
                                                        $subTotal = $order->total_amount;
                                                        $discount = $order->coupon->value ?? null;
                                                        $shippingCharge = $subTotal < 1000000 ? 50000 : 0;
                                                    @endphp
                                                    <tr>
                                                        <td>Sub Total :</td>
                                                        <td class="text-end">
                                                            {{ number_format($total, 0, '.', '.') }} VNĐ
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        @if ($discount)
                                                            @if ($order->coupon->type == 'percent')
                                                                <td>Discount <span
                                                                        class="text-muted">({{ $order->coupon->code }})</span>
                                                                    :
                                                                </td>
                                                                <td class="text-end">
                                                                    {{ number_format($discount, 0, '.', '.') }} %
                                                                </td>
                                                            @else
                                                                <td>Discount <span
                                                                        class="text-muted">({{ $order->coupon->code }})</span>
                                                                    :
                                                                </td>
                                                                <td class="text-end">
                                                                    {{ number_format($discount, 0, '.', '.') }} VNĐ
                                                                </td>
                                                            @endif
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td>Shipping Charge :</td>

                                                        <td class="text-end">
                                                            {{ number_format($shippingCharge, 0, '.', '.') }} VNĐ</td>

                                                    </tr>
                                                    <tr class="border-top border-top-dashed text-danger">
                                                        <th scope="row" style="font-weight: 800; font-size: 20px;">
                                                            Total:
                                                        </th>
                                                        <th class="text-end" style="font-weight: 800; font-size: 20px;">
                                                            {{ number_format($subTotal, 0, '.', '.') }} VNĐ
                                                        </th>
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

                                @if ($order->status_order === 'pending' || $order->status_order === 'confirmed' || $order->status_order === 'processing')
                                    <!-- Nút "Hủy đơn" mở modal -->

                                    <button type="button" class="btn btn-soft-danger btn-sm mt-2 mt-sm-0"
                                        data-bs-toggle="modal" data-bs-target="#cancelOrderModal"><i
                                            class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel
                                        Order</button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="cancelOrderModal" tabindex="-1"
                                        aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="cancelOrderModalLabel">Hủy
                                                        đơn hàng #{{ $order->sku_order }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('orders.cancel', $order->sku_order) }}"
                                                        method="POST">
                                                        @csrf
                                                        <div class="row mb-5">
                                                            <div class="col-sm-5">
                                                                <span>Chọn lý do hủy
                                                                    đơn:</span>
                                                            </div>
                                                            <div class="col-sm-7">
                                                                <select class="pb-0" name="cancel_reason">

                                                                    <option value="">Chọn lý do
                                                                    </option>

                                                                    <option value="Thay đổi phương thức thanh toán">
                                                                        Thay
                                                                        đổi phương thức thanh toán</option>
                                                                    <option value="Giá không hợp lý">Giá
                                                                        không hợp lý</option>
                                                                    <option value="Thay đổi địa chỉ nhận hàng">
                                                                        Thay đổi địa chỉ nhận hàng</option>
                                                                    <option value="Thời gian giao hàng lâu">
                                                                        Thời gian giao hàng lâu</option>
                                                                    <option value="Khác">Khác</option>
                                                                </select>

                                                                @error('cancel_reason')
                                                                    <span class="invalid-feedback fw-bold"
                                                                        style="display: flex;padding-top: 7px">
                                                                        {{ $message }}
                                                                    </span>
                                                                @enderror
                                                            </div>


                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-5">
                                                                <label for="otherReason" class="form-label">Lý
                                                                    do khác (nếu có):</label>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="mb-3">

                                                                    <textarea class="form-control" id="otherReason" name="other_reason" rows="3"></textarea>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                            <button type="submit" class="btn btn-danger">Xác nhận
                                                                hủy</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if ($order->status_order == 'cancelled')
                                        <span type="button"
                                            class="btn btn-soft-danger btn-sm mt-2 mt-sm-0 fw-bold text-danger"><i
                                                class="mdi mdi-archive-remove-outline align-middle me-1"></i> Order has
                                            been
                                            cancelled</span>
                                    @else
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                    @if ($order->status_order !== 'canceled')
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
                                                                class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div id="collapseOne" class="accordion-collapse collapse show"
                                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body ms-2 ps-5 pt-0">
                                                <h6 class="mb-1">An order has been placed.</h6>
                                                <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                                <h6 class="mb-1">Seller has processed your order.</h6>
                                                <p class="text-muted mb-0">Thu, 16 Dec 2021 - 5:48AM</p>
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
                                                href="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
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
                    @endif
                </div>
                <!--end card-->
            </div>
            <!--end col-->
            @if ($order->status_order !== 'canceled')
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex">
                                <h5 class="card-title flex-grow-1 mb-0"><i
                                        class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Logistics
                                    Details
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
                                        <a href="{{ route('showFormUpdateProfile', Auth::user()->id) }}"
                                            class="link-secondary">View Profile</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled mb-0 vstack gap-3">
                                    <li>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                @if (!empty($order->user->avatar))
                                                    <img src="{{ Storage::url($order->user->avatar) }}" alt=""
                                                        class="avatar-sm rounded-circle">
                                                @else
                                                    <img src="{{ asset('image-default/avatar.jpg') }}" alt=""
                                                        class="avatar-sm rounded">
                                                @endif
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
                                        {{ $order->user->province }}
                                    </li>
                                    <li>
                                        <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                        {{ $order->user->district }}
                                    </li>
                                    <li>
                                        <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                        {{ $order->user->ward }}
                                    </li>
                                    <li>
                                        <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                        {{ $order->user->address }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                                Shipping
                                Address</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">

                                <li class="fw-medium fs-14">
                                    <i class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user_name }}
                                </li>
                                <li>
                                    <i class="mdi mdi-phone text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user_phone }}
                                </li>
                                <li>
                                    <i class="mdi mdi-email text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user_email }}
                                </li>
                                <li>
                                    <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user_province }}
                                </li>
                                <li>
                                    <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user_district }}
                                </li>
                                <li>
                                    <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user_ward }}
                                </li>
                                <li>
                                    <i class="mdi mdi-map-marker text-muted fs-16 align-middle me-1"></i>
                                    {{ $order->user_address }}
                                </li>
                            </ul>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0"><i
                                    class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
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
                                        <i class="ri-money-dollar-circle-line me-2 align-middle text-muted fs-16"></i>
                                        Total Amount:
                                    </p>
                                </div>
                                <div class="flex-grow-1 ms-2">
                                    <p class="mb-0 fw-bold">{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</p>
                                </div>
                            </div>



                        </div>
                    </div>
                    <!--end card-->
                </div>
            @endif
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
