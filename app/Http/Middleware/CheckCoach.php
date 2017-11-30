<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Admins;
class CheckCoach
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Config::set('auth.defaults.guard' , "admin");
        if(Auth::guard('admin')->check())
        {
            //$admin= Admins::where('id',Auth::guard('admin')->id())->where(['active'=>'1','usertype'=>'coach'])->first();
            $admin= Admins::where('id',Auth::guard('admin')->id())->where(['active'=>'1'])->first();
            if(!$admin)
            {
                Auth::guard('admin')->logout();
                return abort("403","Invalid access");
            }
            return $next($request);
        }
        else 
        {
            return redirect()->intended('login/coach')->with('message', 'Please Login to access coach area');
        }
    }
}
