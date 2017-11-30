<?php namespace Dexel\Contact\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use JWTAuth;
use JWTFactory;
use App\Models\Users;
use Tymon\JWTAuth\Exceptions\JWTException;
use Dexel\Contact\Models\ContactModel;
use Mail;
use App\Mail\Contact As Contactus;

/**
 * The HomeController class.
 *
 * @package Dexel\Contact
 * @author  Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
	protected $request;
    public function __construct(Request $request)
    {
        $this->request =$request;
        $this->model_name = 'contact';
    }
    public function store()
    {
        $input = $this->request->only('fname','lname','email','phone','message','g-recaptcha-response');              
        $validator = ContactModel::validation($input,'no');       
        if ($validator->fails())
        {
            $output['code']='validation';
            $output['errors']=$validator->messages(); 
             return api_response('7001','Validation error',$this->model_name,$validator->messages());
        }
        $input['created_by'] = \Auth::guard('user')->id();
        $input['message'] = nl2br($input['message']);
        $user = ContactModel::create($input);
        try
        {
            Mail::to(env('ADMIN_MAIL_ADDRESS'))->queue(new Contactus($user,'admin'));
            Mail::to($user->email)->queue(new Contactus($user,'user'));               
        }
        catch (\Exception $e)
        {
            // mail fialed    
        }
        return api_response('7000','success',$this->model_name,$user);
   } 
}