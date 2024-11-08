@extends('admin.layouts.master')

@section('title')
<<<<<<< HEAD
    List Order
=======
    Orders List
@endsection

@section('content')
    <h1>Đây là trang quản lý đơn hàng</h1>
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
<<<<<<< HEAD
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">List Order</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">List Order</li>
=======
            <div class="page-title-box align-items-center">

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.create') }}">Orders</a></li>
                        <li class="breadcrumb-item text-danger">List</li>
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
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
<<<<<<< HEAD
                    <h5 class="card-title mb-0">List Order</h5>

                    <a href="" class="btn btn-primary mb-3">Add New</a>
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
                                <th>Staff</th>
                                <th>Order Date</th>
=======
                    <div class="card-title mb-0">
                        <h3>Orders List</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.orders.create') }}"><i class="btn btn-success ri-add-fill"></i></a>
                    </div>
                </div>
                <div class="card-body">

                    {{-- Hiển thị thông báo thành công --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" disabled aria-label="alert"></button>
                        </div>
                    @endif

                    {{-- <table id="example"
                        class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                        style="width:100%">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
<<<<<<< HEAD
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->sku_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->status_order }}</td>
                                    <td>{{ $item->status_payment }}</td>
                                    <td>{{ $item->total_amount }}</td>
                                    <td>{{ $item->role->name }}</td>
                                    <td>{{ $item->created_at->format('d/m/y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.orders.edit', $item) }}" class="btn btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>
@endsection

@section('style-libs')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
=======
                            @foreach ($data as $key => $item)
                                <tr class="align-middle">
                                    <th>{{ $key + 1 }}</th>
                                    <th>{{ $item->name }}</th>
                                    <th class="{{ $item->is_active == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $item->is_active == 1 ? 'Active' : 'Inactive' }}</th>
                                    <th>{{ $item->created_at }}</th>
                                    <th>{{ $item->updated_at }}</th>
                                    <th>
                                        <a href="{{ route('admin.categories.show', $item->id) }}" class="me-2">
                                            <i class="ri-search-line text-muted fs-18 rounded-2 border p-2"></i></a>

                                        <a href="{{ route('admin.categories.edit', $item->id) }}"><i
                                                class="ri-pencil-fill text-muted fs-18 rounded-2 border p-2"></i></a>

                                        <form action="{{ route('admin.categories.destroy', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white"><i
                                                    class="ri-delete-bin-5-fill text-muted fs-18 rounded-2 border p-2"></i></button>
                                        </form>
                                    </th>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }} --}}
                </div>
            </div>
        </div><!--end col-->
    </div> <!--end row-->
@endsection

@section('css')
    <!--datatable css-->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />

>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<<<<<<< HEAD

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('script-libs')
=======
@endsection

@section('js')
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<<<<<<< HEAD
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

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
=======
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script> --}}
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    {{-- <script>
        new DataTable("#myTable");
    </script> --}}
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
@endsection
