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

    <form action="{{ route('admin.orders.update', $order) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-xl-8">
                <div class="card ribbon-box ribbon-fill shadow-none right">
                    <div class="tab-content">
                        <div>
                            @if ($order->total_amount >= 500000)
                                <div class="ribbon-two ribbon-two-danger"><span>Free Ship</span></div>
                            @endif

                            <div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="mb-3 d-flex">
                                            <label for="billinginfo-firstName" class="form-label">{{ $order->staff->role->name }} :
                                                <span class="text-danger">{{ $order->staff->name }}</span></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="mb-3 d-flex">
                                            <label for="billinginfo-firstName" class="form-label">Sku :
                                                <span class="text-danger">{{ $order->sku_order }}</span></label>
                                        </div>
                                    </div>
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
                                            <label for="billinginfo-phone" class="form-label">Status Payment</label>
                                            <div class="hstack gap-2 flex-wrap">
                                                @foreach ($data['statusPayment'] as $id => $vi)
                                                    @if ($order->status_payment == $id)
                                                        <input type="radio" class="btn-check" name="status_payment"
                                                            id="statusPayment_{{ $id }}"
                                                            value="{{ $id }}" checked>
                                                        <label
                                                            class="btn {{ $order->status_payment == App\Models\Order::STATUS_PAYMENT_FAILED ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                            for="statusPayment_{{ $id }}">{{ $id }}</label>
                                                    @else
                                                        <input type="radio" class="btn-check" name="status_payment"
                                                            id="statusPayment_{{ $id }}"
                                                            value="{{ $id }}" @disabled($order->status_payment == App\Models\Order::STATUS_PAYMENT_REFUNDED)>
                                                        <label class="btn btn-outline-success"
                                                            for="statusPayment_{{ $id }}">{{ $id }}</label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="billinginfo-phone" class="form-label">Payment</label>
                                            <div class="hstack gap-2 flex-wrap">
                                                @foreach ($data['paymentStatus'] as $id => $vi)
                                                    @if ($order->payment->status == $id)
                                                        <input type="radio" class="btn-check" name="payment_status"
                                                            id="paymetnStatus_{{ $id }}"
                                                            value="{{ $id }}" checked>
                                                        <label class="btn {{ $order->payment->status == App\Models\Payment::STATUS_FAILED ? 'btn-outline-danger' : 'btn-outline-success' }}"
                                                            for="paymetnStatus_{{ $id }}">{{ $id }}</label>
                                                    @else
                                                        <input type="radio" class="btn-check" name="payment_status"
                                                            id="paymetnStatus_{{ $id }}"
                                                            value="{{ $id }}" @disabled($order->payment->status == App\Models\Payment::STATUS_REFUNDED)>
                                                        <label class="btn btn-outline-success"
                                                            for="paymetnStatus_{{ $id }}">{{ $id }}</label>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body checkout-tab">
                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">

                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bill-info" type="button" role="tab"
                                        aria-controls="pills-bill-info" aria-selected="true"><i
                                            class="ri-user-2-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Customer Info</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link fs-15 p-3" id="pills-bill-address-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-bill-address" type="button" role="tab"
                                        aria-controls="pills-bill-address" aria-selected="false"><i
                                            class="ri-truck-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                        Shipping Info</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
                                aria-labelledby="pills-bill-info-tab">

                                <div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-firstName" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="billinginfo-Name"
                                                    value="{{ $order->user->name }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-lastName" class="form-label">Email</label>
                                                <input type="text" class="form-control" id="billinginfo-Balance"
                                                    value="{{ $order->user->email }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="billinginfo-phone"
                                                    value="{{ $order->user->phone }}" disabled>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-3">
                                                <label for="billinginfo-email" class="form-label">Zip Code</label>
                                                <input type="email" class="form-control" id="billinginfo-zip_code"
                                                    value="{{ $order->user->zip_code }}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="province" class="form-label">Province</label>
                                                <input type="email" class="form-control" id="billinginfo-zip_code"
                                                    value="{{ $order->user->province }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">District</label>
                                                <input type="text" class="form-control" id="billinginfo-phone"
                                                    value="{{ $order->user->district }}" disabled>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label for="billinginfo-phone" class="form-label">Ward</label>
                                                <input type="text" class="form-control" id="billinginfo-phone"
                                                    value="{{ $order->user->ward }}" disabled>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="mb-3">
                                        <label for="billinginfo-address" class="form-label">Address</label>
                                        <textarea class="form-control" id="billinginfo-address" disabled rows="3">{{ $order->user->district }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->
                            <div class="tab-pane fade" id="pills-bill-address" role="tabpanel"
                                aria-labelledby="pills-bill-address-tab">
                                <div class="col">
                                    <div>
                                        <h5 class="mb-1">Recipient Address</h5>
                                    </div>

                                    <div class="mt-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <div class="flex-grow-1">
                                                <h5 class="fs-14 mb-0">Saved Address</h5>
                                            </div>
                                            <div class="flex-shrink-0">
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-sm btn-success mb-3"
                                                    data-bs-toggle="modal" data-bs-target="#addAddressModal">
                                                    Add Address
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row gy-3">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="form-check card-radio">
                                                    <input id="shippingAddress01" name="shippingAddress" type="radio"
                                                        class="form-check-input" checked>
                                                    <label class="form-check-label" for="shippingAddress01">
                                                        <span
                                                            class="mb-4 fw-semibold d-block text-muted text-uppercase">Home
                                                            Address</span>

                                                        <span class="fs-14 mb-2 d-block">{{ $order->user_name }}</span>
                                                        <span
                                                            class="text-muted fw-normal text-wrap mb-1 d-block">{{ $order->user_address }}</span>
                                                        <span
                                                            class="text-muted fw-normal text-wrap mb-1 d-block">{{ $order->user_email }}</span>
                                                        <span
                                                            class="text-muted fw-normal d-block">{{ $order->user_phone }}</span>
                                                    </label>
                                                </div>
                                                <div
                                                    class="d-flex flex-wrap p-2 py-1 bg-light rounded-bottom border mt-n1">
                                                    <div>
                                                        <a href="#" class="d-block text-body p-1 px-2"
                                                            data-bs-toggle="modal" data-bs-target="#addAddressModal"><i
                                                                class="ri-pencil-fill text-muted align-bottom me-1"></i>
                                                            Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Order Item</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive table-card">
                            <table class="table table-borderless align-middle mb-0">
                                <thead class="table-light text-muted">
                                    <tr>
                                        <th style="width: 90px;" scope="col">Product</th>
                                        <th scope="col">Product Info</th>
                                        <th scope="col" class="text-end">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($dataProductVariant as $item)
                                        @php
                                            $price =
                                                $item['product']->price_regular *
                                                ((100 - $item['product']->price_sale) / 100);

                                            $totalPrice =
                                                (empty($price) ? $item['product']->price_regular : $price) *
                                                $item['quantity'];
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="avatar-md bg-light rounded p-1">
                                                    <img src="{{ $item['product']->img_thumbnail }}" alt=""
                                                        class="img-fluid d-block">
                                                </div>
                                            </td>
                                            <td>
                                                <h5 class="fs-14"><a href="apps-ecommerce-product-details"
                                                        class="text-body">{{ $item['product']->name }}</a>
                                                </h5>
                                                <p class="rounded-circle text-muted mb-0">
                                                    Color: <i class="ri-checkbox-blank-circle-fill"
                                                        style="color: {{ $item['color']->name }};"></i> -
                                                    Size: {{ $item['size']->name }}</p>
                                                <p class="text-muted mb-0">
                                                    {{ number_format($price, 0, '.', ',') }}
                                                </p>
                                            </td>
                                            <td class="text-end">
                                                {{ number_format($totalPrice, 0, '.', ',') }}
                                                VND</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="fw-semibold text-danger" colspan="2">Sub Total :</td>
                                        <td class="fw-semibold text-danger text-end">
                                            {{ number_format($order->total_amount, 0, '.', ',') }} VND</td>
                                    </tr>

                                    <tr>
                                        <td class="fw-semibold float-start" colspan="2">Payment Method :</td>
                                        <td class="fw-semibold text-end">{{ $order->payment->payments_method }}</td>
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- end card body -->
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <button class="btn btn-success" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>


    <div id="addAddressModal" class="modal fade zoomIn" tabindex="-1" aria-labelledby="addAddressModalLabel"
        aria-hidden="true">
        <form action="{{ route('admin.orders.update', $order) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addAddressModalLabel">Address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="mb-3">
                                <label for="addaddress-Name" class="form-label">User Name</label>
                                <input type="text" class="form-control" id="addaddress-Name" placeholder="Enter name"
                                    value="{{ $order->user_name }}">
                            </div>

                            <div class="mb-3">
                                <label for="addaddress-textarea" class="form-label">User Address</label>
                                <textarea class="form-control" id="addaddress-textarea" placeholder="Enter address" rows="2">{{ $order->user_address }}</textarea>
                            </div>

                            <div class="mb-3">
                                <label for="addaddress-Name" class="form-label">User Phone</label>
                                <input type="text" class="form-control" id="addaddress-Name"
                                    placeholder="Enter phone no." value="{{ $order->user_phone }}">
                            </div>

                            <div class="mb-3">
                                <label for="email-Name" class="form-label">User Email</label>
                                <input type="text" class="form-control" id="email-Name" placeholder="Enter email"
                                    value="{{ $order->user_email }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </form>
    </div>
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

    .table {
        border-radius: 6px;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .table th,
    .table td {
        text-align: center;
        vertical-align: middle;
    }

    .table th {
        background-color: #f7f9fc;
        color: #333;
        font-weight: 600;
    }

    .table-bordered tr:hover {
        background-color: #f1f7ff;
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

    /* Bảng sản phẩm */
    .table {
        border: none;
        margin-top: 20px;
    }

    .table th {
        background-color: #f7f9fc;
        color: #333;
        font-weight: bold;
        text-align: center;
        border-bottom: 2px solid #e0e6ed;
    }

    .table td {
        text-align: center;
        vertical-align: middle;
        padding: 15px;
    }

    .table tr:hover {
        background-color: #f1f7ff;
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
@section('script-libs')
    <script src="https://cdn.jsdelivr.net/npm/toastify-js" async></script>
@endsection

@section('scripts')
    <script src="{{ URL::asset('theme/admin/assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('theme/admin/assets/js/pages/modal.init.js') }}"></script>
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
@endsection

@section('style-libs')
    <!-- multi.js css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/admin/assets/libs/multi.js/multi.min.css') }}" />
@endsection
