@extends('admin.layouts.master')

@section('title')
    List Review
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">List Review</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">List Review</li>
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
                    <h5 class="card-title mb-0">List Review</h5>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Comment</th>
                                <th>Comment Date</th>
                                <th>Update Date</th>
                                <th>Is Show</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ \Str::limit($item->product->name, 30) }}</td>
                                    <td>{{ \Str::limit($item->comment, 30) }}</td>
                                    <td>{{ $item->created_at->format('d/m/y') }}</td>
                                    <td>{{ $item->updated_at->format('d/m/y') }}</td>

                                    <form action="{{ route('admin.reviews.update', $item->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <select name="is_show" class="form-control border-0">
                                                {!! $item->is_show == 0
                                                    ? '<option value="0" checked>Show</option> <option value="1">Hide</option>'
                                                    : '<option value="1" checked>Hide</option> <option value="0">Show</option>' !!}
                                            </select>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn btn-warning edit-item-btn"
                                                data-bs-toggle="modal" data-bs-target="#showModal">Detail</button>
                                            <button class="btn btn-info">Update</button>
                                        </td>
                                    </form>

                                </tr>

                                {{-- detail review --}}
                                <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header bg-light p-3">
                                                <h5 class="modal-title" id="exampleModalLabel">Review Detail</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close" id="close-modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div>
                                                    <label for="">Comment</label>
                                                    <textarea class="form-control" cols="30" rows="4">{{ $item->comment }}</textarea>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="text-center">
                                                        <img width="50px" height="50px" src="{{ $item->user->avatar }}"
                                                            class="rounded-circle mb-3"><br>
                                                        <b>{{ $item->user->email }}</b>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class="col-md-6">
                                                            <p>{{ $item->user->name }}</p>
                                                            <p>{{ $item->user->phone }}</p>
                                                            <p>{{ $item->user->balance }}</p>
                                                            <p>{{ $item->user->zip_code }}</p>
                                                        </div>

                                                        <div class="col-md-6 text-end">
                                                            <p>{{ $item->user->role->name }}</p>
                                                            <p>{{ $item->user->address }}</p>
                                                            <p>{{ $item->user->district }}</p>
                                                            <p>{{ $item->user->province }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div>
                                                    <div class="text-center">
                                                        <img width="50%" height="50%"
                                                            src="{{ $item->product->img_thumbnail }}" class="mb-3">
                                                    </div>
                                                    <div class="row mt-2">
                                                        <b>{{ $item->product->name }}</b>
                                                        <p class="mt-3">Category: {{ $item->product->category->name }}</p>
                                                        <p>Price Regular: {{ $item->product->price_regular }}</p>
                                                        <p>Price Sale: {{ $item->product->price_sale }}</p>
                                                        <p>Description: {{ $item->product->description }}</p>
                                                        <p>View: {{ $item->product->view }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
