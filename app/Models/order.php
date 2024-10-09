<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'address_id',
        'order_number',
        'cart_price',
        'delivery_charge',
        'coupon_code',
        'coupon_amount',
        'total_price',
        'payment_status',
        'payment_method',
        'payment_id',
        'status',
        'shipping_address',
    ];
}
