<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBiddingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biddings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('genre_id');
            $table->integer('phase_id');
            $table->string('title', 255);
            $table->text('description');
            $table->string('opening', 255);
            $table->string('indentifier', 255);
            $table->string('object', 255);
            $table->string('active', 1);
            $table->integer('order');
            $table->integer('type_id');
            $table->integer('bidding_category_id');
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
        Schema::dropIfExists('biddings');
    }
}
