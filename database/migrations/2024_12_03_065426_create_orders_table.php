<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable(); // Added address column
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->enum('status', ['pending', 'completed', 'cancelled']);
            $table->string('payment_method');
            $table->string('delivery_method');
            $table->string('reference_number')->nullable(); // Added GCash reference number column
            $table->string('proof_of_payment')->nullable(); // Added proof of payment column
            $table->unsignedBigInteger('user_id')->nullable(); // Added user_id column
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // Foreign key to users table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
