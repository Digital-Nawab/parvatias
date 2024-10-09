<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'stock_remain',
        'stock_add',
        'stock_final',
        'old_price',
        'new_price',
    ];
}
