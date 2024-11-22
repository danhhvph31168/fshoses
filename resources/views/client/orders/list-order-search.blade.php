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
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad" style="padding: 0; padding-top: 20px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping__cart__table rounded shadow-sm bg-white">
                        <table class="table table-hover align-middle">
                            <thead class="bg-gradient text-white"
                                style="background: linear-gradient(90deg, #ff7eb3, #ff758c);">
                                <tr class="text-center">
                                    <th>Order Code</th>
                                    <th>Order Date</th>
                                    <th>Status Order</th>
                                    <th>Status Payment</th>
                                    <th>Total Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr class="text-center">
                                    <td>
                                        <a href="{{ route('getDetailOrderItem', $order->sku_order) }}"
                                            class="text-danger fw-bold">
                                            {{ $order->sku_order }}
                                        </a>
                                    </td>
                                    <td>{{ $order->created_at->toDateString() }}</td>
                                    <td>
                                        <span
                                            class="badge rounded-pill {{ $order->status_order === 'pending' ? 'bg-warning text-dark' : 'bg-success' }}">
                                            {{ ucfirst($order->status_order) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge rounded-pill {{ $order->status_payment === 'unpaid' ? 'bg-secondary' : 'bg-success' }}">
                                            {{ ucfirst($order->status_payment) }}
                                        </span>
                                    </td>
                                    <td>{{ number_format($order->total_amount, 0, ',', '.') }} VNĐ</td>
                                    <td>
                                        @if ($order->status_order === 'pending' && $order->created_at->diffInHours(now()) <= 24)
                                            <!-- Nút "Hủy đơn" mở modal -->
                                            <!-- Nút kích hoạt modal -->
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#cancelOrderModal">
                                                Hủy đơn
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="cancelOrderModal" tabindex="-1"
                                                aria-labelledby="cancelOrderModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="cancelOrderModalLabel">Hủy
                                                                đơn hàng #{{ $order->sku_order }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('orders.cancel', $order->sku_order) }}"
                                                                method="POST">
                                                                @csrf

                                                                <div class="row mb-4">
                                                                    <div class="col">
                                                                        <span>Chọn lý do hủy
                                                                            đơn:</span>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select
                                                                            class="pb-0 @error('cancel_reason') is-invalid @enderror"
                                                                            id="cancelReason" name="cancel_reason" required>
                                                                            <option value="">-- Chọn lý do --
                                                                            </option>
                                                                            <option value="Thay đổi phương thức thanh toán">
                                                                                Thay
                                                                                đổi phương thức thanh toán</option>
                                                                            <option value="Giá không hợp lý">Giá
                                                                                không hợp lý</option>
                                                                            <option value="Thay đổi địa chỉ nhận hàng">
                                                                                Thay đổi địa chỉ nhận hàng</option>
                                                                            <option value="Thời gian giao hàng lâu">
                                                                                Thời gian giao hàng lâu</option>
                                                                            <option value="Khác">Khác</option>
                                                                        </select>
                                                                    </div>
                                                                    @error('cancel_reason')
                                                                        <div class="invalid-feedback">
                                                                            {{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                </div>






                                                                <div class="row">
                                                                    <div class="col">
                                                                        <label for="otherReason" class="form-label">Lý
                                                                            do khác (nếu có):</label>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="mb-3">

                                                                            <textarea class="form-control @error('other_reason') is-invalid @enderror" id="otherReason" name="other_reason"
                                                                                rows="3"></textarea>
                                                                            @error('other_reason')
                                                                                <div class="invalid-feedback">
                                                                                    {{ $message }}
                                                                                </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Đóng</button>
                                                                    <button type="submit" class="btn btn-danger">Xác nhận
                                                                        hủy</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            <button type="button" disabled class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal">
                                                Hủy đơn
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
<style>
    .breadcrumb__text h4 {
        font-size: 28px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .breadcrumb__links a {
        font-size: 14px;
        font-weight: 500;
        transition: color 0.3s;
    }

    .breadcrumb__links a:hover {
        color: #ffd3e6;
        text-decoration: underline;
    }

    /* Table Styling */
    .table thead {
        color: white;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .table-hover tbody tr:hover {
        background-color: #ffe6f0;
    }

    .badge {
        padding: 0.5em 0.8em;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
    }

    /* Buttons */
    .btn-danger {
        background-color: #ff7eb3;
        border-color: #ff758c;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-danger:hover {
        background-color: #ff5173;
        transform: scale(1.05);
    }
</style>
