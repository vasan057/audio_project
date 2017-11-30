<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned()->unique();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('cascade');
            $table->string('photo')->nullable();
            $table->date('dob')->nullable();
            $table->string('about')->nullable();
            $table->json('address')->nullable();
            $table->enum('gender',['M','F','O'])->default('M');
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('admins_profile');
        Schema::enableForeignKeyConstraints();
    }
}
