<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đánh Giá Sản Phẩm</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet" />
    <!-- Custom CSS -->
    <style>
    body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg, #fdfbfb, #ebedee);
        color: #333;
    }

    .container {
        max-width: 700px;
        margin: 50px auto;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    h3 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #ff6b6b;
        text-align: center;
        margin-bottom: 30px;
    }

    .form-control,
    .form-select {
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        font-size: 1rem;
    }

    .form-control:focus,
    .form-select:focus {
        box-shadow: 0 0 8px rgba(255, 107, 107, 0.5);
        border-color: #ff6b6b;
    }

    .btn-primary {
        background: linear-gradient(45deg, #ff6b6b, #ff4757);
        border: none;
        padding: 12px;
        font-size: 1.2rem;
        font-weight: 600;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #ff4757, #ff6b6b);
        transform: scale(1.05);
    }

    .alert {
        border-radius: 8px;
    }

    .rating {
        display: flex;
        justify-content: center;
        flex-direction: row-reverse;
        /* Xếp sao từ phải qua trái trong HTML */
    }

    .rating input {
        display: none;
        /* Ẩn radio buttons */
    }

    .rating label {
        font-size: 2.5rem;
        /* Kích thước sao */
        color: #ddd;
        /* Màu mặc định */
        cursor: pointer;
        transition: color 0.2s ease-in-out;
    }

    /* Khi hover, làm sáng tất cả sao phía trước (trái sang phải) */
    .rating label:hover,
    .rating label:hover~label {
        color: #ff6b6b;
    }

    /* Khi chọn sao, làm sáng tất cả sao phía trước và sao được chọn */
    .rating input:checked~label {
        color: #ff6b6b;
    }
    </style>
</head>

<body>

    <div class="container">
        <h3>Đánh Giá Sản Phẩm</h3>

        <!-- Hiển thị sản phẩm -->
        <div class="card mb-4">
            <img src="{{ $product->img_thumbnail }}" class="card-img-top" alt="Sản phẩm" />
            <div class="card-body text-center">
                <h5 class="card-title fw-bold">{{ $product->name }}</h5>
                <p class="card-text text-muted">Giá: {{ $product->price_sale }}</p>
                <p class="text-muted mb-0">Color: <span
                        class="fw-medium">{{ $order->orderItems->first()->productVariant->color->name }}</span></p>
                <p class="text-muted mb-0">Size: <span
                        class="fw-medium">{{ $order->orderItems->first()->productVariant->size->name }}</span></p>
            </div>
        </div>

        @if ($errors->any() || session('error'))
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header align-items-center d-flex">
                        @if ($errors->any())
                        <div class="alert alert-danger" style="width: 100%;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger" style="width: 100%;">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Form đánh giá -->

        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}" />
            <input type="hidden" name="product_id" value="{{ $product->id }}" />
            <input type="hidden" name="order_id" value="{{ $order->id }}" />
            <input type="hidden" name="product_variant_id" value="{{ $productVariant->id }}" />

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
        </form>
    </div>

    <!-- Link Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>