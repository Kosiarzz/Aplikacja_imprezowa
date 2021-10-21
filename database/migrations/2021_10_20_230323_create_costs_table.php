<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('costs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('note');
            $table->string('cost');
            $table->string('quantity');
            $table->string('advance');
            $table->date('date_payment');
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->foreignId('group_id')->constrained('groups')->onDelete('cascade')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('costs');
    }
}
