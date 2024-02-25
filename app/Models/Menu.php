<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Menu extends Model
{
    use HasFactory, softDeletes;

    protected $fillable = [
        'name_en',
        'name_kh',
        'slug_en',
        'slug_kh',
        'menu_type',
        'type',
        'url',
        'ordering'
    ];
}
