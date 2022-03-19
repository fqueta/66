<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddImagePreviewFieldsToPostsTable extends Migration {

    /**
     * Make changes to the table.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function(Blueprint $table) {

            $table->string('image_preview_file_name')->nullable();
            $table->integer('image_preview_file_size')->nullable()->after('image_preview_file_name');
            $table->string('image_preview_content_type')->nullable()->after('image_preview_file_size');
            $table->timestamp('image_preview_updated_at')->nullable()->after('image_preview_content_type');

        });

    }

    /**
     * Revert the changes to the table.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function(Blueprint $table) {

            $table->dropColumn('image_preview_file_name');
            $table->dropColumn('image_preview_file_size');
            $table->dropColumn('image_preview_content_type');
            $table->dropColumn('image_preview_updated_at');

        });
    }

}