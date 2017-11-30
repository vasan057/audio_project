<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use App\Models\Articles;
use App\Models\ArticleViews;
use App\Models\ArticleCategories;
use Auth;
/**
 * The ArticleController facade.
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class ArticleController extends Controller
{
    public function index()
     {
     	$articles = Articles::with('category','essence','createdby')->where(['active'=>'1'])->orderBy('created_at', 'desc')->get();
         return view('web.articles',['articles'=>$articles]);
     }
     public function detail($id)
     {
     	$id=Crypt::decrypt($id);
     	$article = Articles::with('category','essence','createdby')->where(['active'=>'1','id'=>$id])->first();
     	if(!$article)
     	{
     		abort(404);
     	}
     	$article_view = new ArticleViews(['created_by'=>Auth::guard('user')->id()]);
     	$article->views()->save($article_view);
     	$related_articles = Articles::with('category','essence','createdby')->where(['active'=>'1','category_id'=>$article->category_id])->take(4)->get();
         return view('web.article_detail',['article'=>$article,'related_articles'=>$related_articles]);
     }
     public function category($category_id)
     {
       $category_id=Crypt::decrypt($category_id);
       $articles = Articles::with('category','essence','createdby')->where(['active'=>'1', 'category_id'=>$category_id])->orderBy('created_at', 'desc')->get();
         return view('web.article_category',['articles'=>$articles]);
     }
}
