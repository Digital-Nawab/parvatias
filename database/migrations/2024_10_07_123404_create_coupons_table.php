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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('coupon_code')->unique();
            $table->enum('coupon_type', ['offer', 'coupon'])->default('coupon');
            $table->float('coupon_amount');
            $table->enum('amount_type', ['percentage', 'fixed']);
            $table->unsignedBigInteger('category_id')->nullable(); 
            $table->unsignedBigInteger('product_id')->nullable(); 
            $table->unsignedBigInteger('user_id')->nullable();    
            $table->enum('user_type', ['all', 'new', 'existing']);
            $table->float('cart_amount')->default(0);
            $table->date('expiry_date');
            $table->tinyInteger('status')->default(1);  
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
