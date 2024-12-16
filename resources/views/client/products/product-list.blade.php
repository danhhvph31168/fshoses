@extends('client.layouts.master')

@section('title')
    Products List
@endsection

@section('content')
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
                        <div class="col-md-12">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="" class="text-bg-dark text-uppercase"> Products List</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($getAllProducts as $item)
                                    @if ($item->is_active == 1)
                                        @php
                                            $price = $item->price_regular * ((100 - $item->price_sale) / 100);
                                        @endphp
                                        <div class="col-md-4 mb-3">
                                            <div class="card">
                                                <div class="border-bottom" style="width: 100%">
                                                    <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                                        alt="..." height="200px">
                                                </div>
                                                <div class="card-body" style="height: 180px">
                                                    <a href="" class="text-dark card-title fs-6 fw-bold">
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
                        </div>
                        {{ $getAllProducts->links() }}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
