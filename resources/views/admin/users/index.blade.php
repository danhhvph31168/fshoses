@extends('admin.layouts.master')

@section('title')
    Accounts List
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box  align-items-center">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item text-danger">List</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    @if ($errors->any() || session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        @if ($errors->any())
                            <div class="alert alert-danger" style="width: 100%;">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" style="width: 100%;">
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Hiển thị thông báo thành công --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismis="alert" aria-label="Close">
            </button>
        </div>
    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div>
                        <a class="btn btn-success" href="{{ route('admin.users.create') }}">
                            <i class="ri-add-fill"></i> Add User </a>
                    </div>
                    <div class="d-flex">
                        <form action="" method="GET" class="form-inline">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="Recipient's username"
                                    aria-describedby="button-addon2" name="key" placeholder="Search ...">
                                <button class="btn btn-success ms-2" type="submit" id="button-addon2">Tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-bordered nowrap dt-responsive table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr class="align-middle text-center">
                                    <td style="width: 10px">{{ $item->id }}</td>
                                    <td style="width: 100px"> <img src="{{ Storage::url($item->avatar) }}" alt=""
                                            width="50px">
                                    </td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>
                                        @if ($item->address)
                                            {{ $item->address }}
                                            @endif @if ($item->ward)
                                                -{{ $item->ward }}
                                            @endif
                                            <br>
                                            @if ($item->district)
                                                {{ $item->district }}
                                                @endif @if ($item->province)
                                                    -{{ $item->province }}
                                                @endif

                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-switch" type="checkbox"
                                                data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $item->id) }}" class="btn btn-light"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i
                                                class="ri-eye-fill align-bottom"></i></a>

                                        <a href="{{ route('admin.users.edit', $item->id) }}" class="btn btn-light"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                class="ri-pencil-fill align-bottom"></i></a>

                                        {{-- <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this user?')">
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

                    {{ $data->appends(request()->all())->links() }}
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('scripts')
    <script>
        $(document).on('change', '.toggle-switch', function() {
            let userId = $(this).data('id');
            let newValue = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.users.updateCustomer', ':id') }}".replace(':id', userId),
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
