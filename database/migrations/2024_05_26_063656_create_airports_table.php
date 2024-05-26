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
        Schema::create('airports', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('iata_code', 3)->unique();
            $table->string('icao_code', 4)->unique();
            $table->string('country');
            $table->string('city');
            $table->string('timezone');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['name', 'iata_code', 'icao_code'], name: 'airport_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('airports');
    }
};
