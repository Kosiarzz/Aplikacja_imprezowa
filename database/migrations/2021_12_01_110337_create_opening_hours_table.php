<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpeningHoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opening_hours', function (Blueprint $table) {
            $table->id();
            $table->string('monday')->default('Zamknięte');
            $table->string('tuesday')->default('Zamknięte');;
            $table->string('wednesday')->default('Zamknięte');;
            $table->string('thursday')->default('Zamknięte');;
            $table->string('friday')->default('Zamknięte');;
            $table->string('saturday')->default('Zamknięte');;
            $table->string('sunday')->default('Zamknięte');;
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opening_hours');
    }
}
