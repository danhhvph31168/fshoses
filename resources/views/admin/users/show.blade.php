@extends('admin.layouts.master')

@section('title')
    Accounts Detail
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box  align-items-center">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item">Detail </li>
                        <li class="breadcrumb-item text-danger">{{ $data->name }}</li>
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
                    <div class="card-title mb-0 align-content-center">
                        <h3>Information: <span class="text-danger fs-3">{{ $data->name }}</span></h3>
                    </div>
                    <div>

                        <a href="{{ route('admin.users.index') }}"><i
                                class="ri-arrow-go-back-fill text-muted fs-18 rounded-2 border p-2 me-2"></i></a>

                        <a href="{{ route('admin.users.edit', $data->id) }}"><i
                                class="ri-pencil-fill text-muted fs-18 rounded-2 border p-2"></i></a>

                        <form action="{{ route('admin.users.destroy', $data->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Are you sure you want to delete this account?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="border-0 bg-white"><i
                                    class="ri-delete-bin-5-fill text-muted fs-18 rounded-2 border p-2"></i></button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3"><img src="{{ Storage::url($data->avatar) }}" alt="" width="300px">
                        </div>
                        <div class="col-md-9">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Column</th>
                                        <th>Value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Name</td>
                                        <td>{{ $data->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>{{ $data->email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Phone</td>
                                        <td>{{ $data->phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Role</td>
                                        <td>{{ $data->role->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Balance</td>
                                        <td>{{ number_format($data->balance, 0, ',', '.') }} VNĐ</td>
                                    </tr>
                                    <tr>
                                        <td>Address</td>
                                        <td>{{ $data->address }}</td>
                                    </tr>
                                    <tr>
                                        <td>District</td>
                                        <td>{{ $data->district }}</td>
                                    </tr>
                                    <tr>
                                        <td>Province</td>
                                        <td>{{ $data->province }}</td>
                                    </tr>
                                    <tr>
                                        <td>Zip Code</td>
                                        <td>{{ $data->zip_code }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status</td>
                                        <td class="{{ $data->status == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $data->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Created at</td>
                                        <td>{{ $data->created_at }}</td>
                                    </tr>
                                    <tr>
                                        <td>Updated at</td>
                                        <td>{{ $data->updated_at }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('js')
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

    {{-- <script>
        new DataTable("#example", {
            order: [0, 'asc']
        });
    </script> --}}
@endsection
