<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterArticleCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('article_category', function (Blueprint $table)
        {
            $sql =  "ALTER TABLE `article_category` CHANGE `title` `title` VARCHAR(64)";
            \DB::connection()->getPdo()->exec($sql);
            $sql = "ALTER TABLE `article_category` ADD UNIQUE(`title`)";
            \DB::connection()->getPdo()->exec($sql);
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
