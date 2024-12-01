@extends('admin.layouts.master')

@section('title')
    Brands List
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box align-items-center">
                {{-- <h4 class="mb-sm-0">Danh sách tài khoản</h4> --}}

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.brands.create') }}">Brands</a></li>
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
                        <h3>Brands List</h3>
                    </div>
                    <div>
                        <a href="{{ route('admin.brands.create') }}"><i class="btn btn-success ri-add-fill"></i></a>
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
                                <th>Name</th>
                                <th>Image</th>
                                <th>Status</th>
                                <th>Created at</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach ($data as $key => $item)
                                <tr class="align-middle">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td style="width: 100px"> <img src="{{ Storage::url($item->image) }}" alt=""
                                            width="50px">
                                    </td>
                                    <td class="{{ $item->status == 1 ? 'text-success' : 'text-danger' }}">
                                        {{ $item->status == 1 ? 'Active' : 'Inactive' }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>

                                    <td>
                                        {{-- <a href="{{ route('admin.brands.show', $item->id) }}" class="btn btn-light"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i
                                                class="ri-eye-fill align-bottom"></i></a> --}}

                                        <a href="{{ route('admin.brands.edit', $item->id) }}" class="btn btn-light"
                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                class="ri-pencil-fill align-bottom"></i></a>

                                        <form action="{{ route('admin.brands.destroy', $item->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Are you sure you want to delete this brand?')">
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
                    {{ $data->links() }}
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection

@section('css')
@endsection

@section('js')
    {{-- <script>
        new DataTable("#myTable");
    </script> --}}
@endsection
