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

    <form action="{{ route('admin.orders.update', $order) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Edit Order</h4>
                        @if ($order->total_amount >= 500000)
                            <span class="badge text-bg-success p-3">Free Ship</span>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <div class="col-md-3">
                                    <label for="sku" class="form-label">Sku</label>
                                    <input type="text" class="form-control" name="sku_order" id="sku"
                                        value="{{ $order->sku_order }}" disabled>
                                </div>

                                <div class="col-md-3">
                                    <label for="sku" class="form-label">Status Order</label>
                                    <select name="status_order" class="form-control">
                                        @foreach ($data['statusOrder'] as $id => $vi)
                                            <option @selected($order->status_order == $id) value="{{ $id }}">
                                                {{ $id }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="sku" class="form-label">Status Payment</label>
                                    <select name="status_payment" class="form-control">
                                        @foreach ($data['statusPayment'] as $id => $vi)
                                            <option @selected($order->status_payment == $id) value="{{ $id }}">
                                                {{ $id }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="sku" class="form-label">Role</label>
                                    <select name="role_id" class="form-control">
                                        @foreach ($data['roles'] as $id => $name)
                                            <option @selected($order->role_id == $id) value="{{ $id }}">
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
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
                        <h4 class="card-title mb-0 flex-grow-1">Order Item</h4>
                    </div>
                    <div class="card-body" id="card-body">

                        @foreach ($dataProductVariant as $item)
                            <div class="live-preview mb-3">
                                <div class="row gy-4">
                                    <div class="col-md-12">
                                        <table class="table table-bordered border text-center">
                                            <tr>
                                                <th>Product Image</th>
                                                <th>Product Name</th>
                                                <th>Product Price</th>
                                                <th>Product Size</th>
                                                <th>Product Color</th>
                                                <th>Product Quantity</th>
                                            </tr>
                                            <tr>
                                                <td><img src="{{ $item['product']->img_thumbnail }}" width="50px"
                                                        height="50px"></td>
                                                <td>{{ $item['product']->name }}</td>
                                                <td>
                                                    {{ empty($item['product']->price_sale) ? $item['product']->price_regular : $item['product']->price_sale }}
                                                </td>
                                                <td>{{ $item['size']->name }}</td>
                                                <td>{{ $item['color']->name }}</td>
                                                <td>{{ $item['quantity'] }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!--end col-->
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
                                    <input type="text" class="form-control" value="{{ $order->user->balance }}"
                                        disabled>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="sku" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" value="{{ $order->user->zip_code }}"
                                        disabled>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="sku" class="form-label">Customer Email</label>
                                    <input type="text" class="form-control" value="{{ $order->user->email }}" disabled>
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="sku" class="form-label">Customer Address</label>
                                    <input type="text" class="form-control" value="{{ $order->user->address }}"
                                        disabled>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="sku" class="form-label">Customer Phone</label>
                                    <input type="text" class="form-control" value="{{ $order->user->phone }}"
                                        disabled>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="sku" class="form-label">Customer District</label>
                                    <input type="text" class="form-control" value="{{ $order->user->district }}"
                                        disabled>
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="sku" class="form-label">Customer Province</label>
                                    <input type="text" class="form-control" value="{{ $order->user->province }}"
                                        disabled>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="card col-md-6">
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
                                    <label for="sku" class="form-label">Note</label>
                                    <textarea class="form-control" cols="30" rows="5">{{ $order->user_note }}</textarea>
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
                                    <input type="radio" class="btn-check" id="success-outlined" autocomplete="on"
                                        checked>
                                    <label style="width: 100%" class="btn btn-outline-success"
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
                        <button class="btn btn-primary" type="submit">Save</button>
                    </div>
                </div>
            </div>
        </div>

    </form>
@endsection

@section('script-libs')
@endsection

@section('scripts')
@endsection

@section('style-libs')
    <!-- multi.js css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/admin/assets/libs/multi.js/multi.min.css') }}" />
@endsection
