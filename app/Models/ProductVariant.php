<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'product_size_id',
        'product_color_id',
        'image',
        'quantity',
    ];
    public function product()
    {
        // Variants n-1 Products:
        return $this->belongsTo(Product::class);
    }
    public function size()
    {
        // ProductVarisant n-1 ProductSize
        return $this->belongsTo(ProductSize::class,'product_size_id');
    }
    public function color()
    {
        // ProductVariants n-1 ProductColor
        return $this->belongsTo(ProductColor::class,'product_color_id');
    }
}
