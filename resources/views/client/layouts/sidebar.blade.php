<div class="row mb-5">
    <div class="col-md-12">
        <!-- Bộ lọc giá -->
        <div class="mb-4">
            <p id="price_show" class="fw-semibold">Từ: 0 VNĐ - 5.000.000 VNĐ</p>
            <input type="hidden" id="hidden_min_price" value="0">
            <input type="hidden" id="hidden_max_price" value="{{ $maxPrice ?? 5000000 }}">
            <div id="price_range"></div>
        </div>

        <!-- Bộ lọc thương hiệu -->
        <div class="mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Thương hiệu</h3>
            <div class="list-group">
                @foreach ($brd as $item)
                <div class="list-group-item d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-2 common_selector brand"
                        value="{{ $item->name }}">
                    <span>{{ $item->name }}</span>
                    <span class="badge bg-secondary">{{ $item->products->count() }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Bộ lọc danh mục -->
        <div class="mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Danh mục</h3>
            <div class="list-group">
                @foreach ($cate as $item)
                <div class="list-group-item d-flex align-items-center">
                    <input type="checkbox" class="form-check-input me-2 common_selector category"
                        value="{{ $item->name }}">
                    <span>{{ $item->name }}</span>
                    <span class="badge bg-secondary">{{ $item->products->count() }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<style>
h3 {
    color: #333;
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 15px;
    text-transform: uppercase;
    position: relative;
}

h3::after {
    content: '';
    width: 50px;
    height: 3px;
    background-color: #696969;
    display: block;
    margin-top: 5px;
}

/* List Group Styling */
.list-group {
    background: #ffffff;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.list-group-item {
    padding: 10px 15px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    border: none;
    border-bottom: 1px solid #eee;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    border-radius: 5px;
}

.list-group-item:last-child {
    border-bottom: none;
}

.list-group-item:hover {
    background-color: #f8f9fa;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.list-group-item input {
    accent-color: #ff6f61;
    cursor: pointer;
}

.list-group-item span {
    font-size: 1rem;
    color: #555;
}

/* Price Range */
#price_range {
    margin-top: 15px;
    height: 8px;
    background: #ddd;
    border-radius: 5px;
    position: relative;
}

#price_range::before,
#price_range::after {
    content: '';
    width: 15px;
    height: 15px;
    border-radius: 50%;
    background: #696969;
    position: absolute;
    top: -3.5px;
}

#price_range::before {
    left: 0;
}

#price_range::after {
    right: 0;
}

#price_show {
    font-size: 1rem;
    color: #444;
    font-weight: 500;
    margin-bottom: 10px;
}

/* Badges */
.badge {
    font-size: 0.9rem;
    background-color: black;
    color: #fff;
    padding: 5px 10px;
    border-radius: 20px;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.badge:hover {
    background-color: #ff3d2e;
}

/* Responsive Adjustments */
@media screen and (max-width: 768px) {
    h3 {
        font-size: 1rem;
    }

    .list-group-item {
        padding: 8px 10px;
    }

    .badge {
        font-size: 0.8rem;
        padding: 3px 8px;
    }
}
</style>
<script>
$(document).ready(function() {
    function fetchProducts() {
        const brands = [];
        const categories = [];
        const minPrice = $('#hidden_min_price').val();
        const maxPrice = $('#hidden_max_price').val();

        $('.common_selector.brand:checked').each(function() {
            brands.push($(this).val());
        });

        $('.common_selector.category:checked').each(function() {
            categories.push($(this).val());
        });

        $.ajax({
            url: "{{ route('search.products') }}",
            method: "GET",
            data: {
                brand: brands,
                category: categories,
                min_price: minPrice,
                max_price: maxPrice,
            },
            success: function(response) {
                // Cập nhật danh sách sản phẩm
                $('#product-list').html(response.html);

                // Cập nhật maxPrice nếu cần
                const currentMaxPrice = $('#price_range').slider('option', 'max');
                if (response.maxPrice && response.maxPrice !== currentMaxPrice) {
                    $('#price_range').slider('option', 'max', response.maxPrice);
                    $('#hidden_max_price').val(response.maxPrice); // Cập nhật giá trị ẩn
                }

                // Cập nhật nhãn hiển thị giá
                $('#price_show').html(
                    `Từ: ${$('#price_range').slider('values', 0)} VNĐ - ${$('#price_range').slider('values', 1)} VNĐ`
                );
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    // Lắng nghe thay đổi của các bộ lọc
    $('.common_selector').on('change', function() {
        fetchProducts();
    });

    // Cấu hình thanh trượt giá
    $('#price_range').slider({
        range: true,
        min: 0,
        max: 5000000, // Giá trị mặc định
        values: [0, 5000000],
        step: 100000,
        slide: function(event, ui) {
            $('#price_show').html(`Từ: ${ui.values[0]} VNĐ - ${ui.values[1]} VNĐ`);
            $('#hidden_min_price').val(ui.values[0]);
            $('#hidden_max_price').val(ui.values[1]);
        },
        stop: function(event, ui) {
            fetchProducts(); // Gọi AJAX khi người dùng dừng kéo
        }
    });

    // Gọi AJAX lần đầu để đồng bộ maxPrice
    fetchProducts();
    console.log({
        minPrice: $('#hidden_min_price').val(),
        maxPrice: $('#hidden_max_price').val(),
    });
});
</script>