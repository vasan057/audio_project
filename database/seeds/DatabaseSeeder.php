<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(AdminTableSeeder::class);
        //$this->call(ExpertiseTableSeeder::class);
        //$this->call(ArticleTableSeeder::class);
        //$this->call(VideoTableSeeder::class);
        //$this->call(AudioTableSeeder::class);
        $this->call(ScienceCategoryTableSeeder::class);
    }
}
