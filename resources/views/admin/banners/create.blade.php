@extends('admin.layouts.master')

@section('title')
    Add New Banner
@endsection

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box align-items-center">

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Banners</a>
                        </li>
                        <li class="breadcrumb-item text-danger">Add New Banner</li>
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

    <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="live-preview">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row gy-4 mb-3">
                                        <div>
                                            <label for="name" class="form-label">Name</label>
                                            <input type="text" class="form-control" name="name" id="name">
                                        </div>
                                    </div>

                                    <div class="row gy-4 mb-3">
                                        <div>
                                            <label for="collection" class="form-label">Collection</label>
                                            <input type="text" class="form-control" name="collection" id="collection">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="row gy-4 mb-3">
                                        <div>
                                            <label for="title" class="form-label">Url</label>
                                            <input type="text" class="form-control" name="url">
                                        </div>
                                    </div>

                                    <div class="row gy-4 mb-3">
                                        <div>
                                            <label for="description" class="form-label">Description</label>
                                            <input type="text" class="form-control" name="description" id="description">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image: </label>
                                <input type="file" id="image" name="image" class="form-control mb-3"
                                    onchange="showImage(event)">
                                <img id="img_danh_muc" src="" alt="image" style="width: 80px; display:none">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status: </label>
                                <div class="col-sm-10 d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="gridRadios1"
                                            value="1" checked>
                                        <label class="form-check-label text-success" for="gridRadios1">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                            value="0">
                                        <label class="form-check-label text-danger" for="gridRadios2">
                                            Inactive
                                        </label>
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
                    </div>
                </div>
            </div>
            <!--end col-->
        </div>

    </form>

@endsection

@section('css')
@endsection

@section('js')
    <script>
        function showImage(event) {
            const img_danh_muc = document.getElementById('img_danh_muc');

            const file = event.target.files[0];

            const reader = new FileReader();

            reader.onload = function() {
                img_danh_muc.src = reader.result;
                img_danh_muc.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection
