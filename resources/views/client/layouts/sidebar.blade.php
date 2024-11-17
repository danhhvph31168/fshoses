{{-- Bộ lọc --}}
<div class="row mb-5">
    <div class="col-md-12">
        <table class="table table-nowrap border table-hover">
            <thead>
                <tr>
                    <th scope="col" class=" text-uppercase">Lọc theo giá</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="col-md-12">

        <div class="list-group">
            <input type="hidden" id="hidden_minimun_price" name="hidden_minimun_price" value="0">
            <input type="hidden" id="hidden_maximun_price" name="hidden_maximun_price" value="100000000">

            <p id="price_show">Từ: 0 VNĐ - 100 Triệu VNĐ</p>

            <div id="price_range"></div>
        </div>
    </div>
</div>

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
                                {{ $item->name }} <i class="ri-arrow-right-line align-middle"></i></a><span
                                class="float-end badge bg-dark-subtle">{{ $item->products->count() }}</span>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>

{{-- Danh mục sản phẩm --}}
<div class="row">
    <div class="col-md-12">
        <table class="table table-nowrap border table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-bg-dark text-uppercase">Danh mục sản phẩm</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cate as $item)
                    <tr>
                        <td><a href="{{ route('client.productByCategory', $item->id) }}" class="link-success">
                                {{ $item->name }} <i class="ri-arrow-right-line align-middle"></i></a><span
                                class="float-end badge bg-dark-subtle">{{ $item->products->count() }}</span>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
