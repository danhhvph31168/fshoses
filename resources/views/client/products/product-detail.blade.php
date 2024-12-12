@extends('client.layouts.master')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')

    <div class="shop-details" style="padding: 0;">
        <div class="product__details__pic" style="width: 100%; margin:0;">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product__details__breadcrumb" style=" margin-bottom: 0 !important;">
                        <a href="/" style="opacity: 50%">Home</a>
                        <span style="color:red; font-weight: 600; opacity: 75%">{{ $product->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="container mb-3" style="width: 100%;">
            <div class="row ">
                <div class="col-lg-12">
                    <div class="card border-0" style="border: none !important">
                        <div class="card-body" style="border: none !important">
                            <div class="row gx-lg-5">
                                <div class="col-xl-4 col-md-8 mx-auto">
                                    <div class="product-img-slider sticky-side-div">
                                        <div class="swiper product-thumbnail-slider p-2 rounded bg-light">
                                            <div class="swiper-wrapper">
                                                @foreach ($productGalleries as $item)
                                                    <div class="swiper-slide text-center">
                                                        <img src="{{ Storage::url($item->image) }}" alt=""
                                                            class="img-fluid d-block" />
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="swiper-button-next"></div>
                                            <div class="swiper-button-prev"></div>
                                        </div>

                                        <div class="swiper product-nav-slider mt-2">
                                            <div class="swiper-wrapper">
                                                @foreach ($productGalleries as $item)
                                                    <div class="swiper-slide">
                                                        <div class="nav-slide-item" style="width: 100%;">
                                                            <img src="{{ Storage::url($item->image) }}" alt=""
                                                                class="img-fluid d-block" height="200px" />
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-xl-8">
                                    <div class="mt-xl-0 mt-5">
                                        <div class="d-flex mb-3">
                                            <div class="flex-grow-1">
                                                <h4 class="text-danger text-uppercase">{{ $product->name }}</h4>
                                                <div class="hstack gap-3 flex-wrap mt-3">
                                                    <div><a href="{{ route('client.productByCategory', $product->category->id) }}"
                                                            class="text-primary d-block">{{ $product->category->name }}</a>
                                                    </div>
                                                    <div class="vr"></div>
                                                    <div><a href="#"
                                                            class="text-primary d-block">{{ $product->brand->name }}</a>
                                                    </div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Views : <span
                                                            class="text-body fw-medium">{{ $product->views }}</span>
                                                    </div>
                                                    <div class="vr"></div>
                                                    <div class="text-muted">Published : <span
                                                            class="text-body fw-medium">{{ $product->created_at->format('d/m/Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form action="{{ route('cart.add') }}" method="post">
                                            @csrf

                                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                                            <div class="mt-4 text-muted">
                                                <h5 class="fs-14 mb-2">Description :</h5>
                                                <p>{{ $product->description ?? '' }}</p>
                                            </div>
                                            <div class="mt-4 text-muted">
                                                <h5 class="fs-14 mb-2"></h5>
                                                <p>{!! $product->content ?? '' !!}</p>
                                            </div>

                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <div class="mt-4">
                                                        <h5 class="fs-14 mb-2">Sizes :</h5>
                                                        <div class="d-flex flex-wrap gap-2 me-3">
                                                            @foreach ($sizes as $id => $size)
                                                                <div>
                                                                    <input type="radio" class="btn-check"
                                                                        name="product_size" value="{{ $id }}"
                                                                        id="productsize-radio{{ $size }}">
                                                                    <label
                                                                        class="btn btn-soft-primary avatar-xs rounded-circle p-0 d-flex justify-content-center align-items-center"
                                                                        for="productsize-radio{{ $size }}">{{ $size }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-xl-6">
                                                    <div class="mt-4">
                                                        <h5 class="fs-14 mb-2">Colors:</h5>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            @foreach ($colors as $id => $color)
                                                                <div>
                                                                    <input type="radio" name="product_color"
                                                                        value="{{ $id }}"
                                                                        id="color-{{ $id }}" class="color-radio"
                                                                        style="display: none;">
                                                                    <label for="color-{{ $id }}"
                                                                        style="
                                                                    width: 35px;
                                                                    height: 35px;
                                                                    border: 2px solid #ccc;
                                                                    background-color: {{ $color }};
                                                                    border-radius: 50%;
                                                                    display: inline-block;
                                                                    cursor: pointer;
                                                                    transition: border-color 0.3s;
                                                                ">
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row my-3">
                                                <div class="col-4">
                                                    <h5 class="fs-14">Quantity</h5>
                                                    <div class="pro-qty-2">
                                                        <input type="text" value="1"
                                                            oninput="validateQuantity(this)" id="quatity"
                                                            class="border-0 text-center mt-2" name="quatity">
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <button class="btn btn-secondary w-100 mt-4"
                                                        style="background-color: grey">Add To
                                                        Cart</button>
                                                </div>
                                            </div>
                                        </form>
                                        <hr>

                                        <div class="my-5">
                                            {{-- <div class="my-3">
                                                <span class="fs-5">Ratings & Reviews</span>
                                            </div> --}}
                                            <div class="row gy-4 gx-0">
                                                <div class="col-lg-4">
                                                    <div>
                                                        <div class="">
                                                            <span class="fs-5 mb-2">Rating:</span>
                                                        </div>
                                                        <div class="-3">
                                                            <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                                <div class="d-flex align-items-center">
                                                                    <div class="flex-grow-1">
                                                                        <div class="fs-16 align-middle text-warning">
                                                                            @for ($i = 1; $i <= 5; $i++)
                                                                                @if ($i <= floor($averageRating))
                                                                                    <i class="bi bi-star-fill"></i>
                                                                                @elseif ($i - $averageRating < 1)
                                                                                    <i class="bi bi-star-half"></i>
                                                                                @else
                                                                                    <i class="bi bi-star"></i>
                                                                                @endif
                                                                            @endfor
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0">
                                                                        <h6 class="mb-0">{{ round($averageRating, 1) }}
                                                                            out of 5</h6>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="text-center">
                                                                <div class="text-muted">
                                                                    Total
                                                                    <span
                                                                        class="fw-medium">{{ number_format($totalRatings) }}</span>
                                                                    reviews
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="mt-3">
                                                            @foreach ([5, 4, 3, 2, 1] as $star)
                                                                @php
                                                                    $count = $ratingBreakdown->get($star, 0);
                                                                    $percentage =
                                                                        $totalRatings > 0
                                                                            ? ($count / $totalRatings) * 100
                                                                            : 0;
                                                                @endphp
                                                                <div class="row align-items-center g-2">
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0">{{ $star }} star
                                                                            </h6>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="p-2">
                                                                            <div
                                                                                class="progress animated-progress progress-sm">
                                                                                <div class="progress-bar bg-{{ $star == 5 ? 'success' : ($star == 1 ? 'danger' : 'warning') }}"
                                                                                    role="progressbar"
                                                                                    style="width: {{ $percentage }}%"
                                                                                    aria-valuenow="{{ $percentage }}"
                                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <div class="p-2">
                                                                            <h6 class="mb-0 text-muted">
                                                                                {{ $count }}</h6>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                            <!-- end row -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- end col -->


                                                <div class="col-lg-8">
                                                    <div class="ps-lg-4">
                                                        <div class="">
                                                            <span class="fs-5">Reviews</span>
                                                        </div>

                                                        <div class="me-lg-n3 pe-lg-4 mt-3" data-simplebar
                                                            style="max-height: 225px">
                                                            <ul class="list-unstyled mb-0">
                                                                @foreach ($product->ratings as $item)
                                                                    <li class="">
                                                                        <div class="row d-flex">
                                                                            <div class="col-md-12 p-0 mt-3">
                                                                                <div class="row p-0 m-0 b-0">
                                                                                    <div
                                                                                        class="col-md-2 text-center align-content-center">
                                                                                        <img class="rounded-circle"
                                                                                            src="{{ Storage::url($item->user->avatar) }}"
                                                                                            width="50px" height="50px"
                                                                                            alt="">
                                                                                    </div>
                                                                                    <div class="col-md-8 p-0">
                                                                                        <p class="fw-bolder mb-1">
                                                                                            {{ $item->user->name }}
                                                                                            -
                                                                                            {{ $item->created_at->format('d/m/Y') }}
                                                                                        </p>

                                                                                        <div class="flex-grow-1">
                                                                                            <div
                                                                                                class="fs-16 align-middle text-warning">
                                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                                    @if ($i <= floor($item->value))
                                                                                                        <i
                                                                                                            class="bi bi-star-fill"></i>
                                                                                                        @elseif ($i - $item->value < 1)
                                                                                                        <i
                                                                                                            class="bi bi-star-half"></i>
                                                                                                    @else
                                                                                                        <i
                                                                                                            class="bi bi-star"></i>
                                                                                                    @endif
                                                                                                @endfor
                                                                                            </div>
                                                                                        </div>

                                                                                        {{-- <p>{{ $item->value }}</p> --}}
                                                                                        <p>{{ $item->comment }}</p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>

                                                    </div>
                                                </div>
                                                <!-- end col -->
                                            </div>
                                            <!-- end Ratings & Reviews -->
                                        </div>
                                        <div class="row mt-4">
                                            <div class="ps-lg-4">
                                                <div class="">
                                                    <span style="font-size: 18px;">Comments </span>
                                                </div>

                                                <div class="me-lg-n3 pe-lg-4" data-simplebar style="max-height: 225px;">
                                                    <ul class="list-unstyled mb-0">
                                                        <li class="py-2">
                                                            <div class="border border-dashed rounded p-3">
                                                                <form action="{{ route('handleAddComment') }}"
                                                                    method="post" class="d-flex mb-4">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                    @if (Auth::check())
                                                                        <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="2"
                                                                            placeholder="Enter comment here..."></textarea>
                                                                    @else
                                                                        <textarea name="comment" class="form-control" rows="2" placeholder="You must log in to comment"></textarea>
                                                                    @endif
                                                                    <button class="btn btn-primary"><i
                                                                            class="bi bi-send p-3"></i></button>
                                                                </form>

                                                                @error('comment')
                                                                    <div class="alert alert-danger">{{ $message }}
                                                                    </div>
                                                                @enderror


                                                                @foreach ($product->reviews as $item)
                                                                    <div class="row d-flex">
                                                                        <form
                                                                            action="{{ route('destroyComment', $item) }}"
                                                                            method="post" class="">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <div class="col-md-12 p-0 mt-3">
                                                                                <div class="row p-0 m-0 b-0">
                                                                                    <div
                                                                                        class="col-md-2 text-center align-content-center">
                                                                                        <img class="rounded-circle"
                                                                                            src="{{ Storage::url($item->user->avatar) }}"
                                                                                            width="50px" height="50px"
                                                                                            alt="">
                                                                                    </div>
                                                                                    <div class="col-md-8 p-0">
                                                                                        <p class="fw-bolder mb-1">
                                                                                            {{ $item->user->name }}
                                                                                            -
                                                                                            {{ $item->created_at->format('d/m/Y') }}
                                                                                        </p>
                                                                                        <p>{{ $item->comment }}</p>
                                                                                    </div>
                                                                                    <div
                                                                                        class="col-md-2 p-0 text-center align-content-center">
                                                                                        @if (Auth::user() == $item->user)
                                                                                            <button
                                                                                                onclick="return confirm('Are you sure?')"
                                                                                                class="btn btn-danger rounded-circle"
                                                                                                style="width: 40px; height: 40px;"><i
                                                                                                    class="bi bi-trash"></i></button>
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                        </li>
                                                    </ul>

                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <!-- end card body -->
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

            <div class="container my-5">
                <div class="row mb-4">
                    <div class="col-md-12">
                        <h3 class="text-center text-uppercase text-secondary border-bottom pb-3">Related Products</h3>
                    </div>
                </div>

                <div class="row">
                    @foreach ($relatedProducts as $item)
                        @php
                            $price = $item->price_regular * ((100 - $item->price_sale) / 100);
                        @endphp
                        <div class="col-md-3 mb-4">
                            <div class="card shadow-sm h-100">

                                <div class="border-bottom" style="position: relative; overflow: hidden;">
                                    @if (\Str::contains($item->img_thumbnail, 'http'))
                                        <img src="{{ $item->img_thumbnail }}" class="card-img-top" alt="..."
                                            style="height: 200px; object-fit: cover;">
                                    @else
                                        <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                            alt="..." style="height: 200px; object-fit: cover;">
                                    @endif

                                    @if ($item->price_sale > 0)
                                        <div class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 small">
                                            {{ $item->price_sale }}%
                                        </div>
                                    @endif
                                </div>


                                <div class="card-body d-flex flex-column">
                                    <a href="{{ route('productDetail', $item->slug) }}"
                                        class="text-dark card-title fs-6 fw-bold text-center mb-2 text-truncate">
                                        {{ $item->name }}
                                    </a>

                                    @if ($item->price_sale > 0)
                                        <p class="card-text text-danger text-center">
                                            {{ number_format($price, 0, ',', '.') }} VNĐ -
                                            <span class="text-decoration-line-through text-muted">
                                                {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ
                                            </span>
                                        </p>
                                    @else
                                        <p class="card-text text-danger text-center">
                                            {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ
                                        </p>
                                    @endif
                                    <div class="mb-3 text-center">
                                        <a style="background-color: #d17572"
                                            href="{{ route('productDetail', $item->slug) }}"
                                            class="btn btn-secondary btn-sm w-100">Show more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-md-12 text-center">
                        <a href="{{ route('client.product-list') }}" class="btn btn-outline-secondary my-3">
                            More >>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('theme/client/cssfix/detail/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/detail/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/detail/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/detail/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/detail/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/client/cssfix/detail/comment.css') }}" rel="stylesheet" type="text/css" />


    <style>
        .container {
            max-width: 1420px;
        }

        .mobile-menu ul {
            margin: 0;
            padding: 0;
            padding-left: 3px;
        }

        body {
            background-color: #F5F5F5;
        }

        .color-radio+label {
            width: 35px;
            height: 35px;
            border: 2px solid #ccc;
            border-radius: 50%;
            display: inline-block;
            cursor: pointer;
            transition: border-color 0.3s;
        }

        .color-radio:checked+label {
            border-color: rgb(0, 110, 255);
            width: 40px;
            height: 40px;
        }

        footer {
            width: 100%;
        }

        .card.shadow-sm {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
        }

        .card.shadow-sm:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            z-index: 10;
        }
    </style>
@endsection

@section('js')
    <script>
        function validateQuantity(input) {
            input.value = input.value.replace(/[^0-9]/g, '');

            let value = parseInt(input.value);

            if (isNaN(value) || value < 1) {
                input.value = 1;
            } else if (value > 15) {
                input.value = 15;
            }
        }

        document.addEventListener("DOMContentLoaded", function() {
            const colorRadios = document.querySelectorAll('.color-radio');

            colorRadios.forEach((radio) => {
                radio.addEventListener('change', function() {
                    // Bỏ màu tối cho tất cả các label
                    colorRadios.forEach((input) => {
                        const label = document.querySelector(`label[for="${input.id}"]`);
                        label.style.borderColor = '#ccc'; // Khôi phục viền màu gốc
                        label.style.boxShadow = 'none'; // Bỏ hiệu ứng tối
                    });

                    // Làm tối màu cho label của radio được chọn
                    const selectedLabel = document.querySelector(`label[for="${this.id}"]`);
                    selectedLabel.style.borderColor = 'blue'; // Viền màu đen
                    selectedLabel.style.boxShadow =
                        '0 0 5px rgba(0, 0, 0, 0.5)'; // Thêm hiệu ứng tối
                });
            });
        });
    </script>

    <script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/ecommerce-product-details.init.js') }}"></script>

    <script src="{{ asset('theme/admin/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/layout.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/app.js') }}"></script>    
@endsection
