<?php namespace Dexel\Follow\Http\Middleware;

use Closure;

/**
 * The FollowMiddleware class.
 *
 * @package Dexel\Follow
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class FollowMiddleware
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
        return $next($request);
    }
}
