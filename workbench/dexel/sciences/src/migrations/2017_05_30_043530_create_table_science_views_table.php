<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableScienceViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
   public function up()
    {
        Schema::create('science_views', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('science_id')->unsigned();
            $table->foreign('science_id')->references('id')->on('sciences')->onDelete('cascade');
            $table->integer('created_by')->unsigned()->nullable();
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
        Schema::dropIfExists('science_views');
        Schema::enableForeignKeyConstraints();
    }
}
