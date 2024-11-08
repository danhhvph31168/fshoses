<?php

namespace App\Models;

use App\Models\Product;
// use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        // 'parent_id',
        'is_active',
    ];

    public function products()
    {
        // Categories 1-n Products:
        return $this->hasMany(Product::class);

        // public function parent()
        // {
        //     return $this->belongsTo(Category::class, 'parent_id');
        // }

        // public function children()
        // {
        //     return $this->hasMany(Category::class, 'parent_id');
    }
}
