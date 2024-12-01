<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'image',
        'status',
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    protected $casts = [
        'status' => 'boolean',
    ];

}
