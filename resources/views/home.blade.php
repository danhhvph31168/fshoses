@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <!-- Hero Section Begin -->
    @include('client.layouts.hero')
    <!-- Hero Section End -->
    <!-- Banner Section Begin -->
    @include('client.layouts.banner')
    <!-- Banner Section End -->

    <section class="product spad mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="filter__controls">
                        {{-- @foreach ($categories as $item)
                            <li class="active" data-filter="*">{{ $item->name }}</li>
                        @endforeach --}}
                        <li data-filter=".new-arrivals">Hot Deal</li>
                        <li data-filter=".hot-sales">Hot Sales</li>
                        {{-- <li data-filter=".hot-sales">Hot Sales</li> --}}
                    </ul>
                </div>
            </div>

            <div class="row product__filter">
                @foreach ($products as $item)
                    @if ($item->is_active == 1)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix new-arrivals">
                            <div class="product__item">
                                {{-- @dd($item->category->name); --}}
                                <div class="product__item__pic set-bg" data-setbg="{{ Storage::url($item->img_thumbnail) }}"
                                    {{-- data-setbg="https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg" --}}>
                                    <span class="">
                                        {{-- {{ $item->is_hot_deal == 1 ? 'Hot Deal' : $item->category->name }} --}}
                                        {!! $item->is_hot_deal == 1 ? '<span class="badge bg-danger">Hot Deal</span>' : '' !!}
                                    </span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="{{ asset('theme/client/img/icon/heart.png') }}"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('theme/client/img/icon/compare.png') }}"
                                                    alt="">
                                                <span>Compare</span></a></li>
                                        {{-- <li><a href="{{ route('product.detail', $item->slug) }}"><img
                                                src="{{ asset('theme/client/img/icon/search.png') }}" alt=""></a>
                                    </li> --}}
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h5>{{ $item->name }}</h5>
                                    {{-- <a href="#" class="add-cart">+ Add To Cart</a> --}}
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>{{ number_format($item->price_sale, 0, ',', '.') }} VNĐ</h5>
                                    <span
                                        class="text-danger text-decoration-line-through">{{ number_format($item->price_regular, 0, ',', '.') }}
                                        VNĐ</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="div row product__filter">
                @foreach ($products as $item)
                    @if ($item->is_show_home == 1)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-md-6 col-sm-6 mix hot-sales">
                            <div class="product__item">
                                {{-- @dd($item->category->name); --}}
                                <div class="product__item__pic set-bg" {{-- data-setbg="{{ Storage::url($item->img_thumbnail) }}" --}}
                                    data-setbg="https://sadesign.vn/wp-content/uploads/2021/04/phong-cach-chup-anh-giay-dep-2021.jpg">
                                    <span class="">
                                        {{-- {{ $item->is_hot_deal == 1 ? 'Hot Deal' : $item->category->name }} --}}
                                        {!! $item->is_hot_deal == 1 ? '<span class="badge bg-danger">Hot Deal</span>' : '' !!}
                                    </span>
                                    <ul class="product__hover">
                                        <li><a href="#"><img src="{{ asset('theme/client/img/icon/heart.png') }}"
                                                    alt=""></a></li>
                                        <li><a href="#"><img src="{{ asset('theme/client/img/icon/compare.png') }}"
                                                    alt="">
                                                <span>Compare</span></a></li>
                                        {{-- <li><a href="{{ route('product.detail', $item->slug) }}"><img
                                            src="{{ asset('theme/client/img/icon/search.png') }}" alt=""></a>
                                </li> --}}
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h5>{{ $item->name }}</h5>
                                    {{-- <a href="#" class="add-cart">+ Add To Cart</a> --}}
                                    <div class="rating">
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <h5>{{ number_format($item->price_sale, 0, ',', '.') }} VNĐ</h5>
                                    <span
                                        class="text-danger text-decoration-line-through">{{ number_format($item->price_regular, 0, ',', '.') }}
                                        VNĐ</span>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    <!-- Categories Section Begin -->
    @include('client.layouts.hot_product')
    <!-- Categories Section End -->


    <!-- Latest Blog Section Begin -->
    @include('client.layouts.trending')
    <!-- Latest Blog Section End -->
@endsection
