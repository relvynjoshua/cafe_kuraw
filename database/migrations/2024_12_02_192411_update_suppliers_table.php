<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            // Conditionally drop the columns if they exist
            if (Schema::hasColumn('suppliers', 'contact_person')) {
                $table->dropColumn('contact_person');
            }
            if (Schema::hasColumn('suppliers', 'phone_number')) {
                $table->dropColumn('phone_number');
            }
            if (Schema::hasColumn('suppliers', 'email')) {
                $table->dropColumn('email');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            // Re-add the columns if you need to rollback
            if (!Schema::hasColumn('suppliers', 'contact_person')) {
                $table->string('contact_person')->after('company_name');
            }
            if (!Schema::hasColumn('suppliers', 'phone_number')) {
                $table->string('phone_number')->after('contact_person');
            }
            if (!Schema::hasColumn('suppliers', 'email')) {
                $table->string('email')->after('phone_number');
            }
        });
    }
};
