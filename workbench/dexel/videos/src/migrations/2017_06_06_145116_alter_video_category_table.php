<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterVideoCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql =  "ALTER TABLE `video_category` CHANGE `title` `title` VARCHAR(64)";
            \DB::connection()->getPdo()->exec($sql);
        $sql = "ALTER TABLE `video_category` ADD UNIQUE(`title`)";
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
