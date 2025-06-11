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
        Schema::create('product_type_size', function (Blueprint $table) {
            $table->id();
            $table->foreignId('size_id')->constrained('sizes')->onDelete('cascade');
            $table->foreignId('product_type_id')->constrained('product_types')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['size_id', 'product_type_id'])->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_type_size');
    }
};
