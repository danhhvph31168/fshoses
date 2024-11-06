@extends('admin.layouts.master')

@section('title')
    Coupons List
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box align-items-center">
                {{-- <h4 class="mb-sm-0">Danh sách tài khoản</h4> --}}

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.categories.create') }}">Categories</a></li>
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
                    <div class="card-title mb-0">
                        <h3>Coupon List</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.coupons.create') }}"><i class="btn btn-success ri-add-fill"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Hiển thị thông báo thành công --}}
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismis="alert" aria-label="Close">
                            </button>
                        </div>
                    @endif
                    <table id="example"
                        class="table table-bordered dt-responsive nowrap table-striped align-middle text-center"
                        style="width:100%">
                        <thead>
                            <tr class="">
                                <th>#</th>
                                <th>Code</th>
                                <th>Value</th>
                                <th>Quantity</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $key => $item)
                                <tr class="align-middle">
                                    <th>{{ $key + 1 }}</th>
                                    <th>{{ $item->code }}</th>
                                    <th>{{ $item->type == 'percent' ? $item->value . '%'
                                    : number_format($item->value*1000, 0, ',', '.') . ' VND' }}</th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>{{ $item->start_date }}</th>
                                    <th>{{ $item->end_date }}</th>
                                    <td>


                                        <a href="{{ route('admin.coupons.edit', $item->id) }}" class="btn btn-light"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                class="ri-pencil-fill align-bottom"></i></a>

                                        <form action="{{ route('admin.coupons.destroy', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this coupon?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light" data-bs-toggle="tooltip"
                                                title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $coupons->links() }}
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('css')
    <!--datatable css-->
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" /> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css" />

    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
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
@endsection
