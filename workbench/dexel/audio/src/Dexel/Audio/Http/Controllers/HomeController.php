<?php namespace Dexel\Audio\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Dexel\Audio\Facades\Audio;
use App\Models\Audios;
use App\Models\AudioViews;
use App\Models\Playlists;
use App\Models\AudioRatings;
use App\Models\AudioComments;
use Auth;
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

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function player($playlist_id,$audio_id)
    {
        $audio = Audios::where(['playlist_id'=>$playlist_id,'id'=>$audio_id])->first();
        if(!$audio)
        {
            abort(404);
        }
        $playlists = Playlists::with(['category','audios','audios.views','createdby'])->where('id',$playlist_id)->get();
        return view('web.audio_player_new',['playlists'=>$playlists,'audio_id'=>$audio_id]);
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
        
        $expires = time() + 60;
        
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
        $audio_view = new AudioViews(['created_by'=>Auth::guard('user')->id()]);
        $audio->views()->save($audio_view);

        $result['code']='200';
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
        return response()->json($result);
    }
    public function get_rate_comment($slug)
    {
        $playlist = Playlists::with('audios','audios.ratings','audios.ratings.createdby','audios.ratings.createdby.profile','audios.ratings.comment')->where(['slug'=>$slug])->first();
        if(!$playlist)
        {
            abort(404);
        }
        //dd($playlist);
        return view('web.rating_comment',['playlist'=>$playlist]);
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
        $audio_rating = AudioRatings::firstOrNew(['audio_id'=>$audio->id,'created_by'=>Auth::guard('user')->id()]);
        if(!$rate = $this->request->input('rate'))
        {
            $rate = 1;
        }
        if($rate > 5)
        {
            return response()->json(['code'=>'validation','message'=>'invalid rate value']);
        }
        $audio_rating->rate = $rate;
        $audio_rating->save();
        return response()->json(['code'=>'success']);
    }
    public function post_comment($slug,$audio_id)
    {
        $input = $this->request->only('comment');
        $validator = AudioComments::validation($input);
        if ($validator->fails())
        {
            $output['code']='validation';
            $output['errors']=$validator->messages();
            return response()->json($output);
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
        $audio_rating = AudioRatings::where(['audio_id'=>$audio->id,'created_by'=>Auth::guard('user')->id()])->first();
        if(!$audio_rating)
        {
            $validator->errors()->add('comment', 'Please rate, before comment!');
            $output['code']='validation';
            $output['errors']=$validator->messages();
            return response()->json($output);
        }
        $audio_comment = AudioComments::firstOrNew(['rating_id'=>$audio_rating->id,'audio_id'=>$audio->id,'created_by'=>Auth::guard('user')->id()]);
        $audio_comment->comment = nl2br($input['comment']);
        $audio_comment->save();
        $output['code']='success';
        return response()->json($output);
    }
}
