<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('theme/admin/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/admin/assets/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('theme/admin/assets/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('theme/admin/assets/images/logo-light.png') }}" alt="" height="17">
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
                    {{-- Dashboard --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{ route('admin.dashboard') }}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Analytics</span>
                        </a>
                    </li>

                    {{-- Categories --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarCategory" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarCategory">
                            <i class="ri-layout-3-line"></i> <span data-key="t-layout">Categories</span>
                            {{-- <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span> --}}
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

                    {{-- Products --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarProducts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarproducts">
                            <i class="ri-file-list-3-line"></i> <span data-key="t-forms">Products</span>
                            {{-- <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span> --}}
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

                    {{-- Accounts --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAccounts" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarAccounts">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Accounts</span>
                            {{-- <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span> --}}
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
                            {{-- <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span> --}}
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
                @endif


                @if (Auth::user()->role_id === 1 || Auth::user()->role_id === 2)
                    {{-- Orders --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarOrders" data-bs-toggle="collapse" role="button"
                            aria-expanded="false" aria-controls="sidebarOrders">
                            <i class="ri-account-circle-line"></i> <span data-key="t-authentication">Orders</span>
                            {{-- <span class="badge badge-pill bg-danger" data-key="t-hot">Hot</span> --}}
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarOrders">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="{{ route('admin.orders.index') }}" class="nav-link"
                                        data-key="t-horizontal">List</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-key="t-horizontal">Add new</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
