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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique()->index();
            $table->enum('order_status',['pending','confirmed','delivered','completed','cancelled'])->default('pending');
            $table->double('total_amount')->default(0);
            $table->string('order_date');
            $table->string('delivery_start_date')->nullable();
            $table->string('delivery_end_date')->nullable();
            $table->string('confirm_message')->nullable();
            $table->string('deliver_message')->nullable();
            $table->string('cancel_message')->nullable();
            $table->string('is_cancel')->default(0);
            $table->double('tax_amount')->default(0);
            $table->double('net_total')->default(0);
            // $table->double('shipping_amount')->default(0);

            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->string('customer_address_id')->conspotrained('customer_addresses')->onDelete('cascade');

            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('cascade');
            $table->integer('is_paid')->default(0);
            $table->timestamp('payment_received_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
