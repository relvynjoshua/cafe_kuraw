<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name')->unique(); // Role name (e.g., admin, user, cashier)
            $table->string('description')->nullable(); // Optional description
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
}