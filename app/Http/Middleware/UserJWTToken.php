<?php
namespace App\Http\Middleware;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
class UserJWTToken
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
        if($payload['model'] != 'user')
        {
            return api_response('6003','Token invalid','user',[],'403');
        }
        \Config::set('auth.defaults.guard' , "user");
        try{
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return api_response('6004','Device not found','user',[],404);
            }
        }catch (JWTException $e) {
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return api_response('6002','Token expired','user',[],$e->getStatusCode());
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return api_response('6003','Token invalid','user',[],$e->getStatusCode());
            }else{
                return api_response('6000','Token is required','user',[],$e->getStatusCode());
            }
        }
       return $next($request);
    }
}