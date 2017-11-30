@extends("web.main")
@section('css')
    <link rel="stylesheet" href="{{asset('hls/video-js.css')}}">
    <link rel="stylesheet" href="{{asset('hls/player.css')}}">
    <link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
    <link rel="stylesheet" href="{{asset('assets/coach/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
    <link rel="stylesheet" href="{{asset('rating/fontawesome-stars.css')}}">
@stop
@section('content')
<!-- |===[:::::::::::::> New header section start -->
    <!--<img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">-->
    <div class="streak_header col-md-12">
       <div class="webx-page-title pull-right" >
           <div class="header-character pull-right">
           <div class="halo">
                    <span class="halo_ring1"></span>
                    <span class="halo_ring2"></span>
                    <span class="halo_ring3"></span>
                    <span class="halo_ring4"></span>
                </div>
                <div class="char_music_right">
                    <img src="{{asset('assets/web/images/icn_music_white.png')}}" class="char_music1" alt="">
                    <img src="{{asset('assets/web/images/icn_music_cyan.png')}}" class="char_music2" alt="">
                </div>
                <div class="char_music_left">
                    <img src="{{asset('assets/web/images/icn_music_white.png')}}" class="char_musicleft1" alt="">
                    <img src="{{asset('assets/web/images/icn_music_cyan.png')}}" class="char_musicleft2" alt="">
                </div>
               <img src="{{asset('assets/web/images/header-character-audio.png')}}" class="header-character-char" alt="">
            </div>
            <h2 class="pull-right coach-playlist-title">Coach Playlist</h2>
       </div>
       <div class="clearboth"></div>
        <span class="streak-header"></span>
    </div>
<!-- |===[:::::::::::::> New header section end -->
<div class="coach-audio-profile-header">
    <div class="dexel-coach-describeHeader pull-left">
    <a  href="{!!url('coache/'.base64_encode($coach->id))!!}">
        <img src="{{cdn($coach->profile->photo)}}" class="img-circle" alt="img">
        <label class="pull-left">{{$coach->fname}} {{$coach->lname}}</label>
        </a>
     </div>

     </div>
    <div class="article-science-inner inner-pagemenu audio-page">

      <div class="clearboth"></div>
        @if($categories->count())
        @foreach($categories as $category)
         <?php $active_class = ""; if($categoryTitle == $category->title) { $active_class= 'lse_high'; } ?>
         <a class="l-s-each {{$active_class}}  essense" data-id="1"  href="{{url('coache/'.base64_encode($coach->id).'/audios/'.$category->title)}}">
                        <span class="high-flower active"></span>
                    <div class="l-s-each_inner ">

                        <div class="l-s-each_icn">
                            <img src="{{asset('categories/icn_category_'.$category->icon.'.png')}}" alt="" width="60" height="60">
                        </div>
                        <p>{{$category->title}}</p>
                    </div>
                </a>
        @endforeach
        @else
            <p>Please stay tuned, new content will be available soon.</p>
        @endif
        <div class="clearboth"> </div>
    </div>

<section class="container dexel-audio-maincontainer" id="playlists" style="padding-top:40px;">
    <div class="row">
            <!-- list -->
            <?php $access_limit=4; $access_count=1; ?>
             @foreach($playlists as $playlist)
             <?php
                $playlist_count=0;
                if(!Auth::guard('user')->check())
                {
                    if(($access_count > $access_limit) || (app('request')->input('page') >= 1))
                    {
                        //display as locked resource
                    ?>

                        <div class="col-md-3 col-sm-4 col-xs-12 animate-box" data-animate-effect="fadeIn">
                        {{-- CARD --}}
                            <div class="dexel-audio-card audio-panel-locked" data-img="{{cdn($playlist->image)}}" data-title="{{$playlist->name}}">
                                    <div class="dexel-audio-grp" style="background:url({{cdn($playlist->image)}}) no-repeat center center; background-size: cover;">
                                     {{--   <img class="img-dac-front" src="{{asset('assets/web/images/meditation-bg.jpg')}}"> --}}
                                       <div class="img-dac-front-overlay"></div>
                                        <div class="dexel-audio-imagepanel-locked">
                                            <div class="postCount col-md-12 text-left">
                                                <b><img src="{{asset('assets/playlist/images/icn_music.png')}}" alt="music"></b>
                                                <span>{{$playlist->audios->count()}}</span>
                                                <!-- <b><img src="{!!$playlist->image!!}" alt="music"></b> -->

                                            </div>
                                        </div>
                                        <div class="dexel-audio-Contentpanel col-md-12 ">
                                            <h3>{{$playlist->name}}</h3>
                                            <!-- <p>by&nbsp;{{$playlist->createdby->fname}}</p> -->
                                        </div>
                                        {{-- lock overlay --}}
                                        {{-- <div class="dexel-audio-card-locked-overlay">
                                            <a href="{{url('login')}}" class="btn-general"> Register to unlock </a>
                                        </div> --}}

                                    </div>
                                      <div class="dexel-audio-actionpanel">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="dexel-audio-profile">
                                                    <img class="img-circle" src="{{asset('assets/web/images/yoga.jpeg')}}" alt="profile">
                                                    <label>{{$playlist->createdby->fname}}</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="dexel-audio-profile">
                                                    <img class="heartin" src="{{asset('assets/web/images/sf_listen.png')}}" alt="profile">
                                                    <label>234</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="dexel-audio-profile">
                                                    <img class="relax" src="{{asset('categories/icn_category_'.$playlist->category->icon.'.png')}}" alt="category">
                                                    <label>{{$playlist->category->title}}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    <?php   continue;   }  $access_count++;   }   ?>
                @include('web.audio_card')
            @endforeach
            <!-- list -->

        </div>

</section>
{{ $playlists->links() }}
@include('web.audio_player')
@stop
@section('script')
    <script src="{{asset('hls/video.js')}}"></script>
    <script src="{{asset('hls/Youtube.min.js')}}"></script>
    <script src="{{asset('hls/videojs-contrib-hls.js')}}"></script>
    <script src="{{asset('hls/player.js')}}"></script>
    <script src="{{asset('rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('rating/rating.js')}}"></script>
@stop
