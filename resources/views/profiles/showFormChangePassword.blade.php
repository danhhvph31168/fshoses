
@extends('auth.layouts.master')
@section('title')
    Change Password
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Change Password</h5>
                    </div>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="p-2 mt-4">
                        <form method="POST" action="{{ route('handleChangePassword')}}">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Old Password</label>
                                <input type="password" class="form-control @error('old_password') is-invalid @enderror"
                                    name="old_password"  id="old_password" placeholder="Enter old password">
                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror"
                                    name="password"  id="password" placeholder="Enter new password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="username" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation"  id="password_confirmation" placeholder="Enter password confirmation">
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            


                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Change</button>

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
    {{-- <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Thay đổi mật khẩu') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('handleChangePassword') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu cũ') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('old_password') is-invalid @enderror"
                                        name="old_password" autocomplete="current-password">

                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Mật khẩu mới') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password_confirmation"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Xác nhận mật khẩu mới') }}</label>

                                <div class="col-md-6">
                                    <input id="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" autocomplete="current-password">

                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send') }}
                                    </button>
                                    <a class="btn btn-primary" href="{{route('home')}}">Back</a>
                                </div>
                            </div>
                        </form>
                        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <!-- Giúp modal căn giữa theo chiều dọc -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Password changed successfully.
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Password changed successfully.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="confirmButton">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- end row -->
@endsection
{{-- <style>
    /* Đặt modal ở giữa màn hình theo chiều ngang, trượt từ trên xuống */
    .modal.fade .modal-dialog {
        transform: translateY(-30%);
        /* Đặt vị trí ban đầu của modal cao hơn màn hình một chút */
        transition: transform 0.5s ease, opacity 0.5s ease;
        opacity: 0;
        /* Ban đầu, modal sẽ trong suốt */
    }

    .modal.fade.show .modal-dialog {
        transform: translateY(0);
        /* Khi hiện modal, đặt vị trí về giữa màn hình */
        opacity: 1;
        /* Hiện modal */
    }
</style> --}}


  
    
