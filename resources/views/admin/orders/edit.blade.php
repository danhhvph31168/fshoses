@extends('admin.layouts.master')

@section('title')
    Edit new
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Edit Order</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                        <li class="breadcrumb-item active">Edit new</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-8">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Status --}}
                <div class="card ribbon-box ribbon-fill shadow-none right">
                    <div class="tab-content">
                        <div>
                            @if ($order->total_amount >= 500000)
                                <div class="ribbon-two ribbon-two-danger"><span>Free Ship</span></div>
                            @endif

                            <div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="mb-3 d-flex">
                                            <label for="billinginfo-firstName" class="form-label">Sku:
                                                <span class="text-danger">{{ $order->sku_order }}</span></label>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="mb-3 d-flex">
                                            <label for="billinginfo-firstName" class="form-label">Payment Method:
                                                <span
                                                    class="text-danger">{{ Str::upper($order->payment->payments_method) }}</span></label>
                                        </div>
                                    </div>

                                    @if (!empty($order->staff))
                                        <div class="col-sm-5">
                                            <div class="mb-3 d-flex">
                                                <label for="billinginfo-firstName" class="form-label">Handler:
                                                    <span class="text-danger">{{ $order->staff->name }}
                                                        ({{ $order->staff->role->name }})</span></label>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="billinginfo-email" class="form-label">Status Order</label>
                                            <div class="hstack gap-2 flex-wrap">
                                                @foreach ($data['statusOrder'] as $id => $vi)
                                                    @if ($order->status_order == $id)
                                                        <input type="radio" class="btn-check" name="status_order"
                                                            id="status_order_{{ $id }}"
                                                            value="{{ $id }}" checked>
                                                        <label
                                                            class="btn
                                                        {{ $order->status_order == App\Models\Order::STATUS_ORDER_CANCELED ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                            for="status_order_{{ $id }}">{{ $id }}</label>
                                                    @else
                                                        <input type="radio" class="btn-check" name="status_order"
                                                            id="status_order_{{ $id }}"
                                                            value="{{ $id }}" @disabled(
                                                                $order->status_order == App\Models\Order::STATUS_ORDER_CANCELED ||
                                                                    $order->status_order == App\Models\Order::STATUS_ORDER_DELIVERED)>
                                                        <label class="btn btn-outline-success "
                                                            for="status_order_{{ $id }}">{{ $id }}</label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="mb-3">
                                            <label for="billinginfo-phone" class="form-label">Payment</label>
                                            <div class="hstack gap-2 flex-wrap">
                                                @foreach ($data['paymentStatus'] as $id => $vi)
                                                    @if ($order->payment->status == $id)
                                                        <input type="radio" class="btn-check" name="payment_status"
                                                            id="paymetnStatus_{{ $id }}"
                                                            value="{{ $id }}" checked>
                                                        <label
                                                            class="btn {{ $order->payment->status == App\Models\Payment::STATUS_FAILED ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                            for="paymetnStatus_{{ $id }}">{{ $id }}</label>
                                                    @else
                                                        <input type="radio" class="btn-check" name="payment_status"
                                                            id="paymetnStatus_{{ $id }}"
                                                            value="{{ $id }}" @disabled(
                                                                $order->payment->status == App\Models\Payment::STATUS_FAILED ||
                                                                    $order->payment->status == App\Models\Payment::STATUS_PAID ||
                                                                    $order->status_order == App\Models\Order::STATUS_ORDER_CANCELED)>
                                                        <label class="btn btn-outline-success"
                                                            for="paymetnStatus_{{ $id }}">{{ $id }}</label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- button --}}
                                <div class="row">
                                    <div>
                                        <button class="btn btn-primary float-md-end" style="width: 16%"
                                            type="submit">Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            {{-- Product --}}
            <div class="card">
                <div>
                    <table class="table text-center">
                        <thead>
                            <tr>
                                <th style="width: 170px;" scope="col">Product</th>
                                <th scope="col">Name</th>
                                <th scope="col">Variant</th>
                                <th scope="col" class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $subtotal = 0;
                            @endphp
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td>
                                        @if ($item->productVariant->image)
                                            <img src="{{ Storage::url($item->productVariant->image) }}" alt=""
                                                height="80%" width="80%" class="d-block rounded" />
                                        @else
                                            <img src="{{ Storage::url($item->productVariant->product->img_thumbnail) }}"
                                                alt="" height="80%" width="80%" class="d-block rounded" />
                                        @endif
                                    </td>
                                    <td style="align-content: center;">
                                        <h5 class="fs-14"><a
                                                href="{{ route('productDetail', $item->productVariant->product->slug) }}"
                                                class="text-body">{{ $item->productVariant->product->name }}</a>
                                        </h5>
                                    </td>
                                    <td style="align-content: center !important;">
                                        <p class="rounded-circle text-muted mb-0">
                                            Color: <i class="ri-checkbox-blank-circle-fill"
                                                style="color: {{ $item->productVariant->color->name }};"></i> -
                                            Size: {{ $item->productVariant->size->name }}</p>
                                        <p class="text-muted mb-0">
                                            {{ number_format($item->price) }} x{{ $item->quantity }}
                                        </p>
                                    </td>

                                    @php
                                        $price = intval($item->price);
                                        $total = $price * $item->quantity;
                                    @endphp

                                    <td class="text-end" style="align-content: center;">
                                        {{ number_format($total) }}
                                        vnđ
                                    </td>
                                </tr>
                                @php
                                    $subtotal += $total;
                                @endphp
                            @endforeach

                            {{-- @dd($subtotal) --}}

                            @if ($order->coupon)
                                <tr>
                                    <td class="fw-semibold text-danger text-start" colspan="3">Sub Total :</td>
                                    <td class="fw-semibold text-danger text-end">
                                        {{ number_format($subtotal) }} vnđ
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-danger text-start" colspan="3">Discount
                                        [{{ $order->coupon->code }}] :</td>
                                    <td class="fw-semibold text-danger text-end">
                                        {{ number_format($order->coupon->value) }}
                                        @if ($order->coupon->type == 'percent')
                                            %
                                        @else
                                            VNĐ
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-danger text-start" colspan="3">Total :</td>
                                    <td class="fw-semibold text-danger text-end">
                                        {{ number_format($order->total_amount) }} vnđ
                                    </td>
                                </tr>
                            @else
                                <tr>
                                    <td class="fw-semibold text-danger text-start" colspan="3">Sub Total :</td>
                                    <td class="fw-semibold text-danger text-end">
                                        {{ number_format($order->total_amount) }} vnđ
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-danger text-start" colspan="3">Discount
                                        ({{ $order->coupon->code }}) :</td>
                                    <td class="fw-semibold text-danger text-end"> 0 </td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-danger text-start" colspan="3">Total :</td>
                                    <td class="fw-semibold text-danger text-end">
                                        {{ number_format($order->total_amount) }} vnđ
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                </div>

            </div>
        </div>


        {{-- User --}}
        <div class="col-xl-4">
            @if (!$order->user->password == null)
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Customer</h5>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <ul class="list-unstyled mb-0 vstack gap-3">
                            <li>
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ Storage::url($order->user->avatar) }}" alt=""
                                            class="avatar-sm rounded">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fs-14 mb-1">{{ $order->user->name }}</h6>
                                        <p class="text-muted mb-0">{{ $order->user->role->name }}</p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->user->email }}
                            </li>

                            <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->user->phone }}
                            </li>

                            <li><i class="ri-user-location-line me-2 align-middle text-muted fs-16"></i>
                                {{ $order->user->address }}, {{ $order->user->ward }}, {{ $order->user->district }},
                                {{ $order->user->province }}
                            </li>
                        </ul>
                    </div>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-0">Shipping Address</h5>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    @if ($order->user->avatar)
                                        <img src="{{ Storage::url($order->user->avatar) }}" alt=""
                                            class="avatar-sm rounded">
                                    @else
                                        <img src="{{ asset('image-default/avatar.jpg') }}" alt=""
                                            class="avatar-sm rounded">
                                    @endif
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{ $order->user_name }}</h6>
                                </div>
                            </div>
                        </li>
                        <li>
                            <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $order->user_email }}
                        </li>

                        <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $order->user_phone }}
                        </li>

                        <li><i class="ri-user-location-line me-2 align-middle text-muted fs-16"></i>
                            {{ $order->user_address }}, {{ $order->user_ward }}, {{ $order->user_district }},
                            {{ $order->user_province }}
                        </li>

                        <li><i class="ri-sticky-note-line  me-2 align-middle text-muted fs-16"></i>{{ $order->user_note }}
                        </li>

                    </ul>
                </div>
            </div>

        </div>

    </div>
