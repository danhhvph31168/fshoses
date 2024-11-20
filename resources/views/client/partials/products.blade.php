@foreach ($products as $item)
<div class="col-md-4 mb-3">
    <div class="card">
        <div class="border-bottom" style="width: 100%">
            <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top" alt="..." height="200px">
        </div>
        <div class="card-body" style="height: 180px">



            <a href="" class="text-dark card-title fs-6 fw-bold">
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
            <div class="mb-3">
                <a href="#" class="btn btn-secondary">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>

</div>
@endforeach