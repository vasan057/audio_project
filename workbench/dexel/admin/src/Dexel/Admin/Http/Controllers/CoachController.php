<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admins;
use App\Models\Articles;
use App\Models\Videos;
use App\Models\Playlists;
use App\Models\Audios;
use App\Models\PlaylistCategory;
use Auth;
use DB;
use App\Models\AudioComments;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Filesystem\Filesystem;
use AWS;
/**
 * The CoachController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class CoachController extends Controller
{
    protected $request;

    public function __construct(Factory $storage, Filesystem $file,Request $request)
    {
        $this->storage = $storage;
        $this->file = $file;
        $this->request = $request;
    }

	public function index()
    {
        $coaches = Admins::with('profile')->where('userType','coach')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin::coach.index',['coaches'=>$coaches]);
    }

    public function find_coach()
    {
        $search_value = $this->request->get('term',NULL);
        //dd($search_value);
        $columns = ['fname','lname','email','phone'];
        $query = Admins::select('admins.id',DB::raw("CONCAT(admins.fname,' ',admins.lname) as label"),'admins_profile.photo');
        $query->join('admins_profile', 'admins.id', '=', 'admins_profile.admin_id');
        $query->where('admins.fname', 'like','%'.$search_value.'%');
        foreach($columns as $column)
        {
          $query->orWhere('admins.'.$column, 'like','%'.$search_value.'%');
        }
        $coaches = $query->get();
        return response()->json($coaches);
    }

    public function activate($coachId)
    {
        $id = base64_decode($coachId);
        $coach = Admins::find($id);
        if(!$coach)
        {
            abort(404);
        }
        $coach->active = '1';
        $coach->updated_by = Auth::guard('admin')->id();
        $coach->save();
        return response()->json(['code'=>'success','text'=>'fa-eye','action'=>'deactivate/'.$coachId]);
    }
    public function deactivate($coachId)
    {
        $id = base64_decode($coachId);
        $coach = Admins::find($id);
        if(!$coach)
        {
            abort(404);
        }
        $coach->active = '0';
        $coach->updated_by = Auth::guard('admin')->id();
        $coach->save();
        return response()->json(['code'=>'success','text'=>'fa-eye-slash','action'=>'activate/'.$coachId]);
    }
    public function profile($coachId)
    {
        $id = base64_decode($coachId);
        $coach = Admins::find($id);
        if(!$coach)
        {
            abort(404);
        }
        $count['articles']= Articles::where(['created_by'=>$coach->id])->count();
        $count['videos'] = Videos::where(['created_by'=>$coach->id])->count();
        $count['playlists'] = Playlists::where(['created_by'=>$coach->id])->count();
        $recent['playlists'] = Playlists::where(['created_by'=>$coach->id])->orderBy('created_at', 'desc')->take(3)->get();
        // $recent['comments'] = AudioComments::with(['audio','createdby'])->whereHas('audio',function($q) use ($id){
        //     $q->where('created_by',$id);
        // })->orderBy('created_at', 'desc')->take(4)->get();
        return view('admin::coach.profile',['count'=>$count,'coach'=>$coach,'recent'=>$recent]);

            /*$playlists= Playlists::with('category','audios','createdby')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(4)->get();
            $articles= Articles::with('category','essence','views')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(4)->get();
            $videos = Videos::with('category','essence','views')->where(['created_by'=>Auth::guard('admin')->id()])->orderBy('created_at', 'desc')->take(4)->get();
            //dd($articles);
            return view('admin::profile',['playlists'=>$playlists,'videos'=>$videos,'articles'=>$articles]);*/
    }
    public function audios($coachId,$category_id=NULL)
    {
        $id = base64_decode($coachId);
        $coach = Admins::find($id);
        $categories = PlaylistCategory::where(['created_by'=>$id,'active'=>'1'])->get();
        if(!$category_id)
        {
            $category_id = $categories->first()->id;
        }
        $playlists = Playlists::with('category','audios','createdby')->where(['created_by'=>$id,'category_id'=>$category_id])->orderBy('created_at', 'desc')->get();
        $playlists_count = Playlists::where(['created_by'=>$id])->count();
        return view('admin::coach.playlist',['playlists'=>$playlists,'categories'=>$categories,'category_id'=>$category_id,'playlists_count'=>$playlists_count,'coach'=>$coach]);
    }
    public function edit_audio($coachId,$slug)
    {
        $id = base64_decode($coachId);
        $coach = Admins::find($id);
        if(!$coach)
        {
            abort(404);
        }
        $categories = PlaylistCategory::where(['created_by'=>$id,'active'=>'1'])->get();
        $playlist = Playlists::with('category','audios','createdby')->where(['slug'=>$slug])->orderBy('created_at', 'desc')->first();
        
        if(!$playlist)
        {
            abort(404);
        }
        return view('admin::coach.playlist_edit_form',['playlist'=>$playlist,'coach'=>$coach,'categories'=>$categories]);
    }
    public function editStore_audio($coachId,$slug){
        //to set memory limit for file 
        //dd($this->request->all());
        ini_set('memory_limit','1256M');
        $id = base64_decode($coachId);
        $coach = Admins::find($id);
        if(!$coach)
        {
            abort(404);
        }
        $playlist = Playlists::with('category','audios','createdby')->where(['slug'=>$slug])->orderBy('created_at', 'desc')->first();
        if(!$playlist)
        {
            abort(404);
        }
        $inputs = $this->request->only('name','description','category');
        $unset_aduios = $this->request->get('unset_aduios',[]);
        //dd($unset_aduios);
        $inputs['image'] = $this->request->file('image');
        $audio_input['audio']= $this->request->file('audio');
        $audio_input['audio_name']= $this->request->get('audio_name');
        $audio_input['audio_id']= $this->request->get('audio_id');
        $audio_input['audio_description']= $this->request->get('audio_description');
        if(count($audio_input['audio_name']) != count($audio_input['audio_description']) )
        {
            abort('403','Invalid Request');
        }
        //$inputs['slug'] = str_replace(' ', '_', strtolower(trim($inputs['name'])));
        //dd($audio_input['audio'][0]->getClientMimeType());
        $Playlistvalidator = Playlists::edit_validation($inputs,$playlist->id);
        $Audiovalidator = Audios::edit_validation($audio_input);
        if ($Playlistvalidator->fails() || $Audiovalidator->fails())
        {
            $validationMessages = array_merge_recursive($Playlistvalidator->messages()->toArray(), $Audiovalidator->messages()->toArray());
            //dd($validationMessages);
            return back()->withInput()->withErrors($validationMessages);
        }
        if(!PlaylistCategory::where(['id'=>$inputs['category'],'active'=>'1','created_by'=>$id])->first())
        {
            $Playlistvalidator->errors()->add('category', 'Invalid category!');
            return back()->withInput()->withErrors($Playlistvalidator);
        }
        $transaction = DB::transaction(function() use($inputs,$audio_input,$playlist,$unset_aduios)
        {
           //insert query
            $inputs['description']=nl2br($inputs['description']);
            $inputs['updated_by']=Auth::guard('admin')->id();
            $inputs['category_id']=$inputs['category'];
            unset($inputs['category']);
            $jobIds=[];
            $playlist->update($inputs);
            if(isset($inputs['image']) && ($inputs['image']))
                {
                    try
                    {
                        $imageFileName = "/playlist/".$playlist->id."/".$playlist->slug."_".time() . '.' . $inputs['image']->getClientOriginalExtension();
                        $s3 = \Storage::disk('s3');
                        $s3->deleteDirectory(env('S3_ASSET_PATH','assets')."/playlist/".$playlist->id);
                        $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($inputs['image']), 'public');
                        $playlist->image = $imageFileName;
                        $playlist->save();   
                    }
                    catch (Exception $e)
                    {
                        $Playlistvalidator->errors()->add('image', 'Something is wrong!, upload failed!');
                        return back()->withInput()->withErrors($Playlistvalidator);
                    }
                }
            for($i=0; $i<count($audio_input['audio_name']); $i++)
            {
                if(isset($audio_input['audio_id'][$i]) && ($audio_input['audio_id'][$i]))
                {
                    $audio = Audios::find($audio_input['audio_id'][$i]);
                    if(!$audio)
                    {
                        abort('403','Inavalid access');
                    }
                    $audio->description = $audio_input['audio_description'][$i];
                    $audio->name=$audio_input['audio_name'][$i];
                    $audio->save();
                }
                else
                {
                    $audio = new Audios(
                    ['name'=>$audio_input['audio_name'][$i],'created_by'=>Auth::guard('admin')->id(),
                    'updated_by'=>Auth::guard('admin')->id(),'description'=>$audio_input['audio_description'][$i],'path'=>''
                    ]);    
                    $audio = $playlist->audios()->save($audio);
                }
                
                //upload to s3
                if(isset($audio_input['audio'][$i]) && ($audio_input['audio'][$i]))
                {
                    $ext = $audio_input['audio'][$i]->getClientOriginalExtension();
                                $pathName = env('S3_AUDIO_PATH').'/'.$playlist->id.'/'.$audio->id.'/dexel_'.time();
                    $fileName = $pathName.".$ext";

                    try
                    {
                        $s3 = $this->storage->disk('s3');
                        $s3->put($fileName, $this->file->get($audio_input['audio'][$i]->getRealPath()));
                                            $jobIds[]= $this->trnascoderJob($fileName);
                    }
                    catch (Exception $ex)
                    {
                        $Audiovalidator->errors()->add('audio.0', 'Something is wrong!, upload failed!');
                        return back()->withInput()->withErrors($Audiovalidator);
                        //throw new Exception('Not able to store file, details:' . $ex->getMessage());
                    }
                    $audio->path = $pathName.".m3u8";;
                    $audio->save();
                }
            }

            //delete audios
            if(count($unset_aduios))
            {
                Audios::destroy($unset_aduios);
            }
            return $jobIds;
        });
      return redirect('/coach/'.$coachId.'/upload/audios/jobs?jobids='.implode(',',$transaction));
    }
    public function trnascoderJob($srcFile)
        {
            //ref:http://docs.aws.amazon.com/aws-sdk-php/v2/guide/service-elastictranscoder.html
            $file_details = pathinfo($srcFile);
            
            $s3 = \Storage::disk('s3');
            $s3->deleteDirectory(env('S3_AUDIO_HLS_PATH').'/'.$file_details['dirname']);
            
            $ElasticTranscoder = AWS::createClient('ElasticTranscoder');
            $result = $ElasticTranscoder->createJob([
                //pipeline id
                'PipelineId'=>env('AWS_PIPELINEID'),
                'Input' => [
                    //inpute file
             'Key' => $srcFile,
             'FrameRate' => 'auto',
             'Resolution' => 'auto',
             'AspectRatio' => 'auto',
             'Interlaced' => 'auto',
             'Container' => 'auto',
         ],
             'Outputs'=>[
                 [
                 //output prefix file name
                 'Key' =>$file_details['filename'],
                 //System preset: HLS Audio - 64k
                 'PresetId'=>'1351620000001-200071',
                 //seconds to split to file
                 'SegmentDuration'=>'10'
             ]
         ],
         //output folder name
         'OutputKeyPrefix'=>env('S3_AUDIO_HLS_PATH').'/'.$file_details['dirname'].'/'
            ]);
            return $result['Job']['Id'];
        }
        public function jobStatus($coachId)
        {
            $jobIds = array_filter(explode(',',$this->request->get('jobids')));
            $jobs=[];
            if(count($jobIds))
            {
                $ElasticTranscoder = AWS::createClient('ElasticTranscoder');
                foreach ($jobIds as $jobId)
                {
                    $result = $ElasticTranscoder->readJob(['Id' => $jobId]);
                    $tmp['Status'] = $result['Job']['Output']['Status'];
                    if(isset($result['Job']['Output']['StatusDetail']))
                    {
                        $tmp['StatusDetail'] = $result['Job']['Output']['StatusDetail'];
                    }
                    else
                    {
                        $tmp['StatusDetail'] = '';
                    }
                    $jobs[]=$tmp;
                }
            }
            else
            {
                return redirect('coach/'.$coachId.'/upload/audios');
            }
            //dd($jobs);
            return view('admin::coach.jobs',['jobs'=>$jobs,'coachId'=>$coachId]);
        }
        public function deletePlayist($coachId,$slug)
        {
            $id = base64_decode($coachId);
            $coach = Admins::find($id);
            if(!$coach)
            {
                abort(404);
            }
            $playlist = Playlists::where(['slug'=>$slug])->first();
            if(!$playlist)
            {
                abort(404);
            }
            $playlist->delete();
        }
        public function playistAction($coachId,$slug)
        {
            $id = base64_decode($coachId);
            $coach = Admins::find($id);
            if(!$coach)
            {
                abort(404);
            }
            $playlist = Playlists::where(['slug'=>$slug])->first();
            if(!$playlist)
            {
                abort(404);
            }
            $action = $this->request->get('action',NULL);
            if($action == 'activate' || $action == 'approve')
            {
                $playlist->active = '1';
                $action = 'decativate';
                $state = 'active';
            }
            else
            {
                $playlist->active = '0';
                $action = 'activate';
                $state = 'inactive';
            }
            $playlist->updated_by = Auth::guard('admin')->id();
            $playlist->save();
            return response()->json(['code'=>'success','action'=>$action,'state'=>$state]);
        }
}
