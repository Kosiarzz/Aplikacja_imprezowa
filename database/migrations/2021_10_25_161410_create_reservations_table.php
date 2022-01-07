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
            $table->string('name_user')->nullable();
            $table->string('name_business')->nullable();
            $table->date('date_from');
            $table->date('date_to');
            $table->string('status');
            $table->string('note')->nullable();;
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade')->nullable();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities')->nullable();
            $table->timestamps();
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
