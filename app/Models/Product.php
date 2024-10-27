<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $fillable = [
        'category_id',
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
        'is_hot_deal',
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

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
