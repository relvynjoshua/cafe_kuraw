<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key to the orders table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key to the products table
            $table->integer('quantity'); // Quantity of the product in the order
            $table->decimal('price', 10, 2); // Price of the product at the time of the order
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_product');
    }
};
