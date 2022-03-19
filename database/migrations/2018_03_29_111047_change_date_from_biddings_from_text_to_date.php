<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDateFromBiddingsFromTextToDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('biddings', function($table) {
            $table->dropColumn('opening');
        });
        Schema::table('biddings', function($table) {
            $table->datetime('opening');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('biddings', function($table) {
            $table->dropColumn('opening');
        });
        Schema::table('biddings', function($table) {
            $table->string('opening', 255);
        });
    }
}
