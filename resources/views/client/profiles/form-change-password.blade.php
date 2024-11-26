@extends('client.layouts.checkout.checkout')

@section('title')
    Update account information
@endsection
@section('content')
    <section class="shop-details" style="">
        <div class="product__details__pic" style="padding: 40px 0 15px; margin-bottom: 0;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb">
                        <a href="{{ route('client.home') }}">Home</a>
                        <span style="color:black">Change Password > </span>
                        <span style="color:black">{{ $user->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="page-content">
        <div class="container-fluid" style="padding-left: 100px; padding-right: 100px;">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-xxl-3">
                    <div class="card mt-n5">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                    <img src="{{ $user->avatar }}" name="avatar"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image"
                                        alt="user-profile-image" />
                                </div>
                                <h5 class="fs-16 mb-1">{{ $user->name }}</h5>
                                <p class="text-muted mb-0">{{$user->email}}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-9">
                    <div class="card mt-xxl-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="mdi mdi-lock-outline"></i> Change Password
                                    </a>
                                </li>

                            </ul>
                        </div>

                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    @if (session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                    <form action="{{ route('handleChangePassword') }}" method="POST">
                                        @csrf
                                        <div class="row g-2">
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="oldpasswordInput" class="form-label">
                                                        Old Password*
                                                    </label>
                                                    <input type="password"
                                                        class="form-control @error('old_password') is-invalid @enderror"
                                                        name="old_password" id="oldpasswordInput"
                                                        placeholder="Enter current password" autofocus />
                                                    @error('old_password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">
                                                        New Password*
                                                    </label>
                                                    <input type="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" id="newpasswordInput"
                                                        placeholder="Enter new password" />
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="confirmpasswordInput" class="form-label">
                                                        Confirm Password*
                                                    </label>
                                                    <input type="password"
                                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                                        name="password_confirmation" id="confirmpasswordInput"
                                                        placeholder="Confirm password" />
                                                    @error('password_confirmation')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>



                                            <div class="col-lg-12 mt-3">
                                                <div class="text-end">
                                                    <button class="btn btn-primary" type="submit"
                                                    id="submit">Change Password</button>
                                                 
                                                    <div class="btn btn-soft-primary">
                                                        <a href="{{ route('client.home') }}"
                                                            class="fs-13 mb-4 title fw-medium" style="color: #212529">
                                                            Back
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->
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
            let row = `<option value="">{{ $user->province ? $user->province : 'Chọn' }}</option>`;
            return axios.get(api)
                .then((response) => {
                    // const a = $user->province
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
                $('#province_text').val($("#province option:selected").text())
                $('#district_text').val($("#district option:selected").text())
                $('#ward_text').val($("#ward option:selected").text())
            })


        }
    </script>
@endsection
