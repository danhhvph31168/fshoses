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
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    name="name" value="{{ $user->name }}" id="username" placeholder="Enter username">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ $user->email }}" id="username" placeholder="Enter email"
                                    disabled>
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
                                            <img src="{{ $user->avatar_url }}" alt=""
                                                class="img-fluid rounded-circle">
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
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    name="phone" value="{{ $user->phone }}" id="phone" placeholder="Enter phone">
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
                            <div class="mb-3">
                                <label for="username" class="form-label">District</label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror"
                                    name="district" value="{{ $user->district }}" id="district"
                                    placeholder="Enter district">
                                @error('district')
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
                                <label for="username" class="form-label">Province</label>
                                <input type="text" class="form-control @error('province') is-invalid @enderror"
                                    name="province" value="{{ $user->province }}" id="province"
                                    placeholder="Enter province">
                                @error('province')
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
                                <button class="btn btn-success w-100" type="submit">Update</button>

                            </div>

                            <div class="mt-4 text-center">
                                <div class="signin-other-title">
                                    <a href="{{ route('home') }}" class="fs-13 mb-4 title fw-medium"
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
