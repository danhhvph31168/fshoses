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
                                    <option value="">All Status</option>
                                    <option value="pending">Pending</option>
                                    <option value="confirmed">Confirmed</option>
                                    <option value="processing">Processing</option>
                                    <option value="shipping">Shipping</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="canceled">Canceled</option>
                                    <option value="refunded">Refunded</option>
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
                                @include('client.orders.order-table', ['orders' => $orders])
                            </tbody>
                        </table>
                        <div class="p-3 float-end">
                            {{ $orders->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .small.text-muted{
            display: none !important;
        }
    </style>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#status_order_filter').change(function() {
                let status = $(this).val(); // Lấy giá trị từ dropdown
                console.log('Dropdown changed!');
                console.log('Selected Status:', status);
                // Nếu giá trị rỗng, gửi trạng thái "Tất cả"
                if (!status) {
                    console.warn('No status selected. Showing all orders.');
                }
                $.ajax({
                    url: "{{ route('searchOrders') }}",
                    type: "GET",
                    data: {
                        status_order: status // Truyền giá trị (có thể rỗng) cho server
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
        });
    </script>
@endpush
