<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('item_name');
            $table->unsignedBigInteger('category_id'); 
            $table->unsignedBigInteger('supplier_id')->nullable(); 
            $table->unsignedInteger('quantity');
            $table->string('unit')->nullable();
            $table->decimal('price', 10, 2);
            $table->date('expiry_date')->nullable();
            $table->text('description')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
