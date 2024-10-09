<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag_name',
         'tag_url',
         'tag_image',
         'tag_banner',
         'meta_title',
         'meta_desc',
         'meta_keyword',
        ];
}
