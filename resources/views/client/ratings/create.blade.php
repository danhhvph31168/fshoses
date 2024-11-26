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
        @foreach ($product->productItem as $product)
        <div class="container mb-4">
            <h3>Đánh Giá Sản Phẩm</h3>

            <!-- Hiển thị sản phẩm -->
            <div class="card mb-4">
                <img src="{{ $product->image }}" class="card-img-top" alt="Sản phẩm" />
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                    <p class="card-text text-muted">Giá: {{ number_format($product->price, 0, ',', '.') }} VND</p>
                </div>
            </div>

            <!-- Form đánh giá -->
            <input type="hidden" name="user_id" value="{{ auth()->id() }}" />
            <input type="hidden" name="product_id" value="{{ $product->id }}">

            <div class="mb-4">
                <label for="rating" class="form-label fw-bold">Đánh Giá của bạn:</label>
                <div class="rating">
                    <input type="radio" id="star5" name="value" value="5" required />
                    <label for="star5" title="Tuyệt vời">&#9733;</label>

                    <input type="radio" id="star4" name="value" value="4" required />
                    <label for="star4" title="Tốt">&#9733;</label>

                    <input type="radio" id="star3" name="value" value="3" required />
                    <label for="star3" title="Bình thường">&#9733;</label>

                    <input type="radio" id="star2" name="value" value="2" required />
                    <label for="star2" title="Tệ">&#9733;</label>

                    <input type="radio" id="star1" name="value" value="1" required />
                    <label for="star1" title="Rất tệ">&#9733;</label>
                </div>
            </div>

            <!-- Nhận xét -->
            <div class="mb-4">
                <label for="comment" class="form-label fw-bold">Nhận xét của bạn:</label>
                <textarea class="form-control" id="comment" name="comment" rows="4"
                    placeholder="Hãy chia sẻ cảm nghĩ của bạn về sản phẩm này..." required></textarea>
            </div>

            <!-- Nút gửi -->
            <button type="submit" class="btn btn-primary w-100">
                Gửi Đánh Giá
            </button>
        </div>
    </form>
</div>
