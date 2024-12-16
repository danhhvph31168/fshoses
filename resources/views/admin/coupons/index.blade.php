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
                                <th>Condition</th>
                                <th>Start date</th>
                                <th>End date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $key => $item)
                                <tr class="align-middle">
                                    <th>{{ $key + 1 }}</th>
                                    <th>{{ $item->code }}</th>
                                    <th>{{ $item->type == 'percent' ? $item->value . '%' : number_format($item->value, 0, ',', '.') . ' VND' }}
                                    </th>
                                    <th>{{ $item->quantity }}</th>
                                    <th>{{ number_format($item->minimum_order_value, 0, ',', '.') }} VNĐ</th>
                                    <th>{{ \Carbon\Carbon::parse($item->start_date)->format('d/m/Y') }}</th>
                                    <th>{{ \Carbon\Carbon::parse($item->end_date)->format('d/m/Y') }}</th>
                                    <th>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-switch" type="checkbox"
                                                data-id="{{ $item->id }}"
                                                {{ $item->is_active == 1 ? 'checked' : '' }}>
                                        </div>
                                    </th>
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

@section('scripts')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(document).on('change', '.toggle-switch', function() {
            let couponId = $(this).data('id');
            let newValue = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.coupons.updateStatus', ':id') }}".replace(':id', couponId),
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    is_active: newValue
                },
                success: function(response) {
                    console.log(200);
                    toastr.success(
                        `Status updated successfully!`
                    );
                },
                error: function() {
                    alert('An error occurred while updating the status.');
                }
            });
        });
    </script>
@endsection

@section('style-libs')
    <style>
        .form-check-input {
            width: 40px;
            height: 20px;
            background-color: #ccc;
            border-radius: 20px;
            position: relative;
            cursor: pointer;
            appearance: none;
            outline: none;
            transition: all 0.3s ease-in-out;
        }

        .form-check-input:checked {
            background-color: #4caf50;
        }

        .form-check-input::before {
            content: '';
            position: absolute;
            top: 2px;
            left: 2px;
            width: 16px;
            height: 16px;
            background-color: white;
            border-radius: 50%;
            transition: all 0.3s ease-in-out;
        }

        .form-check-input:checked::before {
            transform: translateX(20px);
        }
    </style>


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

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    {{-- <script src="{{ asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script> --}}

    <script>
        new DataTable("#example", {
            order: [
                [0, 'desc']
            ]
        });
    </script>
@endsection
