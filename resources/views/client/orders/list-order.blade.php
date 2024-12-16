@extends('client.layouts.master')

@section('title')
Order List - Fshoes
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
                    <div class="row mb-2" >
                        <div class="col-lg-12 ">
                            <form method="GET" action="{{ route('filterStatusOrder') }}" class="ms-1">
                                <div class="row me-2" style="justify-content: flex-end">
                                    <div class="col-sm-2">
                                        <label for="Sku Order" class="form-label">Order Code</label>
                                        <input type="text" style="height: 42px;" class="form-control" name="sku_order"
                                            placeholder="Enter order code" value="{{ request('sku_order') }}">
                                    </div>

                                    <div class="col-sm-2">
                                        <label for="Start date" class="form-label">Start date</label>
                                        <input type="date" class="form-control" name="start_date"
                                            value="{{ request('start_date') }}" style="height: 42px;">
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="End date" class="form-label">End date</label>
                                        <input type="date" class="form-control" name="end_date"
                                            value="{{ request('end_date') }}" style="height: 42px;">
                                    </div>

                                    <div class="col-sm-2">
                                        <div>
                                            <label for="Status Order" class="form-label">Status Order</label>
                                        </div>
                                        <select class="mb-4" name="status_order" aria-label="Default select example">
                                            <option value="" {{ request('status_order') == '' ? 'selected' : '' }}>All
                                                status order
                                            </option>
                                            <option value="pending"
                                                {{ request('status_order') == 'pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="confirmed"
                                                {{ request('status_order') == 'confirmed' ? 'selected' : '' }}>Confirmed
                                            </option>
                                            <option value="processing"
                                                {{ request('status_order') == 'processing' ? 'selected' : '' }}>Processing
                                            </option>
                                            <option value="shipping"
                                                {{ request('status_order') == 'shipping' ? 'selected' : '' }}>
                                                Shipping</option>
                                            <option value="delivered"
                                                {{ request('status_order') == 'delivered' ? 'selected' : '' }}>Delivered
                                            </option>
                                            <option value="canceled"
                                                {{ request('status_order') == 'canceled' ? 'selected' : '' }}>
                                                Canceled</option>
                                        </select>
                                        <div style="align-content: center;">
                                            <button type="submit" class="btn btn-info ms-3" style="height: 42px;"><i
                                                    class="bi bi-search"></i></button>
                                        </div>
                                    </div>

                                </div>
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
        .small.text-muted {
            display: none !important;
        }

        .form-select.w-25 {
            display: block !important;
        }

        .nice-select.form-select.w-25 {
            display: none !important;
        }
    </style>
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

@push('scripts')
    {{-- <script>
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
            // Xử lý phân trang thông qua AJAX
            $(document).on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                // Thêm trạng thái "loading"
                $('.pagination').addClass('loading');
                $.ajax({
                    url: url,
                    success: function(response) {
                        // Cập nhật dữ liệu
                        $('table tbody').html(response.html);
                        $('.p-3').html(response.pagination);
                        // Gỡ trạng thái "loading"
                        $('.pagination').removeClass('loading');
                    },
                    error: function(xhr) {
                        console.error('Pagination Error:', xhr.responseText);
                        alert('Error: ' + xhr.status + ' - ' + xhr.statusText);
                    }
                });
            });
        });
    </script> --}}
@endpush
