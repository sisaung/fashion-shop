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
        Schema::create('fit_product_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fit_id')->constrained('fits')->onDelete('cascade');
            $table->foreignId('product_type_id')->constrained('product_types')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['fit_id', 'product_type_id'])->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fit_product_type');
    }
};
