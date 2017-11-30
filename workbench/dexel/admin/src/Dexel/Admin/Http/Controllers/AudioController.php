<?php namespace Dexel\Admin\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Playlists;
use App\Models\PlaylistCategory;
use App\Models\Audios;
use App\Models\AudioOfWeek;
use Auth;
use DB;
use AWS;
use Illuminate\Contracts\Filesystem\Factory;
use Illuminate\Filesystem\Filesystem;
/**
 * The AudioController facade.
 *
 * @package Dexel\Admin\Http\Controllers
 * @author Manikandan R <mani@dexeldesigns.com>
 */
class AudioController extends Controller
{
    protected $request;

    public function __construct(Factory $storage, Filesystem $file,Request $request)
    {
        $this->storage = $storage;
        $this->file = $file;
        $this->request = $request;
    }

    public function index($category_id=NULL)
    {
        $categories = PlaylistCategory::where(['created_by'=>Auth::guard('admin')->id(),'active'=>'1'])->get();
        if(!count($categories))
        {
            //redirect to add category
            return redirect('coach/audios/my_category');
        }
        if(!$category_id)
        {
            $category_id = $categories->first()->id;
        }
        $playlists = Playlists::with('category','audios','createdby')->where(['created_by'=>Auth::guard('admin')->id(),'category_id'=>$category_id])->orderBy('created_at', 'desc')->get();
        $playlists_count = Playlists::with('category')->whereHas('category',function($q){
                $q->where('active','1');
            })
        ->where(['created_by'=>Auth::guard('admin')->id()])->count();
        return view('admin::audio.index',['playlists'=>$playlists,'categories'=>$categories,'category_id'=>$category_id,'playlists_count'=>$playlists_count]);
    }
    public function get()
    {
        $categories = PlaylistCategory::where(['created_by'=>Auth::guard('admin')->id(),'active'=>'1'])->get();
        if(!count($categories))
        {
            //redirect to add category
            return redirect('coach/audios/my_category');
        }
        return view('admin::audio.form',['categories'=>$categories]);
    }
    public function get_my_category($id=NULL)
    {
        if(Auth::guard('admin')->user()->usertype == 'admin')
        {
            $icons=[1,2,3,4,5,6,7,8,9];
        }
        else
        {
            $icons=[101,102,103,104,105,106,107,108,109];
        }
        $categories = PlaylistCategory::where(['created_by'=>Auth::guard('admin')->id()])->paginate(10);
        if($id)
        {
            $playlist_category = PlaylistCategory::where(['created_by'=>Auth::guard('admin')->id(),'id'=>$id])->first();
            if(!$playlist_category)
            {
                abort(404);
            }
        }
        else
        {
            $playlist_category = NULL;
        }
        return view('admin::audio.my_category',['categories'=>$categories,'icons'=>$icons,'playlist_category'=>$playlist_category]);
    }
    public function add_my_category($id=NULL)
    {
        $input = $this->request->only('title','icon');
        $validator = PlaylistCategory::validation($input);
        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }
        $input['title'] = ucfirst(trim($input['title']));
        $input['created_by'] = $input['updated_by'] = Auth::guard('admin')->id();
        $input['active'] = '1';
        
