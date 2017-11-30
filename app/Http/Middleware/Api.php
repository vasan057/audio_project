<?php
namespace App\Http\Middleware;
use Closure;
class Api
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
        if( $request->header('Accept') != 'application/json' && $request->header('Content-Type') != 'application/json' ){
            return api_response('404','Invalid request','api',null,404);
        }
       return $next($request);
    }
}