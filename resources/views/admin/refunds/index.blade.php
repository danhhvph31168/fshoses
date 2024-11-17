@extends('admin.layouts.master')

@section('title')
    List Refund
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">List Refund</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">List Refund</li>
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
                    <h5 class="card-title mb-0">List Refund</h5>
                    <button class="btn btn btn-primary edit-item-btn" data-bs-toggle="modal" data-bs-target="#showModal">Add
                        New</button>
                </div>
                <div class="card-body">
                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                        style="width:100%">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sku Order</th>
                                <th>User</th>
                                <th>Status</th>
                                <th>Reason</th>
                                <th>Refund Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->order->sku_order }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <form action="{{ route('admin.refunds.update', $item->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <td>
                                            <select name="status" class="form-control">
                                                @foreach ($status as $id => $value)
                                                    <option @selected($item->status == $id) value="{{ $id }}">
                                                        {{ $id }}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>{{ $item->reason }}</td>
                                        <td>{{ $item->created_at->format('d/m/y') }}</td>
                                        <td>
                                            <button class="btn btn-warning">Update</button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div>

    {{-- create refund --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">Refund New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" autocomplete="off" action="{{ route('admin.refunds.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div>
                            <label for="order_id" class="form-label">Order</label>
                            <select class="form-control @error('order_id') is-invalid @enderror" data-trigger
                                name="order_id" id="order_id" required>
                                @foreach ($orders as $item)
                                    <option value="{{ $item->id }}">{{ $item->sku_order }} - {{ $item->user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('order_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="reason" class="form-label @error('reason') is-invalid @enderror">Reason</label>
                            <textarea class="form-control" name="reason" rows="3"></textarea>
                            @error('reason')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label for="status" class="form-label @error('status') is-invalid @enderror">Status</label>
                            <select class="form-control" data-trigger name="status" required>
                                @foreach ($status as $id => $value)
                                    <option value="{{ $id }}">{{ $id }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success" id="add-btn">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
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
