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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->float('total_price');
            $table->string('payment_method');
            $table->string('payment_status');
            $table->text('order_note')->nullable();
            $table->text('shipping_address')->nullable();
            $table->enum('status', ['pending', 'approved', 'processing', 'shipped', 'awaiting_payment', 'completed', 'declined'])->default('pending');
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
