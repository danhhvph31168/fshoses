{{-- @section('content') --}}
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Profile | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('theme/admin/assets/images/favicon.ico') }}">

    <!-- Layout config Js -->
    <script src="{{ asset('theme/admin/assets/js/layout.js') }}"></script>
    <!-- Bootstrap Css -->
    <link href="{{ asset('theme/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('theme/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{ asset('theme/admin/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />

</head>


<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cập nhật') }}</div>

                    <div class="card-body">
                        @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                        @endif
                        <form method="POST" action="{{ route('handleUpdateProfile') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="name"
                                        value="{{ $user->name }}" autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $user->email }}" autocomplete="email" autofocus disabled>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="avatar"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Avatar') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="file"
                                        class="form-control mb-4 @error('email') is-invalid @enderror" name="avatar"
                                        autocomplete="email" autofocus>
                                    <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="" width="100px"
                                        height="100px">
                                    {{-- {{dd($user->avatar)}} --}}
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ $user->phone }}" autocomplete="phone" autofocus>

                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="text"
                                        class="form-control @error('address') is-invalid @enderror" name="address"
                                        value="{{ $user->address }}" autocomplete="address" autofocus>

                                    @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('District') }}</label>

                                <div class="col-md-6">
                                    <input id="district" type="text"
                                        class="form-control @error('district') is-invalid @enderror" name="district"
                                        value="{{ $user->district }}" autocomplete="district" autofocus>

                                    @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="address"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Balance') }}</label>

                                <div class="col-md-6">
                                    <input id="balance" type="text"
                                        class="form-control @error('balance') is-invalid @enderror" name="balance"
                                        value="{{ $user->balance }}" autocomplete="balance" autofocus disabled>

                                    @error('balance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="province"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Province') }}</label>

                                <div class="col-md-6">
                                    <input id="province" type="text"
                                        class="form-control @error('province') is-invalid @enderror" name="province"
                                        value="{{ $user->province }}" autocomplete="province" autofocus>

                                    @error('province')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="zip_code"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Zip_code') }}</label>

                                <div class="col-md-6">
                                    <input id="zip_code" type="text"
                                        class="form-control @error('zip_code') is-invalid @enderror" name="zip_code"
                                        value="{{ $user->zip_code }}" autocomplete="zip_code" autofocus>

                                    @error('zip_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update
                                    </button>
                                    <a href="{{ route('client.home') }}" class="btn btn-primary">
                                        {{ __('Back') }}
                                    </a>
                                </div>


                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/plugins.js') }}"></script>

    <!-- password-addon init -->
    <script src="{{ asset('theme/admin/assets/js/pages/password-addon.init.js') }}"></script>

</body>

</html>
{{-- @endsection --}}