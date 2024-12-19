@extends('admin.layouts.master')

@section('title')
    Products List
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box  align-items-center">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
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
                        <a class="btn btn-primary" href="{{ route('admin.products.create') }}">
                            <i class="ri-add-fill"></i> Add product </a>
                    </div>
                    <form action="{{ route('admin.filterProducts') }}" method="GET" class="row">
                        <div class="col-md-3">
                            <select id="brand_name" name="brand_name" class="form-control">
                                <option value="" {{ request('brand_name') == '' ? 'selected' : '' }}>Select Brand
                                </option>
                                @foreach ($brands as $id => $name)
                                    <option value="{{ $name }}"
                                        {{ request('brand_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select name="category_name" id="category_name" type="text" class="form-control">
                                <option value="" {{ request('category_name') == '' ? 'selected' : '' }}>Select
                                    Category</option>
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $name }}"
                                        {{ request('category_name') == $name ? 'selected' : '' }}>{{ $name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <input type="text" class="form-control" name="product_name" placeholder="Enter product name"
                                value="{{ request('product_name') }}">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <table id="myTable" class="table table-bordered nowrap dt-responsive table-striped align-middle"
                        style="width:100%">
                        <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>Sku</th>
                                <th>Img Thumbnail</th>
                                <th>Name</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Price Regular</th>
                                <th>Price Sale (%)</th>
                                <th>Views</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($data->isEmpty())
                                <tr>
                                    <td colspan="9" class="text-muted fw-bold text-center">No products found. Please
                                        try adjusting your filters!</td>
                                </tr>
                            @else
                                @foreach ($data as $key => $item)
                                    @php
                                        $price = $item->price_regular * ((100 - $item->price_sale) / 100);
                                    @endphp

                                    <tr class="align-middle text-center">
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->sku }}</td>
                                        <td style="width:150px;">
                                            @if (\Str::contains($item->img_thumbnail, 'http'))
                                                <img src="{{ $item->img_thumbnail }}" class="card-img-top" alt="..."
                                                    height="100px">
                                            @else
                                                <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                                    alt="..." height="100px" width="50px">
                                            @endif
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->brand?->name }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ number_format($item->price_regular, 0, ',', '.') }} VNĐ</td>
                                        <td class="text-primary">{{ $item->price_sale }}%</td>
                                        <td>{{ $item->views }}</td>
                                        <td>
                                            <div class="form-check form-switch text-center">
                                                <input class="form-check-input toggle-switch" type="checkbox"
                                                    data-id="{{ $item->id }}"
                                                    {{ $item->is_active == 1 ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.products.show', $item->id) }}" class="btn btn-light"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="View"><i
                                                    class="ri-eye-fill align-bottom"></i></a>

                                            <a href="{{ route('admin.products.edit', $item->id) }}" class="btn btn-light"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                    class="ri-pencil-fill align-bottom"></i></a>

                                            {{-- <form action="{{ route('admin.products.destroy', $item->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-light" data-bs-toggle="tooltip"
                                                    title="Delete"><i class="ri-delete-bin-5-fill"></i></button>
                                            </form> --}}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    {{ $data->links() }}
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection

@section('scripts')
    <script>
        $(document).on('change', '.toggle-switch', function() {
            let productId = $(this).data('id');
            let newValue = $(this).is(':checked') ? 1 : 0;

            $.ajax({
                url: "{{ route('admin.products.updateProduct', ':id') }}".replace(':id', productId),
                method: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    is_active: newValue
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
@endsection
