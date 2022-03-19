<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddDesktopFieldsToBannerTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function(Blueprint $table) {

            $table->string('desktop_file_name')->nullable();
            $table->integer('desktop_file_size')->nullable()->after('desktop_file_name');
            $table->string('desktop_content_type')->nullable()->after('desktop_file_size');
            $table->timestamp('desktop_updated_at')->nullable()->after('desktop_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banners', function(Blueprint $table) {

            $table->dropColumn('desktop_file_name');
            $table->dropColumn('desktop_file_size');
            $table->dropColumn('desktop_content_type');
            $table->dropColumn('desktop_updated_at');

        });
    }

}