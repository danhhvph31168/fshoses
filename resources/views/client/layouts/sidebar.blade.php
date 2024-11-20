

{{-- Danh sách thương hiệu --}}
<div class="row">
    <div class="col-md-12">
        <table class="table table-nowrap border table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-bg-secondary text-uppercase">Thương hiệu</th>
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
                    <th scope="col" class="text-bg-secondary text-uppercase">Danh mục sản phẩm</th>
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
