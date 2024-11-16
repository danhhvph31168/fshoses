<header class="header">

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('theme/client/img/logo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="./shop.html">Shop</a></li>
                        <li><a href="#">Sản phẩm</a>

                        </li>
                        <li><a href="./blog.html">Blog</a></li>
                        <li><a href="./contact.html">Contacts</a></li>

                        <a href="#" class="" style="color: #111111;"><i
                                class="bi bi-cart-check-fill mr-2"></i></a>
                    </ul>
                </nav>
            </div>



            <div class="col-md-3">

                @if (Auth::check())
                    <div class="dropdown ms-sm-3 header__menu topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">

                                <img src="{{ Auth::user()->avatar }}" alt="" width="18px" height="18px"
                                    style="border-radius: 50%; object-fit: cover;">
                                {{-- <i class="bi bi-person-circle"></i> --}}

                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text fw-semibold">
                                        {{ Auth::user()->name }}</span>
                                </span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i
                                        class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Trang Admin</span></a>
                            @endif
                            <a class="dropdown-item" href="{{ route('showFormUpdateProfile', Auth::user()->id) }}"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Cập nhật thông tin tài khoản</span></a>

                            <a class="dropdown-item" href="{{ route('showFormChangePassword') }}"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Thay đổi mật khẩu</span></a>
                            <a class="dropdown-item" href="{{ route('getListOrderHistory') }}"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Lịch sử đơn hàng</span></a>

                            <form action="{{ route('auth.logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item w-100 text-start"
                                    style="background: none; border: none; padding: .25rem 1.5rem;">
                                    <i class="mdi mdi-lifebuoy text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="dropdown ms-sm-3 header__menu topbar-user">
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-person-circle"></i>

                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text fw-semibold">
                                        Tài khoản</span>
                                </span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                           
                            <a class="dropdown-item" href="{{ route('showFormSearchOrder') }}">
                                <span class="align-middle">Tra cứu đơn hàng</span></a>
                            <a class="dropdown-item" href="{{ route('auth.showFormLogin') }}"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Login</span></a>
                            <a class="dropdown-item" href="{{ route('auth.showFormRegister') }}"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Register</span></a>
                        </div>
                    </div>
                @endif

            </div>

        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
