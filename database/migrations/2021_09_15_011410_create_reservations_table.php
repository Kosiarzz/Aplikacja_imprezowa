<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->date('date_from');
            $table->date('date_to');
            $table->boolean('status');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unsigned();
            $table->foreignId('room_id')->constrained('rooms')->onDelete('cascade')->unsigned();
            $table->foreignId('city_id')->constrained('cities')->onDelete('cascade')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
