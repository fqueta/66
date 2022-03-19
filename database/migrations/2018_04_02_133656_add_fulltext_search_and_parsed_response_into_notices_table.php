<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFulltextSearchAndParsedResponseIntoNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notices', function($table) {
            $table->text('parsed_response');
        });
        DB::statement("ALTER TABLE notices ADD FULLTEXT INDEX search(title, parsed_response)");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE notices DROP INDEX search");
        Schema::table('notices', function($table) {
            $table->dropColumn('parsed_response');
        });
    }
}
