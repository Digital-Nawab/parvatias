<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'product_name',   
        'product_sku',  
        'stock_quantity', 
        'product_price',  
        'product_url',   
        'product_image',
        'product_banner',
        'meta_title',      
        'meta_description', 
        'meta_keyword',   
        'short_description',   
        'long_description',   
        'product_metal',   
        'product_material',   
        'product_metal_purity',   
        'product_size',   
        'product_width',   
        'product_height',   
        'approx_gross_weight',   
        'is_sold',
        'gender'      
    ];
}
