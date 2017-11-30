<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $record = \App\Models\Admins::where(['email'=>'admin@stressfit.com'])->first();
        if(!$record)
        {
            $record = new \App\Models\Admins();
        }
        else
        {

        }
        $record->email='admin@stressfit.com';
        $record->fname='Admin';
        $record->lname='Stressfit';
        $record->password=Hash::make('password');
        $record->phone='9976251014';
        $record->email_verified='1';
        $record->active='1';
        $record->usertype='admin';
		if($record->save())
        {
            $profile_arr = ['photo' => 'photo path','dob'=>'1986-01-02','about'=>"Testing",'address'=>['street'=>'14ths street','city'=>'CH','state'=>'TN'],'gender'=>'M','updated_by'=>$record->id];
            if($record->profile)
            {
                $record->profile->update($profile_arr);
            }
            else
            {
                $profile = new \App\Models\AdminsProfile($profile_arr);
                $record->profile()->save($profile);
            }
        }
    }
}
