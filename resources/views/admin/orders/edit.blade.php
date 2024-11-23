@extends('admin.layouts.master')

@section('title')
Edit new
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Edit new</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                    <li class="breadcrumb-item active">Edit new</li>
                </ol>
            </div>

        </div>
    </div>
</div>

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="tab-content">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Order Item</h4>
            </div>
            <div class="card-body" id="card-body">

                <div class="live-preview mb-3">
                    <div class="row gy-4">
                        <div class="col-md-12">
                            <table class="table table-bordered border-0 text-center">
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Product Size</th>
                                    <th>Product Color</th>
                                    <th>Product Quantity</th>
                                </tr>
                                @foreach ($dataProductVariant as $item)
                                    <tr>

                                        <td><img src="{{ $item['product']->img_thumbnail }}" width="50px" height="50px">
                                        </td>
                                        <td>{{ $item['product']->name }}</td>
                                        <td>
                                            {{ empty($item['product']->price_sale) ? $item['product']->price_regular : $item['product']->price_sale }}
                                        </td>
                                        <td>{{ $item['size']->name }}</td>
                                        <td>
                                            <div
                                                class="rounded-circle fs-20" style="color: {{$item['color']->name}};">
                                                <i class="ri-checkbox-blank-circle-fill"></i>
                                            </div>
                                        </td>
                                        <td>{{ $item['quantity'] }}</td>
                                    </tr>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--end col-->
</div>

