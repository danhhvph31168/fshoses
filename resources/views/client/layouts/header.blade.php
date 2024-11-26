<header class="header" style="position: sticky; top: 0; z-index: 1000; font-size: 18px; font-family: sans-serif; ">

    <div class="container p-0">
        <div class="row" style="padding-left: 10px;  justify-content: space-evenly">
            <div class="" style="width: 160px;">
                <div class="header__logo" style="width: 100px;">
                    <a href="\"><img src="{{ asset('theme/client/img/logo/newlogoblack1.png') }}" alt=""
                        style="width: 100px;"></a>
                </div>
            </div>
            <div class="col-md-8" style="align-content: center;">
                <nav class="header__menu mobile-menu">
                    <ul style="display: flex; white-space: nowrap; justify-content: space-around">
                        <div class="search-container">
                            <input type="text" id="search-input" placeholder="Search products..." autocomplete="off">
                            <div id="search-results" class="dropdown-menu"></div>
                        </div>

                        <li class="active mx-3"><a style="font-weight:500 !important;" class="text-uppercase"
                                href="/">Home</a></li>
                        </li>

                        <li class="active mx-3"><a style="font-weight:500 !important;" class="text-uppercase"
                                href="#">Category</a>
                            <ul class="dropdown">
                                @foreach ($cate as $item)
                                    @if ($item->is_active == 1)
                                        <li><a
                                                href="{{ route('client.productByCategory', $item->id) }}">{{ $item->name }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>

                        <li class="active mx-3"><a style="font-weight:500 !important;" class="text-uppercase"
                                href="#">Contact</a>
                        </li>

                        <li class="active mx-3"><a style="font-weight:500 !important;" class="text-uppercase"
                                href="{{ route('showFormSearchOrder') }}">Order Tracking</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-2" style="align-content: center; width: 10.333333%">
                <div class="dropdown ms-sm-5 header__menu topbar-user" style="background: #ffffff;">
                    @if (Auth::check())
                        <button type="button" class="btn" id="page-header-user-dropdown-1"
                            data-bs-toggle="dropdown-1" aria-haspopup="true" aria-expanded="false">
                            <a href="{{ route('cart.list') }}" class="d-flex align-items-center  text-black">
                                <i class="bi bi-cart"></i>
                            </a>
                        </button>

                        <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <span class="d-flex align-items-center">
                                <img src="{{ Storage::url(Auth::user()->avatar) }}" alt=""
                                    style="border-radius: 50%" width="30px" height="25px">
                            </span>
                            </a>
                        </button>

                        <div class="dropdown-menu dropdown-menu-end">
                            <span
                                class=" dropdown-item align-middle text-danger d-none d-xl-inline-block fw-medium user-name-text"
                                style="font-size: 18px; font-family: sans-serif; "><strong>Hi,
                                    {{ implode(' ', array_slice(explode(' ', Auth::user()->name), -2)) }}
                                </strong></span>
                            @if (Auth::user()->role_id == 2 || Auth::user()->role_id == 1)
                                <a class="dropdown-item" target="#" href="{{ route('admin.') }}"><i
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
                        <button type="button" class="btn" id="page-header-user-dropdown-1"
                            data-bs-toggle="dropdown-1" aria-haspopup="true" aria-expanded="false">
                            <a class="d-flex align-items-center text-black">
                                <i class="mdi mdi-cart-outline text-muted fs-16">Cart</i>
                            </a>
                        </button>

                        <button type="button" class="btn" id="page-header-user-dropdown"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span
                                class="d-flex align-items-center text-start ms-xl-2 d-none d-xl-inline-block ms-1 fw-medium user-name-text"
                                style="font-size: 18px; font-family: sans-serif;"><i
                                    class="mdi mdi-account-outline text-muted fs-16">Login</i>
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
        background-color: white;
    }

    .dropdown li a:hover {
        color: black !important;
    }

    .header__menu {
        margin-left: 0 !important;
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
