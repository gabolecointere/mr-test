<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAttachmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('attachments', function (Blueprint $table) {
            $table->dropForeign('attachments_comment_id_foreign');
            $table->dropColumn('comment_id');
            $table->dropForeign('attachments_post_id_foreign');
            $table->dropColumn('post_id');
        });

        Schema::table('attachments', function (Blueprint $table) {
            $table->bigInteger('post_id')->nullable();
            $table->bigInteger('comment_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
