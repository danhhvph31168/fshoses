<div class="app-menu navbar-menu">
    <div class="navbar-brand-box">
        <a href="{{ route('admin.') }}" class="logo logo-dark">
            <span class="logo-sm"></span>
            <span class="logo-lg"></span>
        </a>

        <a href="{{ route('admin.') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('theme/admin/assets/images/logo.jpg') }}" alt="" height="100"
                    width="150">
            </span>
            <span class="logo-lg fs-1 text-black">
                <img src="{{ asset('theme/admin/assets/images/logo.jpg') }}" alt="" height="100">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                @if (Auth::user()->role_id === 1)
                    <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                        </a>
                    </li>

                    @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.orders.index') }}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Orders</span>
                            </a>
                        </li>
                    @endif

                    {{-- Accounts --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAccounts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAccounts">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Accounts</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAccounts">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.users.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add new</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Roles --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarRoles" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarRoles">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Roles</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarRoles">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.roles.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add new</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Products --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarproducts">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Products</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarProducts">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.products.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Categories --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCategory" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarCategory">
                            <i class="ri-layout-3-line"></i> <span data-key="t-layout">Categories</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCategory">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.categories.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Product Sizes --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarProductSizes" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarProductSizes">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Product Sizes</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarProductSizes">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.productSizes.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.productSizes.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Product Colors --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarProductColors" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarProductColors">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Product Colors</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarProductColors">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.productColors.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.productColors.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Banner --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarBanner" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarbanner">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Banner</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarBanner">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.banners.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.banners.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Brands --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarBrands" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarBrands">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Brands</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarBrands">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.brands.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.brands.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add new</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    {{-- Coupons --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCoupons" data-bs-toggle="collapse"
                            role="button" aria-expanded="false" aria-controls="sidebarCoupons">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Coupons</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarCoupons">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.coupons.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.coupons.create') }}" class="nav-link"
                                        data-key="t-horizontal">Add new</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{ route('admin.reviews.index') }}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Review</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>

    <div class="sidebar-background"></div>
</div>
