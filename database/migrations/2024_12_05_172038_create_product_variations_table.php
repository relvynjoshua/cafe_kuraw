<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductVariationsTable extends Migration
{
    public function up()
    {
        Schema::create('product_variations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id'); // Foreign key to products table
            $table->string('type'); // Type of variation (e.g., "Size", "Temperature")
            $table->string('value'); // Value of variation (e.g., "Medium", "Large", "Hot", "Cold")
            $table->decimal('price', 10, 2); // Price of this specific variation
            $table->timestamps();

            // Define foreign key constraint
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_variations');
    }
};