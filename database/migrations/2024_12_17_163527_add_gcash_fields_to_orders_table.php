<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGcashFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('gcash_reference_number')->nullable();
            $table->string('gcash_proof')->nullable(); // Store the file path
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('gcash_reference_number');
            $table->dropColumn('gcash_proof');
        });
    }
}