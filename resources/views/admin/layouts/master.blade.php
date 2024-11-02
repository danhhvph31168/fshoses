<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<<<<<<< HEAD
    @yield('meta')
=======
>>>>>>> tuanndph31135

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('theme/admin/assets/images/favicon.ico') }}">

<<<<<<< HEAD
    @yield('style-libs')
=======
    @yield('css')
>>>>>>> tuanndph31135

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
<<<<<<< HEAD

    @yield('styles')

=======
    <style>
        * {
            font-family: 'Times New Roman', Times, serif;
            font-size: 0.8vw;
        }
    </style>
>>>>>>> tuanndph31135
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

<<<<<<< HEAD
        @include('admin.layouts.partials.header');

        @include('admin.layouts.partials.sidebar');
=======
        @include('admin.layouts.header')


        <!-- ========== App Menu ========== -->
        @include('admin.layouts.sidebar')
        <!-- Left Sidebar End -->
>>>>>>> tuanndph31135

        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
<<<<<<< HEAD
=======


>>>>>>> tuanndph31135
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
<<<<<<< HEAD
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @include('admin.layouts.partials.footer');
=======
            </div>
            <!-- End Page-content -->

            @include('admin.layouts.footer')
>>>>>>> tuanndph31135
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

<<<<<<< HEAD

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <div class="customizer-setting d-none d-md-block">
        <div class="btn-info rounded-pill shadow-lg btn btn-icon btn-lg p-2" data-bs-toggle="offcanvas"
            data-bs-target="#theme-settings-offcanvas" aria-controls="theme-settings-offcanvas">
            <i class='mdi mdi-spin mdi-cog-outline fs-22'></i>
        </div>
    </div>

=======
>>>>>>> tuanndph31135
    <script>
        const PATH_ROOT = '{{ asset('theme/admin') }}';
    </script>
    <!-- JAVASCRIPT -->
<<<<<<< HEAD
=======
    <!-- JAVASCRIPT -->
>>>>>>> tuanndph31135
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="{{ asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/plugins.js') }}"></script>

<<<<<<< HEAD
    @yield('script-libs')
=======
    @yield('js')
>>>>>>> tuanndph31135

    <!-- App js -->
    <script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>

    @yield('scripts')
<<<<<<< HEAD

</body>

</html>
=======
</body>

</html>

>>>>>>> tuanndph31135
