    @extends('client.layouts.master')

    @section('title')
    Danh sách đặt hàng
    @endsection

    @section('content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Order History</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client.home') }}">Home</a>
                            <a href="./shop.html">Shop</a>
                            <span>Order History</span>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Order History Section Begin -->

    <section class="shopping-cart spad" style="padding: 0; padding-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row mb-4">
                        <div class="col-lg-12">
                        <form class="d-flex justify-content-end">
                            <select id="status_order_filter" class="form-select w-25">
                                <option value="" {{ $statusOrder === null ? 'selected' : '' }}>All Status</option>
                                <option value="pending" {{ $statusOrder === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $statusOrder === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="processing" {{ $statusOrder === 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipping" {{ $statusOrder === 'shipping' ? 'selected' : '' }}>Shipping</option>
                                <option value="delivered" {{ $statusOrder === 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="canceled" {{ $statusOrder === 'canceled' ? 'selected' : '' }}>Canceled</option>
                                <option value="refunded" {{ $statusOrder === 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </form>
                        </div>
                    </div>
                    <div class="shopping__cart__table rounded shadow-sm bg-white">
                        <table class="table table-hover align-middle">
                            <thead class="bg-gradient text-white"
                                style="background: linear-gradient(90deg, #ff7eb3, #ff758c);">
                                <tr class="text-center">
                                    <th>STT</th>
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                    <th>Status Order</th>
                                    <th>Status Payment</th>
                                    <th>Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('client.orders._order_table', ['orders' => $orders])
                            </tbody>

                        </table>
                        <div class="p-3">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->



    @endsection

    @push('scripts')
    <script>
$(document).ready(function() {
    $('#status_order_filter').change(function() {
        let status = $(this).val(); // Lấy giá trị từ dropdown

        $.ajax({
            url: "{{ route('searchOrders') }}",
            type: "GET",
            data: {
                status_order: status // Truyền giá trị
            },
            success: function(response) {
                // Cập nhật bảng đơn hàng
                $('table tbody').html(response.html);
                $('.p-3').html(response.pagination);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });

    // Xử lý phân trang
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        let url = $(this).attr('href');
        let status = $('#status_order_filter').val(); // Lấy trạng thái hiện tại

        $.ajax({
            url: url,
            data: { status_order: status }, // Truyền tham số hiện tại
            success: function(response) {
                $('table tbody').html(response.html);
                $('.p-3').html(response.pagination);
            },
            error: function(xhr) {
                console.error('Error:', xhr.responseText);
            }
        });
    });
});
    </script>
    @endpush