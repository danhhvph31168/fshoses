<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',   // Khóa ngoại đến bảng carts
        'product_id', // Khóa ngoại đến bảng products
        'quantity',   // Số lượng sản phẩm
        'price'   // Số lượng sản phẩm
    ];

    // Mối quan hệ với Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Mối quan hệ với Product (giả sử bạn có model Product)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
