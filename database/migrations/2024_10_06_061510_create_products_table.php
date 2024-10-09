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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->constrained('categories')->onDelete('set null');
            $table->string('product_sku');
            $table->integer('stock_quantity')->default(1);
            $table->string('product_name');
            $table->decimal('product_price', 10, 2);
            $table->string('product_material')->nullable()->default('Silver');;
            $table->string('product_metal')->nullable();
            $table->string('product_metal_purity')->nullable();
            $table->string('product_size')->nullable();
            $table->string('product_width')->nullable();
            $table->string('product_height')->nullable();
            $table->string('approx_gross_weight')->nullable();
            $table->string('product_url');
            $table->string('product_image');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_keyword')->nullable();
            $table->text('short_description');
            $table->text('long_description')->nullable();
            $table->string('gender');
            $table->enum('is_sold', ['1', '2'])->default('1');
            $table->enum('is_active', ['1', '2'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
