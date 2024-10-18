@extends('admin.layouts.master')

@section('title')
    Add new
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Add new</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Order</a></li>
                        <li class="breadcrumb-item active">Add new</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    <form action="{{ route('admin.orders.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Create Order</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <div class="col-md-2 mt-3">
                                    <label for="sku" class="form-label">Sku</label>
                                    <input type="text" class="form-control" name="sku_order" id="sku"
                                        value="DH-{{ strtoupper(\Str::random(6)) }}">
                                </div>

                                <div class="col-md-2 mt-3">
                                    <label for="sku" class="form-label">Status Order</label>
                                    <select name="status_order" class="form-control">
                                        @foreach ($data['statusOrder'] as $id => $name)
                                            <option value="{{ $id }}">{{ $id }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2 mt-3">
                                    <label for="sku" class="form-label">Status Payment</label>
                                    <select name="status_payment" class="form-control">
                                        @foreach ($data['statusPayment'] as $id => $name)
                                            <option value="{{ $id }}">{{ $id }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <label for="sku" class="form-label">User</label>
                                    <select name="user_id" class="form-control">
                                        @foreach ($data['users'] as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3 mt-3">
                                    <label for="sku" class="form-label">Role</label>
                                    <select name="role_id" class="form-control">
                                        @foreach ($data['roles'] as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
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
                        <h4 class="card-title mb-0 flex-grow-1">Create Product</h4>
                        <button type="button" class="btn btn-info" onclick="addProduct()">Add Product</button>
                    </div><!-- end card header -->
                    <div class="card-body" id="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <label for="sku" class="form-label">Product</label>
                                    <select name="product[1][id]" id="" class="form-control">
                                        @foreach ($data['products'] as $product)
                                            <option value="{{ $product->id }}">
                                                <p>{{ $product->name }}</p>:
                                                <span>{{ $product->price_sale }}</span>
                                            </option>
                                        @endforeach
                                    </select>

                                    <!-- end card -->
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="sku" class="form-label">Size</label>
                                            <select name="product[1][size]" id="" class="form-control">
                                                @foreach ($data['sizes'] as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sku" class="form-label">Color</label>
                                            <select name="product[1][color]" id="" class="form-control">
                                                @foreach ($data['colors'] as $id => $name)
                                                    <option value="{{ $id }}">{{ $name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="sku" class="form-label">Quantity</label>
                                            <input class="form-control" type="number" name="product[1][quatity]"
                                                value="1">
                                        </div>
                                    </div>
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
                        <h4 class="card-title mb-0 flex-grow-1">Recipient address</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">

                                <div class="col-md-4 mt-3">
                                    <label for="sku" class="form-label">User Name</label>
                                    <input type="text" class="form-control" name="user_name">
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="sku" class="form-label">User Email</label>
                                    <input type="email" class="form-control" name="user_email">
                                </div>

                                <div class="col-md-4 mt-3">
                                    <label for="sku" class="form-label">User Phone</label>
                                    <input type="text" class="form-control" name="user_phone">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="sku" class="form-label">User Address</label>
                                    <input type="text" class="form-control" name="user_address">
                                </div>

                                <div class="col-md-6 mt-3">
                                    <label for="sku" class="form-label">Note</label>
                                    <textarea class="form-control" name="user_note" id="" cols="30" rows="1"></textarea>
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
                        <h4 class="card-title mb-0 flex-grow-1">Payment Method</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <input type="radio" class="btn-check" name="outlined"
                                        value="{{ App\Models\Payment::PAYMENTS_METHOD_CASH }}" id="success-outlined"
                                        autocomplete="on" checked>
                                    <label style="width: 100%" class="btn btn-outline-success"
                                        for="success-outlined">Cash Payment</label>
                                </div>

                                <div class="col-md-6">
                                    <select name="payment_status" class="form-control">
                                        <option value="{{ App\Models\Payment::STATUS_COMPLETED }}">
                                            {{ ucwords(App\Models\Payment::STATUS_COMPLETED) }}</option>
                                        <option value="{{ App\Models\Payment::STATUS_PENDING }}">
                                            {{ ucwords(App\Models\Payment::STATUS_PENDING) }}</option>
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
                    </div><!-- end card header -->
                </div>
            </div>
            <!--end col-->
        </div>

    </form>
@endsection

@section('script-libs')
@endsection

@section('scripts')
    <script>
        let a = 2;

        function addProduct() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let i = a++;
            let html = `
                <div class="live-preview mt-4" id="${id}_item">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <label for="sku" class="form-label">Product</label>
                            <select name="product[${i}][id]" id="" class="form-control">
                                @foreach ($data['products'] as $product)
                                    <option value="{{ $product->id }}">
                                        <p>{{ $product->name }}</p>:
                                        <span>{{ $product->price_sale }}</span>
                                    </option>
                                @endforeach
                            </select>

                            <!-- end card -->
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="sku" class="form-label">Size</label>
                                    <select name="product[${i}][size]" id="" class="form-control">
                                        @foreach ($data['sizes'] as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="sku" class="form-label">Color</label>
                                    <select name="product[${i}][color]" id="" class="form-control">
                                        @foreach ($data['colors'] as $id => $name)
                                            <option value="{{ $id }}">{{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="sku" class="form-label">Quantity</label>
                                    <div class="d-flex">
                                        <input class="form-control" type="number" name="product[${i}][quatity]" value="1">
                                        <button type="button" class="btn btn-danger" onclick="removeProduct('${id}_item')">
                                            <span class="bx bx-trash"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            `;

            $('#card-body').append(html);
            console.log(i);
        }

        function removeProduct(id) {
            if (confirm('Are you sure?')) {
                $('#' + id).remove();
            }
        }
    </script>
@endsection

@section('style-libs')
    <!-- multi.js css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/admin/assets/libs/multi.js/multi.min.css') }}" />
@endsection
