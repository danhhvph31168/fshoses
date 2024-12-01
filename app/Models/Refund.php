<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'user_id',
        'reason',
        'return_date',
        'status',
    ];

    const STATUS = [
        'pending'   => 'Đang chờ xử lý',    #Yêu cầu hoàn tiền đã được tạo nhưng chưa được duyệt hoặc xử lý
        'approved'  => 'Đã duyệt',          #Yêu cầu hoàn tiền đã được chấp thuận và đang trong quá trình xử lý.
        'rejected'  => 'Bị từ chối',        #Yêu cầu hoàn tiền không được chấp thuận.
        'processed' => 'Đã xử lý',          #Hoàn tiền đã được xử lý nhưng chưa hoàn tất việc chuyển tiền.
        'completed' => 'Hoàn tất',          #Số tiền hoàn lại đã được chuyển thành công cho khách hàng.
        'canceled'  => 'Đã hủy',            #Yêu cầu hoàn tiền đã bị hủy bởi khách hàng hoặc hệ thống trước khi hoàn tất.
        'failed'    => 'Thất bại',          #Quá trình hoàn tiền gặp lỗi và không thành công.
    ];

    const STATUS_PENDING    = 'pending';
    const STATUS_APPROVED   = 'approved';
    const STATUS_REJECTED   = 'rejected';
    const STATUS_PROCESSED  = 'processed';
    const STATUS_COMPLETED  = 'completed';
    const STATUS_CANCELED   = 'canceled';
    const STATUS_FAILED     = 'failed';

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order(){
        return $this->belongsTo(Order::class);
    }
}
