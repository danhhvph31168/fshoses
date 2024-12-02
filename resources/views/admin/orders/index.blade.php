@extends('admin.layouts.master')

@section('title')
    List Order
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box  align-items-center">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                        <li class="breadcrumb-item text-danger">List</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <table id="example" class="table responsive nowrap table-striped align-middle" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" style="width: 10px;">
                                    <div class="form-check"></div>
                                </th>
                                <th data-ordering="false">Sku</th>
                                <th data-ordering="false">Customer</th>
                                <th>Total Amount</th>
                                <th>Payment</th>
                                <th>Status Order</th>
                                <th>Status Payment</th>
                                <th>Staff</th>
                                <th>Order Date</th>
                                <th>User address :</th>
                                <th>User email :</th>
                                <th>User phone :</th>
                                <th>Product Item</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <th scope="row">
                                        <div class="form-check">
                                        </div>
                                    </th>
                                    <td>{{ $item->sku_order }}</td>

                                    <td class="{{ !($item->user->password == null) ? 'text-info' : '' }}">
                                        {{ $item->user->name }}</td>

                                    <td>{{ number_format($item->total_amount) }} vnđ</td>
                                    <td
                                        class="{{ $item->payment->payments_method == 'vnpay' ? 'text-info' : 'text-warning' }}">
                                        {{ $item->payment->payments_method }}</td>
                                    <td>
                                        <span class="badge bg-success-subtle text-info">{{ $item->status_order }}</span>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger-subtle text-info">{{ $item->status_payment }}</span>
                                    </td>
                                    <td>{{ $item->staff_id ? $item->staff->name : 'unprocessed' }}</td>
                                    <td>
                                        <span class="badge rounded-pill text-bg-success">
                                            {{ \Carbon\Carbon::parse($item->created_at)->diffForHumans() }}</span>
                                    </td>
                                    <td>{{ $item->user_address }}</td>
                                    <td>{{ $item->user_email }}</td>
                                    <td>{{ $item->user_phone }}</td>
                                    <td>
                                        @foreach ($item->orderItems as $orderItem)
                                            <div class="d-flex align-items-center mt-1">
                                                <div class="flex-shrink-0 me-3">
                                                    <div class="avatar-xl bg-light rounded p-1">
                                                        <img src="{{ $orderItem->productVariant->image }}" alt=""
                                                            height="100px" width="100%" class="img-fluid d-block" />
                                                    </div>
                                                </div>

                                                <div class="flex-grow-1">
                                                    <h5 class="fs-14 mb-3">
                                                        <a href="#" class="text-body">
                                                            {{ $orderItem->productVariant->product->name }}
                                                        </a>
                                                    </h5>

                                                    <p class="rounded-circle text-muted mb-2">
                                                        Color: <i class="ri-checkbox-blank-circle-fill"
                                                            style="color: {{ $orderItem->productVariant['color']->name }};"></i>
                                                        Size: {{ $orderItem->productVariant['size']->name }}
                                                    </p>
                                                    <p class="rounded-circle text-muted mb-2">
                                                        Price:
                                                        {{ number_format($orderItem->price) }}
                                                        x {{ $orderItem->quantity }}
                                                    </p>
                                                </div>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <ul class="list-inline hstack gap-2 mb-0">
                                            <li class="list-inline-item" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                                data-bs-placement="top" title="View">
                                                <a href="apps-ecommerce-order-details" class="text-primary d-inline-block">
                                                    <i class="ri-eye-fill fs-16"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item edit" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" data-bs-placement="top" title="Edit">
                                                <a href="{{ route('admin.orders.edit', $item) }}"
                                                    class="text-primary d-inline-block edit-item-btn">
                                                    <i class="ri-pencil-fill fs-16"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ URL::asset('theme/admin/assets/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('theme/admin/assets/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="{{ URL::asset('theme/admin/assets/js/pages/datatables.init.js') }}"></script>

    <!--ecommerce-customer init js -->
    <script src="{{ URL::asset('theme/admin/assets/js/pages/ecommerce-order.init.js') }}"></script>
    <script src="{{ URL::asset('theme/admin/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
@endsection

<style>
    .dt-buttons .buttons-colvis {
        display: inline-block;
        margin: 5px;
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 5px 10px;
        border-radius: 4px;
        cursor: pointer;
    }
</style>
