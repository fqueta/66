<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddMobileFieldsToBannerTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banners', function(Blueprint $table) {

            $table->string('mobile_file_name')->nullable();
            $table->integer('mobile_file_size')->nullable()->after('mobile_file_name');
            $table->string('mobile_content_type')->nullable()->after('mobile_file_size');
            $table->timestamp('mobile_updated_at')->nullable()->after('mobile_content_type');

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

            $table->dropColumn('mobile_file_name');
            $table->dropColumn('mobile_file_size');
            $table->dropColumn('mobile_content_type');
            $table->dropColumn('mobile_updated_at');

        });
    }

}