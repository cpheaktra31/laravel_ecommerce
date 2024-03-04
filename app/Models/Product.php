<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name_kh',
        'name_en',
        'slug_kh',
        'slug_en',
        'short_info_kh',
        'short_info_en',
        'min_price',
        'max_price',
        'description_kh',
        'description_en',
        'featured_image',
        'is_active',
        'is_feature'
    ];
}
