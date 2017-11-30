<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Diet','Meditation','Self Development','Fitness','Detox','Mindful Living','Neuroplasticity','Bio Electrical','Heart Mind Coherence','Psychoneuro Immunology','Epigenetics','Breath','Gut Brain'];
        foreach ($titles as $title)
        {
            $record = \App\Models\ArticleCategory::firstOrCreate(['title'=>$title,'created_by'=>'1','updated_by'=>'1']);
        }
        $titles = ['Stress','Anxiety','Sleep','Healing','Relax','Contemplative','Beginner','Creative','Presence'];
        foreach ($titles as $title)
        {
            $record = \App\Models\ArticleEssence::firstOrCreate(['title'=>$title,'created_by'=>'1','updated_by'=>'1']);
        }
    }
}
