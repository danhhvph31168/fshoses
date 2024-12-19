@extends('admin.layouts.master')

@section('title')
    List Comment
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">List Comment</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Comment</a></li>
                        <li class="breadcrumb-item active">List</li>
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
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image Product</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Comment</th>
                                <th>Date</th>
                                <th>Show</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>
                                        <img src="{{ Storage::url($item->product->img_thumbnail) }}" width="100"
                                            height="100" alt="">
                                    </td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>
                                        <a href="{{ route('productDetail', $item->product->slug) }}">
                                            {{ \Str::limit($item->product->name, 30) }}
                                        </a>
                                    </td>
                                    <td>{{ \Str::limit($item->comment, 30) }}</td>
                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                    <td>
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input toggle-switch" type="checkbox"
                                                data-id="{{ $item->id }}" {{ $item->is_show == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <a class="btn btn-light" href="{{ route('admin.reviews.show', $item->id) }}"><i
                                                class="ri-eye-fill align-bottom"></i></a>
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

@section('scripts')

    <script>
        $(document).on('change', '.toggle-switch', function() {
            let reviewId = $(this).data('id');
            let newValue = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.reviews.update', ':id') }}".replace(':id', reviewId),
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    is_show: newValue
                },
                success: function(response) {
                    toastr.success(`Status updated successfully`);
                    console.log(200);
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
                [0, 'asc']
            ]
        });
    </script>
@endsection
