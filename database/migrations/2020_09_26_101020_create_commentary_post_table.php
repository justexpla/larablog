<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CommentaryPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentary_post', function (Blueprint $table) {
            $table->primary(['post_id', 'commentary_id']);
            $table->unsignedBigInteger('commentary_id');
            $table->unsignedBigInteger('post_id');

            $table->foreign('commentary_id')
                ->references('id')
                ->on('commentaries');

            $table->foreign('post_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentary_post');
    }
}
