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
                    <div class="card-title mb-0 align-content-center">
                        <h3>Accounts List</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.users.create') }}"><i class="btn btn-success ri-add-fill"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <table id="example" class="table table-bordered nowrap dt-responsive table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                {{-- @if ($item->role_id === 1 || $item->role_id === 2) --}}
                                <tr class="align-middle text-center">
                                    <th style="width: 10px">{{ $item->id }}</th>
                                    <td style="width: 100px"> <img src="{{ Storage::url($item->avatar) }}" alt=""
                                            width="50px">
                                    </td>
                                    <td style="width: 400px">{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->role->name }}</td>
                                    <td class="{{ $item->status == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.show', $item->id) }}" class="me-2">
                                            <i class="ri-search-line text-muted fs-18 rounded-2 border p-2"></i></a>

                                        <a href="{{ route('admin.users.edit', $item->id) }}"><i
                                                class="ri-pencil-fill text-muted fs-18 rounded-2 border p-2"></i></a>

                                        <form action="{{ route('admin.users.destroy', $item->id) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Are you sure you want to delete this account?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="border-0 bg-white"><i
                                                    class="ri-delete-bin-5-fill text-muted fs-18 rounded-2 border p-2"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                {{-- @endif --}}
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>

                {{-- <div class="card-body">
                    <table id="example" class="table table-bordered nowrap dt-responsive table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th>Role</th>
                                <th>Balance</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                @if ($item->role_id !== 1 && $item->role_id !== 2)
                                    <tr class="align-middle text-center">
                                        <th style="width: 10px">{{ $item->id }}</th>
                                        <td style="width: 100px"> <img src="{{ Storage::url($item->avatar) }}"
                                                alt="" width="50px">
                                        </td>
                                        <td style="width: 400px">{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->role->name }}</td>
                                        <td>{{ $item->balance }}</td>
                                        <td class="{{ $item->status == 1 ? 'text-success' : 'text-danger' }}">
                                            {{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td>
                                            <div class="d-flex mt-2 align-item-center">
                                                <a href="{{ route('admin.users.edit', $item->id) }}" type="submit"
                                                    class="btn btn-warning me-2">EDIT</a>

                                                <form action="{{ route('admin.users.destroy', $item->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">DELETE</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div> --}}
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
