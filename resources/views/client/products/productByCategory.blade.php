@extends('client.layouts.master')

@section('content')
    <section class="product spad mt-5">
        <div class="container">
            <div class="row">

                {{-- Menu navbar --}}
                @include('client.layouts.filter')

                {{-- Main content --}}
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="" class="text-bg-dark text-uppercase"> {{ $cate->name }}</th>

                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                @foreach ($prds as $item)
                                    <div class="col-md-4 mb-3">
                                        <div class="card">
                                            <div class="border-bottom" style="width: 100%">
                                                <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                                    alt="..." height="200px">
                                            </div>
                                            <div class="card-body" style="height: 200px">
                                                <a href="" class="text-dark card-title fs-6">
                                                    {{ $item->name }}
                                                </a>
                                                <p class="card-text text-danger">
                                                    {{ number_format($item->price_regular, 0, ',', '.') }}
                                                    VNĐ
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
                        {{ $prds->links() }}
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
