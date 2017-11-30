<?php
namespace Dexel\Authentication\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Devices;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;

class DeviceController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  protected $request;

  public function __construct(Request $request)
  {
      $this->request = $request;
  }
  public function index()
  {
    //\Config::set('jwt.user' , "App\Models\Configuration");
    \Config::set('auth.defaults.guard' , "device");
    $credentials = $this->request->only('type','password');
    /*$Android = stripos($_SERVER['HTTP_USER_AGENT'],"Android");
     if($Android)
     {
       $credentials['type']='android';
     }*/
    try {
      $customClaims = ['model' => 'device'];
      if (! $token = JWTAuth::attempt($credentials,$customClaims)) {
            return api_response('2001','Invalid credentials','device',null,401);
          }
    } catch (JWTException $e) {
        // something went wrong whilst attempting to encode the token
        return api_response('500','Could not create token','device',null,500);
    }
    return api_response('2000','token','device',['token' => $token]);
  }
  public function refresh()
  {
    try {
      $token = JWTAuth::getToken('value');
      $payload = JWTAuth::getPayload($token);
      $timediff = $payload['exp']-time();
      //1278750 is 14 days
      if($timediff > 1278750)
      {
        //token is valid for greater then 15 days, provied same token
        return api_response('2000','refresh_token',$payload['model'],['token'=>(string)$token]);
      }
      if($payload['model'] == 'user')
      {
          \Config::set('auth.defaults.guard' , "user");
      }
      else
      {
          \Config::set('auth.defaults.guard' , "device");
      }      
      $newToken = JWTAuth::refresh($token);
      return api_response('2000','refresh_token','device',['token' => $newToken]);
    } catch (JWTException $e) {
        // something went wrong whilst attempting to encode the token
        return api_response('500','Could not create token','device',null,500);
    }
  }
}
 

     



















    


      
