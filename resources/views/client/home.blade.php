@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    @include('client.layouts.banner')

    <section class="product spad mt-5">
        {{-- Sale --}}
        <div class="container my-5">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h3 class="text-center text-uppercase text-secondary border-bottom pb-3">Best Salers</h3>
                </div>
            </div>

            <div class="row">
                @foreach ($products as $item)
                    @if ($item->is_sale == 1)
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
                    @endif
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


        {{-- New Arrivals --}}
        <div class="container my-5">
            <div class="row mb-4">
                <div class="col-md-12">
                    <h3 class="text-center text-uppercase text-secondary border-bottom pb-3">New Arrivals</h3>
                </div>
            </div>

            <div class="row">
                @foreach ($listLatestProduct as $item)
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
                                    <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top" alt="..."
                                        style="height: 200px; object-fit: cover;">
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
                                    <a style="background-color: #d17572" href="{{ route('productDetail', $item->slug) }}"
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

        {{-- Banner hot product --}}
        <div class="row mb-5">
            @include('client.layouts.hot_product')
        </div>

        {{-- Sản phẩm theo danh mục --}}
        <div class="container my-5">
            @foreach ($categories as $category)
                @if ($category->products()->count() > 0)
                    <div class="row mb-5">
                        <!-- Tiêu đề danh mục -->
                        <div class="col-md-12">
                            <h3 class="text-center text-uppercase text-secondary border-bottom pb-3">
                                {{ $category->name }}
                            </h3>
                        </div>

                        <!-- Sản phẩm -->
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($category->products()->take(4)->get() as $item)
                                    <div class="col-md-3 mb-4">
                                        <div class="card shadow-sm h-100">
                                            <!-- Hình ảnh sản phẩm -->
                                            <div class="border-bottom" style="position: relative; overflow: hidden;">
                                                @if (\Str::contains($item->img_thumbnail, 'http'))
                                                    <img src="{{ $item->img_thumbnail }}" class="card-img-top"
                                                        alt="..." style="height: 200px; object-fit: cover;">
                                                @else
                                                    <img src="{{ Storage::url($item->img_thumbnail) }}"
                                                        class="card-img-top" alt="..."
                                                        style="height: 200px; object-fit: cover;">
                                                @endif
                                                @if ($item->price_sale > 0)
                                                    <div
                                                        class="position-absolute top-0 end-0 bg-danger text-white px-2 py-1 small">
                                                        {{ $item->price_sale }}%
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Nội dung sản phẩm -->
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
                        </div>

                        <!-- Nút "Xem thêm" -->
                        <div class="col-md-12 text-center">
                            <a href="{{ route('client.productByCategory', $category->id) }}"
                                class="btn btn-outline-secondary my-3">
                                More >>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </section>
@endsection
@section('css')
    <style>
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
    </style>
@endsection
