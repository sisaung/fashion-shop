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
        Schema::table('reviews', function (Blueprint $table) {
            // Make user_id nullable
            $table->foreignId('user_id')->nullable()->change();

            // Add session_id for guest reviews
            $table->string('session_id')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
               // Revert user_id back to not nullable
               $table->foreignId('user_id')->nullable(false)->change();

               // Remove session_id column
               $table->dropColumn('session_id');
        });
    }
};
