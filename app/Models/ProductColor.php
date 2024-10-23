<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];
    public function variants(){
        // ProductColor 1-n ProductVariants
        return $this->hasMany(ProductVariant::class);
    }
}
