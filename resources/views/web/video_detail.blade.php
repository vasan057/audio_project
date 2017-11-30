@extends("web.main")
@section('css')
<link rel="stylesheet" href="{{asset('hls/video-js.css')}}">
@stop
@section('content')
@include('web.category')
<br></br>       <br></br>
<section class="dexel-video-innerpanel">
        <div class="container-fluid">
            <div class="row animate-box">
              <?php $url = $video->video_url;
            preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $url, $matches);
            $id = $matches[1]; ?>

              <video id="my-video" class="video-js vjs-default-skin" controls preload="auto" poster="{{cdn($video->cover_img)}}"
              data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://youtu.be/<?php echo $id; ?>"}] }'></video>
            </div>
        </div>
        <div class="dexel-inner-videoCntpanel">
            <div class="container">
                <div class="row animate-box dexel-inner-videoCntHeader">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h1 class="text-left">{{$video->title}}</h1>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="text-center"><span></span>{{$video->essence->title}}</label>
                        <label class="text-center"><span></span>{{$video->author}}</label>
                        <label class="pull-right"><span></span>{{$video->views->count()}}</label>
                    </div>
                </div>
                <div class="row animate-box dexel-inner-videoCnt">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p class="text-left">{{strip_tags($video->description)}}</p>
			   </div>
                </div>
                <div class="row animate-box dexel-feature-videoCnt">
                    <div class="col-md-12 col-sm-12 col-xs-12 dexel-feature-videoCntHeader">
                        <label>RELATED VIDEOS</label>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 ">
                        <div class="row">
                           <?php if(!empty($recent_videos)){ foreach($recent_videos as $video) { ?>
                            <a href="{{url('video/'.Crypt::encrypt($video->id))}}"><div class="col-md-5 col-sm-6 col-xs-12">

                                <div class="video-card animate-box">
                                    <div class="video-Badge"></div>
                                    <div class="img-Panel">
                                        <img src="{{cdn($video->cover_img)}}" class="img-responsive" alt="video-img">
                                    </div>
                                    <div class="content-Panel text-left">
                                        <h3><?php echo $video->title; ?></h3>
                                        <p><?php
										$description=strip_tags($video->description);
										$description = (strlen($video->description) > 137) ? substr($video->description,0,137)."..." : $description;
										echo $description; ?></p>
                                    </div>
                                    <div class="action-Panel container">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>40 mins</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>Lvl 2-5</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>{{$video->views->count()}}</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div> </a>
						   <?php } } ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
@section('javascript')
<script src="{{asset('assets/web/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/web/js/video-js.js')}}"></script>
<script src="{{asset('assets/web/js/youtube.js')}}"></script>
<script src="{{asset('assets/web/js/modernizr-2.6.2.min.js')}}"></script>
<!-- If you'd like to support IE8 -->
<script src="{{asset('assets/web/js/video-jsIE.js')}}"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->
<script src="{{asset('assets/frontend/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/main.js')}}"></script>
    <script src="{{asset('hls/video-js.js')}}"></script>
	<script src="{{asset('hls/youtube.js')}}"></script>
    <script src="{{asset('assets/frontend/js/owl.carousel.min.js.download')}}"></script>


<script type="text/javascript">

        $(document).ready(function() {

			$.getJSON('http://gdata.youtube.com/feeds/api/videos/<?php echo $id; ?>?v=2&alt=jsonc',function(data,status,xhr){
    alert(data.data.title);
    // data contains the JSON-Object below
});

              $("#owl-demo").owlCarousel({

                  navigation : true, // Show next and prev buttons
                  slideSpeed : 300,
                  paginationSpeed : 400,
                  singleItem:true,
				  autoplay:true,
				  loop:true

                  // "singleItem:true" is a shortcut for:
                  // items : 1,
                  // itemsDesktop : false,
                  // itemsDesktopSmall : false,
                  // itemsTablet: false,
                  // itemsMobile : false

              });

            });
@stop
