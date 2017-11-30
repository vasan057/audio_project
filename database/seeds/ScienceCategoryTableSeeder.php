<?php

use Illuminate\Database\Seeder;

class ScienceCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Neuroplasticity','Bio-electrical Field','Heart Mind Coherence','Psychoneuro immunology','Epigenetics','Breath','Gut Brain','Placebo Mind'];
        foreach ($titles as $title)
        {
            $record = \App\Models\ScienceCategory::firstOrCreate(['title'=>$title,'slug'=>str_replace(' ', '_', strtolower($title)),'created_by'=>'1','updated_by'=>'1']);
        }
    }
}
