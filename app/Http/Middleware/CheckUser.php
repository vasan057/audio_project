<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
class CheckUser
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
        if(Auth::guard('user')->check())
        {
            $user = Users::where('id',Auth::guard('user')->id())->where(['active'=>'1'])->first();
            if(!$user)
            {
                Auth::guard('user')->logout();
                return abort("403","Invalid access");
            }
            return $next($request);
        }
        else 
        {
            return redirect()->intended('login')->with('message', 'Please Login');
        }
    }
}
