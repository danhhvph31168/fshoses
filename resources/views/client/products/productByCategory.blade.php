@extends('client.layouts.master')

@section('content')
<section class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__text">
                    <h4>Categories</h4>
                    <div class="breadcrumb__links">
                        <a href="{{ route('client.home') }}">Home</a>
                        <span>Categories</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<section class="product spad mt-5">
    <div class="container">
        <div class="row">

            <div class="col-md-3">
                {{-- Menu navbar --}}
                @include('client.layouts.sidebar')
            </div>

            {{-- Main content --}}
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <h5 class="text-dark text-uppercase fw-bold border-bottom pb-2" style="font-size: 25px;">
                        </h5>
                    </div>
                    <div class="col-md-12">

                        <div class="row" id="product-list">
                            @include('client.partials.products', ['products' => $prds])
                            @foreach ($prds as $item)
                            <div class="col-md-4 mb-3">
                                <div class="card">
                                    <div class="border-bottom" style="width: 100%">
                                        <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                            alt="..." height="200px">
                                    </div>
                                    <div class="card-body" style="height: 180px">



                                        <a href="{{route('productDetail',$item->slug)}}"
                                            class="text-dark card-title fs-6 fw-bold">
                                            {{ $item->name }}
                                        </a>
                                        @if ($item->price_sale > 0)
                                        <p class="card-text text-danger">
                                            {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ -
                                            <span class="text-decoration-line-through">
                                                {{ number_format($item->price_sale, 0, ',', '.') }} VNĐ</span>
                                        </p>
                                        @else
                                        <p class="card-text text-danger">
                                            {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ
                                        </p>
                                        @endif
                                        <div class="mb-3">
                                            <a href="#" class="btn btn-secondary">Thêm vào giỏ hàng</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $prds->links() }}
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
@section('css')

<style>
/* Product Card */
.card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
}

.card:hover {
    transform: translateY(-10px) scale(1.03);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    z-index: 10;
}

.card-image-container {
    overflow: hidden;
    position: relative;
}

.card-image-container img {
    transition: transform 0.5s ease, filter 0.3s ease;
}

.card:hover .card-image-container img {
    transform: scale(1.1);
    filter: brightness(0.9);
}


.card .card-title {
    transition: color 0.3s ease;
}

.card:hover .card-title {
    color: #007bff;
}

.position-absolute {
    transition: transform 0.3s ease;
}

.card:hover .position-absolute {
    transform: scale(1.2);
}

h3 {
    font-weight: bold;
    font-size: 1.5rem;
}

.btn-secondary {
    background-color: #EED5D2;
    border: none;
    transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
}

.btn-secondary:hover {
    background-color: #e6554f;
    transform: translateY(-3px);
    box-shadow: 0 4px 10px rgba(255, 111, 97, 0.3);
}

.btn-secondary:focus {
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(255, 111, 97, 0.5);
}

.btn-outline-secondary {
    color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-outline-secondary:hover {
    background-color: #007bff;
    color: #fff;
    border-color: #0056b3;
    box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
}

.btn-outline-secondary:focus {
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
}

.card-img-top {
    transition: transform 0.4s ease, box-shadow 0.4s ease;
}

.card:hover .card-img-top {
    /* zoom ảnh */
    /* transform: rotate(360deg); */

    /* xoay ảnh */
    transform: scale(1.1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.card {
    overflow: hidden;
    border-radius: 10px;
}

/* Pagination */
.pagination {
    display: flex;
    justify-content: center;
    gap: 5px;
}

.pagination li a {
    color: #333;
    font-size: 14px;
    padding: 5px 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
    transition: all 0.3s;
}

.pagination li a:hover {
    background-color: #f26522;
    color: #fff;
    border-color: #f26522;
}

.pagination .active span {
    background-color: #f26522;
    color: #fff;
    border-color: #f26522;
}
</style>
@endsection