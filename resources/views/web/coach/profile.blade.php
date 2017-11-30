@extends("web.main")
@section('css')
<link rel="stylesheet" href="{{asset('assets/coach/css/style.css')}}">
<link rel="stylesheet" href="{{asset('hls/video-js.css')}}">
<link rel="stylesheet" href="{{asset('hls/player.css')}}">
<link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
<link rel="stylesheet" href="{{asset('rating/fontawesome-stars.css')}}">
@stop
@section('content')
     <!--   <:::::::::::::]==|  New profile page   |===[:::::::::::::>   -->
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
                <a class="profilex-left-audio "  href="{{url('coache/'.base64_encode($coach->id).'/audios')}}" >
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
            <p class="pull-left "> Followers: <span> {{$coach->followers->count()}}</span></p>  <!-- follower count -->
            <div class="clearboth"></div>
            @if(Auth::guard('user')->check())
                @if($follow)
                  <button class="btn btn-primary btn-lg" id="follow_coach" data-action="{{base64_encode($coach->id)}}/remove"> Unfollow </button>
                @else
                  <button class="btn btn-primary btn-lg" id="follow_coach" data-action="{{base64_encode($coach->id)}}"> Follow </button>
                @endif
            @else
              <a class="btn btn-primary btn-lg" href="{{url('login')}}"> Follow </a>
            @endif
            <div class="clearboth"></div>
          </div>

      </div>
       <div class="col-md-7 profilex-right">
         
          <div class="clearboth"></div>
          <div class=" col-md-12 profilex-expertisebox">
            <h4>EXPERTISE</h4>
            <ul class="profilex-expertise">
               @foreach($coach->expertise as $expertise)
                <li> <img src="{{asset('expertise/images/'.str_replace(' ', '_', strtolower(trim($expertise->title))).'.png')}}" alt="">  <p>{{$expertise->title}}</p></li>
               @endforeach
               @if($coach->custom_expertise->count())
                  @foreach($coach->custom_expertise as $custom_expertise)
                    <li> <img src="{{asset('assets/coach/images/expertise_default.png')}}" alt="">  <p>{{$custom_expertise->title}}</p></li>
                  @endforeach
               @endif
            </ul>
          </div>
          <div class="clearboth"></div>
          <div class=" col-md-12 profilex-about">
            <h4>ABOUT</h4>
            <p>{!!$coach->profile->about!!}</p>
          </div>
          <div class=" col-md-12 profilex-sample">
            <h4>Library</h4>
            <div class="row" id="playlists">

                        @foreach($recent['playlists'] as $playlist)
                        <?php $playlist_count=0; ?>
                          @include('web.audio_card')
                        @endforeach
                        <div class="clearboth"></div>
                        <br/>
                        <div class="col-md-12 profilex-viewbtn">
                        <a class="btn btn-primary btn-lg"  href="{{url('coache/'.base64_encode($coach->id).'/audios')}}" >View All</a>
                        </div>
                        <div class="clearboth"></div>
                    </div>
          </div>
          {{--<div class=" col-md-12 profilex-comments">
            <h4>Recent Comments</h4>
            <div class="audio-comment-each">
              @foreach($recent['comments'] as $comment)
              <h3>{{$comment->audio->name}}</h3>
                <p>{!!$comment->comment!!}</p>
                <div class="audio-comment-each-author">
                    <img src="{{cdn($comment->createdby->profile->photo)}}" alt="">
                    <p>{{$comment->createdby->fname}}<span> - {{date('d-m-Y',strtotime($comment->created_at))}}</span></p>
                </div>
              @endforeach
            </div>
          </div>--}}
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#follow_coach').click(function(event) {
      /* Act on the event */
      current_div = $(this);
        action = current_div.attr('data-action');
      $.ajax({
        url: base_url+'/follow/'+action,
        type: 'POST',
        dataType: 'json',
        data: {'_token': csrf_token},
      })
      .done(function(data) {
        if(data.code == 'success')
        {
          current_div.html(data.text);
          current_div.attr('data-action',data.action);
        }
      })
      .fail(function() {
        //console.log("error");
      })
      .always(function() {
        //console.log("complete");
      });

    });
  });
</script>
@stop
