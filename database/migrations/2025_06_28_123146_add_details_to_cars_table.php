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
        Schema::table('cars', function (Blueprint $table) {
            $table->year('year')->nullable();
            $table->string('color')->nullable();
            $table->unsignedTinyInteger('seats')->nullable();
            $table->unsignedTinyInteger('doors')->nullable();
            $table->unsignedInteger('mileage')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn(['year', 'color', 'seats', 'doors', 'mileage']);
        });
    }
};
