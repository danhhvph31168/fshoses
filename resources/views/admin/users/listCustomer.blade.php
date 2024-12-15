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
                        <a class="btn btn-primary" href="{{ route('admin.users.create') }}">
                            <i class="ri-add-fill"></i> Add User </a>
                    </div>
                    <div class="d-flex">
                        <form action="" method="GET" class="form-inline">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" aria-label="Recipient's username"
                                    aria-describedby="button-addon2" name="key" placeholder="Search ...">
                                <button class="btn btn-primary ms-2" type="submit" id="button-addon2">Search</button>
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
                                <th>Addres</th>
                                <th>Status</th>
                                <th>Created</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer as $item)
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
                                        {{ $item->created_at->format('d/m/Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $customer->links() }}
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('css')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).on('change', '.toggle-switch', function() {
            let reviewId = $(this).data('id');
            let newValue = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.users.updateCustomer', ':id') }}".replace(':id', reviewId),
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    status: newValue
                },
                success: function(response) {
                    toastr.success('Status updated success')
                    console.log(200);
                },
                error: function() {
                    alert('An error occurred while updating the status.');
                }
            });
        });
    </script>
@endsection
