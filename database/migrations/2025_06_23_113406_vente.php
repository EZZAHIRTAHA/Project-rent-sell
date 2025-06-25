<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('ventes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('car_id');
        $table->unsignedBigInteger('user_id')->nullable(); // who bought it
        $table->integer('quantity')->default(1);
        $table->decimal('price_unit', 10, 2);
        $table->decimal('total_price', 10, 2);
        $table->string('payment_method')->nullable();
        $table->timestamp('sold_at')->nullable();
        $table->timestamps();

        // Foreign keys
        $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
