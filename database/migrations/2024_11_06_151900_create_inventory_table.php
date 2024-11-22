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
            $table->string('unit'); // e.g., kg, pcs, liter
            $table->decimal('price', 10, 2); // price per unit
            $table->date('expiry_date')->nullable(); // for perishable items
            $table->unsignedBigInteger('supplier_id')->nullable(); // Foreign key for suppliers
            $table->unsignedBigInteger('category_id')->nullable(); // Foreign key for categories
            $table->text('description')->nullable();
            $table->string('location')->nullable(); // e.g., storage room A, shelf 2
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('set null');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventory', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->dropForeign(['category_id']);
        });

        Schema::dropIfExists('inventory');
    }
};
