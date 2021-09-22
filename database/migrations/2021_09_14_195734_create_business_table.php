<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('short_description');
            $table->integer('priceFrom');
            $table->integer('priceTo');
            $table->string('unit');
            $table->string('range');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->unsigned();
            $table->integer('city_id')->constrained('cities')->unsigned();
            $table->integer('social_id')->constrained('socials')->onDelete('cascade')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businesses');
    }
}
