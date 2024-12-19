@extends('admin.layouts.master')

@section('title')
    Banners List
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box align-items-center">
                {{-- <h4 class="mb-sm-0">Danh sách tài khoản</h4> --}}

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.banners.create') }}">Banners</a></li>
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
                        <h3>Banners List</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.banners.create') }}"><i class="btn btn-primary ri-add-fill"></i></a>
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
                                <th>Image</th>
                                <th>Name</th>
                                <th>Collection</th>
                                <th>Url</th>
                                <th>Description</th>
                                <th>Created</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data as $key => $item)
                                <tr class="align-middle">
                                    <td>{{ $key + 1 }}</td>
                                    <td style="width: 100px"> <img src="{{ Storage::url($item->image) }}" alt=""
                                            width="100" height="100">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->collection }}</td>
                                    <td>
                                        <a href="{{ $item->url }}" target="_blank">{{ $item->url }}</a>
                                    </td>
                                    <td>{{ $item->description }}</td>

                                    <td>{{ $item->created_at->format('d/m/Y') }}</td>

                                    <td>
                                        <div class="form-check form-switch text-center">
                                            <input class="form-check-input toggle-switch" type="checkbox"
                                                data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.banners.edit', $item->id) }}" class="btn btn-light"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                class="ri-pencil-fill align-bottom"></i></a>

                                        {{-- <form action="{{ route('admin.banners.destroy', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this brand?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light" data-bs-toggle="tooltip"
                                                title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
                                        </form> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('scripts')

    <script>
        $(document).on('change', '.toggle-switch', function() {
            let bannerId = $(this).data('id');
            let newValue = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.banners.updateStatus', ':id') }}".replace(':id', bannerId),
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: newValue
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

@section('css')
@endsection

@section('script-libs')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    </script>
@endsection