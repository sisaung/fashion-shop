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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->unique()->index();
            $table->string('product_code')->unique()->index();
            $table->text('product_description')->nullable();
            $table->string('slug')->unique();
            $table->float('original_price');
            $table->float('sale_price');
            $table->float('display_price');
            $table->float('discount_percentage')->nullable();
            $table->enum('gender',['male','female','unisex']);
            $table->string('is_new_arrival')->default(0);
            $table->string('is_popular')->default(0);
            $table->string('is_trending')->default(0);
            $table->string('is_hot')->default(0);
            $table->string('is_best')->default(0);
            $table->string('is_feature')->default(0);
            $table->string('is_discount')->default(0);
            $table->string('is_flash_sale')->default(0);
            $table->string('stock_count')->default(0);
            $table->string('is_out_of_stock')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('brand_id')->constrained('brands')->onDelete('cascade');
            $table->foreignId('product_category_id')->constrained('product_categories')->onDelete('cascade');
            $table->foreignId('product_type_id')->constrained('product_types')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
