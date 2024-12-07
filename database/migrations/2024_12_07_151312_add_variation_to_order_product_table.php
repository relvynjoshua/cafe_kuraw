<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->string('variation')->nullable()->after('price'); // Add the variation column
        });
    }

    public function down()
    {
        Schema::table('order_product', function (Blueprint $table) {
            $table->dropColumn('variation'); // Remove the variation column
        });
    }

};
