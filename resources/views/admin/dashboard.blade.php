@extends('admin.layouts.master')

@section('title')
    Dashboard
@endsection

@section('content')
<<<<<<< HEAD
    <form action="{{ route('admin.dashboard.year') }}" method="post" id="myForm">
        @csrf

        <div class="row">
            <div class="col">

=======
    @if (Auth::user()->role_id === 1)
        {{--  Hiển thị thông báo thành công --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" disabled aria-label="alert"></button>
                </button>
            </div>
        @endif


        <div class="row">
            <div class="col">
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                <div class="h-100">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
<<<<<<< HEAD
                                    <h4 class="fs-16 mb-1">Good Morning, DANH</h4>
=======
                                    <h4 class="fs-16 mb-1">Good Morning, Anna!</h4>
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
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
<<<<<<< HEAD

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

=======
                                            <!--end col-->
                                            <div class="col-auto">
                                                <button type="button" class="btn btn-soft-success"><i
                                                        class="ri-add-circle-line align-middle me-1"></i>
                                                    Add Product</button>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                                <button type="button"
                                                    class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn"><i
                                                        class="ri-pulse-line"></i></button>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                                    </form>
                                </div>
                            </div>
                        </div>
<<<<<<< HEAD

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
=======
                    </div>


                    <div class="row">
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
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                +16.24 %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                                    data-target="559.25">0</span>k
                                            </h4>
                                            <a href="" class="text-decoration-underline">View net
                                                earnings</a>
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
                                                <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                                +29.08 %
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end justify-content-between mt-4">
                                        <div>
                                            <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                    data-target="183.35">0</span>M
                                            </h4>
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
                                                    data-target="165.89">0</span>k
                                            </h4>
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
                    </div> <!-- end row-->

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header border-0 align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                                    <div>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">
                                            ALL
                                        </button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">
                                            1M
                                        </button>
                                        <button type="button" class="btn btn-soft-secondary btn-sm">
                                            6M
                                        </button>
                                        <button type="button" class="btn btn-soft-primary btn-sm">
                                            1Y
                                        </button>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-header p-0 border-0 bg-light-subtle">
                                    <div class="row g-0 text-center">
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value"
                                                        data-target="7585">0</span>
                                                </h5>
                                                <p class="text-muted mb-0">Orders</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1">$<span class="counter-value"
                                                        data-target="22.89">0</span>k
                                                </h5>
                                                <p class="text-muted mb-0">Earnings</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0">
                                                <h5 class="mb-1"><span class="counter-value" data-target="367">0</span>
                                                </h5>
                                                <p class="text-muted mb-0">Refunds</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-6 col-sm-3">
                                            <div class="p-3 border border-dashed border-start-0 border-end-0">
                                                <h5 class="mb-1 text-success"><span class="counter-value"
                                                        data-target="18.92">0</span>%
                                                </h5>
                                                <p class="text-muted mb-0">Conversation Ratio</p>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div><!-- end card header -->
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6

                                <div class="card-body p-0 pb-2">
                                    <div class="w-100">
                                        <div id="customer_impression_charts"
<<<<<<< HEAD
                                            data-colors='["--vz-primary", "--vz-success", "--vz-danger", "--vz-warning", "--vz-info"]'
                                            class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>

                            </div><!-- end card -->
                        </div>


                        <div class="col-xl-4">

=======
                                            data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                                            class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->

                        <div class="col-xl-4">
                            <!-- card -->
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Sales by Locations</h4>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-soft-primary btn-sm">
                                            Export Report
                                        </button>
                                    </div>
<<<<<<< HEAD
                                </div>

=======
                                </div><!-- end card header -->

                                <!-- card body -->
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                                <div class="card-body">

                                    <div id="sales-by-locations"
                                        data-colors='["--vz-light", "--vz-success", "--vz-primary"]' style="height: 269px"
                                        dir="ltr"></div>

                                    <div class="px-2 py-2 mt-1">
<<<<<<< HEAD

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

=======
                                        <p class="mb-1">Canada <span class="float-end">75%</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                aria-valuemax="75">
                                            </div>
                                        </div>

                                        <p class="mt-3 mb-1">Greenland <span class="float-end">47%</span>
                                        </p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                style="width: 47%" aria-valuenow="47" aria-valuemin="0"
                                                aria-valuemax="47">
                                            </div>
                                        </div>

                                        <p class="mt-3 mb-1">Russia <span class="float-end">82%</span></p>
                                        <div class="progress mt-2" style="height: 6px;">
                                            <div class="progress-bar progress-bar-striped bg-primary" role="progressbar"
                                                style="width: 82%" aria-valuenow="82" aria-valuemin="0"
                                                aria-valuemax="82">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                    </div>

                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Best Selling Products</h4>
                                    <div class="flex-shrink-0">
<<<<<<< HEAD
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

=======
                                        <div class="dropdown card-header-dropdown">
                                            <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <span class="fw-semibold text-uppercase fs-12">Sort by:
                                                </span><span class="text-muted">Today<i
                                                        class="mdi mdi-chevron-down ms-1"></i></span>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-end">
                                                <a class="dropdown-item" href="#">Today</a>
                                                <a class="dropdown-item" href="#">Yesterday</a>
                                                <a class="dropdown-item" href="#">Last 7 Days</a>
                                                <a class="dropdown-item" href="#">Last 30 Days</a>
                                                <a class="dropdown-item" href="#">This Month</a>
                                                <a class="dropdown-item" href="#">Last Month</a>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-hover table-centered align-middle table-nowrap mb-0">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="assets/images/products/img-1.png" alt=""
                                                                    class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a
                                                                        href="apps-ecommerce-product-details.html"
                                                                        class="text-reset">Branded
                                                                        T-Shirts</a></h5>
                                                                <span class="text-muted">24 Apr 2021</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$29.00</h5>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">62</h5>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">510</h5>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$1,798</h5>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="assets/images/products/img-2.png" alt=""
                                                                    class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a
                                                                        href="apps-ecommerce-product-details.html"
                                                                        class="text-reset">Bentwood
                                                                        Chair</a></h5>
                                                                <span class="text-muted">19 Mar 2021</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$85.20</h5>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">35</h5>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal"><span
                                                                class="badge bg-danger-subtle text-danger">Out
                                                                of stock</span> </h5>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$2982</h5>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="assets/images/products/img-3.png" alt=""
                                                                    class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a
                                                                        href="apps-ecommerce-product-details.html"
                                                                        class="text-reset">Borosil Paper
                                                                        Cup</a></h5>
                                                                <span class="text-muted">01 Mar 2021</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$14.00</h5>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">80</h5>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">749</h5>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$1120</h5>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="assets/images/products/img-4.png" alt=""
                                                                    class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a
                                                                        href="apps-ecommerce-product-details.html"
                                                                        class="text-reset">One Seater
                                                                        Sofa</a></h5>
                                                                <span class="text-muted">11 Feb 2021</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$127.50</h5>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">56</h5>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal"><span
                                                                class="badge bg-danger-subtle text-danger">Out
                                                                of stock</span></h5>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$7140</h5>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar-sm bg-light rounded p-1 me-2">
                                                                <img src="assets/images/products/img-5.png" alt=""
                                                                    class="img-fluid d-block" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1"><a
                                                                        href="apps-ecommerce-product-details.html"
                                                                        class="text-reset">Stillbird
                                                                        Helmet</a></h5>
                                                                <span class="text-muted">17 Jan 2021</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$54</h5>
                                                        <span class="text-muted">Price</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">74</h5>
                                                        <span class="text-muted">Orders</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">805</h5>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 my-1 fw-normal">$3996</h5>
                                                        <span class="text-muted">Amount</span>
                                                    </td>
                                                </tr>
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                                            </tbody>
                                        </table>
                                    </div>

<<<<<<< HEAD
                                    <div class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start"
                                        id="paginationLinks">
                                        {{ $topProducts->links() }}
=======
                                    <div
                                        class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                        <div class="col-sm">
                                            <div class="text-muted">
                                                Showing <span class="fw-semibold">5</span> of <span
                                                    class="fw-semibold">25</span> Results
                                            </div>
                                        </div>
                                        <div class="col-sm-auto  mt-3 mt-sm-0">
                                            <ul
                                                class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                <li class="page-item disabled">
                                                    <a href="#" class="page-link">←</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">1</a>
                                                </li>
                                                <li class="page-item active">
                                                    <a href="#" class="page-link">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">→</a>
                                                </li>
                                            </ul>
                                        </div>
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6">
                            <div class="card card-height-100">
                                <div class="card-header align-items-center d-flex">
<<<<<<< HEAD
                                    <h4 class="card-title mb-0 flex-grow-1">Top Categories</h4>
=======
                                    <h4 class="card-title mb-0 flex-grow-1">Top Sellers</h4>
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
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
<<<<<<< HEAD
                                </div>
=======
                                </div><!-- end card header -->
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-centered table-hover align-middle table-nowrap mb-0">
                                            <tbody>
<<<<<<< HEAD
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

=======
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="assets/images/companies/img-1.png"
                                                                    alt="" class="avatar-sm p-2" />
                                                            </div>
                                                            <div>
                                                                <h5 class="fs-14 my-1 fw-medium">
                                                                    <a href="apps-ecommerce-seller-details.html"
                                                                        class="text-reset">iTest
                                                                        Factory</a>
                                                                </h5>
                                                                <span class="text-muted">Oliver Tyler</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">Bags and Wallets</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">8547</p>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">$541200</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 mb-0">32%<i
                                                                class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                        </h5>
                                                    </td>
                                                </tr><!-- end -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="assets/images/companies/img-2.png"
                                                                    alt="" class="avatar-sm p-2" />
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="fs-14 my-1 fw-medium"><a
                                                                        href="apps-ecommerce-seller-details.html"
                                                                        class="text-reset">Digitech
                                                                        Galaxy</a></h5>
                                                                <span class="text-muted">John Roberts</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">Watches</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">895</p>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">$75030</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 mb-0">79%<i
                                                                class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                        </h5>
                                                    </td>
                                                </tr><!-- end -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="assets/images/companies/img-3.png"
                                                                    alt="" class="avatar-sm p-2" />
                                                            </div>
                                                            <div class="flex-gow-1">
                                                                <h5 class="fs-14 my-1 fw-medium"><a
                                                                        href="apps-ecommerce-seller-details.html"
                                                                        class="text-reset">Nesta
                                                                        Technologies</a></h5>
                                                                <span class="text-muted">Harley
                                                                    Fuller</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">Bike Accessories</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">3470</p>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">$45600</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 mb-0">90%<i
                                                                class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                        </h5>
                                                    </td>
                                                </tr><!-- end -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="assets/images/companies/img-8.png"
                                                                    alt="" class="avatar-sm p-2" />
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="fs-14 my-1 fw-medium"><a
                                                                        href="apps-ecommerce-seller-details.html"
                                                                        class="text-reset">Zoetic
                                                                        Fashion</a></h5>
                                                                <span class="text-muted">James Bowen</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">Clothes</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">5488</p>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">$29456</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 mb-0">40%<i
                                                                class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                        </h5>
                                                    </td>
                                                </tr><!-- end -->
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0 me-2">
                                                                <img src="assets/images/companies/img-5.png"
                                                                    alt="" class="avatar-sm p-2" />
                                                            </div>
                                                            <div class="flex-grow-1">
                                                                <h5 class="fs-14 my-1 fw-medium">
                                                                    <a href="apps-ecommerce-seller-details.html"
                                                                        class="text-reset">Meta4Systems</a>
                                                                </h5>
                                                                <span class="text-muted">Zoe Dennis</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">Furniture</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">4100</p>
                                                        <span class="text-muted">Stock</span>
                                                    </td>
                                                    <td>
                                                        <span class="text-muted">$11260</span>
                                                    </td>
                                                    <td>
                                                        <h5 class="fs-14 mb-0">57%<i
                                                                class="ri-bar-chart-fill text-success fs-16 align-middle ms-2"></i>
                                                        </h5>
                                                    </td>
                                                </tr><!-- end -->
                                            </tbody>
                                        </table><!-- end table -->
                                    </div>

                                    <div
                                        class="align-items-center mt-4 pt-2 justify-content-between row text-center text-sm-start">
                                        <div class="col-sm">
                                            <div class="text-muted">
                                                Showing <span class="fw-semibold">5</span> of <span
                                                    class="fw-semibold">25</span> Results
                                            </div>
                                        </div>
                                        <div class="col-sm-auto  mt-3 mt-sm-0">
                                            <ul
                                                class="pagination pagination-separated pagination-sm mb-0 justify-content-center">
                                                <li class="page-item disabled">
                                                    <a href="#" class="page-link">←</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">1</a>
                                                </li>
                                                <li class="page-item active">
                                                    <a href="#" class="page-link">2</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">3</a>
                                                </li>
                                                <li class="page-item">
                                                    <a href="#" class="page-link">→</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                </div> <!-- .card-body-->
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->

                    <div class="row">
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
                                </div><!-- end card header -->

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
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table
                                            class="table table-borderless table-centered align-middle table-nowrap mb-0">
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
                                                                <img src="assets/images/users/avatar-1.jpg" alt=""
                                                                    class="avatar-xs rounded-circle" />
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
                                                                class="text-muted fs-11 ms-1">(61
                                                                votes)</span></h5>
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
                                                                <img src="assets/images/users/avatar-2.jpg" alt=""
                                                                    class="avatar-xs rounded-circle" />
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
                                                                class="text-muted fs-11 ms-1">(61
                                                                votes)</span></h5>
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
                                                                <img src="assets/images/users/avatar-3.jpg" alt=""
                                                                    class="avatar-xs rounded-circle" />
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
                                                                class="text-muted fs-11 ms-1">(89
                                                                votes)</span></h5>
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
                                                                <img src="assets/images/users/avatar-4.jpg" alt=""
                                                                    class="avatar-xs rounded-circle" />
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
                                                                class="text-muted fs-11 ms-1">(47
                                                                votes)</span></h5>
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
                                                                <img src="assets/images/users/avatar-6.jpg" alt=""
                                                                    class="avatar-xs rounded-circle" />
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
                                                                class="text-muted fs-11 ms-1">(161
                                                                votes)</span></h5>
                                                    </td>
                                                </tr><!-- end tr -->
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div>
                                </div>
                            </div> <!-- .card-->
                        </div> <!-- .col-->
                    </div> <!-- end row-->
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js')
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
    <!-- apexcharts -->
    <script src="{{ asset('theme/admin/assets/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!--Swiper slider js-->
    <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>

<<<<<<< HEAD
    <!-- Dashboard init biểu đồ -->
    <script src="{{ asset('theme/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection

@section('style-libs')
    {{-- date --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}

=======
    <!-- Dashboard init -->
    <script src="{{ asset('theme/admin/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>
@endsection

@section('css')
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
    <!-- jsvectormap css -->
    <link href="{{ asset('theme/admin/assets/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />

    <!--Swiper slider css-->
    <link href="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
<<<<<<< HEAD

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
=======
>>>>>>> e4f1f6b206d8046727d700235a178d0aa58385f6
@endsection
