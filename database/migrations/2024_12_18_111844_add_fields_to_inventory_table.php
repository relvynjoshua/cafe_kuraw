<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration 
{
    public function up()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->boolean('is_expirable')->default(false)->after('expiry_date');
            $table->integer('low_stock_threshold')->default(5)->after('quantity');
            $table->softDeletes(); // Enable soft deletes
        });
    }

    public function down()
    {
        Schema::table('inventories', function (Blueprint $table) {
            $table->dropColumn(['is_expirable', 'low_stock_threshold', 'deleted_at']);
        });
    }
};
