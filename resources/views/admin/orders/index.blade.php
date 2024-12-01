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
                <div class="card-header d-flex justify-content-between">
                    <div class="align-content-center">
                        <h3 class="card-title fs-3">List Order</h3>
                        {{-- <a href="" class="btn btn-primary mb-3">Add New</a> --}}
                    </div>
                    <div class="">
                        <form action="" method="GET" class="form-inline">
                            <div class="input-group">
                                <input type="text" class="form-control" aria-label="Recipient's username"
                                    aria-describedby="button-addon2" name="key" placeholder="Search ...">
                                <button class="btn btn-success ms-2" type="submit" id="button-addon2">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>Sku Order</th>
                                <th>Name Customer</th>
                                <th>Status Order</th>
                                <th>Status Payment</th>
                                <th>Total Amount</th>
                                {{-- <th>Staff</th> --}}
                                <th>Order Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->sku_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->status_order }}</td>
                                    <td>{{ $item->status_payment }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    {{-- <td>{{ $item->role->name }}</td> --}}
                                    <td>{{ $item->created_at->format('d/m/y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.edit', $item) }}" class="btn btn-success">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    {{ $data->links() }}
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
<style>
    /* Card */
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border: none;
    }

    /* Header card */
    .card-header {
        background-color: #eff6ff;
        /* Nhẹ nhàng hơn */
        border-bottom: 2px solid #c9daf8;
        font-weight: bold;
    }

    .card-title {
        color: #1a73e8;
        /* Màu xanh nổi bật */
    }

    /* Button */
    .btn-primary {
        background-color: #1a73e8;
        /* Màu xanh Google */
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #1558c7;
    }

    .btn-warning {
        color: white;
        background-color: #fbb034;
        /* Màu cam nổi bật */
        border: none;
        transition: background-color 0.3s ease;
    }

    .btn-warning:hover {
        background-color: #e69b00;
    }


    .table {
        border-collapse: collapse;
        background-color: white;
        margin-top: 10px;
    }

    .table thead {
        background-color: #405189;

        color: white;
    }

    .table th {
        text-align: center;
        vertical-align: middle;
    }

    .table tbody tr:nth-child(even) {
        background-color: #f1f8ff;

    }

    .table tbody tr:hover {
        background-color: #e3f2fd;

    }

    .table td,
    .table th {
        padding: 12px 15px;
        vertical-align: middle;
    }


    .dt-responsive {
        overflow-x: auto;
    }

    .table tbody tr:hover {
        background-color: #dce9ff;
        /* Màu xanh nhạt hơn */
        transform: scale(1.02);
        /* Phóng to nhẹ */
        transition: all 0.2s ease-in-out;
        /* Hiệu ứng mượt */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        /* Bóng mờ khi hover */
    }

    /* Hover hiệu ứng cho nút Edit */
    .btn-warning:hover {
        background-color: #e58900;
        /* Màu cam đậm hơn */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        /* Thêm bóng mờ */
        transform: scale(1.05);
        /* Phóng to nhẹ nút */
        transition: all 0.3s ease;
    }

    /* Hover hiệu ứng cho nút Add New */
    .btn-primary:hover {
        background-color: #0f5bb5;
        /* Xanh đậm hơn */
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.2);
        /* Thêm bóng mờ */
        transform: scale(1.05);
        /* Phóng to nhẹ nút */
        transition: all 0.3s ease;
    }
</style>
@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    {{-- 
    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script> --}}
@endsection
