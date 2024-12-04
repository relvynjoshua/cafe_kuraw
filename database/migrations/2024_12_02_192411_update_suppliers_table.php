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
        Schema::table('suppliers', function (Blueprint $table) {
            $table->renameColumn('name', 'company_name'); // Rename 'name' to 'company_name'
            $table->string('contact_person')->after('company_name'); // Add 'contact_person' column
            $table->string('phone_number')->after('contact_person'); // Add 'phone_number' column
            $table->string('email')->unique()->after('phone_number'); // Add 'email' column with unique constraint
            $table->text('address')->after('email'); // Add 'address' column
            $table->dropColumn('contact'); // Remove 'contact' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->renameColumn('company_name', 'name'); // Rename 'company_name' back to 'name'
            $table->dropColumn(['contact_person', 'phone_number', 'email', 'address']); // Remove newly added columns
            $table->string('contact')->nullable(); // Re-add the 'contact' column
        });
    }
};
