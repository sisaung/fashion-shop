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
        Schema::table('user_addresses', function (Blueprint $table) {
           // Drop the unique index first
           $table->dropUnique('user_addresses_phone_number_unique');

           // Change the column type (for example, keep as string without unique)
           $table->string('phone_number')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_addresses', function (Blueprint $table) {
            // Revert to unique if needed
            $table->string('phone_number')->nullable()->unique()->change();
        });
    }
};
