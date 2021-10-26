<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_categories', function (Blueprint $table) {
            $table->id();
            $table->string('icon_name');
            $table->boolean('status');
            $table->integer('group_id')->constrained('groups')->onDelete('cascade')->unsigned();
            $table->integer('category_id')->constrained('category')->onDelete('cascade')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups_categories');
    }
}
