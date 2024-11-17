<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'collection',
        'title',
        'description',
        'image',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
