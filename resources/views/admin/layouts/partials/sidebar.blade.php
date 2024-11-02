<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('theme/admin/assets/images/logo-sm.png') }}" alt="" height="22">
                    </span>
            <span class="logo-lg">
                        <img src="{{ asset('theme/admin/assets/images/logo-dark.png') }}" alt="" height="17">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.') }}" class="logo logo-light">
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
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboards</span>
                    </a>
                </li>

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
                                    data-key="t-horizontal">Add New</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarOrder" data-bs-toggle="collapse" role="button"
                       aria-expanded="false" aria-controls="sidebarOrder">
                        <i class="ri-layout-3-line"></i>
                        <span data-key="t-layouts">Orders</span>

                    </a>
                    <div class="collapse menu-dropdown" id="sidebarOrder">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.index') }}" class="nav-link"
                                   data-key="t-horizontal">List</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.orders.create') }}" class="nav-link"
                                   data-key="t-horizontal">Create</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.refunds.index') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Refund</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ route('admin.reviews.index') }}">
                        <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Review</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
