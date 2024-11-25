<header class="header" style="position: sticky; top: 0; z-index: 1000; font-size: 18px; font-family: sans-serif; ">

    <div class="container">
        <div class="row">
            <div class="" style="width: 160px;">
                <div class="header__logo" style="width: 100px;">
                    <a href="\"><img src="{{ asset('theme/client/img/logo/newlogoblack1.png') }}" alt=""
                        style="width: 100px;"></a>
                </div>
            </div>
            <div class="col-md-6">
                <nav class="header__menu mobile-menu">
                    <ul style="display: flex; white-space: nowrap;">

                        <div class="search-container">
                            <input type="text" id="search-input" placeholder="Search products..." autocomplete="off">
                            <div id="search-results" class="dropdown-menu"></div>
                        </div>

                        <li class="active"><a href="/">Home</a></li>


                        <!-- <li><a href="#">Brands</a>
                            <ul class="dropdown" style="background-color: white;  border: 1px solid black;">
                                @foreach ($brd as $item)
@if ($item->status == 1)
<li><a style="color: black;"
                                        href="{{ route('client.productByBrand', $item->id) }}">{{ $item->name }}</a>
                                </li>
@endif
@endforeach
                            </ul>
                        </li> -->


                        </li>

                        <li><a href="#">Categories</a>
                            <ul class="dropdown" style="background-color: white;  border: 1px solid black;">
                                @foreach ($cate as $item)
                                    {{-- @dd($item) --}}
                                    @if ($item->is_active == 1)
                                        <li><a style="color: black;"
                                                href="{{ route('client.productByCategory', $item->id) }}">{{ $item->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('showFormSearchOrder') }}">Order Tracking</a></li>

                    </ul>

                </nav>
            </div>


            <div class="col-md-4">
                <div class="dropdown ms-sm-5 header__menu topbar-user" style="background: #ffffff;">
                    <button type="button" class="btn" id="page-header-user-dropdown-1" data-bs-toggle="dropdown-1"
                        aria-haspopup="true" aria-expanded="false">
                        <a class="d-flex align-items-center text-black">
                            <i class="mdi mdi-cart-outline text-muted fs-16"></i>
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                    style="font-size: 18px; font-family: sans-serif;"><strong>Cart</strong></span>
                            </span>
                        </a>
                    </button>

                    @if (Auth::check())
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img src="{{ Auth::user()->avatar }}" alt="" style="border-radius: 50%"
                                    width="20px" height="22px">

                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                        style="font-size: 18px; font-family: sans-serif; "><strong>
                                            {{ implode(' ', array_slice(explode(' ', Auth::user()->name), -2)) }}</strong></span>
                                </span>

                            </span>
                            </a>
                        </button>


                        <div class="dropdown-menu dropdown-menu-end">
                            @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                                <a class="dropdown-item" href="#"><i
                                        class="mdi mdi-view-dashboard-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Admin Page</span></a>
                            @endif
                            <a class="dropdown-item" href="{{ route('showFormUpdateProfile', Auth::user()->id) }}"><i
                                    class="mdi mdi-account-circle-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Profile</span></a>
                            <a class="dropdown-item" href="{{ route('showFormChangePassword') }}"><i
                                    class="mdi mdi-lock-outline text-muted fs-16 align-middle me-1"></i>

                                <span class="align-middle">Change Password</span></a>
                            <a class="dropdown-item" href="{{ route('getListOrderHistory') }}"><i
                                    class="mdi mdi-history text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Order History</span></a>
                            <form action="{{ route('auth.logout') }}" method="post">
                                @csrf
                                <button type="submit" class="border-0 dropdown-item">
                                    <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle" data-key="t-logout">Logout</span>
                                </button>
                            </form>
                        </div>
                    @else
                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <i class="mdi mdi-account-outline text-muted fs-16"></i>
                                <span class="text-start ms-xl-2">
                                    <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                        style="font-size: 18px; font-family: sans-serif;"><strong>Account</strong></span>
                                </span>
                            </span>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="{{ route('auth.showFormLogin') }}"><i
                                    class="mdi mdi-login text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Login</span></a>
                            <a class="dropdown-item" href="{{ route('auth.showFormRegister') }}"><i
                                    class="mdi mdi-account-plus-outline text-muted fs-16 align-middle me-1"></i>
                                <span class="align-middle">Register</span></a>
                        </div>
                    @endif


                </div>
            </div>
        </div>
        <div class="canvas__open"><i class="fa fa-bars"></i></div>
    </div>
</header>
<style>
    .search-container {
        position: relative;
        margin-right: 40px;
    }

    #search-input {
        width: 300px;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 20px;
        font-size: 14px;
        transition: all 0.3s ease;
    }

    #search-input:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    #search-results {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        z-index: 1000;
        background-color: white;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-top: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        display: none;
        max-height: 200px;
        overflow-y: auto;
    }

    #search-results .dropdown-item {
        padding: 10px;
        font-size: 14px;
        color: #333;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    #search-results .dropdown-item:hover {
        background-color: #f8f9fa;
    }


    .dropdown li:hover {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#search-input').on('keyup', function() {
            let query = $(this).val();

            if (query.length >= 1) {
                $.ajax({
                    url: "{{ route('search') }}",
                    type: 'GET',
                    data: {
                        query: query
                    },
                    success: function(data) {
                        console.log(data)
                        let results = '';
                        if (data.length > 0) {
                            data.forEach(item => {
                                results += `
                                        <a href="/product-detail/${item.slug}"  >
                                            <div class="dropdown-item">
                                                <img src="${item.img_thumbnail}" alt="${item.name}" style="width: 30px; height: 30px; border-radius: 50%; margin-right: 10px;">
                                                <span>${item.name}</span>
                                                <span style="float: right; color: #007bff;">${item.price_regular}</span>
                                            </div>
                                        </a>
                                        
                                    `;
                            });
                        } else {
                            results = '<div class="dropdown-item">No results found</div>';
                        }
                        $('#search-results').html(results).fadeIn();
                    }
                });
            } else {
                $('#search-results').fadeOut();
            }
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('.search-container').length) {
                $('#search-results').fadeOut();
            }
        });
    });
</script>
