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
            $table->string('note')->nullable();
            $table->string('cost')->default('0');
            $table->string('quantity')->default('1');
            $table->string('advance')->default('0');
            $table->date('date_payment')->nullable();
            $table->boolean('status')->default(false);
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
