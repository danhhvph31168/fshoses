<header class="header" style="position: sticky; top: 0; z-index: 1000; font-size: 18px; font-family: sans-serif; ">

    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <div class="header__logo">
                    <a href="\"><img src="{{ asset('theme/client/img/logonew.png') }}" alt="" style="width: 60px;"></a>
                </div>
            </div>
            <div class="col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul style="display: flex; white-space: nowrap;">
                        <li class="active"><a href="/">Home</a></li>


                        <li><a href="#">Brands</a>
                            <ul class="dropdown">
                                @foreach ($brd as $item)
                                @if ($item->status == 1)
                                <li><a href="{{ route('client.productByBrand', $item->id) }}">{{ $item->name }}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>


                        </li>

                        <li><a href="#">Categories</a>
                            <ul class="dropdown">
                                @foreach ($cate as $item)
                                {{-- @dd($item) --}}
                                @if ($item->is_active == 1)
                                <li><a href="{{ route('client.productByCategory', $item->id) }}">{{ $item->name }}</a>
                                </li>
                                @endif
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                        <li><a href="{{ route('showFormSearchOrder') }}">Order Tracking</a></li>
                    </ul>

                </nav>
            </div>


            <div class="col-md-4">
                <div class="dropdown ms-sm-5 header__menu topbar-user" style="background: #ffffff;">
                    @if (Auth::check())
                    <button type="button" class="btn" id="page-header-user-dropdown-1" data-bs-toggle="dropdown-1"
                        aria-haspopup="true" aria-expanded="false">
                        <a {{-- href="{{ route('cart.list') }}" --}} class="d-flex align-items-center  text-black">
                            <i class="bi bi-cart"></i>
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                    style="font-size: 18px; font-family: sans-serif; ">
                                    <strong>Cart</strong></span>
                            </span>
                        </a>
                    </button>

                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img src="{{ Auth::user()->avatar }}" alt="" style="border-radius: 50%" width="20px"
                                height="22px">

                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                    style="font-size: 18px; font-family: sans-serif; "><strong>{{ Auth::user()->name }}</strong></span>
                            </span>

                        </span>
                        </a>
                    </button>


                    <div class="dropdown-menu dropdown-menu-end">
                        @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                        <a class="dropdown-item" href="#"><i
                                class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Admin Page</span></a>
                        @endif
                        <a class="dropdown-item" href="{{ route('showFormUpdateProfile', Auth::user()->id) }}"><i
                                class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Profile</span></a>
                        <a class="dropdown-item" href="{{ route('getListOrderHistory') }}"><i
                                class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Order History</span></a>
                        <a class="dropdown-item" href="{{ route('showFormChangePassword') }}"><i
                                class="mdi mdi-calendar-check-outline text-muted fs-16 align-middle me-1"></i>
                            <span class="align-middle">Change Password</span></a>
                        <form action="{{ route('auth.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="border-0 dropdown-item">
                                <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle" data-key="t-logout">Logout</span>
                            </button>
                        </form>
                    </div>

                    @else
                    <button type="button" class="btn" id="page-header-user-dropdown-1" data-bs-toggle="dropdown-1"
                        aria-haspopup="true" aria-expanded="false">
                        <a {{-- href="{{ route('cart.list') }}" --}} class="d-flex align-items-center  text-black">
                            <i class="bi bi-cart"></i>
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                    style="font-size: 18px; font-family: sans-serif;"><strong>Cart</strong></span>
                            </span>
                        </a>
                    </button>

                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <i class="bi bi-person-circle"></i>
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                    style="font-size: 18px; font-family: sans-serif;"><strong>Account</strong></span>
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