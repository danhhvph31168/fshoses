@extends('client.layouts.master')

@section('title')
    Trang chủ
@endsection

@section('content')
    <!-- Hero Section Begin -->
    @include('client.layouts.hero')
    <!-- Banner Section End -->

    <section class="product spad mt-5">
        <div class="container">
            <div class="row">

                {{-- Menu navbar --}}
                @include('client.layouts.sidebar')

                {{-- Main content --}}
                <div class="col-md-9">
                    @foreach ($categories as $category)
                        {{-- @dd($categories) --}}
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-nowrap">
                                    <thead>
                                        <tr>
                                            <th scope="" class="text-bg-dark">
                                                {{ $category->name }} <a
                                                    href="{{ route('client.productByCategory', $category->id) }}"
                                                    class="float-end">Xem thêm >></a></th>
                                        </tr>
                                    </thead>
                                </table>                                
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($category->products as $item)
                                    {{-- @dd($item) --}}
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="border-bottom" style="width: 100%">
                                                    <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                                        alt="..." height="200px">
                                                </div>
                                                <div class="card-body" style="height: 180px">
                                                    <a href="" class="text-dark card-title fs-6">
                                                        {{ $item->name }}
                                                    </a>
                                                    <p class="card-text text-danger">
                                                        {{ number_format($item->price_regular, 0, ',', '.') }} VNĐ
                                                    </p>
                                                    <div class="">
                                                        <a href="#" class="btn btn-secondary">Mua Hàng</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>                                
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- {{$categories->links()}} --}}
            </div>
        </div>
    </section>
@endsection
