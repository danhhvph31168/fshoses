{{-- Bộ lọc --}}
<div class="row mb-5">
    <div class="col-md-12">

        <div class="mb-4">
            <p id="price_show" class="fw-semibold"></p>
            <input type="hidden" id="hidden_min_price" value="0">
            <input type="hidden" id="hidden_max_price" value="10000000">
            <div id="price_range"></div>
        </div>

        <div class=" mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Products</h3>
            <div class="list-group">
                <div class="list-group-item d-flex align-items-center justify-content-between">
                    <div>
                        <input type="checkbox" class="form-check-input common_selector is_sale" value="1"
                            {{ request('is_sale') == 1 ? 'checked' : '' }}>
                        <span>Best Seller</span>
                    </div>
                    <span class="badge rounded-pill bg-danger text-white"></span>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Categories</h3>
            <div class="list-group">
                @foreach ($cate as $item)
                    <div class="list-group-item d-flex align-items-center justify-content-between">
                        <div>
                            <input type="checkbox" class="form-check-input me-2 common_selector category"
                                value="{{ $item->id }}"
                                {{ isset($selectedCategory) && $selectedCategory == $item->id ? 'checked' : '' }}>
                            <span>{{ $item->name }}</span>
                        </div>
                        <span
                            class="badge rounded-pill bg-danger text-white">{{ $item->products->where('is_active', 1)->count() }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-4">
            <h3 class="text-uppercase fw-bold mb-3">Brands</h3>
            <div class="list-group" style="max-height: 300px; overflow-y: auto;">
                @foreach ($brd as $index => $item)
                    <!-- Chỉ hiển thị 4 mục đầu tiên -->
                    <div class="list-group-item d-flex align-items-center justify-content-between">
                        <div>
                            <input type="checkbox" class="form-check-input me-2 common_selector brand"
                                value="{{ $item->name }}">
                            <span>{{ $item->name }}</span>
                        </div>
                        <span class="badge rounded-pill bg-danger text-white">
                            {{ $item->products->where('is_active', 1)->count() }}
                        </span>
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

        const categoryId = "{{ $selectedCategory ?? '' }}";
        $('.common_selector.category').each(function() {
            if ($(this).val() == categoryId) {
                $(this).prop('checked', true);
            }
        });

        function fetchProducts(pageUrl = null) {
            const brands = [];
            const categories = [];
            const minPrice = $('#hidden_min_price').val();
            const maxPrice = $('#hidden_max_price').val();
            const isSale = $('.common_selector.is_sale:checked').val();

            $('.common_selector.category:checked').each(function() {
                categories.push($(this).val());
            });

            $('.common_selector.brand:checked').each(function() {
                brands.push($(this).val());
            });

            const url = pageUrl ? pageUrl : "{{ route('search.products') }}";
            $.ajax({
                url: url,
                method: "GET",
                data: {
                    brand: brands,
                    category: categories,
                    min_price: minPrice,
                    max_price: maxPrice,
                    is_sale: isSale,
                },
                success: function(response) {
                    $('#product-list').html(response.html);
                    $('.pagination-container').html(response.pagination);
                    const currentMaxPrice = $('#price_range').slider('option', 'max');
                    if (response.maxPrice && response.maxPrice !== currentMaxPrice) {
                        $('#price_range').slider('option', 'max', response.maxPrice);
                        $('#hidden_max_price').val(response.maxPrice);
                    }

                    $('#price_show').html(
                        `Price: ${parseInt($('#hidden_min_price').val()).toLocaleString('vi-VN')} VNĐ - ${parseInt($('#hidden_max_price').val()).toLocaleString('vi-VN')} VNĐ`
                    );
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        $('.common_selector').on('change', function() {
            fetchProducts();
        });


        $(document).on('click', '.pagination a', function(event) {
            event.preventDefault();
            const pageUrl = $(this).attr('href');
            fetchProducts(pageUrl);
        });

        $('#price_range').slider({
            range: "min",
            min: 0,
            max: $('#price_range').data('max'),
            value: parseInt($('#hidden_min_price').val()),
            step: 100000,
            slide: function(event, ui) {
                $('#price_sho  w').html(
                    `Price: ${ui.value.toLocaleString('vi-VN')} VNĐ - ${parseInt($('#hidden_max_price').val()).toLocaleString('vi-VN')} VNĐ`
                );
                $('#hidden_min_price').val(ui.value);
            },
            stop: function(event, ui) {
                fetchProducts();
            }
        });

        fetchProducts();
    });
</script>

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.js"></script>
@endpush
