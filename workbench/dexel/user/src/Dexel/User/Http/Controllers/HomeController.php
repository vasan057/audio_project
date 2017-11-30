<?php namespace Dexel\User\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\User\Facades\User;
use App\Models\Articles;
use App\Models\ArticleViews;
use App\Models\ArticleCategories;
use App\Models\Videos;
use App\Models\VideoViews;
use App\Models\Playlists;
use Crypt;
/**
 * The HomeController facade.
 *
 * @package Dexel\User\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
    public function index()
     {
         return view('user::index');
     }
     public function collection()
      {
          $articles = Articles::with('category','essence','createdby')->where(['active'=>'1'])->orderBy('created_at', 'desc')->get();
          $videos = Videos::with('category','essence','createdby')->where(['active'=>'1'])->orderBy('created_at', 'desc')->get();
            return view('user::collection',['articles'=>$articles,'videos'=>$videos]);
      }
      public function profile()
       {
           return view('user::profile');
       }
       public function credit()
        {
            return view('user::credits');
        }
        public function coach()
          {
              return view('user::coachlist');
          }
       public function coachprofile()
         {
             return view('user::coachprofile');
         }



}
