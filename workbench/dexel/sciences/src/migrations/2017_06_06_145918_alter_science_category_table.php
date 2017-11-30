<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterScienceCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql =  "ALTER TABLE `science_category` CHANGE `title` `title` VARCHAR(64)";
        \DB::connection()->getPdo()->exec($sql);
        $sql =  "ALTER TABLE `science_category` CHANGE `slug` `slug` VARCHAR(64)";
        \DB::connection()->getPdo()->exec($sql);
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
