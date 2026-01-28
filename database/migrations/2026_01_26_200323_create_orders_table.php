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
        $table->foreignId('event_id')->constrained('events')->restrictOnDelete()->cascadeOnUpdate();
        $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete()->cascadeOnUpdate();

        $table->unsignedInteger('qty')->default(1);
        $table->unsignedBigInteger('unit_price')->default(0);
        $table->unsignedBigInteger('total_price')->default(0);

        $table->dateTime('order_date');
        $table->enum('status', ['paid','cancelled'])->default('paid');

        $table->timestamps();

        $table->index(['status', 'order_date']);
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
