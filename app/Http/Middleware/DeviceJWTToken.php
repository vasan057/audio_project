<?php
namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class DeviceJWTToken
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
        $payload = JWTAuth::getPayload(JWTAuth::getToken());
        //\Config::set('jwt.user' , "App\Models\Configuration");
        //$token=JWTAuth::getToken();
        //dd(JWTAuth::parseToken()->authenticate());
        try{
            if($payload['model'] == 'user')
            {
                \Config::set('auth.defaults.guard' , "user");
            }
            else
            {
                \Config::set('auth.defaults.guard' , "device");
            }
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return api_response('2005','Device not found','device',[],404);
            }
        }catch (JWTException $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return api_response('2002','Token expired','device',[],$e->getStatusCode());
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return api_response('2003','Token invalid','device',[],$e->getStatusCode());
            }else{
                return api_response('2004','Token is required','device',[],$e->getStatusCode());
            }
        }
       return $next($request);
    }
}