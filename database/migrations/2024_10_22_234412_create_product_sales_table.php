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
        Schema::create('product_sale', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('sale_id');
            $table->integer('quantity');

            // Define foreign keys
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');

            // Define composite primary key
            $table->primary(['product_id', 'sale_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');
    }
};
