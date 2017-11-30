<?php namespace Dexel\Contact\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Contact\Facades\Contact;
use Dexel\Contact\Models\ContactModel;
use Mail;
use App\Mail\Contact As Contactus;
use Auth;
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
    }
    public function index()
    {
        return view('contact::index');
    }
    public function store()
    {
        $input = $this->request->only('fname','lname','email','phone','message','g-recaptcha-response');              
        $validator = ContactModel::validation($input);       
        if ($validator->fails())
        {
            $output['code']='validation';
            $output['errors']=$validator->messages(); 
            return redirect('contact')->withErrors($validator)->withInput();
        }
        $input['created_by'] = Auth::guard('user')->id();
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
        return redirect('contact')->with('message','Thank you!, Will get back to you shortly');
   } 
}