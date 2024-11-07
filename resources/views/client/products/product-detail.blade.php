@extends('client.layouts.master')

@section('title')
    Chi tiết sản phẩm
@endsection

@section('content')
    <div class="container mb-3">
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
                                                <div class="swiper-slide">
                                                    <img src="{{ $item->image }}" alt=""
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
                                                    <div class="nav-slide-item">
                                                        <img src="{{ $item->image }}" alt=""
                                                            class="img-fluid d-block" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-xl-8">
                                <div class="mt-xl-0 mt-5">
                                    <div class="d-flex">
                                        <div class="flex-grow-1">
                                            <h4>{{ $product->name }}</h4>
                                            <div class="hstack gap-3 flex-wrap mt-3">
                                                <div><a href="#"
                                                        class="text-primary d-block">{{ $product->category->name }}</a>
                                                </div>
                                                <div class="vr"></div>
                                                <div class="text-muted">Views : <span
                                                        class="text-body fw-medium">{{ $product->views }}</span></div>
                                                <div class="vr"></div>
                                                <div class="text-muted">Published : <span
                                                        class="text-body fw-medium">{{ $product->created_at->format('d/m/y') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    <form action="{{ route('cart.add') }}" method="post">
                                        @csrf

                                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                                        <div class="mt-4 text-muted">
                                            <h5 class="fs-14 mb-2">Description :</h5>
                                            <p>{{ $product->description ?? 'ahjhj' }}</p>
                                        </div>

                                        <div class="row">
                                            <div class="col-xl-6">
                                                <div class="mt-4">
                                                    <h5 class="fs-14 mb-2">Sizes :</h5>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($sizes as $id => $size)
                                                            <div>
                                                                <input type="radio" class="btn-check" name="product_size"
                                                                    value="{{ $id }}"
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
                                                <div class=" mt-4">
                                                    <h5 class="fs-14 mb-2">Colors :</h5>
                                                    <div class="d-flex flex-wrap gap-2">
                                                        @foreach ($colors as $id => $color)
                                                            <style>
                                                                input[type="radio"].color-radio-{{ $id }} {
                                                                    display: none;
                                                                }

                                                                input[type="radio"].color-radio-{{ $id }}+label {
                                                                    width: 35px;
                                                                    height: 35px;
                                                                    border: 2px solid #ccc;
                                                                    background-color: {{ $color }};
                                                                    border-radius: 50%;
                                                                    display: inline-block;
                                                                    cursor: pointer;
                                                                    transition: border-color 0.3s;
                                                                }

                                                                input[type="radio"].color-radio-{{ $id }}:checked+label {
                                                                    border-color: rgb(0, 110, 255);
                                                                    background-color: {{ $color }};
                                                                    width: 40px;
                                                                    height: 40px;
                                                                }
                                                            </style>

                                                            <div>
                                                                <input type="radio" name="product_color"
                                                                    value="{{ $id }}"
                                                                    id="color-{{ $id }}"
                                                                    class="color-radio-{{ $id }}">
                                                                </input>
                                                                <label for="color-{{ $id }}"></label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <h5 class="fs-14">Quantity</h5>
                                                <div class="pro-qty-2">
                                                    <input type="text" value="1" class="border-0 text-center mt-2"
                                                        name="quatity">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <button class="btn btn-secondary w-100 mt-4">Add To Cart</button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row mt-4">
                                        <div class="ps-lg-4">
                                            <div class="d-flex flex-wrap align-items-start gap-3">
                                                <h5 class="fs-14">Reviews: </h5>
                                            </div>

                                            <div class="me-lg-n3 pe-lg-4" data-simplebar style="max-height: 225px;">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="py-2">
                                                        <div class="border border-dashed rounded p-3">
                                                            <form action="{{ route('handleAddComment') }}" method="post"
                                                                class="d-flex mb-4">
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

                                                            @foreach ($comments as $item)
                                                                <form action="{{ route('destroyComment', $item) }}"
                                                                    method="post" class="d-flex justify-content-between">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <div class="d-flex">
                                                                        <img class="rounded-circle"
                                                                            src="{{ $item->user->avatar }}"
                                                                            width="50px" height="50px" alt="">
                                                                        <div class="ms-2">
                                                                            <p class="fw-bolder mb-1">
                                                                                {{ $item->user->name }}
                                                                            </p>
                                                                            <p>{{ $item->comment }}</p>
                                                                        </div>
                                                                    </div>

                                                                    @if (Auth::user() == $item->user)
                                                                        <button onclick="return confirm('Are you sure?')"
                                                                            class="btn btn-danger rounded-circle"
                                                                            style="width: 40px; height: 40px;"><i
                                                                                class="bi bi-trash"></i></button>
                                                                    @endif
                                                                </form>
                                                            @endforeach
                                                        </div>
                                                    </li>
                                                </ul>
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
        </div>
    </div>
@endsection

@section('css')
    <link href="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('theme/admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" /> --}}
    <link href="{{ asset('theme/admin/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('theme/admin/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .footer {
            background-color: black !important;
            margin: 0;
            padding: 0;
            padding-top: 20px;
            max-width: 100% !important;
            position: static !important;
        }

        .footer .container {
            max-width: 100% !important;
            background-color: black !important;
        }

        .topbar-user {
            background: none !important;
        }
    </style>
@endsection

@section('js')
    <script></script>

    <script src="{{ asset('theme/admin/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('theme/admin/assets/js/pages/ecommerce-product-details.init.js') }}"></script>
@endsection
