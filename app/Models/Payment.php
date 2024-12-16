<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'payments_method',
        'status',
    ];

    const PAYMENTS_METHOD = [
        'vnpay'             => 'Thanh toán thông qua VNPay.',
        'cash '             => 'Thanh toán bằng tiền mặt ',
    ];

    const PAYMENTS_METHOD_VNPAY             = 'vnpay';
    const PAYMENTS_METHOD_CASH              = 'cash';

    const STATUS = [
        'pending'       => 'Đang chờ xử lý',    # Giao dịch thanh toán đã được tạo nhưng chưa hoàn tất (ví dụ: chờ xác nhận từ cổng thanh toán, chờ khách hàng nhập thông tin thẻ).
        'paid'          => 'Đã thanh toán',
        'failed'        => 'Thất bại',          # Thanh toán không thành công do lỗi (ví dụ: thẻ bị từ chối, thiếu tiền trong tài khoản, hoặc lỗi hệ thống).
    ];

    const STATUS_PENDING        = 'pending';
    const STATUS_PAID           = 'paid';
    const STATUS_FAILED         = 'failed';

    public function order(){
        return $this->hasOne(Order::class);
    }
}
