<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',64);
            $table->string('slug',64)->unique();
            $table->enum('active',['0','1'])->default('1');
            $table->enum('approved',['0','1'])->default('1');
            $table->string('short_description');
            $table->text('description');
            $table->string('author',64);
            $table->enum('isfree',['0','1'])->default('0');
            $table->enum('recommended',['0','1'])->default('0');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('article_category')->onDelete('cascade');
            $table->integer('essence_id')->unsigned();
            $table->foreign('essence_id')->references('id')->on('article_essence')->onDelete('cascade');
            $table->string('cover_img');
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('admins')->onDelete('cascade');
            $table->integer('updated_by')->unsigned();
            $table->foreign('updated_by')->references('id')->on('admins')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
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
        Schema::dropIfExists('articles');
        Schema::enableForeignKeyConstraints();
    }
}
