@extends('admin.layouts.master')

@section('title')
    Update Accounts
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box  align-items-center">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Accounts</a></li>
                        <li class="breadcrumb-item text-info">Update: <span class="text-danger"> {{ $model->name }}</span>
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

    <form action="{{ route('admin.users.update', $model->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Thông tin --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        <h4 class="card-title mb-0 flex-grow-1">Information</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="name" class="form-label">Name: </label>
                                    <input type="text" id="name" name="name"
                                        class="form-control @error('name') is_invalid @enderror"
                                        value="{{ $model->name }}">
                                    @error('name')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="address" class="form-label">Address: </label>
                                    <input type="text" id="address" name="address"
                                        class="form-control @error('address') is_invalid @enderror"
                                        value="{{ $model->address }}">
                                    @error('address')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="district" class="form-label">District: </label>
                                    <input type="text" id="district" name="district"
                                        class="form-control @error('district') is_invalid @enderror"
                                        value="{{ $model->district }}">
                                    @error('district')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="province" class="form-label">Province: </label>
                                    <input type="text" id="province" name="province"
                                        class="form-control @error('province') is_invalid @enderror"
                                        value="{{ $model->province }}">
                                    @error('province')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="balance" class="form-label">Balance: </label>
                                    <input type="number" id="balance" name="balance" min="0"
                                        class="form-control @error('balance') is_invalid @enderror"
                                        value="{{ number_format($model->balance, 0, ',', '.') }}">
                                    @error('balance')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="zip_code" class="form-label">Zip Code: </label>
                                    <input type="number" id="zip_code" name="zip_code" min="0"
                                        class="form-control @error('zip_code') is_invalid @enderror"
                                        value="{{ $model->zip_code }}">
                                    @error('zip_code')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Role: </label>
                                    <select id="role_id" name="role_id" class="form-control">
                                        {{-- <option>-- Select Role --</option> --}}
                                        @foreach ($role as $id => $name)
                                            <option value="{{ $id }}" @selected($model->role_id === $id)>
                                                {{ $name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="status" class="form-label">Status: </label>
                                    <div class="col-sm-10 d-flex gap-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="gridRadios1" value="1"
                                                {{ $model->status == 1 ? 'checked' : '' }}>
                                            <label class="form-check-label text-success" for="gridRadios1">
                                                Active
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status"
                                                id="gridRadios2" value="0"
                                                {{ $model->status == 0 ? 'checked' : '' }}>
                                            <label class="form-check-label text-danger" for="gridRadios2">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-6">

                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone: </label>
                                    <input type="number" id="phone" name="phone"
                                        class="form-control @error('phone') is_invalid @enderror"
                                        value="{{ $model->phone }}">
                                    @error('phone')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email: </label>
                                    <input type="text" id="email" name="email"
                                        class="form-control @error('email') is_invalid @enderror"
                                        value="{{ $model->email }}">
                                    @error('email')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password: </label>
                                    <input type="password" id="password" name="password"
                                        class="form-control @error('password') is_invalid @enderror"
                                        value="{{ $model->password }}">
                                    @error('password')
                                        <p class="text-danger mt-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="avatar" class="form-label">Avatar: </label>
                                    <input type="file" id="avatar" name="avatar" class="form-control"
                                        onchange="showImage(event)">
                                    <img id="img_danh_muc" src="{{ Storage::url($model->avatar) }}" alt="Avatar"
                                        style="width: 80px">
                                </div>

                            </div>

                            <div class="d-flex ">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                                <a href="{{ route('admin.users.index') }}"><i
                                        class="btn btn-success ri-arrow-go-back-fill"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('css')
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>

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

@section('scripts')
    <script>
        CKEDITOR.replace('content');

        function addImageGallery() {
            let id = 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            let html = `
                <div class="col-md-4" id="${id}_item">
                    <label for="${id}" class="form-label">Image</label>
                    <div class="d-flex">
                        <input type="file" class="form-control me-2" name="product_galleries[]" id="${id}">
                        <button type="button" class="btn btn-danger" onclick="removeImageGallery('${id}_item')">
                            <span class="bx bx-trash"></span>
                        </button>
                    </div>
                </div>
            `;

            $('#gallery_list').append(html);
        }

        function removeImageGallery(id) {
            if (confirm('Chắc chắn xóa không?')) {
                $('#' + id).remove();
            }
        }
    </script>
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
