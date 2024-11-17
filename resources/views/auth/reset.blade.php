@extends('auth.layouts.master')
@section('title')
    Forgot Password
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Create new password</h5>
                        <p class="text-muted">Your new password must be different from previous used password.</p>
                    </div>

                    <div class="p-2">
                        <form method="POST" action="{{ route('handleForgotPass', [$user->id, $token]) }}">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        name="password" placeholder="Enter password" id="password-input"
                                        aria-describedby="passwordInput">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="confirm-password-input">Confirm Password</label>
                                <div class="position-relative auth-pass-inputgroup mb-3">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        name="password_confirmation" placeholder="Confirm password"
                                        id="confirm-password-input">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Reset Password</button>
                            </div>

                        </form>
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
                <p class="mb-0">Wait, I remember my password... <a href="auth-signin-basic.html"
                        class="fw-semibold text-primary text-decoration-underline"> Click here </a> </p>
            </div>

        </div>
    </div>
@endsection
