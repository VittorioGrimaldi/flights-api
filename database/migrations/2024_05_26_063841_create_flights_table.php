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
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained();
            $table->string('flight_number');
            $table->string('status');
            $table->string('departure_airport');
            $table->unsignedBigInteger('departure_airport_id');
            $table->string('arrival_airport');
            $table->unsignedBigInteger('arrival_airport_id');
            $table->timestamp('departure_datetime');
            $table->timestamp('arrival_datetime');
            $table->time('duration');
            $table->float('distance', 8, 2);
            $table->float('economy_price', 8, 2);
            $table->float('business_price', 8, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('arrival_airport_id')->references('id')->on('airports');
            $table->foreign('departure_airport_id')->references('id')->on('airports');

            $table->unique(['airline_id', 'flight_number'], name: 'flight_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
