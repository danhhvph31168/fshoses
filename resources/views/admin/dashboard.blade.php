@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
    <form action="{{ route('admin.dashboard.year') }}" method="post" id="myForm">
        @csrf

        <div class="row">
            <div class="col">

                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">Good Morning, DANH</h4>
                                    <p class="text-muted mb-0">Here's what's happening with your store
                                        today.</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                    <form action="javascript:void(0);">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-sm-auto">
                                                <div class="input-group">
                                                    <input type="text"
                                                        class="form-control border-0 dash-filter-picker shadow"
                                                        data-provider="flatpickr" data-range-date="true"
                                                        data-date-format="d M, Y"
                                                        data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                    <div class="input-group-text bg-primary border-primary text-white">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-auto">
                                                <button type="button" class="btn btn-soft-success"><i
                                                        class="ri-add-circle-line align-middle me-1"></i> Add
                                                    Product
                                                </button>
                                            </div>

                                            <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn">
                                                    <i class="ri-pulse-line"></i></button>
                                            </div>

                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Total Earnings</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +16.24
                                            %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                                data-target="559.25">0</span>k </h4>
                                        <a href="" class="text-decoration-underline">View net earnings</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="bx bx-dollar-circle text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Orders</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-danger fs-14 mb-0">
                                            <i class="ri-arrow-right-down-line fs-13 align-middle"></i>
                                            -3.57 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="36894">0</span></h4>
                                        <a href="" class="text-decoration-underline">View all orders</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                            <i class="bx bx-shopping-bag text-info"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Customers</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i> +29.08
                                            %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="183.35">0</span>M </h4>
                                        <a href="" class="text-decoration-underline">See details</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="bx bx-user-circle text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            My Balance</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-muted fs-14 mb-0">
                                            +0.00 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                                data-target="165.89">0</span>k </h4>
                                        <a href="" class="text-decoration-underline">Withdraw money</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="bx bx-wallet text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> --}}

                    <div class="row">

                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Revenue Order</h4>
                                    <div class="d-flex align-items-center justify-content-end">
                                        <input type="date" name="dateStart" id="dateStart"
                                            class="form-control border-info" style="width: 120px;"
                                            value="{{ old('dateStart') }}">

                                        <span id="addDateEnd" data-bs-toggle="collapse" href="#collapseExample"
                                            role="button" aria-expanded="false" aria-controls="collapseExample"> > </span>

                                        <div class="collapse" id="collapseExample">
                                            <input type="date" name="dateEnd" id="dateEnd"
                                                class="form-control border-info" style="width: 120px;">
                                        </div>

                                        <button type="submit" id="subYear" class="btn btn-info"><i
                                                class="bi bi-search"></i></button> >

                                        <select id="yearSelect" name="filteryear" class="form-control border-info"
                                            style="width: 62px;">
                                            @foreach (range($currentYear, 2022) as $year)
                                                <option class="border-none" value="{{ $year }}"
                                                    @selected(request('filteryear') == $year)>{{ $year }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                                {{-- @if (!request('filteryear')) --}}
                                <div class="card-header p-0 border-0 bg-light-subtle">
                                    <div class="row row-cols-lg-5 g-0 text-center">
                                        <div class="col">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value text-primary"
                                                        data-target="{{ $dataDate['filterDayOrder'] }}">0</span>
                                                </h5>
                                                <p class="text-primary mb-0">Orders</p>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value text-success"
                                                        data-target="{{ $dataDate['filterDayEarning'] }}">0</span><span
                                                        class="text-success">k</span>
                                                </h5>
                                                <p class="text-success mb-0">Earnings</p>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1 text-danger"><span class="counter-value"
                                                        data-target="{{ $dataDate['filterDayOrderCancel'] }}">0</span>
                                                </h5>
                                                <p class="text-danger mb-0">Refunds</p>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1 text-warning"><span class="counter-value"
                                                        data-target="{{ $dataDate['filterDayRefund'] }}">0</span>
                                                </h5>
                                                <p class="text-warning mb-0">Order Cancel</p>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1 text-info"><span class="counter-value"
                                                        data-target="{{ $dataDate['filterDayProduct'] }}">0</span>
                                                </h5>
                                                <p class="text-info mb-0">Product Count</p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                {{-- @endif --}}

                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <div id="customer_impression_charts"
                                            data-colors='["--vz-primary", "--vz-success", "--vz-danger", "--vz-warning", "--vz-info"]'
                                            class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>

                            </div><!-- end card -->
                        </div>


                        <div class="col-xl-4">

                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-primary btn-sm">
                                            Export Report
                                        </button>
                                    </div>
                                </div>

                                <div class="card-body">

                                    <div id="sales-by-locations"
                                        data-colors='["--vz-light", "--vz-success", "--vz-primary"]' style="height: 269px"
                                        dir="ltr"></div>

                                    <div class="px-2 py-2 mt-1">

                                        @foreach ($orderPercentages as $key => $value)
                                            <p class="mb-1">{{ $key }} <span
                                                    class="float-end">{{ number_format($value, 2) }}%</span>
                                            </p>
                                            <div class="progress mt-2" style="height: 6px;">
                                                <div class="progress-bar progress-bar-striped bg-primary"
                                                    role="progressbar" style="width: {{ number_format($value, 2) }}%"
                                                    aria-valuenow="{{ number_format($value, 2) }}" aria-valuemin="0"
                                                    aria-valuemax="{{ number_format($value, 2) }}">
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                            <!-- end card -->
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>
                                    <div class="flex-shrink-0">
                                        <select name="fillterProduct" id="fillterProduct" class="form-control"
                                            onchange="submitForm()">
                                            @if (session('fillterProduct'))
                                                <option value="{{ session('fillterProduct') }}" selected>
                                                    {{ ucwords(str_replace('_', ' ', session('fillterProduct'))) }}
                                                </option>
                                            @endif
                                            <option value="today">Today</option>
                                            <option value="all">All</option>
                                            <option value="yesterday">Yesterday</option>
                                            <option value="last_7_days">Last 7 Days</option>
                                            <option value="last_30_days">Last 30 Days</option>
                                            <option value="this_mouth">This Month</option>
                                            <option value="last_month">Last Month</option>
                                            <option value="last_year">Last Year</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0 ">
                                            <tbody>
                                                @foreach ($topProducts as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                    <img src="{{ $item->img_thumbnail }}" alt=""
                                                                        class="img-fluid d-block" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1"><a
                                                                            href="apps-ecommerce-product-details.html"
                                                                            class="text-reset">{{ \Str::limit($item->name, 15) }}</a>
                                                                    </h5>
                                                                    <span
                                                                        class="text-muted">{{ \Str::limit($item->description, 15) }}</span>
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">
                                                                {{ number_format($item->price_sale ? $item->price_sale : $item->price_regular) }}
                                                            </h5>
                                                            <span class="text-muted">Price</span>
                                                        </td>

                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{ $item->count_orders }}
                                                            </h5>
                                                            <span class="text-muted">Orders</span>
                                                        </td>

                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{ $item->stock }}</h5>
                                                            <span class="text-muted">Stock</span>
                                                        </td>

                                                        <td>
                                                            <h5 class="fs-14 my-1 fw-normal">{{ $item->total_sold }}</h5>
                                                            <span class="text-muted">Amount</span>
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start"
                                        id="paginationLinks">
                                        {{ $topProducts->links() }}
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Top Categories</h4>
                                    <div class="flex-shrink-0">
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="text-muted">Report<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Download Report</a>
                                                <a class="dropdown-item" href="#">Export</a>
                                                <a class="dropdown-item" href="#">Import</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                            <tbody>
                                                @foreach ($topCategory as $item)
                                                    <tr>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-shrink-0 me-2">
                                                                    <img src="{{ $item->category_image }}"
                                                                        alt="" class="avatar-sm p-2" />
                                                                </div>
                                                                <div>
                                                                    <h5 class="fs-14 my-1 fw-medium">
                                                                        <a href="apps-ecommerce-seller-details.html"
                                                                            class="text-reset">{{ $item->category_name }}</a>
                                                                    </h5>
                                                                    {{-- <span class="text-muted">Oliver Tyler</span> --}}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{ $item->total_sold }}</span>
                                                        </td>
                                                        <td>
                                                            <p class="mb-0">{{ $item->stock }}</p>
                                                            <span class="text-muted">Stock</span>
                                                        </td>
                                                        <td>
                                                            <span class="text-muted">{{ number_format($item->total_amount) }}</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="row">
                    <div class="col-xl-4">
                        <div class="card card-height-100">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Store Visits by Source</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Report<i
                                                    class="mdi mdi-chevron-down ms-1"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">Download Report</a>
                                            <a class="dropdown-item" href="#">Export</a>
                                            <a class="dropdown-item" href="#">Import</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div id="store-visits-source"
                                    data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]'
                                    class="apex-charts" dir="ltr"></div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Recent Orders</h4>
                                <div class="flex-shrink-0">
                                    <button type="button" class="btn btn-soft-info btn-sm">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Order ID</th>
                                                <th scope="col">Customer</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Amount</th>
                                                <th scope="col">Vendor</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2112</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('theme/admin/assets/images/users/avatar-1.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Alex Smith</div>
                                                    </div>
                                                </td>
                                                <td>Clothes</td>
                                                <td>
                                                    <span class="text-success">$109.00</span>
                                                </td>
                                                <td>Zoetic Fashion</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success">Paid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">5.0<span
                                                            class="text-muted fs-11 ms-1">(61 votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2111</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('theme/admin/assets/images/users/avatar-2.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Jansh Brown</div>
                                                    </div>
                                                </td>
                                                <td>Kitchen Storage</td>
                                                <td>
                                                    <span class="text-success">$149.00</span>
                                                </td>
                                                <td>Micro Design</td>
                                                <td>
                                                    <span class="badge bg-warning-subtle text-warning">Pending</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.5<span
                                                            class="text-muted fs-11 ms-1">(61 votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2109</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('theme/admin/assets/images/users/avatar-3.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Ayaan Bowen</div>
                                                    </div>
                                                </td>
                                                <td>Bike Accessories</td>
                                                <td>
                                                    <span class="text-success">$215.00</span>
                                                </td>
                                                <td>Nesta Technologies</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success">Paid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.9<span
                                                            class="text-muted fs-11 ms-1">(89 votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2108</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('theme/admin/assets/images/users/avatar-4.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Prezy Mark</div>
                                                    </div>
                                                </td>
                                                <td>Furniture</td>
                                                <td>
                                                    <span class="text-success">$199.00</span>
                                                </td>
                                                <td>Syntyce Solutions</td>
                                                <td>
                                                    <span class="badge bg-danger-subtle text-danger">Unpaid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.3<span
                                                            class="text-muted fs-11 ms-1">(47 votes)</span></h5>
                                                </td>
                                            </tr><!-- end tr -->
                                            <tr>
                                                <td>
                                                    <a href="apps-ecommerce-order-details.html"
                                                        class="fw-medium link-primary">#VZ2107</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{ asset('theme/admin/assets/images/users/avatar-6.jpg') }}"
                                                                alt="" class="avatar-xs rounded-circle" />
                                                        </div>
                                                        <div class="flex-grow-1">Vihan Hudda</div>
                                                    </div>
                                                </td>
                                                <td>Bags and Wallets</td>
                                                <td>
                                                    <span class="text-success">$330.00</span>
                                                </td>
                                                <td>iTest Factory</td>
                                                <td>
                                                    <span class="badge bg-success-subtle text-success">Paid</span>
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">4.7<span
                                                            class="text-muted fs-11 ms-1">(161 votes)</span>
                                                    </h5>
                                                </td>
                                            </tr><!-- end tr -->
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> --}}

                </div> <!-- end .h-100-->

            </div> <!-- end col -->
        </div>
    </form>
@endsection

@section('meta')
    <meta name="orders-data" content="{{ json_encode($orderCounts) }}">
    <meta name="orderscancel-data" content="{{ json_encode($orderCountsCancel) }}">
    <meta name="earnings-data" content="{{ json_encode($totalAmounts) }}">
    <meta name="refunds-data" content="{{ json_encode($refundCounts) }}">
    <meta name="product-data" content="{{ json_encode($productCounts) }}">
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const scrollPosition = localStorage.getItem("scrollPosition");
            if (scrollPosition) {
                window.scrollTo(0, parseInt(scrollPosition));
                localStorage.removeItem("scrollPosition");
            }
        });

        document.getElementById("paginationLinks").addEventListener("click", function(event) {
            if (event.target.tagName === "A") {
                localStorage.setItem("scrollPosition", window.scrollY);
            }
        });

        function submitForm() {
            localStorage.setItem('scrollToElementId', '#fillterProduct');
            $('#fillterProduct').submit();
        }

        $(document).ready(function() {
            const elementId = localStorage.getItem('scrollToElementId');
            if (elementId) {
                const $element = $(elementId);
                if ($element.length) {
                    $(window).scrollTop($element.offset().top);
                }
                localStorage.removeItem('scrollToElementId');
            }
        });

        $(document).ready(function() {

            // $('#collapseExample').collapse('hide');

            $('#yearSelect').change(function() {
                $('#subYear').click();
            });

            $('#fillterProduct').change(function() {
                $('#subYear').click();
            });

        });
    </script>
@endsection

@section('script-libs')
    {{-- date --}}
    {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}

    <!-- apexcharts -->
    <script src="{{ asset('theme/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Dashboard init biểu đồ -->
    <script src="{{ asset('theme/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection

@section('style-libs')
    {{-- date --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}

    <!-- jsvectormap css -->
    <link href="{{ asset('theme/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
@endsection
