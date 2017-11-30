<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Dexel\Contact\Models\ContactModel;
use Auth;
/**
 * The ContactController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class ContactController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

	public function index()
    {
        $contacts = ContactModel::orderBy('created_at', 'desc')->paginate(10);
        return view('admin::contact.index',['contacts'=>$contacts]);
    }
}
