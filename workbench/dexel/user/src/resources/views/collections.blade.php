@extends("web.main")
@section('css')
    <link rel="stylesheet" href="{{asset('hls/video-js.css')}}">
    <link rel="stylesheet" href="{{asset('hls/player.css')}}">
    <link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
    <link rel="stylesheet" href="{{asset('rating/fontawesome-stars.css')}}">
@stop
@section('content')
<!-- |===[:::::::::::::> New header section start -->
<div class="streak_header_space shs_collection"></div>
    <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">
    <div class="streak_header sh-collection col-md-12">
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
            <h2 class="pull-right">My Collection</h2>
       </div>
       <div class="clearboth"></div>
        <span class="streak-header-space shs-collection"></span>
    </div>
<!-- |===[:::::::::::::> New header section end -->

<div class="col-md-12 text-center">
    <div class="article-science-inner inner-pagemenu audio-page">                              
        <div class="clearboth"> </div>
    </div>
</div>
 <div class="clearboth"> </div>
<section class="container dexel-audio-maincontainer " id="playlists" style="padding-top:40px;">
    <div class="row">
            <!-- list -->
            @if($collections->count())
             @foreach($collections as $collection)
                <?php $playlist = $collection->playlists;?>
                @include('web.audio_card')
             @endforeach
             @else
             <p>Oh! It doen't look like you have any playlists added to your collections. Click the " + " under any playlist on the website to add it to your collections page. That way you can access your favourite playlists easily at any time.</p>
            @endif
        </div>

</section>
{{ $collections->links() }}
@include('web.audio_player')
{{-- <div class="gototop js-top">
  <a href="#" class="js-gotop"><i class="fa fa-long-arrow-up"></i></a>
</div> --}}
@stop
@section('script')
    <script src="{{asset('hls/video.js')}}"></script>
    <script src="{{asset('hls/Youtube.min.js')}}"></script>
    <script src="{{asset('hls/videojs-contrib-hls.js')}}"></script>
    <script src="{{asset('hls/player.js')}}"></script>
    <script src="{{asset('rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('rating/rating.js')}}"></script>
@stop
