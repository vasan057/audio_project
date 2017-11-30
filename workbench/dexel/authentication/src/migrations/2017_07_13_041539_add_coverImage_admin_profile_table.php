<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoverImageAdminProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins_profile', function (Blueprint $table)
        {
            $table->string('cover_img')->after('social_link')->nullable();
            $table->string('tag_line','64')->after('social_link')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins_profile', function (Blueprint $table) {
            $table->dropColumn(['cover_img','tag_line']);
        });
    }
}
