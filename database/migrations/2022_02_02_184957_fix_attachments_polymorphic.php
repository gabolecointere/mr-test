<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixAttachmentsPolymorphic extends Migration
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
            $table->dropColumn('comment_id');
            $table->dropColumn('post_id');
        });
        Schema::table('attachments', function (Blueprint $table) {
            $table->morphs('attachable');
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
