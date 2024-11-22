@extends('client.layouts.master')

@section('title')
Chi tiết sản phẩm
@endsection

@section('content')


<section class="shop-details" style="padding: 0; margin-bottom: 10px;">
    <div class="product__details__pic"
        style="width: 100%; padding: 40px 0 15px; margin-bottom: 0; max-width: 1519.2px;">
        <div class="row">
            <div class="col-lg-12">
                <div class="product__details__breadcrumb">
                    <a href="./index.html">Home</a>
                    <a href="./shop.html">Shop</a>
                    <span style="color:black">{{ $product->name }}</span>
                </div>
            </div>
        </div>
    </div>
</section>
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
                                            <div class="swiper-slide">
                                                <img src="{{ $item->image }}" alt="" class="img-fluid d-block" />
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
                                                    <img src="{{ $item->image }}" alt="" class="img-fluid d-block" />
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
                                                        class="text-body fw-medium">{{ $product->views }}</span>
                                                </div>
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
                                                                value="{{ $id }}" id="productsize-radio{{ $size }}">
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
                                                            <input type="radio" name="product_color" value="{{ $id }}"
                                                                id="color-{{ $id }}" class="color-radio"
                                                                style="display: none;">
                                                            <label for="color-{{ $id }}" style="
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

                                        <div class="row mt-3">
                                            <div class="col-4">
                                                <h5 class="fs-14">Quantity</h5>
                                                <div class="pro-qty-2">
                                                    <input type="text" value="1" class="border-0 text-center mt-2"
                                                        name="quatity">
                                                </div>
                                            </div>
                                            <div class="col-8">
                                                <button class="btn btn-secondary w-100 mt-4">Add To
                                                    Cart</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="mt-5">
                                        <div>
                                            <h5 class="fs-14 mb-3">Ratings & Reviews</h5>
                                        </div>
                                        <div class="row gy-4 gx-0">
                                            <div class="col-lg-4">
                                                <div>
                                                    <div class="pb-3">
                                                        <div class="bg-light px-3 py-2 rounded-2 mb-2">
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <div class="fs-16 align-middle text-warning">
                                                                        <i class="bi bi-star-fill"></i> 
                                                                        <i class="bi bi-star-fill"></i> 
                                                                        <i class="bi bi-star-fill"></i> 
                                                                        <i class="bi bi-star-fill"></i> 
                                                                        <i class="bi bi-star-half"></i> 
                                                                    </div>
                                                                    
                                                                </div>
                                                                <div class="flex-shrink-0">
                                                                    <h6 class="mb-0">4.5 out of 5</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="text-center">
                                                            <div class="text-muted">
                                                                Total
                                                                <span class="fw-medium">5.50k</span>
                                                                reviews
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3">
                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0">5 star</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-2">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 50.16%"
                                                                            aria-valuenow="50.16" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0 text-muted">2758</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0">4 star</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-2">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 19.32%"
                                                                            aria-valuenow="19.32" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0 text-muted">1063</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0">3 star</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-2">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-success"
                                                                            role="progressbar" style="width: 18.12%"
                                                                            aria-valuenow="18.12" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0 text-muted">997</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0">2 star</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-2">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-warning"
                                                                            role="progressbar" style="width: 7.42%"
                                                                            aria-valuenow="7.42" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0 text-muted">408</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->

                                                        <div class="row align-items-center g-2">
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0">1 star</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col">
                                                                <div class="p-2">
                                                                    <div class="progress animated-progress progress-sm">
                                                                        <div class="progress-bar bg-danger"
                                                                            role="progressbar" style="width: 4.98%"
                                                                            aria-valuenow="4.98" aria-valuemin="0"
                                                                            aria-valuemax="100"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-auto">
                                                                <div class="p-2">
                                                                    <h6 class="mb-0 text-muted">274</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end row -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end col -->

                                            <div class="col-lg-8">
                                                <div class="ps-lg-4">
                                                    <div class="d-flex flex-wrap align-items-start gap-3">
                                                        <h5 class="fs-14">Reviews:</h5>
                                                    </div>

                                                    <div class="me-lg-n3 pe-lg-4" data-simplebar
                                                        style="max-height: 225px">
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="py-2">
                                                                <div class="border border-dashed rounded p-3">
                                                                    <div class="d-flex align-items-start mb-3">
                                                                        <div class="hstack gap-3">
                                                                            <div
                                                                                class="badge rounded-pill bg-success mb-0">
                                                                                <i class="mdi mdi-star"></i> 4.2
                                                                            </div>
                                                                            <div class="vr"></div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-0">
                                                                                    Superb sweatshirt. I loved it.
                                                                                    It is for winter.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="d-flex flex-grow-1 gap-2 mb-3">
                                                                        <a href="#" class="d-block">
                                                                            <img src="assets/images/small/img-12.jpg"
                                                                                alt=""
                                                                                class="avatar-sm rounded object-fit-cover" />
                                                                        </a>
                                                                        <a href="#" class="d-block">
                                                                            <img src="assets/images/small/img-11.jpg"
                                                                                alt=""
                                                                                class="avatar-sm rounded object-fit-cover" />
                                                                        </a>
                                                                        <a href="#" class="d-block">
                                                                            <img src="assets/images/small/img-10.jpg"
                                                                                alt=""
                                                                                class="avatar-sm rounded object-fit-cover" />
                                                                        </a>
                                                                    </div>

                                                                    <div class="d-flex align-items-end">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-14 mb-0">Henry</h5>
                                                                        </div>

                                                                        <div class="flex-shrink-0">
                                                                            <p class="text-muted fs-13 mb-0">
                                                                                12 Jul, 21
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <li class="py-2">
                                                                <div class="border border-dashed rounded p-3">
                                                                    <div class="d-flex align-items-start mb-3">
                                                                        <div class="hstack gap-3">
                                                                            <div
                                                                                class="badge rounded-pill bg-success mb-0">
                                                                                <i class="mdi mdi-star"></i> 4.0
                                                                            </div>
                                                                            <div class="vr"></div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-0">
                                                                                    Great at this price, Product
                                                                                    quality and look is awesome.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex align-items-end">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-14 mb-0">Nancy</h5>
                                                                        </div>

                                                                        <div class="flex-shrink-0">
                                                                            <p class="text-muted fs-13 mb-0">
                                                                                06 Jul, 21
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="py-2">
                                                                <div class="border border-dashed rounded p-3">
                                                                    <div class="d-flex align-items-start mb-3">
                                                                        <div class="hstack gap-3">
                                                                            <div
                                                                                class="badge rounded-pill bg-success mb-0">
                                                                                <i class="mdi mdi-star"></i> 4.2
                                                                            </div>
                                                                            <div class="vr"></div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-0">
                                                                                    Good product. I am so happy.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex align-items-end">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-14 mb-0">Joseph</h5>
                                                                        </div>

                                                                        <div class="flex-shrink-0">
                                                                            <p class="text-muted fs-13 mb-0">
                                                                                06 Jul, 21
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                            <li class="py-2">
                                                                <div class="border border-dashed rounded p-3">
                                                                    <div class="d-flex align-items-start mb-3">
                                                                        <div class="hstack gap-3">
                                                                            <div
                                                                                class="badge rounded-pill bg-success mb-0">
                                                                                <i class="mdi mdi-star"></i> 4.1
                                                                            </div>
                                                                            <div class="vr"></div>
                                                                            <div class="flex-grow-1">
                                                                                <p class="text-muted mb-0">
                                                                                    Nice Product, Good Quality.
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex align-items-end">
                                                                        <div class="flex-grow-1">
                                                                            <h5 class="fs-14 mb-0">Jimmy</h5>
                                                                        </div>

                                                                        <div class="flex-shrink-0">
                                                                            <p class="text-muted fs-13 mb-0">
                                                                                24 Jun, 21
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
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
                                                                <textarea name="comment"
                                                                    class="form-control @error('comment') is-invalid @enderror"
                                                                    rows="2"
                                                                    placeholder="Enter comment here..."></textarea>
                                                                @else
                                                                <textarea name="comment" class="form-control" rows="2"
                                                                    placeholder="You must log in to comment"></textarea>
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
                                                                        src="{{ $item->user->avatar }}" width="50px"
                                                                        height="50px" alt="">
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
    max-width: 1320px;
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
</style>
@endsection

@section('js')
<script>
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
            selectedLabel.style.borderColor = '#000'; // Viền màu đen
            selectedLabel.style.boxShadow = '0 0 5px rgba(0, 0, 0, 0.5)'; // Thêm hiệu ứng tối
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