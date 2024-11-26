@extends('auth.layouts.master')
@section('title')
    Sign Up
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Create New Account</h5>
                        <p class="text-muted">Get your free velzon account now</p>
                    </div>
                    <div class="p-2 mt-4">
                        <form class="needs-validation" action="{{ route('auth.handleRegister') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="username" class="form-label">Name<span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="username" placeholder="Enter name" name="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="useremail" class="form-label">Email<span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="useremail" placeholder="Enter email address" name="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label class="form-label" for="password-input">Password</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password') is-invalid @enderror"
                                        placeholder="Enter password" id="password-input" aria-describedby="passwordInput"
                                        name="password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password-input">Confirm Password</label>
                                <div class="position-relative auth-pass-inputgroup">
                                    <input type="password"
                                        class="form-control pe-5 password-input @error('password_confirmation') is-invalid @enderror"
                                        placeholder="Enter confirm password" id="password-input"
                                        aria-describedby="passwordInput" name="password_confirmation">
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Sign Up</button>
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

            <div class="mt-4 text-center">
                <p class="mb-0">Already have an account ? <a href="{{ route('auth.showFormLogin') }}"
                        class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
            </div>

        </div>
    </div>
@endsection
