<?php namespace Dexel\Contact\Http\Middleware;

use Closure;

/**
 * The ContactMiddleware class.
 *
 * @package Dexel\Contact
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class ContactMiddleware
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
