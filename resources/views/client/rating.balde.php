<div class="container">
    <h1>Đánh Giá Sản Phẩm</h1>


    {{-- Hiển thị thông báo lỗi nếu có --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    {{-- Thông báo thành công nếu có --}}
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    {{-- Form nhập đánh giá --}}
    <form action="{{ route('ratings.store') }}" method="POST">
        @csrf
        {{-- <input type="hidden" name="user_id" value="{{ auth()->id() }}"> --}}
        <input type="hidden" name="user_id" value="3">
        <input type="hidden" name="order_id" value="{{ $order->id }}">


        @foreach ($order->orderItems as $item)
        @php
            $productVariantId = $item->productVariant->id;  // Lấy sản phẩm biến thể ID
        @endphp


        @if (!$existingRatings->contains($productVariantId))  {{-- Kiểm tra nếu sản phẩm biến thể chưa được đánh giá --}}
            <div class="mb-3">
                <label for="product_variant_id_{{ $productVariantId }}" class="form-label">
                    Đánh Giá cho Sản Phẩm: {{ $item->productVariant->product->name }}
                </label>
                <input type="hidden" name="product_variant_id[]" value="{{ $productVariantId }}"> {{-- Sử dụng mảng cho nhiều sản phẩm --}}
                <select class="form-control" name="value[]" required> {{-- Cũng sử dụng mảng cho điểm đánh giá --}}
                    <option value="">Chọn Điểm Đánh Giá</option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>
                <textarea class="form-control mt-2" name="comment[]" placeholder="Nhận xét của bạn..."></textarea>
            </div>
            @endif
        @endforeach


        <button type="submit" class="btn btn-primary">Gửi Đánh Giá</button>
    </form>


</div>
