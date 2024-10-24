<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'img_thumbnail',
        'price_regular',
        'price_sale',
        'views',
        'description',
        'is_active',
        'is_hot_deal',
        'is_show_home',
        'is_delete',
    ];
    public function category()
    {
        // Products n-1 Categories:
        return $this->belongsTo(Category::class);
    }
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }
    public function variants()
    {
        // Products 1-n Variants:
        return $this->hasMany(ProductVariant::class);
    }
}
