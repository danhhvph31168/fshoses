<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', // Khóa ngoại đến bảng users
    ];

    // Mối quan hệ một-nhiều với CartItem
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Mối quan hệ với User (nếu có)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
