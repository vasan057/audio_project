@extends("web.main")
@section('css')
	<link rel="stylesheet" href="{{asset('hls/video-js.css')}}">
	<link rel="stylesheet" href="{{asset('hls/player.css')}}">
	<link rel="stylesheet" href="{{asset('hls/xplay.css')}}">
	<link rel="stylesheet" href="{{asset('hls/xbase.css')}}">
	<link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
	<link rel="stylesheet" href="{{asset('rating/fontawesome-stars.css')}}">
	<link rel="stylesheet" href="{{asset('share/jquery.sharebox.css')}}">
	<style type="text/css">
	#page-content-wrapper {display: none;}
	.footer-panel{ display:none;}
	</style>
@stop
@section('content')
<!-- xplayer starts -->
<div class="xplay-wrap">
	<div class="xplay-page">
		<!-- Header -->
		<div class="xplay-header">
			<h1 class="xplay-logo" >Stressfit player</h1>
			<a href="http://stressfit.com">GO TO WEBSITE</a>
			<div class="xplay-share-box">
				<p>SHARE</p>
				<div class="share xplay-share" id="dexel-sharebox" class="sharebox" data-services="facebook google+ linkedin twitter pinterest" ></div>
				<div class="clearboth"></div>	
			</div>
			<div class="clearboth"></div>
		</div>
		<!-- content -->
		<div class="xplay-content">
			<!-- top content box -->
			<!-- <div class="xplay-content-1">
				<div class="xplay-content-1-left">
					
				</div>
				<div class="xplay-content-1-right">
					
				</div>
				<div class="clearboth"></div>
			</div> -->
			<!-- main content box -->
			<div class="xplay-content-2">
				<!-- main content box left-->		
				<div class="xplay-content-2-left">
					<div class="xplay-playlist-title-desc xplay-content-1-left" id="audio_player_desc">

					</div>
					<div class="clearboth"></div>
					<span  class="xplay-readmore" id="playlist-desc-more" >READ MORE</span>
					
					<div class="xplay-card-list">
						@foreach($playlists as $playlist)
							@include('web.audio_card_new')
						@endforeach
					</div>
				</div>
				<!-- main content box right-->
				<div class="xplay-content-2-right" >
					<div class="xplay-content-iconset xplay-content-1-right">
						<div class="xplay-collection">
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
						<div class="xplay-rating">	
							<p>View Rating</p>
						</div>
						<p class="xplay-category  xplay-icon-text" style="background:url({{asset('categories/icn_category_'.$playlist->category->icon.'.png')}}) no-repeat left center; " > {{$playlist->category->title}}</p>
						<p class="xplay-listen xplay-icon-text" > 132</p> 
						<!-- Getting error on implementing count -->

						<div class="xplay-author">
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
							<div class="clearboth"></div>
						</div>
						<div class="clearboth"></div>
					</div>
					<div class="xplay-right-main">
						<div class="xplay-audio-title-desc" id="audio_player_singledesc">

						</div>
						<div class="xplay-ratencomment">
						@if(Auth::guard('user')->check())
                <div class="">
                    <div class="form-group form-rate">
                        <label>Rate</label>
                        <div class="form-rate-stars" id="rate-audio1">
                        </div>
                    </div>
                    <div class="form-group form-comment">
                        <label>Comment</label><br/>
                        <textarea id="audio_comment"></textarea>
                       
                    </div>
                    <div class="clearboth"></div>
                     <span id="audio_comment_result" style="display: block;"></span>
                    <button id="audio_comment_submit" type="submit" class="btn btn-default">Submit</button>
                </div>
			@else
			<span class="logintocomment">
			Please <a href="{{url('login')}}"  class="ltca">login</a> to rate.
			</span>
            @endif
						</div>
					</div>
						
				</div>
				<div class="clearboth"></div>
			</div>
			<div class="clearboth"></div>
		</div>
		<!-- player -->
		<div class="xplay-player">
			@include('web.audio_player')
		</div>
	</div>
