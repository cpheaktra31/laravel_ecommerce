<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slide extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title_en',
        'title_kh',
        'short_info_en',
        'short_info_kh',
        'url',
        'image',
        'background',
        'is_active',
        'is_promotion',
        'ordering'
    ];
}
