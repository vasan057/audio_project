@extends("admin::main")
@section('css')
<link rel="stylesheet" href="{{asset('hls/video-js.css')}}">
<link rel="stylesheet" href="{{asset('hls/player.css')}}">
<link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
<link rel="stylesheet" href="{{asset('rating/fontawesome-stars.css')}}">
<style>
  .dexel-header-bg{ display: none;}
</style>

@stop
@section('content')
  <div class="profilex container-fluid">
    <div class="profilex-banner row">
      <img src="{{cdn($coach->profile->cover_img)}}" />
      <p>{{$coach->profile->tag_line}}</p>
        <div class="profilex-streak"></div>
    </div>
    <div class="profilex-inner row">
      <div class="col-md-3 col-md-offset-1 profilex-left">  
            <div class="profilex-photo"> 
                <img src="{{cdn($coach->profile->photo)}}"alt="img"><!-- profile image -->
            </div>
            <h3 class="profilex-name"> {{$coach->fname}} {{$coach->lname}}</h3><!-- profile name -->
             
            <div class="profilex-left-count"> 
                <a class="profilex-left-audio "  href="{{url('coach/'.base64_encode($coach->id).'/upload/audios')}}" > 
                    <span class="profilex-icn profilex-left-audio-icn">  </span>
                    <p> {{$count['playlists']}}</p><!-- profile audio count -->
                </a>
                <!-- <a class="profilex-left-video"> 
                    <span class="profilex-icn profilex-left-video-icn">  </span>
                    <p> {{$count['videos']}}</p>profile video count
                </a>
                <a class="profilex-left-article"> 
                    <span class="profilex-icn profilex-left-article-icn">  </span>
                    <p> {{$count['articles']}}</p>profile article count
                </a> -->
            </div>
            <div class="clearboth"></div>
            <div class="profilex-left-social"> 
                @if($coach->profile->social_link['facebook'])<a href="{{$coach->profile->social_link['facebook']}}" class="profilex-social-i profilex-i-fb"></a>
                @endif
                @if($coach->profile->social_link['gplus'])<a href="{{$coach->profile->social_link['gplus']}}" class="profilex-social-i profilex-i-gp"></a>
                @endif
                @if($coach->profile->social_link['twitter'])<a href="{{$coach->profile->social_link['twitter']}}" class="profilex-social-i profilex-i-tr"></a>
                @endif
                @if($coach->profile->social_link['instagram'])<a href="{{$coach->profile->social_link['instagram']}}" class="profilex-social-i profilex-i-insta"></a>
                @endif

             </div>
             <div class="clearboth"></div>
            <div class=" col-md-12 profilex-follower">
                <p class="pull-left"> Followers: <span> {{$coach->followers->count()}}</span></p>
                <div class="clearboth"></div>
            </div>
              <div class="clearboth"></div>

      </div>
       <div class="col-md-7 profilex-right">  
      
        <div class="col-md-12  profilex-expertisebox">
            <h4>Expertise</h4>
            <ul class="profilex-expertise">
               @foreach($coach->expertise as $expertise)
                <li><img src="{{asset('expertise/images/'.str_replace(' ', '_', strtolower(trim($expertise->title))).'.png')}}" alt=""> <p>{{$expertise->title}}</p></li>
               @endforeach
               @if($coach->custom_expertise->count())
                  @foreach($coach->custom_expertise as $custom_expertise)
                    <li> <img src="{{asset('expertise/images/default.png')}}" alt="">  <p>{{$custom_expertise->title}}</p></li>
                  @endforeach
               @endif
            </ul>
          </div>
          <div class="clearboth"></div>
          <div class=" col-md-12 profilex-about">
            <h4>ABOUT</h4>
            <p>{!!$coach->profile->about!!}</p>
          </div>
          <div class="clearboth"></div>
          <div class=" col-md-12 profilex-sample">
            <h4>Libraries</h4>
            <div class="row" id="playlists">

                        @foreach($recent['playlists'] as $playlist)
                            @include('web.audio_card')
                        @endforeach
                        <div class="clearboth"></div> <br/>
                        <div class="col-md-12  profilex-viewbtn">
                        <a class="btn btn-primary btn-lg"  href="{{url('coach/'.base64_encode($coach->id).'/upload/audios')}}" >View All</a>
                        </div>
                        <div class="clearboth"></div>
                    </div>
          </div>
      </div>
      <div class="clearboth"> </div>

    </div>
  </div>
  @include('web.audio_player')
@stop
@section('script')
<script src="{{asset('hls/video.js')}}"></script>
<script src="{{asset('hls/videojs-contrib-hls.js')}}"></script>
<script src="{{asset('hls/player.js')}}"></script>
<script src="{{asset('rating/jquery.barrating.js')}}"></script>
<script src="{{asset('rating/rating.js')}}"></script>
@stop