<form action="{{ route('admin.orders.update', $order) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div>div>
    <div class="col-xl-8">
        <div class="card ribbon-box ribbon-fill shadow-none right">
            <div class="tab-content">
        <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel"
             aria-labelledby="pills-bill-info-tab">
            @if ($order->total_amount >= 500000)
                <div class="ribbon-two ribbon-two-danger"><span>Free Ship</span></div>
            @endif

            <div>
                <h5 class="mb-1">Edit Order</h5>
            </div>

            <div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="billinginfo-firstName"
                                   class="form-label">Sku</label>
                            <input type="text" class="form-control" name="sku_order" id="sku"
                                   value="{{ $order->sku_order }}" disabled>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="billinginfo-lastName"
                                   class="form-label">Role</label>
                            <select name="role_id" class="form-control">
                                @foreach ($data['roles'] as $id => $name)
                                    <option @selected($order->role_id == $id) value="{{ $id }}">
                                        {{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="billinginfo-email" class="form-label">Status Order</label>
                            <div class="hstack gap-2 flex-wrap">
                                @foreach ($data['statusOrder'] as $id => $vi)
                                    @if($order->status_order == $id)
                                        <input type="radio" class="btn-check" name="status_order" id="status_order_{{ $id }}" value="{{ $id }}" checked>
                                        <label class="btn btn-outline-success" for="status_order_{{ $id }}">{{ $id }}</label>
                                    @else
                                        <input type="radio" class="btn-check" name="status_order" id="status_order_{{ $id }}" value="{{ $id }}">
                                        <label class="btn btn-outline-success" for="status_order_{{ $id }}">{{ $id }}</label>
                                    @endif

                                @endforeach
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="mb-3">
                            <label for="billinginfo-phone"
                                   class="form-label">Status Payment</label>
                            <div class="hstack gap-2 flex-wrap">
                                @foreach ($data['statusPayment'] as $id => $vi)
                                    @if($order->status_order == $id)
                                        <input type="radio" class="btn-check" name="status_payment" id="statusPayment_{{ $id }}" value="{{ $id }}" checked>
                                        <label class="btn btn-outline-success" for="statusPayment_{{ $id }}">{{ $id }}</label>
                                    @else
                                        <input type="radio" class="btn-check" name="status_payment" id="statusPayment_{{ $id }}" value="{{ $id }}">
                                        <label class="btn btn-outline-success" for="statusPayment_{{ $id }}">{{ $id }}</label>
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
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Recipient Address</h4>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    <div class="row gy-4">

                        <div class="col-md-4 mt-3">
                            <label for="sku" class="form-label">User Name</label>
                            <input type="text" class="form-control" value="{{ $order->user_name }}">
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="sku" class="form-label">User Email</label>
                            <input type="email" class="form-control" value="{{ $order->user_email }}">
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="sku" class="form-label">User Phone</label>
                            <input type="text" class="form-control" value="{{ $order->user_phone }}">
                        </div>

                        <div class="col-md-4 mt-3">
                            <label for="sku" class="form-label">User Address</label>
                            <input type="text" class="form-control" value="{{ $order->user_address }}">
                        </div>

                        <div class="col-md-8 mt-3">
                            <label for="sku" class="form-label" style="margin-top: 5px;">Note</label>
                            <textarea class="form-control" cols="30" rows="5"
                                      style="height: 40px;">{{ $order->user_note }}</textarea>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card">
            <div class="card-header">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <h5 class="card-title mb-0">Order Summary</h5>
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
                        <tr>
                            <td>
                                <div class="avatar-md bg-light rounded p-1">
                                    <img src="{{ URL::asset('build/images/products/img-8.png') }}" alt=""
                                         class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-14"><a href="apps-ecommerce-product-details"
                                                     class="text-body">Sweatshirt for Men (Pink)</a>
                                </h5>
                                <p class="text-muted mb-0">$ 119.99 x 2</p>
                            </td>
                            <td class="text-end">$ 239.98</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="avatar-md bg-light rounded p-1">
                                    <img src="{{ URL::asset('build/images/products/img-7.png') }}" alt=""
                                         class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-14"><a href="apps-ecommerce-product-details"
                                                     class="text-body">Noise Evolve Smartwatch</a></h5>
                                <p class="text-muted mb-0">$ 94.99 x 1</p>
                            </td>
                            <td class="text-end">$ 94.99</td>
                        </tr>
                        <tr>
                            <td>
                                <div class="avatar-md bg-light rounded p-1">
                                    <img src="{{ URL::asset('build/images/products/img-3.png') }}" alt=""
                                         class="img-fluid d-block">
                                </div>
                            </td>
                            <td>
                                <h5 class="fs-14"><a href="apps-ecommerce-product-details"
                                                     class="text-body">350 ml Glass Grocery Container</a>
                                </h5>
                                <p class="text-muted mb-0">$ 24.99 x 1</p>
                            </td>
                            <td class="text-end">$ 24.99</td>
                        </tr>
                        <tr>
                            <td class="fw-semibold" colspan="2">Sub Total :</td>
                            <td class="fw-semibold text-end">$ 359.96</td>
                        </tr>
                        <tr>
                            <td colspan="2">Discount <span class="text-muted">(VELZON15)</span>
                                : </td>
                            <td class="text-end">- $ 50.00</td>
                        </tr>
                        <tr>
                            <td colspan="2">Shipping Charge :</td>
                            <td class="text-end">$ 24.99</td>
                        </tr>
                        <tr>
                            <td colspan="2">Estimated Tax (12%): </td>
                            <td class="text-end">$ 18.20</td>
                        </tr>
                        <tr class="table-active">
                            <th colspan="2">Total (USD) :</th>
                            <td class="text-end">
                                        <span class="fw-semibold">
                                            $353.15
                                        </span>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex">

            <div class="card col-md-6">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Customer</h4>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">

                            <div class="col-md-4 mt-3">
                                <label for="sku" class="form-label">Customer Name</label>
                                <input type="text" class="form-control" value="{{ $order->user->name }}" disabled>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="sku" class="form-label">Customer Balance</label>
                                <input type="text" class="form-control" value="{{ $order->user->balance }}" disabled>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="sku" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" value="{{ $order->user->zip_code }}" disabled>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="sku" class="form-label">Customer Email</label>
                                <input type="text" class="form-control" value="{{ $order->user->email }}" disabled>
                            </div>

                            <div class="col-md-6 mt-3">
                                <label for="sku" class="form-label">Customer Address</label>
                                <input type="text" class="form-control" value="{{ $order->user->address }}" disabled>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="sku" class="form-label">Customer Phone</label>
                                <input type="text" class="form-control" value="{{ $order->user->phone }}" disabled>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="sku" class="form-label">Customer District</label>
                                <input type="text" class="form-control" value="{{ $order->user->district }}" disabled>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="sku" class="form-label">Customer Province</label>
                                <input type="text" class="form-control" value="{{ $order->user->province }}" disabled>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!--end col-->
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Payment method</h4>
                </div>
                <div class="card-body">
                    <div class="live-preview">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="radio" class="btn-check" id="success-outlined" autocomplete="on" checked>
                                <label style="width: 100%" class="btn btn-outline-primary"
                                    for="success-outlined">{{ $order->payment->payments_method }} payment</label>
                            </div>

                            <div class="col-md-6">
                                <select name="payment_status" class="form-control">
                                    @foreach ($data['paymentStatus'] as $id => $vi)
                                    <option @selected($order->payment->payments_method == $id) value="{{ $id }}">
                                        {{ $id }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
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
@endsection

@section('scripts')
@endsection

@section('style-libs')
<!-- multi.js css -->
<link rel="stylesheet" type="text/css" href="{{ asset('theme/admin/assets/libs/multi.js/multi.min.css') }}" />
@endsection

<script>
    console.log(@json($dataProductVariant))
</script>
