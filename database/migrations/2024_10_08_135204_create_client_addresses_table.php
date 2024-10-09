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
        Schema::create('client_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('locality');
            $table->string('pincode');
            $table->string('address');
            $table->string('temp_mobile');
            $table->string('temp_name');
            $table->string('city');
            $table->string('state');
            $table->string('state_code')->nullable();
            $table->string('country');
            $table->enum('type', ['home','office','other']);
            $table->tinyInteger('is_active')->default(1);
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_addresses');
    }
};
