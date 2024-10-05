<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
         'category_url',
         'category_image',
         'category_banner',
         'meta_title',
         'meta_description',
         'meta_keyword',
         'is_front',
         'menu_type',
        ];
}
