<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAudioRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audio_ratings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('audio_id')->unsigned();
            $table->tinyInteger('rate')->default('1');
            $table->foreign('audio_id')->references('id')->on('audios')->onDelete('cascade');
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
        Schema::dropIfExists('audio_ratings');
        Schema::enableForeignKeyConstraints();
    }
}
