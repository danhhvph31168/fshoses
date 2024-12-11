<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'staff_id',
        'coupon_id',
        'sku_order',
        'user_name',
        'user_email',
        'user_phone',
        'user_address',
        'user_province',
        'user_district',
        'user_ward',
        'user_note',
        'status_order',
        'total_amount',
        'cancel_reason',
    ];

    const STATUS_ORDER = [
        'pending'       => 'Chờ xác nhận',
        'confirmed'     => 'Đã xác nhận',
        'processing'    => 'Đang xử lý',
        'shipping'      => 'Đang vận chuyển',
        'delivered'     => 'Đã giao hàng',          #Đơn hàng đã được giao thành công đến khách hàng.
        'canceled'      => 'Đơn hàng đã bị hủy',    #Đơn hàng đã bị khách hàng hoặc hệ thống hủy bỏ.
    ];

    const STATUS_ORDER_PENDING          = 'pending';
    const STATUS_ORDER_CONFIRMED        = 'confirmed';
    const STATUS_ORDER_PREPARING_GOODS  = 'processing';
    const STATUS_ORDER_SHIPPING         = 'shipping';
    const STATUS_ORDER_DELIVERED        = 'delivered';
    const STATUS_ORDER_CANCELED         = 'canceled';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }
}
