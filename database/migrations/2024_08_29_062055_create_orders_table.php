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
            $table->string('product_id');
            $table->string('product_name');
            $table->string('product_code');
            $table->enum('product_category',['makanan', 'minuman', 'cemilan']);
            $table->bigInteger('product_price');
            $table->integer('order_qty')->nullable();
            $table->enum('status', ['pending', 'ordered']);
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
