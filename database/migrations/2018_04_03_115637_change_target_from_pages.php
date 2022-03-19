<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTargetFromPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function($table) {
            $table->dropColumn('target');
        });
        Schema::table('pages', function($table) {
            $table->enum('target', ['self', 'blank'])->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function($table) {
            $table->dropColumn('target');
        });
        Schema::table('pages', function($table) {
            $table->enum('target', ['redirect', 'blank'])->default('redirect');
        });
    }
}
