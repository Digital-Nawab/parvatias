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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');  // Unique order number
            $table->string('product_id');  // Unique order number
            $table->string('product_name');  // Unique order number
            $table->string('product_image');  // Unique order number
            $table->integer('qty');  // Order Item QTY
            $table->decimal('price', 10, 2);  //  price of the Product
            $table->string('tax_rate');  // Tax Rate of Product
            $table->decimal('tax_amount', 10, 2);  // TAx price of the Product
            $table->decimal('total_price', 10, 2);  // Total price of the Product
            $table->enum('status', ['pending','new','processing','completed','cancelled','refunded'])->default('pending');  // Status of the order
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
