@extends('client.layouts.master')

@section('title')
    Danh sách sản phẩm
@endsection

@section('content')
    <section class="product spad mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="float-end">
                        <form action="" method="GET" class="form-inline">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control " name="key" placeholder="Search ...">
                                <input type="number" class="form-control ms-2" name="from" placeholder="From ...">
                                <input type="number" class="form-control ms-2" name="to" placeholder="To ...">
                                <button class="btn btn-success ms-2" type="submit" id="button-addon2">Tìm
                                    kiếm</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-3">
                    @include('client.layouts.sidebar')
                </div>

                {{-- Main content --}}
                <div class="col-md-9">
                    <div class="col-md-12">
                        <table class="table table-nowrap">
                            <thead>
                                <tr>
                                    <th scope="" class="text-bg-secondary text-uppercase"> Danh sách sản phẩm</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            @foreach ($data as $item)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="border-bottom" style="width: 100%">
                                            <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top"
                                                alt="..." height="200px">
                                        </div>
                                        <div class="card-body" style="height: 200px">
                                            <div class="mb-3">
                                                <a href="#" class="btn btn-outline-secondary">Mua Hàng</a>
                                            </div>
                                            <a href="" class="text-dark card-title fs-6">
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
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{ $data->links() }}
                </div>

            </div>
        </div>
        </div>
    </section>
@endsection
