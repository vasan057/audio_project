<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreateAdminsTable extends Migration
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fname',64);
            $table->string('lname',64);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone',16)->unique();
            $table->enum('email_verified',['0','1'])->default('0');
            $table->enum('active',['0','1'])->default('0');
            $table->enum('usertype',['admin','coach'])->default('coach');
            $table->rememberToken();
            $table->string('forgot_token',100)->nullable();
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
        Schema::dropIfExists('admins');
        Schema::enableForeignKeyConstraints();
    }
}
