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
        Schema::create('flight_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->text('notes');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['flight_id', 'user_id'], name: 'flight_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flight_reservations');
    }
};
