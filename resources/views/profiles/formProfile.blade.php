@extends('client.layouts.master')

@section('title')
Update account information
@endsection
@section('content')

<section class="shop-details" style="">
    <div class="product__details__pic" style="padding: 40px 0 15px; margin-bottom: 0;">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__breadcrumb">
                    <a href="./index.html">Home</a>
                    <a href="./shop.html">Profile</a>
                    <span style="color:black">{{ $user->name }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="page-content" style="marginleft: 100px; marginright: 100px; margintop: -200px">
    <div class="container-fluid">
        <div class="row">
            <form class="col-xxl-3" method="POST" action="{{ route('handleUpdateProfile') }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="card mt-n5">
                    <div class="card-body p-4">
                        <div class="text-center">
                            <div class="profile-user position-relative d-inline-block mx-auto mb-4">
                                <img src="{{ $user->avatar }}" name="avatar"
                                    class="rounded-circle avatar-xl img-thumbnail user-profile-image @error('avatar') is-invalid @enderror"
                                    alt="user-profile-image" />
                                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                    <input id="profile-img-file-input" type="file" class="profile-img-file-input" />
                                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                        <span class="avatar-title rounded-circle bg-light text-body">
                                            <i class="ri-camera-fill"></i>
                                        </span>
                                    </label>
                                </div>
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <h5 class="fs-16 mb-1">Anna Adame</h5>
                            <p class="text-muted mb-0">Lead Designer / Developer</p>
                        </div>
                    </div>
                </div>

                <div class="card"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-4">
                            <div class="flex-grow-1">
                                <h5 class="card-title mb-0">Portfolio</h5>
                            </div>
                            <div class="flex-shrink-0">
                                <a href="javascript:void(0);" class="badge bg-light text-primary fs-12">
                                    <i class="ri-add-fill align-bottom me-1"></i> Add
                                </a>
                            </div>
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-body text-body">
                                    <i class="ri-github-fill"></i>
                                </span>
                            </div>
                            <input type="email" class="form-control" id="gitUsername" placeholder="Username"
                                value="@daveadame" />
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-primary">
                                    <i class="ri-global-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="websiteInput" placeholder="www.example.com"
                                value="www.velzon.com" />
                        </div>
                        <div class="mb-3 d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-success">
                                    <i class="ri-dribbble-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="dribbleName" placeholder="Username"
                                value="@dave_adame" />
                        </div>
                        <div class="d-flex">
                            <div class="avatar-xs d-block flex-shrink-0 me-3">
                                <span class="avatar-title rounded-circle fs-16 bg-danger">
                                    <i class="ri-pinterest-fill"></i>
                                </span>
                            </div>
                            <input type="text" class="form-control" id="pinterestName" placeholder="Username"
                                value="Advance Dave" />
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-xxl-9">
                <div class="card mt-xxl-n5">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                    <i class="fas fa-home"></i> Personal Details
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                    <i class="far fa-user"></i> Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body p-4">
                        <div class="tab-content">
                            <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                <form action="javascript:void(0);">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">
                                                    Name
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="name" value="{{ $user->name }}" id="username"
                                                    placeholder="Enter username" />
                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">
                                                    Phone Number
                                                </label>
                                                <input type="text"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    name="phone" value="{{ $user->phone }}" id="phone"
                                                    placeholder="Enter phone" />
                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">
                                                    Email Address
                                                </label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ $user->email }}" id="username"
                                                    placeholder="Enter email" disabled />
                                                @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Address</label>
                                                <input type="text"
                                                    class="form-control @error('address') is-invalid @enderror"
                                                    name="address" value="{{ $user->address }}" id="address"
                                                    placeholder="Enter address">
                                                @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            {{-- <select name="" id="province">
                                            </select>
                                            <select name="" id="district">
                                                <option value="">chọn quận</option>
                                            </select>
                                            <select name="" id="ward">
                                                <option value="">chọn phường</option>
                                            </select> --}}
                                            <div class="mb-3">
                                                <label for="province" class="form-label">Province</label>
                                                <select id="province"
                                                    class="form-control @error('province') is-invalid @enderror"
                                                    name="province">
                                                    <option value="">{{ $user->province }}</option>

                                                </select>
                                                <input type="hidden" name="province_text" id="province_text">
                                                @error('province')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="district" class="form-label">District</label>
                                                <select id="district"
                                                    class="form-control @error('district') is-invalid @enderror"
                                                    name="district">
                                                    <option value="">{{ $user->district }}</option>

                                                </select>
                                                <input type="hidden" name="district_text" id="district_text">
                                                @error('district')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="mb-3">
                                                <label for="ward" class="form-label">Ward</label>
                                                <select id="ward"
                                                    class="form-control @error('ward') is-invalid @enderror"
                                                    name="ward">
                                                    <option value="" selected>{{ $user->ward }}</option>
                                                </select>
                                                <input type="hidden" name="ward_text" id="ward_text">

                                                @error('ward')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>


                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <label for="username" class="form-label">Zip_code</label>
                                                <input type="text"
                                                    class="form-control @error('zip_code') is-invalid @enderror"
                                                    name="zip_code" value="{{ $user->zip_code }}" id="zip_code"
                                                    placeholder="Enter zip_code">
                                                @error('zip_code')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>



                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button class="btn btn-primary" type="submit"
                                                    id="submit">Update</button>
                                                <div class="btn btn-soft-success">
                                                    <a href="{{ route('client.home') }}"
                                                        class="fs-13 mb-4 title fw-medium" style="color: #212529">
                                                        Back to home
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane" id="changePassword" role="tabpanel">
                                <form action="javascript:void(0);">
                                    <div class="row g-2">
                                        <div class="col-lg-4">
                                            <div>
                                                <label for="oldpasswordInput" class="form-label">
                                                    Old Password*
                                                </label>
                                                <input type="password" class="form-control" id="oldpasswordInput"
                                                    placeholder="Enter current password" />
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="newpasswordInput" class="form-label">
                                                    New Password*
                                                </label>
                                                <input type="password" class="form-control" id="newpasswordInput"
                                                    placeholder="Enter new password" />
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div>
                                                <label for="confirmpasswordInput" class="form-label">
                                                    Confirm Password*
                                                </label>
                                                <input type="password" class="form-control" id="confirmpasswordInput"
                                                    placeholder="Confirm password" />
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="mb-3">
                                                <a href="javascript:void(0);"
                                                    class="link-primary text-decoration-underline">
                                                    Forgot Password ?
                                                </a>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-success">
                                                    Change Password
                                                </button>
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
body {

    background-color: #F5F5F5;
}

footer {
    width: 100%;
}
</style>

@endsection
@section('scripts')
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