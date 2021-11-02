<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->default('-');
            $table->boolean('invitation')->default(false);
            $table->boolean('confirmation')->default(false);
            $table->boolean('accommodation')->default(false);
            $table->boolean('diet')->default(false);
            $table->enum('type', ['Dorosły', 'Dziecko', 'Niemowlę','Usługodawcy'])->default('Dorosły');
            $table->boolean('transport')->default(false);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('guests');
    }
}
