<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'coupon_code',
        'coupon_type',
        'coupon_amount',
        'amount_type',
        'category_id',
        'product_id',
        'user_id',
        'user_type',
        'cart_amount',
        'expiry_date',
        'status'
    ];
}
