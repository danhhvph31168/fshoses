@extends('auth.layouts.master')
@section('title')
Update account information
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">

            <div class="card-body p-4">
                <div class="text-center mt-2">
                    <h5 class="text-primary">Update account information</h5>
                </div>
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <div class="p-2 mt-4">
                    <form method="POST" action="{{ route('handleUpdateProfile') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="username" class="form-label">Name</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="name"
                                value="{{ $user->name }}" id="username" placeholder="Enter username">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ $user->email }}" id="username" placeholder="Enter email" disabled>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password-input">Avatar</label>
                            <div class="position-relative auth-pass-inputgroup">
                                <input type="file" name="avatar"
                                    class="form-control pe-5 password-input @error('avatar') is-invalid @enderror">
                                <div class="card-body p-4 text-center">
                                    <div class="mx-auto avatar-md">
                                        {{-- <img src="{{ Storage::url($user->avatar_url) }}" alt="" --}}
                                        <img src="{{ $user->avatar_url }}" alt="" class="img-fluid rounded-circle">
                                    </div>
                                </div>
                                @error('avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                value="{{ $user->phone }}" id="phone" placeholder="Enter phone">
                            @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                name="address" value="{{ $user->address }}" id="address" placeholder="Enter address">
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
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
                            <select id="province" class="form-control @error('province') is-invalid @enderror"
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

                        <div class="mb-3">
                            <label for="district" class="form-label">District</label>
                            <select id="district" class="form-control @error('district') is-invalid @enderror"
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

                        <div class="mb-3">
                            <label for="ward" class="form-label">Ward</label>
                            <select id="ward" class="form-control @error('ward') is-invalid @enderror" name="ward">
                                <option value="" selected>{{ $user->ward }}</option>
                            </select>
                            <input type="hidden" name="ward_text" id="ward_text">

                            @error('ward')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Balance</label>
                            <input type="number" class="form-control @error('balance') is-invalid @enderror"
                                name="balance" value="{{ $user->balance }}" id="balance" placeholder="Enter balance"
                                disabled>
                            @error('balance')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Zip_code</label>
                            <input type="text" class="form-control @error('zip_code') is-invalid @enderror"
                                name="zip_code" value="{{ $user->zip_code }}" id="zip_code"
                                placeholder="Enter zip_code">
                            @error('zip_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>


                        <div class="mt-4">
                            <button class="btn btn-success w-100" type="submit" id="submit">Update</button>

                        </div>

                        <div class="mt-4 text-center">
                            <div class="signin-other-title">
                                <a href="{{ route('client.home') }}" class="fs-13 mb-4 title fw-medium"
                                    style="color: #212529">
                                    Back to home
                                </a>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
</div>
<!-- end row -->
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