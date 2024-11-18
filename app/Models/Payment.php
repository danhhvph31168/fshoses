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
        'account_balance'   => 'Thanh toán bằng số dư tài khoản trên trang web (số dư khách hàng có sẵn trong hệ thống).',
        'cash '             => 'Thanh toán bằng tiền mặt ',
    ];

    const PAYMENTS_METHOD_VNPAY             = 'vnpay';
    const PAYMENTS_METHOD_ACCOUNT_BALANCE   = 'account_balance';
    const PAYMENTS_METHOD_CASH              = 'cash';

    const STATUS = [
        'pending'       => 'Đang chờ xử lý',    # Giao dịch thanh toán đã được tạo nhưng chưa hoàn tất (ví dụ: chờ xác nhận từ cổng thanh toán, chờ khách hàng nhập thông tin thẻ).
        'completed'     => 'Đã hoàn tất',
        'failed'        => 'Thất bại',          # Thanh toán không thành công do lỗi (ví dụ: thẻ bị từ chối, thiếu tiền trong tài khoản, hoặc lỗi hệ thống).
        'refunded'      => 'Đã hoàn tiền',      # Số tiền thanh toán đã được hoàn lại cho khách hàng sau khi giao dịch hoàn tất.
        'canceled'      => 'Đã hủy',            # Giao dịch đã bị hủy bởi khách hàng hoặc hệ thống trước khi hoàn thành.
        'in_progress'   => 'Đang xử lý',        # Thanh toán đang được xử lý và có thể mất thời gian để xác nhận (thường dùng cho phương thức thanh toán như chuyển khoản ngân hàng).
    ];

    const STATUS_PENDING        = 'pending';
    const STATUS_COMPLETED      = 'completed';
    const STATUS_FAILED         = 'failed';
    const STATUS_REFUNDED       = 'refunded';
    const STATUS_CANCELED       = 'canceled';
    const STATUS_IN_PROGRESS    = 'in_progress';

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
