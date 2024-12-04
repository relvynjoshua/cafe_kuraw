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
        Schema::table('reservations', function (Blueprint $table) {
            // Rename columns if needed
            $table->renameColumn('customer_name', 'name')->nullable()->change();
            $table->renameColumn('reservation_reason', 'note')->nullable()->change();

            // Add new columns
            $table->string('email')->nullable()->after('name');
            $table->string('phone_number')->nullable()->after('email');
            $table->time('reservation_time')->nullable()->after('reservation_date');
            $table->integer('number_of_guests')->nullable()->after('reservation_time');

            // Modify 'status' column
            $table->string('status')->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Reverse column changes
            $table->renameColumn('name', 'customer_name')->nullable()->change();
            $table->renameColumn('note', 'reservation_reason')->nullable()->change();

            // Drop newly added columns
            $table->dropColumn('email');
            $table->dropColumn('phone_number');
            $table->dropColumn('reservation_time');
            $table->dropColumn('number_of_guests');

            // Revert 'status' column change
            $table->string('status')->change();
        });
    }
};
