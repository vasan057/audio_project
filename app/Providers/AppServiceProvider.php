<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Schema::defaultStringLength(191);
        Validator::extend('phone_number', function($attribute, $value, $parameters) {
            /*accept below formate
              (111) 222-3333 | 1112223333 | 111-222-3333
              */
           //if(preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/i",$value))
            //if(preg_match("/^\D?(\d{3})\D?\D?(\d{3})\D?(\d{4})$/i",$value))
            
            /*(?=.*[0-9]) postive look ahead. Ensures that there is atleast one digit
            [- +()0-9]+ matches numbers, spaces, plus sign, hyphen and brackets*/
            if(preg_match("/^(?=.*[0-9])[- +()0-9]+$/",$value))
            {
                return true;   
            }
            else
            {
                return false;
            }
        });
        Validator::extend('alpha_spaces', function($attribute, $value)
        {
            if(preg_match('/^[\pL\s]+$/u', $value))
            {
                return true;   
            }
            else
            {
                return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
