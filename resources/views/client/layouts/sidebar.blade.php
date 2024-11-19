{{-- Bộ lọc --}}
<div class="row mb-5">
    <div class="col-md-12">
        {{-- Khoảng giá --}}
        <div class="mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Khoảng giá</h3>
            <div class="list-group">
                <input type="hidden" id="hidden_minimun_price" name="hidden_minimun_price" value="0">
                <input type="hidden" id="hidden_maximun_price" name="hidden_maximun_price" value="100000000">
                <p id="price_show" class="fw-semibold">Từ: 0 VNĐ - 100 Triệu VNĐ</p>
                <div id="price_range"></div>
            </div>
        </div>

        {{-- Thương hiệu --}}
        <div class="mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Thương hiệu</h3>
            <div class="list-group">
                @foreach ($brd as $item)
                <div class="list-group-item d-flex align-items-center justify-content-between">
                    <div>
                        <input type="checkbox" class="form-check-input me-2 common_selector brand"
                            value="{{ $item->name }}">
                        <span>{{ $item->name }}</span>
                    </div>
                    <span class="badge bg-secondary">{{ $item->products->count() }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Danh mục sản phẩm --}}
        <div class="mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Danh mục sản phẩm</h3>
            <div class="list-group">
                @foreach ($cate as $item)
                <div class="list-group-item d-flex align-items-center justify-content-between">
                    <div>
                        <input type="checkbox" class="form-check-input me-2 common_selector category"
                            value="{{ $item->name }}">
                        <span>{{ $item->name }}</span>
                    </div>
                    <span class="badge bg-secondary">{{ $item->products->count() }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>