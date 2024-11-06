@extends('admin.layouts.master')

@section('title')
    Update Conpon
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box align-items-center">

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.coupons.index') }}">Coupons</a>
                        </li>
                        <li class="breadcrumb-item text-info">Update: <span class="text-danger"> {{ $coupon->name }}</span>
                        </li>
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
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                </div><!-- end card header -->
                <div class="card-body">

                    <form action="{{ route('admin.coupons.update', $coupon->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="live-preview">
                            <div class="row gy-4">
                                <div class="col-md-4">
                                    <div>
                                        <label for="code" class="form-label">Code</label>
                                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" id="code" value="{{ old('code', $coupon->code) }}" autofocus>
                                        @error('code')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="value" class="form-label">Value</label>
                                        <input type="number" class="form-control @error('value') is-invalid @enderror" name="value" id="value" value="{{ old('value', $coupon->value) }}">
                                        @error('value')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="type">Type</label>
                                        <select name="type" id="type" class="form-control @error('type') is-invalid @enderror">
                                            <option value="fixed" {{ (old('type', $coupon->type) == 'fixed') ? 'selected' : '' }}>VND</option>
                                            <option value="percent" {{ (old('type', $coupon->type) == 'percent') ? 'selected' : '' }}>%</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ old('quantity', $coupon->quantity) }}">
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="start_date" class="form-label">Start date</label>
                                        <input type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" id="start_date" value="{{ old('start_date', $coupon->start_date) }}">
                                        @error('start_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="end_date" class="form-label">End date</label>
                                        <input type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" id="end_date" value="{{ old('end_date', $coupon->end_date) }}">
                                        @error('end_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- <div class="mt-3">
                                        <label for="parent_id" class="form-label">Category</label>
                                        <select type="text" class="form-select" name="parent_id" id="parent_id">
                                            <option value="" selected>Trống</option>

                                            @foreach ($parentCategories as $parent)
                                                @php($each = '')

                                                @include('admin.categories.nested-category', [
                                                    'category' => $parent,
                                                ])
                                            @endforeach
                                        </select>
                                    </div> --}}

                                    <div class="mb-3">
                                        <label for="is_active" class="form-label">Status: </label>
                                        <div class="col-sm-10 d-flex gap-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="gridRadios1" value="1"
                                                    {{ $model->is_active == true ? 'checked' : '' }}>
                                                <label class="form-check-label text-success" for="gridRadios1">
                                                    Active
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="is_active"
                                                    id="gridRadios2" value="0"
                                                    {{ $model->is_active == false ? 'checked' : '' }}>
                                                <label class="form-check-label text-danger" for="gridRadios2">
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header align-items-center d-flex">
                                            <button class="btn btn-primary" type="submit">Save</button>
                                        </div><!-- end card header -->
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>



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
