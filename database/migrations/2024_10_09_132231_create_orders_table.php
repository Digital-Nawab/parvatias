<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');  // Foreign key to users table
            $table->unsignedBigInteger('address_id');  // Foreign key to users Address table
            $table->string('order_number')->unique();  // Unique order number
            $table->decimal('cart_price', 10, 2);  // Total price of the order
            $table->string('delivery_charge')->default('0');  // Appy Coupon Code in  order
            $table->string('coupon_code')->nullable();  // Appy Coupon Code in  order
            $table->decimal('coupon_amount', 10, 2)->default('0');  // Appy Coupon DIscount amount in  order
            $table->decimal('total_price', 10, 2);  // Total price of the order
            $table->string('payment_status')->default('pending');  // Status of the order
            $table->string('payment_method');  // Status of the order
            $table->string('payment_id');  // Payment Gateway Return id
            $table->enum('status', ['pending','new','processing','completed','cancelled','refunded'])->default('pending');  // Status of the order
            $table->text('shipping_address');  // Shipping address for the order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