        if($id)
        {
            $playlist_category = PlaylistCategory::where(['created_by'=>Auth::guard('admin')->id(),'id'=>$id])->first();
            if(!$playlist_category)
            {
                abort(404);
            }
            if(PlaylistCategory::where('id','!=',$id)->where(['title'=>$input['title'],'created_by'=>Auth::guard('admin')->id()])->count())
            {
                $validator->errors()->add('title', 'Title already exists!');
                return back()->withInput()->withErrors($validator);
            }
            $playlist_category->update($input);
            return back()->with('message','Category created successfully');
        }
        else
        {
            if(PlaylistCategory::where(['created_by'=>Auth::guard('admin')->id()])->count() >=9 )
            {
                $validator->errors()->add('title', 'You can have only NINE category!');
                return back()->withInput()->withErrors($validator);
            }
            if(PlaylistCategory::where(['title'=>$input['title'],'created_by'=>Auth::guard('admin')->id()])->count())
            {
                $validator->errors()->add('title', 'Title already exists!');
                return back()->withInput()->withErrors($validator);
            }
            PlaylistCategory::create($input);
            return back()->with('message','Category created successfully');
        }
    }

    public function store(){
        //to set memory limit for file 
        //dd($this->request->all());
        ini_set('memory_limit','1256M');
        $inputs = $this->request->only('name','description','category');
        if(!$inputs['author'] = $this->request->get("author",NULL))
        {
            $inputs['author_detail']['photo'] = $this->request->file("author_detail.photo");
            $inputs['author_detail']['name'] = $this->request->input('author_detail.name');
        }
        else
        {
            $inputs['author'] =  base64_decode($inputs['author']);
        }
        //dd($inputs);
        $inputs['image'] = $this->request->file('image');
        $audio_input['audio']= $this->request->file('audio');
        $audio_input['audio_name']= $this->request->get('audio_name');
        $audio_input['audio_description']= $this->request->get('audio_description');
        if(count($audio_input['audio']) != count($audio_input['audio_name']) || count($audio_input['audio']) != count($audio_input['audio_description']))
        {
            abort('503','Invalid Request');
        }
        $inputs['slug'] = str_replace(' ', '_', strtolower(trim($inputs['name'])));
        //dd($audio_input['audio'][0]->getClientMimeType());
        $Playlistvalidator = Playlists::validation($inputs);
        $Audiovalidator = Audios::validation($audio_input);
        if ($Playlistvalidator->fails() || $Audiovalidator->fails())
        {
            $validationMessages = array_merge_recursive($Playlistvalidator->messages()->toArray(), $Audiovalidator->messages()->toArray());
            return redirect('coach/upload/audio/new')->withInput()->withErrors($validationMessages);
        }
        if(!PlaylistCategory::where(['id'=>$inputs['category'],'active'=>'1','created_by'=>Auth::guard('admin')->id()])->first())
        {
            $Playlistvalidator->errors()->add('category', 'Invalid category!');
            return redirect('coach/upload/audio/new')->withInput()->withErrors($Playlistvalidator);
        }
        $transaction = DB::transaction(function() use($inputs,$audio_input)
        {
           //insert query
            $inputs['description']=nl2br($inputs['description']);
            $inputs['created_by']=$inputs['updated_by']=Auth::guard('admin')->id();
            $inputs['category_id']=$inputs['category'];
            $inputs['active']='1';
            unset($inputs['category']);
            $jobIds=[];
            $playlist = Playlists::create($inputs);
            try
                {
                    $imageFileName = "/playlist/".$playlist->id."/".$playlist->slug."_".time() . '.' . $inputs['image']->getClientOriginalExtension();
                    $s3 = \Storage::disk('s3');
                    $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($inputs['image']), 'public');
                    $playlist->image = $imageFileName;
                    $playlist->save();   
                }
                catch (Exception $e)
                {
                    $Playlistvalidator->errors()->add('image', 'Something is wrong!, upload failed!');
                    return redirect('coach/upload/audio/new')->withInput()->withErrors($Playlistvalidator);
                }
                if(!$inputs['author'])
                {
                    if(isset($inputs['author_detail']['photo']) && ($inputs['author_detail']['photo']))
                    {
                        try
                        {
                            $imageFileName = "/playlist_author/".$playlist->id."/".$playlist->slug."_".time() . '.' . $inputs['author_detail']['photo']->getClientOriginalExtension();
                            $s3 = \Storage::disk('s3');
                            $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($inputs['author_detail']['photo']), 'public');
                            $inputs['author_detail']['photo'] = $imageFileName;
                            $playlist->author_detail = $inputs['author_detail'];
                            $playlist->save();   
                        }
                        catch (Exception $e)
                        {
                            $Playlistvalidator->errors()->add('author_detail.photo', 'Something is wrong!, upload failed!');
                            return redirect('coach/upload/audio/new')->withInput()->withErrors($Playlistvalidator);
                        }
                    }
                    else
                    {
                        $inputs['author_detail']['photo'] = '/profile/coach/defult.png';
                        $playlist->author_detail = $inputs['author_detail'];
                        $playlist->save();   
                    }
                }
                else
                {
                    $playlist->author = $inputs['author'];
                }
            for($i=0; $i<count($audio_input['audio_name']); $i++)
            {
                $audio = new Audios(
                    ['name'=>$audio_input['audio_name'][$i],'created_by'=>Auth::guard('admin')->id(),
                    'updated_by'=>Auth::guard('admin')->id(),'description'=>$audio_input['audio_description'][$i],'path'=>''
                    ]);
                $audio = $playlist->audios()->save($audio);
                //upload to s3

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
                    return redirect('coach/upload/audio/new')->withInput()->withErrors($Audiovalidator);
                    //throw new Exception('Not able to store file, details:' . $ex->getMessage());
                }
                $audio->path = $pathName.".m3u8";;
                $audio->save();
            }
                        return $jobIds;
        });
      return redirect('coach/upload/audios/jobs?jobids='.implode(',',$transaction));
    }
    public function edit($slug)
    {
        $playlist = Playlists::with('category','audios','createdby','custom_author','custom_author.profile')->whereHas('category',function($q){
                $q->where('active','1');
            })->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->orderBy('created_at', 'desc')->first();
        if(!$playlist)
        {
            abort(404);
        }
        $categories = PlaylistCategory::where(['created_by'=>Auth::guard('admin')->id(),'active'=>'1'])->get();
        return view('admin::audio.edit_form',['playlist'=>$playlist,'categories'=>$categories]);
    }
    public function editStore($slug){
        //to set memory limit for file 
        //dd($this->request->all());
        ini_set('memory_limit','1256M');
        $playlist = Playlists::with('category','audios','createdby')->where(['created_by'=>Auth::guard('admin')->id(),'slug'=>$slug])->orderBy('created_at', 'desc')->first();
        if(!$playlist)
        {
            abort(404);
        }
        $inputs = $this->request->only('name','description','category');
        if(!$inputs['author'] = $this->request->get("author",NULL))
        {
            $inputs['author_detail']['photo'] = $this->request->file("author_detail.photo");
            $inputs['author_detail']['name'] = $this->request->input('author_detail.name');
        }
        else
        {
            $inputs['author'] =  base64_decode($inputs['author']);
        }
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
        $inputs['slug'] = str_replace(' ', '_', strtolower(trim($inputs['name'])));
        //dd($audio_input['audio'][0]->getClientMimeType());
        $Playlistvalidator = Playlists::edit_validation($inputs,$playlist->id);
        $Audiovalidator = Audios::edit_validation($audio_input);
        if ($Playlistvalidator->fails() || $Audiovalidator->fails())
        {
            $validationMessages = array_merge_recursive($Playlistvalidator->messages()->toArray(), $Audiovalidator->messages()->toArray());
            //dd($validationMessages);
            return back()->withInput()->withErrors($validationMessages);
        }
        if(!PlaylistCategory::where(['id'=>$inputs['category'],'active'=>'1','created_by'=>Auth::guard('admin')->id()])->first())
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
                if(!$inputs['author'])
                {
                    if(isset($inputs['author_detail']['photo']) && ($inputs['author_detail']['photo']))
                    {
                        try
                        {
                            $imageFileName = "/playlist_author/".$playlist->id."/".$playlist->slug."_".time() . '.' . $inputs['author_detail']['photo']->getClientOriginalExtension();
                            $s3 = \Storage::disk('s3');
                            $s3->deleteDirectory(env('S3_ASSET_PATH','assets')."/playlist_author/".$playlist->id);
                            $s3->put(env('S3_ASSET_PATH','assets').$imageFileName, file_get_contents($inputs['author_detail']['photo']), 'public');
                            $inputs['author_detail']['photo'] = $imageFileName;
                            $playlist->author_detail = $inputs['author_detail'];
                            $playlist->save();   
                        }
                        catch (Exception $e)
                        {
                            $Playlistvalidator->errors()->add('author_detail.photo', 'Something is wrong!, upload failed!');
                            return redirect('coach/upload/audio/new')->withInput()->withErrors($Playlistvalidator);
                        }
                    }
                    else
                    {
                        $inputs['author_detail']['photo'] = $playlist->author_detail['photo'];
                        $playlist->author_detail = $inputs['author_detail'];
                        $playlist->save();   
                    }
                }
                else
                {
                    $playlist->author = $inputs['author'];
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
      return redirect('coach/upload/audios/jobs?jobids='.implode(',',$transaction));
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
        public function jobStatus()
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
                return redirect('coach/upload/audios');
            }
            //dd($jobs);
            return view('admin::audio.jobs',['jobs'=>$jobs]);
        }
        public function deletePlayist($slug)
        {
            $playlist = Playlists::where(['slug'=>$slug,'created_by'=>Auth::guard('admin')->id()])->first();
            if(!$playlist)
            {
                abort(404);
            }
            $playlist->delete();
        }
        public function activate_category($categoryId)
        {
            $id = base64_decode($categoryId);
            $category = PlaylistCategory::where(['id'=>$id,'created_by'=>Auth::guard('admin')->id()])->first();
            if(!$category)
            {
                abort(404);
            }
            $category->active = '1';
            $category->updated_by = Auth::guard('admin')->id();
            $category->save();
            return response()->json(['code'=>'success','text'=>'fa-eye','action'=>'my_category/deactivate/'.$categoryId]);
        }
        public function deactivate_category($categoryId)
        {
            $id = base64_decode($categoryId);
            $category = PlaylistCategory::where(['id'=>$id,'created_by'=>Auth::guard('admin')->id()])->first();
            if(!$category)
            {
                abort(404);
            }
            $category->active = '0';
            $category->updated_by = Auth::guard('admin')->id();
            $category->save();
            return response()->json(['code'=>'success','text'=>'fa-eye-slash','action'=>'my_category/activate/'.$categoryId]);
        }

        /*Audio Of Week*/
        public function audio_week()
        {
            $playlist           = AudioOfWeek::with('playlists')->paginate(10);
            $playlists_count    = AudioOfWeek::with('playlists')->count();            
            $data  = [
                        'playlist'         => $playlist,
                        'playlists_count'  => $playlists_count
                     ];
            return view('admin::audio.thisweek',$data);
        }

        /*Delete sogns form audio of week table*/
        public function deletelist($id = NULL)
        {
            $playlist  = AudioOfWeek::where('id',$id)->delete();
            return back();
        }

        /*Active and Inactive field*/
        public function activelist($id = NULL)
        {
            $playlist  = AudioOfWeek::where('id',$id)->first();
            if($playlist->active == 1){

                $playlist_status = AudioOfWeek::where('id',$id)->update(['active' => '0']);

            } else{

                $playlist_status = AudioOfWeek::where('id',$id)->update(['active' => '1']);

            }
            return back();
        }

        /* Audio of Search*/
        public function searchsongs(Request $request)
        {
             $query = $request->get('term','');
            $products=Playlists::where('name','LIKE','%'.$query.'%')->get();
            
            $data=array();
            foreach ($products as $product) {
                    $data[]=array('value'=>$product->name,'id'=>$product->id);
            }
            if(count($data))
                 return $data;
            else
                return ['value'=>'No Result Found','id'=>''];
        }

        /*Audio of week insert*/
        public function add_weeksong()
        {
            $insert_Arr  = $this->request->only('id','song_id');
            $validator =  AudioOfWeek::validation(['song_id'=>$insert_Arr['song_id']]);
            if($validator->fails())
                    {
                        return back()->withInput()->withErrors($validator);
                    }
            $products    = Playlists::where('name',$insert_Arr['song_id'])->first();
            if($insert_Arr['id']){

                $AudioOfWeek   =  AudioOfWeek::where('id',$insert_Arr['id'])->update(['playlist_id'=>$products->id,'updated_by'=>Auth::guard('admin')->id()]);

            } else {
                    if($products->id){
                        $validator =  AudioOfWeek::validation(['playlist_id'=>$products->id,'song_id'=>$insert_Arr['song_id']]);
                    } else {
                        $validator =  AudioOfWeek::validation(['playlist_id'=>'']);
                    }
                 if($validator->fails())
                    {
                        return back()->withInput()->withErrors($validator);
                    }

                $AudioOfWeek =  AudioOfWeek::create(['playlist_id'=>$products->id,'created_by'=>Auth::guard('admin')->id()]);

            }
            return back();
        }
}
