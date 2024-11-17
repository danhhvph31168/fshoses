@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <!-- Hero Section Begin -->
    @include('client.layouts.banner')
    <!-- Banner Section End -->

    <section class="product spad mt-5">
        <div class="container">
            {{-- Sản phẩm mới nhất --}}
            <div class="row mb-3">
                <div class="col-md-12">
                    <table class="table table-nowrap">
                        <thead>
                            <tr>
                                <th scope="" class="text-bg-secondary text-center fs-4"> GIÀY MỚI NHẤT </th>
                            </tr>
                        </thead>
                    </table>
                </div>

                <div class="col-md-12">
                    <div class="row">
                        @foreach ($listLatestProduct as $item)
                            <div class="col-md-3 mb-3">
                                <div class="card">
                                    <div class="border-bottom" style="width: 100%">
                                        <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                            alt="..." height="180px">
                                    </div>
                                    <div class="card-body" style="height: 180px">

                                        <div class="mb-3">
                                            <a href="#" class="btn btn-outline-secondary">Thêm vào giỏ hàng</a>
                                        </div>

                                        <div class="card-title fs-6 fw-bold">
                                            <a href="#" class="text-dark">
                                                {{ $item->name }}
                                            </a>
                                        </div>

                                        @if ($item->price_sale > 0)
                                            <p class="card-text text-danger fs-6">
                                                {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ -
                                                <span class="text-decoration-line-through text-black-50 fs-6">
                                                    {{ number_format($item->price_sale, 0, ',', '.') }}
                                                    VNĐ</span>
                                            </p>
                                        @else
                                            <p class="card-text text-danger">
                                                {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-md-12 text-center">
                    <a href="{{ route('client.product-list') }}" class="btn btn-outline-secondary my-3">
                        Xem thêm >>
                    </a>
                </div>
            </div>
        </div>

        <!-- Hero Section Begin -->
        <div class="row mb-5">
            @include('client.layouts.hot_product')
        </div>
        <!-- Banner Section End -->

        {{-- Sản phẩm theo danh mục --}}
        <div class="container my-3">
            @foreach ($categories as $category)
                @if ($category->products()->count() > 0)
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="" class="text-bg-secondary  text-center fs-4">{{ $category->name }}
                                        </th>
                                    </tr>
                                </thead>
                            </table>
                        </div>


                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($category->products()->take(4)->get() as $item)
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <div class="border-bottom" style="width: 100%">
                                                <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                                    alt="..." height="180px">
                                            </div>
                                            <div class="card-body" style="height: 180px">

                                                <div class="mb-3">
                                                    <a href="#" class="btn btn-outline-secondary">Thêm vào giỏ hàng</a>
                                                </div>

                                                <div class="card-title fs-6 fw-bold">
                                                    <a href="#" class="text-dark">
                                                        {{ $item->name }}
                                                    </a>
                                                </div>

                                                @if ($item->price_sale > 0)
                                                    <p class="card-text text-danger fs-6">
                                                        {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ -
                                                        <span class="text-decoration-line-through text-black-50 fs-6">
                                                            {{ number_format($item->price_sale, 0, ',', '.') }}
                                                            VNĐ</span>
                                                    </p>
                                                @else
                                                    <p class="card-text text-danger">
                                                        {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        @if ($category->products()->count() > 0)
                            <div class="col-md-12 text-center">
                                <a href="{{ route('client.productByCategory', $category->id) }}"
                                    class="btn btn-outline-secondary my-3">
                                    Xem thêm >>
                                </a>
                            </div>
                        @endif
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
