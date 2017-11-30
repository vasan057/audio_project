<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Quotes;
/**
 * The QuotesController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class QuotesController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

	public function index()
    {
        $quotes = Quotes::orderBy('created_at', 'desc')->get();
        return view('admin::quote.index',['quotes'=>$quotes]);
    }
    public function get()
    {
        return view('admin::quote.form');
    }
    public function edit($id)
    {
        $quote =  Quotes::find($id);
        if((!$quote))
        {
            abort('404');
        }
        return view('admin::quote.edit_form',['quote'=>$quote]);
    }
    public function store($id=NULL)
    {
        $input = $this->request->only('author','description');
        $input['cover_img'] = $this->request->file('cover_img',NULL);
        $input['active'] = '1';
        $validator = Quotes::validation($input);
        if ($validator->fails())
        {
            return back()->withErrors($validator);
        }
        
        $input['created_by'] = $input['updated_by'] = Auth::guard('admin')->id();
        if($id)
        {
            $quote =  Quotes::find($id);
            if((!$quote))
            {
                abort('404');
            }
        }
        else
        {
            $quote = new Quotes();
        }
        foreach ($input as $key=>$value)
        {
            if($value)
            $quote->$key = $value;
        }
        
        if($quote->save())
        {
            if($input['cover_img'])
            {
                $imageFileName = "/quotes/".$quote->id."/".time() . '.' . $input['cover_img']->getClientOriginalExtension();
                $s3 = \Storage::disk('s3');
                //remove old mages if any
                $s3->deleteDirectory(env('S3_ASSET_PATH','assets')."/quotes/".$quote->id);
                $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($input['cover_img']), 'public');
                $quote->cover_img = $imageFileName;
                $quote->save();
            }
        }
        return redirect('coach/view/quote/'.$quote->id);
    }
    public function view($id)
    {
        $quote =  Quotes::find($id);
            if((!$quote))
            {
                abort('404');
            }
        if(!$quote)
        {
            abort('404');
        }

            return view('admin::quote.view',['quote'=>$quote]);
    }
    public function deleteQuote($id)
        {
            $quote = Quotes::where(['id'=>$id,'created_by'=>Auth::guard('admin')->id()])->first();
            if(!$quote)
            {
                abort(404);
            }
            $quote->delete();
        }
}
