<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Blog extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'title_en',
        'title_kh',
        'short_info_en',
        'short_info_kh',
        'description_kh',
        'description_en',
        'featured_image',
        'is_active'
    ];
}
