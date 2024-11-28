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
                        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Accounts</a></li>
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
                    </div>

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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="province" class="form-label">Province</label>
                                            <select id="province"
                                                class="form-control pb-1 @error('province') is-invalid @enderror"
                                                name="">
                                                <option value="">{{ $model->province }}</option>
                                            </select>
                                            <input type="hidden" name="province" id="province_text"
                                                value="{{ $model->province }}">
                                            @error('province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="ward" class="form-label">Ward</label>
                                            <select id="ward"
                                                class="form-control pb-1 @error('ward') is-invalid @enderror"
                                                name="">
                                                <option value="" selected>{{ $model->ward }}</option>
                                            </select>
                                            <input type="hidden" name="ward" id="ward_text"
                                                value="{{ $model->ward }}">
                                            @error('ward')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="district" class="form-label">District</label>
                                            <select id="district"
                                                class="form-control pb-1 @error('district') is-invalid @enderror"
                                                name="">
                                                <option value="">{{ $model->district }}</option>
                                            </select>
                                            <input type="hidden" name="district" id="district_text"
                                                value="{{ $model->district }}">
                                            @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="username" class="form-label">Address</label>
                                            <input type="text"
                                                class="form-control @error('address') is-invalid @enderror" name="address"
                                                value="{{ $model->address }}" id="address" placeholder="Enter address">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

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
                                        value="{{ $model->email }}" readonly>
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
                                <button type="submit" class="btn btn-primary me-2" id="submit">Submit</button>
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
    <link href="{{ asset('theme/client/cssfix/profile/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/profile/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/profile/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/profile/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .header__menu ul {
            padding: 0;
            margin: 0;
        }

        .col-md-6 {
            padding: 0 15px;
        }

        .container {
            max-width: 1320px;
        }

        body {

            background-color: #F5F5F5;
        }

        footer {
            width: 100%;
        }
    </style>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.1/axios.min.js"
        integrity="sha512-bPh3uwgU5qEMipS/VOmRqynnMXGGSRv+72H/N260MQeXZIK4PG48401Bsby9Nq5P5fz7hy5UGNmC/W1Z51h2GQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        const host = "https://provinces.open-api.vn/api/";
        var callAPI = (api) => {
            let row = `<option value="">{{ $model->province ? $model->province : 'Chọn' }}</option>`;
            return axios.get(api)
                .then((response) => {
                    // const a = $model->province
                    // const data = response.data.filter(item => item !== a);
                    // console.log(response.data)
                    renderData(response.data, "province", row);
                });
        }
        callAPI('https://provinces.open-api.vn/api/?depth=1');
        let row = `<option  value="">Chọn</option>`;
        var callApiDistrict = (api) => {
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.districts, "district", row);
                });
        }
        var callApiWard = (api) => {
            let row = `<option  value="">Chọn</option>`;
            return axios.get(api)
                .then((response) => {
                    renderData(response.data.wards, "ward", row);
                });
        }

        var renderData = (array, select, row) => {
            array.forEach(element => {
                row += `<option value="${element.code}">${element.name}</option>`
            });
            document.querySelector("#" + select).innerHTML = row
        }

        $("#province").change(() => {
            callApiDistrict(host + "p/" + $("#province").val() + "?depth=2");
            printResult();
        });
        $("#district").change(() => {
            callApiWard(host + "d/" + $("#district").val() + "?depth=2");
            printResult();
        });
        $("#ward").change(() => {
            printResult();
        })

        var printResult = () => {
            if ($("#district").val() != "" && $("#province").val() != "" &&
                $("#ward").val() != "") {
                let result = $("#province option:selected").text() +
                    " | " + $("#district option:selected").text() + " | " +
                    $("#ward option:selected").text();
                $("#result").text(result)
            }


            $('#submit').click(function() {
                $('#province_text').val($('#province option:selected').text());
                $('#district_text').val($('#district option:selected').text());
                $('#ward_text').val($('#ward option:selected').text());
            })
        }
    </script>
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
