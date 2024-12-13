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
            $table->string('name'); // Nombre del producto
            $table->text('description')->nullable(); // Descripción del producto
            $table->decimal('price', 10, 2); // Precio del producto
            $table->string('image_path'); // Ruta de la imagen del producto
            $table->unsignedBigInteger('category_id'); // Clave foránea a la categoría
            $table->timestamps();

            // Definir la relación con la tabla de categorías
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
