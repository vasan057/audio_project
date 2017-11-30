<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //if($guard == "coach" || $guard == "admin")
        //{
            if (Auth::guard('admin')->check())
            {
                //if($guard == "coach")
                //{
                    return redirect('/coach');
                //}
                /*else if($guard == "admin")
                {

                }
                return redirect('/admin');*/
            }
        //}

        return $next($request);
    }
}
