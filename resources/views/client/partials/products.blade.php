@foreach ($products as $item)
@php
$price = $item->price_regular * ((100 - $item->price_sale) / 100);
@endphp
<div class="col-md-4 mb-3">
    <div class="card">
        <div class="border-bottom" style="width: 100%">
            @if (\Str::contains($item->img_thumbnail, 'http'))
            <img src="{{ $item->img_thumbnail }}" class="card-img-top" alt="..."
                style="height: 200px; object-fit: cover;">
            @else
            <img src="{{ Storage::url($item->img_thumbnail) }}" class="card-img-top" alt="..."
                style="height: 200px; object-fit: cover;">
            @endif
        </div>
        <div class="card-body" style="height: 180px">
            <h3 href="#" class="text-dark card-title fs-6 fw-bold">
                {{ $item->name }}
            </h3>
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