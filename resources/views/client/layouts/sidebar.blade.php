{{-- Menu navbar --}}
<div class="col-md-3">

    {{-- Danh sách thương hiệu --}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-nowrap border table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-bg-dark text-uppercase">Thương hiệu</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brd as $item)
                        <tr>
                            <td><a href="{{ route('client.productByBrand', $item->id) }}" class="link-success">
                                    {{ $item->name }} <i
                                        class="ri-arrow-right-line align-middle"></i></a><span class="float-end badge bg-dark-subtle">{{ $item->products->count() }}</span>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{-- Danh sách sản phẩm mới nhất --}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-nowrap border  table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-bg-dark text-uppercase">Sản phẩm mới nhất</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $item)
                        <tr>
                            <td><a href="#" class="link-success">{{ $item->name }} <i
                                        class="ri-arrow-right-line align-middle"></i></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    {{-- Danh sách sản phẩm bán chạy --}}
    <div class="row">
        <div class="col-md-12">
            <table class="table table-nowrap border  table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="text-bg-dark text-uppercase">Sản phẩm bán chạy nhất</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($brands as $item)
                        <tr>
                            <td><a href="#" class="link-success">{{ $item->name }} <i
                                        class="ri-arrow-right-line align-middle"></i></a></td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
