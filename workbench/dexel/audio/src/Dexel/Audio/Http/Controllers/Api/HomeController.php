<?php namespace Dexel\Audio\Http\Controllers\Api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Audio\Facades\Audio;
use App\Models\Audios;
use App\Models\AudioViews;
use App\Models\Playlists;
use App\Models\AudioRatings;
use App\Models\AudioComments;
use App\Models\PlaylistCategory;
use AWS;
/**
 * The HomeController facade.
 *
 * @package Dexel\Audio\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class HomeController extends Controller
{
    protected $request;
    protected $model_name;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->model_name = 'playlist';
    }
    public function get_categories()
    {
        $categories = PlaylistCategory::select('playlist_category.title','playlist_category.icon')->with('createdby')->whereHas('createdby',function($q){
            $q->where('usertype','admin');
        })->where(['active'=>'1'])->get();
        foreach ($categories as $category) {
            $category->icon = url('categories/icn_category_'.$category->icon.'.png');
        }
        return api_response('5000','success',$this->model_name,$categories);
    }
    public function get_playlist($categoryTitle=NULL)
    {
        $playlists = Playlists::with(['category','audios','createdby','custom_author'])
        ->whereHas('createdby',function($q){
                $q->where('usertype','admin');
            })->whereHas('category',function($q){
                $q->where('active','1');
            })->where(['active'=>'1']);
        //dd($playlists);
        if($categoryTitle)
        {
            //only admin category
            $category = PlaylistCategory::with('createdby')->whereHas('createdby',function($q){
            $q->where('usertype','admin');
            })->where(['active'=>'1','title'=>$categoryTitle])->first();
            if(!$category)
            {
                abort(404);
            }
            $playlists = $playlists->where(['category_id'=>$category->id]);
        }
        $order_by = 'desc';
        $playlists = $playlists->orderBy('created_at', $order_by)->paginate(12);
        if(!$playlists)
        {
            abort(404);
        }
        return api_response('5000','success',$this->model_name,$playlists);
    }
    public function get_audio($playlist_id,$audio_id)
    {
        $audio = Audios::where(['playlist_id'=>$playlist_id,'id'=>$audio_id])->first();
        if(!$audio)
        {
            $result['code']='404';
            $result['message']='Not found';
            return response()->json($result);
        }


        $client = AWS::createClient('cloudfront');
        $streamHostUrl = env('CDN_URL');
        $resourceKey = env('S3_AUDIO_HLS_PATH').'/'.$audio->path;
        
        $expires = time() + 5;
        
        $signedUrlCannedPolicy = $client->getSignedUrl([
            'url'         => $streamHostUrl . '/' . $resourceKey,
            'expires'     => $expires,
            'private_key' => base_path('cdn_key/').env('CDN_PEM'),
            'key_pair_id' => env('CDN_KEY')
        ]);
        $extension = pathinfo($audio->path)['extension'];
        //mp3 type
        $result['type']='audio/mpeg';
        if($extension == "m3u8")
        {
            $result['type']='application/x-mpegURL';
        }
        //add count
        $audio_view = new AudioViews(['created_by'=>jwt_userid()]);
        $audio->views()->save($audio_view);

        $result['url']=(string) $signedUrlCannedPolicy;
        $result['description']=$audio->description;
        $result['name']=$audio->name;
        $result['audio_id']=$audio_id;
        $result['avg_rating'] = ceil($audio->ratings()->avg('rate'));
        $result['my_rating'] = $audio->my_rating()->pluck('rate');
        $result['my_comment'] = $audio->my_comment()->pluck('comment');
        $result['playlist']['description']=$audio->playlist->description;
        $result['playlist']['name']=$audio->playlist->name;
        $result['playlist']['slug']=$audio->playlist->slug;
        $result['playlist']['image']=cdn($audio->playlist->image);
        $result['author']=$audio->createdby->fname;
        return api_response('5000','success',$this->model_name,$result);
    }
    public function get_rate_comment($slug)
    {
        $playlist = Playlists::with('audios','audios.ratings','audios.ratings.createdby','audios.ratings.createdby.profile','audios.ratings.comment')->where(['slug'=>$slug])->first();
        if(!$playlist)
        {
            abort(404);
        }
        return api_response('5000','success',$this->model_name,$playlist);
    }
    public function set_rating($slug,$audio_id)
    {
        $playlist = Playlists::with('audios')->where(['slug'=>$slug])->first();
        if(!$playlist)
        {
            abort(404);
        }
        $audio = $playlist->audios()->where('id',$audio_id)->first();
        if(!$audio)
        {
            abort(404);
        }
        $audio_rating = AudioRatings::firstOrNew(['audio_id'=>$audio->id,'created_by'=>jwt_userid()]);
        if(!$rate = $this->request->input('rate'))
        {
            $rate = 1;
        }
        if($rate > 5)
        {
            return api_response('5001','validation',$this->model_name,['message'=>'invalid rate value']);
        }
        $audio_rating->rate = $rate;
        $audio_rating->save();
        return api_response('5000','success',$this->model_name,[]);
    }
    public function post_comment($slug,$audio_id)
    {
        $input = $this->request->only('comment');
        $validator = AudioComments::validation($input);
        if ($validator->fails())
        {
            return api_response('5001','validation',$this->model_name,$validator->messages());
        }

        $playlist = Playlists::with('audios')->where(['slug'=>$slug])->first();
        if(!$playlist)
        {
            abort(404);
        }
        $audio = $playlist->audios()->where('id',$audio_id)->first();
        if(!$audio)
        {
            abort(404);
        }
        $audio_rating = AudioRatings::where(['audio_id'=>$audio->id,'created_by'=>jwt_userid()])->first();
        if(!$audio_rating)
        {
            $validator->errors()->add('comment', 'Please rate, before comment!');
            return api_response('5001','validation',$this->model_name,$validator->messages());
        }
        $audio_comment = AudioComments::firstOrNew(['rating_id'=>$audio_rating->id,'audio_id'=>$audio->id,'created_by'=>jwt_userid()]);
        $audio_comment->comment = nl2br($input['comment']);
        $audio_comment->save();
        $output['code']='success';
        return api_response('5000','success',$this->model_name,$output);
    }
}
