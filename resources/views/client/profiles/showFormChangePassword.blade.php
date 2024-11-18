{{-- @section('content') --}}
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Velzon - Admin & Dashboard Template</title>
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
<style>
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
</style>

<body>
    <div class="container mt-5">
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
                                </div>
                            </div>
                        </form>
                        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <!-- Giúp modal căn giữa theo chiều dọc -->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="successModalLabel">Cập nhật thành công
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn đã thay đổi mật khẩu thành công.
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
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Kiểm tra nếu có session 'success'
        @if(session('message'))
        // Hiển thị modal
        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
        successModal.show();

        // Khi nhấn "OK", chuyển về trang chủ
        document.getElementById('confirmButton').addEventListener('click', function() {
            window.location.href = "{{ route('client.home') }}";
        });
        @endif
    });
    </script>
</body>

</html>
{{-- @endsection --}}