<?php

use Illuminate\Database\Seeder;
class ExpertiseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$expertise = ['Aerobics','Yoga','Meditation','Gym Instructor','Dietician','Nutritionist','Personal Trainer'];
    	foreach ($expertise as $expert)
    	{
            $record = \App\Models\Expertise::where(['title' => ucfirst($expert)])->first();
            if(!$record)
            {
                $record = new \App\Models\Expertise();
            }
    		$record->title = ucfirst($expert);
    		$record->created_by = '1';
    		$record->updated_by = '1';
    		$record->save();
    	}
    }
}
