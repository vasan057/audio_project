<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Articles;
use Auth;
/**
 * The ArticleController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class ArticleController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

	public function index()
    {
        $articles = Articles::with('category','essence','createdby')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->get();
        return view('admin::article.index',['articles'=>$articles]);
    }
    public function store()
    {
        $input = $this->request->only('title','active','approved','short_description','description','author','isfree','category','essence');
        $input['cover_img'] = $this->request->file('cover_img');
        //$input['recommended'] = $this->request->get('recommended','0');
        
        $input['slug']=str_replace(' ', '_', strtolower(trim($input['title'])));
        $validator = Articles::validation($input);
        if ($validator->fails())
        {
            $output['code']='validation';
            $output['errors']=$validator->messages();
            return response()->json($output);
        }
        
        $input['approved']=1;
        $input['created_by'] = $input['updated_by'] = Auth::guard('admin')->id();
        $input['category_id'] = $input['category'];
        $input['essence_id'] = $input['essence'];
        unset($input['category']);
        unset($input['essence']);
        if($article = Articles::create($input))
        {
            $imageFileName = "/article/".$article->id."/".$article->slug."_".time() . '.' . $input['cover_img']->getClientOriginalExtension();
            $s3 = \Storage::disk('s3');
            $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($input['cover_img']), 'public');
            $article->cover_img = $imageFileName;
            $article->save();
        }
        $output['code']='success';
        return response()->json($output);
    }
    /*public function get($slug)
    {
        $article = Articles::with('category','essence')->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->first();
        if($article)
        {
            return view('admin::article.view',['article'=>$article]);
        }
        else
        {
            abort('404');
        }
    }*/
    public function view($slug)
    {
        $article = Articles::with('category','essence')->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->first();
        if($article)
        {
            return view('admin::article.view',['article'=>$article]);
        }
        else
        {
            abort('404');
        }
    }
    public function remove($slug)
    {
        $article = Articles::with('category','essence')->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->first();
        if($article)
        {
            $article->delete();
        }
        else
        {
            abort('404');
        }
    }
}