@endsection

@section('style-libs')
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/admin/assets/libs/multi.js/multi.min.css') }}" />
@endsection

<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.2s ease-in-out, box-shadow 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }


    .card-header {
        background-color: #f7f9fc;
        padding: 15px;
        border-bottom: 1px solid #e0e6ed;
    }

    .card-title {
        font-size: 18px;
        font-weight: 600;
        color: #333;
    }


    .form-control {
        border: 1px solid #ced4da;
        border-radius: 6px;
        transition: all 0.3s ease;
        padding: 10px 12px;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    label {
        font-size: 14px;
        color: #495057;
        margin-bottom: 5px;
        font-weight: 500;
    }


    .btn-success {
        background-color: #007bff;
        border-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-success {
        border: 1px solid #28a745;
        color: #28a745;
        padding: 10px 20px;
        border-radius: 6px;
        font-size: 14px;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .btn-outline-success:hover {
        background-color: #28a745;
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .badge {
        font-size: 14px;
        font-weight: 500;
        border-radius: 6px;
    }


    .row>.col-md-3,
    .col-md-4,
    .col-md-6 {
        padding: 8px;
    }

    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .card {
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
        padding: 20px;
        background-color: #fff;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    /* Header chỉnh font và badge */
    .card-header {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #ececec;
        padding-bottom: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .badge {
        background: linear-gradient(45deg, #6a5acd, #836fff);
        color: white;
        padding: 5px 12px;
        border-radius: 6px;
        font-size: 14px;
    }

    /* Form các trường input */
    .form-control {
        border-radius: 6px;
        border: 1px solid #d4d4d4;
        padding: 10px;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 6px rgba(0, 123, 255, 0.3);
    }

    label {
        font-size: 14px;
        color: #495057;
        font-weight: 500;
    }

    /* Ảnh trong bảng */
    .product-image img {
        width: 50px;
        height: 50px;
        border-radius: 6px;
        border: 1px solid #dcdcdc;
        object-fit: cover;
    }

    /* Nút cài đặt */
    .settings-icon {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #007bff;
        color: #fff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .settings-icon:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
    }
</style>

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js" async></script>
    <script src="{{ asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/modal.init.js') }}"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
@endsection
