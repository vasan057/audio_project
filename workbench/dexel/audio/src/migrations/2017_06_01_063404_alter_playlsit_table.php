<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPlaylsitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('playlists', function (Blueprint $table)
        {
            $table->string('slug',64)->after('name');
        });
        foreach (\App\Models\Playlists::withTrashed()->get() as $playlist)
        {
            $playlist->slug = str_replace(' ', '_', strtolower(trim($playlist->name)));
            $playlist->save();
        }
        Schema::table('playlists', function (Blueprint $table)
        {
            $sql = "ALTER TABLE `playlists` DROP INDEX `playlists_name_unique`";
            \DB::connection()->getPdo()->exec($sql);
            $sql = "ALTER TABLE `playlists` ADD UNIQUE(`slug`)";
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
        Schema::table('playlists', function (Blueprint $table)
        {
            $table->dropColumn('slug');
        });
    }
}
