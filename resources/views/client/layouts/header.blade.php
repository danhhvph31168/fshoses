<header class="header">

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="header__logo">
                    <a href="\"><img src="{{ asset('theme/admin/assets/images/logo-dark.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul>
                        <li class="active"><a href="/">Trang chủ</a></li>

                        <li><a href="#">Thương hiệu</a></li>
                            <ul class="dropdown">
                                @foreach ($brd as $item)
                                    @if ($item->status == 1)
                                        <li><a
                                                href="{{ route('client.productByBrand', $item->id) }}">{{ $item->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li><a href="#">Danh mục</a>
                            <ul class="dropdown">
                                @foreach ($cate as $item)
                                    {{-- @dd($item) --}}
                                    @if ($item->is_active == 1)
                                        <li><a
                                                href="{{ route('client.productByCategory', $item->id) }}">{{ $item->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Liên hệ</a></li>
                        <li><a href="./contact.html">Tra cứu đơn hàng</a></li>
                    </ul>
                </nav>
            </div>

            <div class="col-md-4">
                <div class="dropdown ms-sm-3 header__menu topbar-user">
                    @if (Auth::user())
                        <button type="button" class="btn" id="page-header-user-dropdown-1"
                            data-bs-toggle="dropdown-1" aria-haspopup="true" aria-expanded="false">
                            <a {{-- href="{{ route('cart.list') }}"  --}} class="d-flex align-items-center  text-black">
                                <i class="bi bi-cart"></i>
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Giỏ hàng</span>
                                </span>
                            </a>
                        </button>

                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-person-circle"></i>
                                <span class="text-start ms-xl-2">
                                    <span
                                        class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">{{ Auth::user()->name }}</span>
                                </span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Thông tin tài khoản</span></a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Lịch sử đặt hàng</span></a>
                            <a class="dropdown-item" href="#"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Đổi mật khẩu</span></a>
                            <form action="{{ route('auth.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="border-0 dropdown-item">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout">Logout</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <button type="button" class="btn" id="page-header-user-dropdown-1"
                            data-bs-toggle="dropdown-1" aria-haspopup="true" aria-expanded="false">
                            <a {{-- href="{{ route('cart.list') }}"  --}} class="d-flex align-items-center  text-black">
                                <i class="bi bi-cart"></i>
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Giỏ hàng</span>
                                </span>
                            </a>
                        </button>

                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <i class="bi bi-person-circle"></i>
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Tài
                                        khoản</span>
                                </span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('auth.showFormLogin') }}"><i
                                    class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Login</span></a>
                            <a class="dropdown-item" href="{{ route('auth.showFormRegister') }}"><i
                                    class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Register</span></a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
