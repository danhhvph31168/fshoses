<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'category_id',
        'brand_id',
        'name',
        'slug',
        'sku',
        'img_thumbnail',
        'price_regular',
        'price_sale',
        'views',
        'description',
        'content',
        'is_active',
        'is_sale',
        'is_show_home',
        'is_delete',
    ];


    protected $casts = [
        'is_active' => 'boolean',
        'is_hot_deal' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
