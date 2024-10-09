<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'product_image',
        'qty',
        'coupon_code',
        'price',
        'tax_rate',
        'tax_amount',
        'total_price',
        'payment_method',
        'status',
    ];
}
