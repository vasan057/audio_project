<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Playlists;
use App\Models\Admins;
use App\Models\Quotes;
use App\Models\ScienceCategory;
use App\Models\AudioOfWeek;
use Crypt;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
       $this->request =$request;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if(Auth::guard('user')->check())
        {
            $order_by = 'desc';
        }
        else
        {
            //LIFO to restrict the access for new records
            $order_by = 'asc';
        }*/
        $order_by = 'desc';
        $playlists = Playlists::with(['category','audios','audios.views','createdby'])->whereHas('createdby',function($q){
                $q->where('usertype','admin');
            })->orderBy('created_at', $order_by)->take(4)->get();
        //dd($playlists);
        $coaches = Admins::with('profile')->where(['usertype'=>'coach','active'=>'1'])->get();
        $playlist  = AudioOfWeek::where('active','1')->pluck('playlist_id');
        $audiofweek = Playlists::with(['category','audios','audios.views','createdby'])->whereIn('id',$playlist)->whereHas('createdby',function($q){
                $q->where('usertype','admin');
            })->orderBy('created_at', $order_by)->take(4)->get();
        //dd($audiofweek[0]->audios);
        $science_category = ScienceCategory::where(['active'=>'1'])->get();
        $quotes = Quotes::where(['active'=>'1'])->get();
        return view('web.home',['playlists'=>$playlists,'coaches'=>$coaches,'science_category'=>$science_category,'quotes'=>$quotes,'audiofweek'=>$audiofweek]);
    }
    public function contactus()
    {
        return view('web.contact');
    }
}