</div>

	<div class="xplay-sidebox" id="xplay-sidebox" >
		<div class="xplay-sidebox-main">
		<!-- slidebox-1 -->
		<div class="xplay-sidebox-comment" id="xplay-sidebox-comment">
		<h3 class="xplay-sidebox-title">Comments</h3>
		{{-- Content here --}}
            <div class="audio-comment-list">
            <?php $isempty=1 ?>
                @foreach($playlist->audios as $audio)
                    @if($audio->ratings->count())
                        <?php $isempty=0; ?>
                        @foreach($audio->ratings as $rating)
                                <div class="audio-comment-each">
                                    <div class="audio-comment-each-left">
                                        
                                        <div class="audio-comment-each-author">
                                            <img src="{{cdn($rating->createdby->profile->photo)}}" alt="">
                                            <p>{{$rating->createdby->fname}}<span> {{date('d-m-Y',strtotime($rating->created_at))}}</span></p>
                                        </div>
                                    </div>
                                    <div class="audio-comment-each-right">
                                        <h3>{{$audio->name}}</h3>
                                        <p class="audio-comment-each-rating">
                                        {!! Form::select('rating',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'],$rating->rate,['class'=>'rating-readonly','slug'=>$playlist->slug,'autocomplete'=>'off'])!!}
                                        </p>

                                        @if($rating->comment)
                                            
                                            <p class="audio-comment-each-comment"><span class="audio-comment-each-rating-seperator"></span>{!!$rating->comment->comment!!}</p>
                                        @endif
                                    </div>
                                </div>
                        @endforeach
                    @endif
                @endforeach
                @if($isempty)
                    No Comments
                @endif
            </div>
			</div>
			<!-- slide box 2 -->
			<div class="xplay-sidebox-desc" id="xplay-sidebox-desc">
				<h3 class="xplay-sidebox-title">Playlist Description</h3>
				<div id="audio_player_fulldesc">
					
				</div>
			</div>
			
		</div>
		<div class="xplay-sidebox-left">
			<div class="xplay-sidebox-icon1" id="showbox" >
				<!-- <img src="{{asset('hls/images/xplay_menu.png')}}" alt=""> -->
			</div>
			<div class="xplay-sidebox-icon2" id="showbox-comment">
				<img src="{{asset('hls/images/xplay_feedback.png')}}" alt="">
				<!-- <p>12</p> -->
			</div>
			<div class="xplay-sidebox-icon2"  id="showbox-desc">
				<img src="{{asset('hls/images/xplay_info.png')}}" alt="">
				<!-- <p>14</p> -->
			</div>
		</div>
	</div>
	<!-- xplayer ends -->

	<div class="row home-audio-panel-inner">
	    
	    <div class="clearboth"> </div>
	</div>
	
	
	
@stop
@section('script')
	<script src="{{asset('hls/video.js')}}"></script>
	<script src="{{asset('hls/Youtube.min.js')}}"></script>
	<script src="{{asset('hls/videojs-contrib-hls.js')}}"></script>
	<script src="{{asset('hls/player_new.js')}}"></script>
	<script src="{{asset('rating/jquery.barrating.js')}}"></script>
	<script src="{{asset('rating/rating.js')}}"></script>
	<script src="{{asset('share/jquery.sharebox.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$("#audio_{{$audio_id}}").click();
			//$("#dexel-sharebox").sharebox();
		});
		
		$("#showbox").attr('data-right',$("#xplay-sidebox").css('right'));
		$("#showbox").click(function(){
			//$("#xplay-sidebox").css("left","100%");
			var right_pos = $("#xplay-sidebox").css('right');
			if(right_pos == '0px')
			{
				//close
				$("#showbox").addClass("xplay-arrow-out");
				$("#showbox").removeClass("xplay-arrow-in");
				$("#xplay-sidebox").animate({"right":$("#showbox").attr('data-right')}, "slow");
			}
			else
			{
				//open
				$("#showbox").addClass("xplay-arrow-in");
				$("#showbox").removeClass("xplay-arrow-out");
				$("#xplay-sidebox").animate({"right":"0px"}, "slow");
			}
		});

		$("#showbox-comment").click(function(){
			$("#xplay-sidebox").animate({"right":"0px"}, "slow");
			$('#xplay-sidebox-desc').hide();
			$('#xplay-sidebox-comment').show();
			var right_pos = $("#xplay-sidebox").css('right');
			if(right_pos == '0px')
			{
				//close
				$("#showbox").addClass("xplay-arrow-out");
				$("#showbox").removeClass("xplay-arrow-in");
				$("#xplay-sidebox").animate({"right":$("#showbox").attr('data-right')}, "slow");
			}
			else
			{
				//open
				$("#showbox").addClass("xplay-arrow-in");
				$("#showbox").removeClass("xplay-arrow-out");
				$("#xplay-sidebox").animate({"right":"0px"}, "slow");
			}
		});

		$("#showbox-desc, #playlist-desc-more").click(function(){
			$("#xplay-sidebox").animate({"right":"0px"}, "slow");
			$('#xplay-sidebox-comment').hide();
			$('#xplay-sidebox-desc').show();
			var right_pos = $("#xplay-sidebox").css('right');
			if(right_pos == '0px')
			{
				//close
				$("#showbox").addClass("xplay-arrow-out");
				$("#showbox").removeClass("xplay-arrow-in");
				$("#xplay-sidebox").animate({"right":$("#showbox").attr('data-right')}, "slow");
			}
			else
			{
				//open
				$("#showbox").addClass("xplay-arrow-in");
				$("#showbox").removeClass("xplay-arrow-out");
				$("#xplay-sidebox").animate({"right":"0px"}, "slow");
			}
		});



		

	</script>
@stop