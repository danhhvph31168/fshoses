<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'role_id',
        'sku_order',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'user_note',
        'status_order',
        'status_payment',
        'total_amount',
    ];

    const STATUS_ORDER = [
        'pending'       => 'Chờ xác nhận',
        'confirmed'     => 'Đã xác nhận',
        'processing'    => 'Đang xử lý',
        'shipping'      => 'Đang vận chuyển',
        'delivered'     => 'Đã giao hàng',          #Đơn hàng đã được giao thành công đến khách hàng.
        'canceled'      => 'Đơn hàng đã bị hủy',    #Đơn hàng đã bị khách hàng hoặc hệ thống hủy bỏ.
        'refunded'      => 'Đã hoàn tiền',          #Đơn hàng bị hủy và khách hàng đã được hoàn tiền
        'failed'        => 'Thất bại',              #Giao dịch hoặc thanh toán đơn hàng không thành công
    ];

    const STATUS_ORDER_PENDING          = 'pending';
    const STATUS_ORDER_CONFIRMED        = 'confirmed';
    const STATUS_ORDER_PREPARING_GOODS  = 'processing';
    const STATUS_ORDER_SHIPPING         = 'shipping';
    const STATUS_ORDER_DELIVERED        = 'delivered';
    const STATUS_ORDER_CANCELED         = 'canceled';
    const STATUS_ORDER_REFUNDED         = 'refunded';
    const STATUS_ORDER_FAILED           = 'failed';

    const STATUS_PAYMENT = [
        'unpaid'    => 'Chưa thanh toán',
        'pending'   => 'Đang chờ thanh toán',   #Đơn hàng đang trong quá trình thanh toán, nhưng chưa hoàn tất (ví dụ: chờ khách hàng thanh toán hoặc chờ xác nhận từ hệ thống thanh toán).
        'paid'      => 'Đã thanh toán',
        'refunded'  => 'Đã hoàn tiền',          #Số tiền của đơn hàng đã được hoàn lại cho khách hàng sau khi thanh toán.
        'failed'    => 'Thanh toán thất bại',   #Quá trình thanh toán đã gặp lỗi, hoặc thanh toán không thành công.
    ];

    const STATUS_PAYMENT_UNPAID     = 'unpaid';
    const STATUS_PAYMENT_PENDING    = 'pending';
    const STATUS_PAYMENT_PAID       = 'paid';
    const STATUS_PAYMENT_REFUNDED   = 'refunded';
    const STATUS_PAYMENT_FAILED     = 'failed';
}
