@extends('admin.layouts.master')

@section('title')
    Products List
@endsection
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box  align-items-center">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li class="breadcrumb-item text-primary">Product Detail</li>
                        <li class="breadcrumb-item text-danger">{{ $product->name }}</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row gx-lg-5">
                        <div class="col-xl-4 col-md-8 mx-auto">
                            <div class="product-img-slider sticky-side-div text-center">
                                <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                    <div class="swiper-wrapper">
                                        @if (count($product->galleries) > 0)
                                            @foreach ($product->galleries as $item)
                                                <div class="swiper-slide">
                                                    <img src="{{ \Storage::url($item->image) }}" class=""
                                                        style="margin: auto;" height="400px">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="swiper-button-next"></div>
                                    <div class="swiper-button-prev"></div>
                                </div>
                                <!-- end swiper thumbnail slide -->
                                <div class="swiper product-nav-slider mt-2">
                                    <div class="swiper-wrapper">
                                        @if (count($product->galleries) > 0)
                                            @foreach ($product->galleries as $item)
                                                <div class="swiper-slide">
                                                    <div class="nav-slide-item" style="max-width: 150px;">
                                                        <img src="{{ \Storage::url($item->image) }}" height="100px"
                                                            width="100px;">
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <!-- end swiper nav slide -->
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-8">
                            <div class="mt-xl-0 mt-5">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h3 class=" text-danger">{{ $product->name }}</h3>
                                        <div class="hstack gap-3 flex-wrap">
                                            <div><a href="#" class="text-primary d-block">SKU : <span
                                                        class="text-body fw-medium">{{ $product->sku }}</span></a>
                                            </div>
                                            <div class="vr"></div>
                                            <div><a href="#" class="text-primary d-block">Views : <span
                                                        class="text-body fw-medium">{{ $product->views }}</span></a>
                                            </div>
                                            <div class="text-muted"></div>
                                            <div class="vr"></div>
                                            <div class="text-muted">Published : <span
                                                    class="text-body fw-medium">{{ $product->created_at }}</span></div>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div>
                                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-light"
                                                data-bs-toggle="tooltip" data-bs-placement="top" title="Edit"><i
                                                    class="ri-pencil-fill align-bottom"></i></a>
                                        </div>
                                    </div>
                                </div>

                                {{-- Rating stars --}}
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                                    {!! renderStars($averageRating) !!}

                                    <div class="flex-shrink-0">
                                        <h6 class="mb-0">{{ round($averageRating, 1) }}
                                            out of 5</h6>
                                    </div>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Price Regular:</p>
                                                    <h5 class="mb-0">
                                                        {{ number_format($product->price_regular, 0, ',', '.') }} VNĐ
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-money-dollar-circle-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Price Sale:</p>
                                                    <h5 class="mb-0">
                                                        {{ number_format($product->price_sale, 0, ',', '.') }} %
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-file-copy-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">No. of Orders :</p>
                                                    <h5 class="mb-0">{{ $orderCount['count_orders'] ?? 0 }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- end col -->
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="p-2 border border-dashed rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="avatar-sm me-2">
                                                    <div class="avatar-title rounded bg-transparent text-success fs-24">
                                                        <i class="ri-inbox-archive-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <p class="text-muted mb-1">Total Revenue :</p>
                                                    <h5 class="mb-0">
                                                        {{ number_format($orderCount['total_amount']) ?? 0 }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end col -->
                                </div>

                                {{-- // Variants --}}
                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 flex-grow-1">Variants</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="live-preview">
                                                    <div class="row gy-4" style="height:400px; overflow:scroll">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr class="text-center">
                                                                    <th>Size</th>
                                                                    <th>Color</th>
                                                                    <th>Quantity</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php
                                                                    $productVariants = [];
                                                                    $totalQuantity = 0;

                                                                    $product->productVariants->map(function (
                                                                        $item,
                                                                    ) use (&$productVariants) {
                                                                        $key =
                                                                            $item->product_size_id .
                                                                            '-' .
                                                                            $item->product_color_id;

                                                                        $productVariants[$key] = [
                                                                            'quantity' => $item->quantity,
                                                                            'image' => $item->image,
                                                                        ];
                                                                    });
                                                                @endphp

                                                                @foreach ($sizes as $sizeID => $sizeName)
                                                                    @php($flagRowspan = true)

                                                                    @foreach ($colors as $colorID => $colorName)
                                                                        <tr class="text-center align-middle">
                                                                            @if ($flagRowspan)
                                                                                <td style="vertical-align: middle;"
                                                                                    rowspan="{{ count($colors) }}">
                                                                                    <b>{{ $sizeName }}</b>
                                                                                </td>
                                                                            @endif

                                                                            @php($flagRowspan = false)

                                                                            @php($key = $sizeID . '-' . $colorID)

                                                                            <td><span
                                                                                    style="background: {{ $colorName }}; padding: 5px 15px; border: 1px solid gray"></span>
                                                                            </td>

                                                                            <td class="w-25">
                                                                                <input type="text" class="form-control"
                                                                                    value="{{ $productVariants[$key]['quantity'] }}"
                                                                                    name="product_variants[{{ $key }}][quantity]">
                                                                            </td>
                                                                            <td>
                                                                                @if ($productVariants[$key]['image'])
                                                                                    <img src="{{ \Storage::url($productVariants[$key]['image']) }}"
                                                                                        width="80px" height="80px">
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 text-muted">
                                    <h5 class="fs-14">Description :</h5>
                                    <p>{{ $product->description }}</p>
                                </div>

                                <div class="product-content mt-5">
                                    <h5 class="fs-14 mb-3">Product Description
                                        :</h5>
                                    <nav>
                                        <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab"
                                            role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="nav-speci-tab" data-bs-toggle="tab"
                                                    href="#nav-speci" role="tab" aria-controls="nav-speci"
                                                    aria-selected="true">Specification</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab"
                                                    href="#nav-detail" role="tab" aria-controls="nav-detail"
                                                    aria-selected="false">Details</a>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="tab-content border border-top-0 p-4" id="nav-tabContent">
                                        <div class="tab-pane fade show active" id="nav-speci" role="tabpanel"
                                            aria-labelledby="nav-speci-tab">
                                            <div class="table-responsive">
                                                <table class="table mb-0">
                                                    <tbody>
                                                        <tr>
                                                            <th scope="row" style="width: 200px;">
                                                                Category</th>
                                                            <td>
                                                                @foreach ($categories as $id => $name)
                                                                    @if ($product->category_id === $id)
                                                                        {{ $name }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                Brand</th>
                                                            <td>
                                                                @foreach ($brands as $id => $name)
                                                                    @if ($product->brand_id === $id)
                                                                        {{ $name }}
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                Colors</th>
                                                            <td>
                                                                @foreach ($colors as $id => $name)
                                                                    <span
                                                                        style="background: {{ $name }}; padding: 5px 15px; margin-left: 5px; border: 1px solid gray">
                                                                    </span>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">
                                                                Sizes</th>
                                                            <td>
                                                                @foreach ($sizes as $id => $name)
                                                                    <span
                                                                        class="text-info fs-5 me-2">{{ $name }}</span>
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="nav-detail" role="tabpanel"
                                            aria-labelledby="nav-detail-tab">
                                            <div>
                                                <h5 class="font-size-16 mb-3 text-danger">
                                                    {{ $product->name }}</h5>

                                                <p>{!! $product->content !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('css')
    <!--Swiper slider css-->
    <link href="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
        integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('js')
    <!--Swiper slider js-->
    <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <!-- ecommerce product details init -->
    <script src="{{ asset('theme/admin/assets/js/pages/ecommerce-product-details.init.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/js/all.min.js"
        integrity="sha512-1JkMy1LR9bTo3psH+H4SV5bO2dFylgOy+UJhMus1zF4VEFuZVu5lsi4I6iIndE4N9p01z1554ZDcvMSjMaqCBQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    {{-- <script>
        new DataTable("#example", {
            order: [0, 'asc']
        });
    </script> --}}
@endsection
