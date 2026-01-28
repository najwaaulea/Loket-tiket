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
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_category_id')->constrained('event_categories')->restrictOnDelete()->cascadeOnUpdate();

        $table->string('name', 200);
        $table->string('location', 150)->nullable();
        $table->dateTime('event_date');

        $table->unsignedBigInteger('price')->default(0);
        $table->unsignedInteger('quota')->default(0); // stok tiket
        $table->timestamps();

        $table->index(['event_category_id', 'name']);
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
