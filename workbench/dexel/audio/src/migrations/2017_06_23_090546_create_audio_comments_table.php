<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comment');
            $table->integer('audio_id')->unsigned();
            $table->foreign('audio_id')->references('id')->on('audios')->onDelete('cascade');
            $table->integer('rating_id')->unsigned();
            $table->foreign('rating_id')->references('id')->on('audio_ratings')->onDelete('cascade');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('audio_comments');
        Schema::enableForeignKeyConstraints();
    }
}
