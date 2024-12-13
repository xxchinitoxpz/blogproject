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
        Schema::create('product_cart', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('cart_id');
            $table->integer('quantity')->default(1); // Cantidad de productos en el carrito

            // Definimos las claves foráneas
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            
            // Clave primaria compuesta
            $table->primary(['product_id', 'cart_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_carts');
    }
};
