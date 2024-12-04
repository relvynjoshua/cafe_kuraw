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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->integer('quantity');
            $table->string('unit'); //e.g., kg, pcs, liter
            $table->decimal('price', 10, 2); //price per unit
            $table->date('expiry_date')->nullable(); //for perishable items
            $table->string('supplier')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable(); //e.g., coffee beans, milk, sugar
            $table->string('location')->nullable();//e.g., storage room A, shelf 2
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
