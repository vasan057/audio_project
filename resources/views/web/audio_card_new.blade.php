<?php $playlist_count=0; ?>
<div class="animate-box dexel-audio-card-each" data-animate-effect="fadeIn">
{{-- CARD --}}
{{-- add "dac-locked" class name below to lock the card --}}
    <div class="dexel-audio-card ">
       <div class="dexel-flipContainer">
            <div class="dexel-flipcard">
            {{-- CARD - Frontside - start --}}
                <div class="face front">
                    {{--== set background image here dexel-audio-grp ==--}}
                     <div class="dexel-audio-grp" style="background:url({{cdn($playlist->image)}}) no-repeat center center; background-size: cover;">
                     {{--   <img class="img-dac-front" src="{{asset('assets/web/images/meditation-bg.jpg')}}"> --}}
                       <div class="img-dac-front-overlay"></div>
                        <div class="dexel-audio-imagepanel ">
                            <div class="postCount col-md-12 text-left">
                                <b title="No of Audios"><img src="{{asset('assets/playlist/images/icn_music.png')}}" alt="playlist" ></b>
                                <span>{{$playlist->audios->count()}}</span>
                                <!-- <b><img src="{!!$playlist->image!!}" alt="music"></b> -->

                            </div>
                        </div>
                        <div class="dexel-audio-Contentpanel col-md-12 ">
                            <h3>{{$playlist->name}}</h3>
                           <!--  <p>by&nbsp;{{$playlist->createdby->fname}}</p> -->
                        </div>
                        <!--<div class="dexel-audio-hovercontent">
                            <span>
                            <p>{!!$playlist->description!!}</p>
                            </span>
                        </div
                         <i class="dexel-flipper dexel-audio-card-play" title="Selct Audio & Play" >
                            <span class="dexel-audio-play-ring"></span>
                            <span class="dexel-audio-play-ring2"></span>
                            <img src="{{asset('assets/playlist/images/icn_play.png')}}" alt="music">
                        </i> >-->
                    </div>

                </div>
                {{-- CARD - Frontside - end --}}
                {{-- CARD - backside - start --}}
                <div class="face back">
                    <div class="col-md-12 dexel-audio-backpanel">
                        <i title="Flip card" class="dexel-flipper dexel-audio-card-flip"><img src="{{asset('assets/playlist/images/icn_flip.png')}}" alt="music"></i>
                        <p class="col-md-12 text-left">{{$playlist->name}}</p>
                        <div class="dexel-audio-list">

                            <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                            <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                                <div class="jp-type-playlist">
                                    <div class="jp-playlist">
                                        <ul><?php $avg_count = 0;  $rating_avg = 0;?>
                                            @foreach($playlist->audios as $audio)
                                                <li class="play_audio_new" id="audio_{{$audio->id}}" data-url="{{'playlist/'.$playlist->id.'/audio/'.$audio->id}}">{{$audio->name}}</li>
                                                <?php
                                                $playlist_count += $audio->views->count();
                                                if($avg = ceil($audio->ratings()->avg('rate')))
                                                {
                                                    $avg_count++;
                                                    $rating_avg += $avg;
                                                }
                                                ?>
                                            @endforeach
                                        </ul>
                                        <span style="position: absolute; left: 50px;    bottom: 10px;    color: #fbb9f9; ">*click on a title to play*</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- CARD - backside - end --}}
                {{-- card-lock  overlay  --}}
                 <div class="dexel-audio-card-lock">
                  <a href="#" class="btn-general"> Register to unlock </a>
                  </div>
                 {{-- card-lock    --}}
            </div>
            <div class="row ">
            <div class="col-md-12 ">
            <div class="col-md-12 dexel-audio-card-rating-outer" style="display:none;" >
                <?php
                if($avg_count)
                {
                    $avg_rate=ceil($rating_avg / $avg_count);
                }
                else
                {
                    $avg_rate=$rating_avg;
                }
                ?>
                <div class="col-md-8 col-xs-8 dexel-audio-card-rating" title="Rating" >
                    {!! Form::select('rating',[''=>'','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'],$avg_rate,['class'=>'rating-readonly','slug'=>$playlist->slug,'autocomplete'=>'off'])!!}
                </div>
                <div class=" col-md-4 col-xs-4 dexel-audio-collection">
                    @if(Auth::guard('user')->check())
                        <?php if($playlist->mycollections->count())
                        {
                            $action="remove";
                        }
                        else
                        {
                            $action="add";
                        }
                        ?>
                        <div title="Add to Collection" class="col-md-12 col-sm-12 col-xs-12 add_collection {{$action}}" data-action="{{$action}}" data-id="{{$playlist->id}}">
                            <label>Add to Collection</label>
                        </div>
                    @elseif(!Auth::guard('admin')->check())
                        <div title="Add to Collection" class="col-md-4 col-sm-4 col-xs-4 add_collection_login audio-panel-locked"  data-img="{{cdn($playlist->image)}}" data-title="{{$playlist->name}}">
                            <label>Add to Collection</label>
                        </div>
                    @endif
                </div>
                <div class="clearboth"></div>
                </div>
                </div>
            </div>
            <!-- <div class="dexel-audio-actionpanel">
                <div class="col-md-4 col-sm-4 col-xs-4">
                    <div class="dexel-audio-profile" title="Author name">
                        <?php if(Auth::guard('admin')->check())
                        {
                            if(Auth::guard('admin')->user()->usertype == 'admin')
                            {
                                $url = url('coach/profile').'/';
                            }
                            else
                            {
                                $url = url('coach/profile').'?';
                            }
                        }
                        else
                        {
                            $url = url('coache').'/';
                        }
                        ?>
                            @if($playlist->author)
                                <a href="{{$url.base64_encode($playlist->author)}}"><img class="img-circle" src="{{cdn($playlist->custom_author->profile->photo)}}" alt="profile">
                                <label>{{$playlist->custom_author->fname}}</label>
                                </a>
                             @elseif($playlist->author_detail['name'])
                                <img class="img-circle" src="{{cdn($playlist->author_detail['photo'])}}" alt="profile">
                                <label>{{$playlist->author_detail['name']}}</label>
                             @else 
                                <a href="{{$url.base64_encode($playlist->created_by)}}"><img class="img-circle" src="{{cdn($playlist->createdby->profile->photo)}}" alt="profile">
                                <label>{{$playlist->createdby->fname}}</label>
                                </a>
                            @endif
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="dexel-audio-profile" title="No of times Listened">
                        <img class="heartin" src="{{asset('assets/web/images/sf_listen.png')}}" alt="profile">
                        <label>{{$playlist_count}}</label>
                    </div>
                   
                </div>
                <div class="col-md-5 col-sm-5 col-xs-5">
                    <div class="dexel-audio-profile" title="Category ">
                        <img class="relax" src="{{asset('categories/icn_category_'.$playlist->category->icon.'.png')}}" alt="category">
                        <label>{{$playlist->category->title}}</label>
                    </div>
                </div> 
               
                <div class="clearboth"></div>
            </div> -->
        </div>
    </div>
    <div class="xplay-playlist jp-playlist">
    <h5>Playlist</h5>
    <ul>
    <?php $avg_count = 0;  $rating_avg = 0;?>
    @foreach($playlist->audios as $audio)
        <li class="play_audio_new" id="audio_{{$audio->id}}" data-url="{{'playlist/'.$playlist->id.'/audio/'.$audio->id}}">{{$audio->name}}</li>
        <?php
        $playlist_count += $audio->views->count();
        if($avg = ceil($audio->ratings()->avg('rate')))
        {
            $avg_count++;
            $rating_avg += $avg;
        }
        ?>
    @endforeach
</ul>
</div>
<div class="clearboth"></div>
</div>

