@extends("web.main")
@section('css')
    <link rel="stylesheet" href="{{asset('hls/video-js.css')}}">
    <link rel="stylesheet" href="{{asset('hls/player.css')}}">
    <link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
    <link rel="stylesheet" href="{{asset('rating/fontawesome-stars.css')}}">
    <style type="text/css">
    .dexel-header-bg
    {
        display: none;
    }
    .dexel-slide-img:hover
    {
        cursor: pointer;
    }
    .slick-prev , .slick-next
    {
        z-index: 9999;
    }



.sidebar-brand-logo{ display:none; }
.landing_logo_main img { display:none;}
.hamburger.is-closed{ left:-40px;}

    </style>
@stop
@section('content')
        <header id="dexel-header">
            <div class="landing_new">
                <div class="landing-bg-container">
                    <img class="landing-bg2 lb_default" src="{{asset('assets/web/images/bg_attract_b.png')}}">
                    <img class="landing-bg1 lb_default" src="{{asset('assets/web/images/bg_attract_a.png')}}">
                    <img class="landing-bg2 lb_768" src="{{asset('assets/web/images/bg_attract_b_768.png')}}">
                    <img class="landing-bg1 lb_768" src="{{asset('assets/web/images/bg_attract_a_768.png')}}">
                    <img class="landing-bg2 lb_1366" src="{{asset('assets/web/images/bg_attract_b_1366.png')}}">
                    <img class="landing-bg1 lb_1366" src="{{asset('assets/web/images/bg_attract_a_1366.png')}}">
                </div>
                    
                    
                <!-- landing section first ==============================================-->
                <div class="landing_attract">
                    <div class="landing_attract_inner">
                    <img src="{{asset('assets/web/images/landing_new_logo.png')}}" class="landing-new-logo" alt="">
                    <div class="clearboth"></div>
                    <div class="landing_attract_left">
                         <!-- landing section left ==================================-->
                        <h3>Audios of the week</h3>
                        <div class="landing_attract_each_inner">
                            @foreach($audiofweek as $value)
                                @foreach($value->audios as $audio)
                            <div class="landing_attract_card">
                                <div class="landing-imgcontainer">
                                    <img src="{{asset('assets/web/images/pow.jpg')}}" alt="">
                                    <span class="img-hover play_audio"  data-url="{{'player/'.$value->id.'/audio/'.$audio->id}}"></span>
                                </div>

                                <h4>{{$value->name}}</h4>
                                <span>By 
                                       @if($value->author)
                                            {{$value->custom_author->fname}}
                                        @elseif($value->author_detail['name'])
                                            {{$value->author_detail['name']}}
                                        @else 
                                            {{$value->createdby->fname}}
                                        @endif
                                </span>
                            </div>
                                @endforeach
                            @endforeach
                            <!-- <div class="landing_attract_card">
                                <div class="landing-imgcontainer">
                                    <img src="{{asset('assets/web/images/pos.jpg')}}" alt="">
                                    <span class="img-hover"></span>
                                </div>

                                <h4>Power of Positivity</h4>
                                <span>By Elliot</span>
                            </div> -->
                            <div class="clearboth"></div>
                        </div>
                    </div>
                    <div class="landing_attract_right">
                         <!-- landing section right  ===============================-->
                        <h3>Audios comming soon</h3>
                        <div class="landing_attract_each_inner">
                            <div class="landing_attract_card">
                                <div class="landing-imgcontainer">
                                    <img src="{{asset('assets/web/images/spirit.png')}}" alt="">
                                    <span class="img-hover"></span>
                                </div>
                                
                                <h4>Spiritual Warrior</h4>
                                <span>By Elliot</span>
                            </div>
                            <div class="landing_attract_card">
                            <div class="landing-imgcontainer">
                                    <img src="{{asset('assets/web/images/trans.jpg')}}" alt="">
                                    <span class="img-hover"></span>
                                </div>

                                <h4>Transcend Boredom</h4>
                                <span>By Elliot</span>
                            </div>
                            <div class="clearboth"></div>
                        </div>
                    </div>
                    <div class="clearboth"></div>
                    <div class="scroll_icn">
                    
                </div> 
                    </div>
                </div>
                <!-- landing section 2 character  ===============================-->
                <div class="landing_outer landing_outer_new">

                <div class="landing">
                     <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo_home" alt="">
                  <div class="character">
                        <img class="enso" src="{{asset('assets/web/images/enso.png')}}" alt="">
                        <img class="hand_left_3" src="{{asset('assets/web/images/hand_left_3.png')}}" alt="">
                        <img class="hand_left_1" src="{{asset('assets/web/images/hand_left_1.png')}}" alt="">
                        <img class="hand_left_2" src="{{asset('assets/web/images/hand_left_2.png')}}" alt="">
                        <img class="hand_right_3" src="{{asset('assets/web/images/hand_right_3.png')}}" alt="">
                        <img class="hand_right_1" src="{{asset('assets/web/images/hand_right_1.png')}}" alt="">
                        <img class="hand_right_2" src="{{asset('assets/web/images/hand_right_2.png')}}" alt="">
                        <img src="{{asset('assets/web/images/characteer.png')}}" class="ch_body" alt="">
                        <!-- <a href="{{url('articleCategory/'.Crypt::encrypt('meditation'))}}">
                            <div class="hand_box_left1 hbl">

                                <img class="glow_ball" src="{{asset('assets/web/images/principle2_char.png')}}">
                                 <p class="hand-text"> Meditation</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('diet'))}}">

                            <div class="hand_box_left2 hbl">

                                <img class="glow_ball" src="{{asset('assets/web/images/principle3_char.png')}}">
                                <p class="hand-text"> Diet</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('self development'))}}">

                            <div class="hand_box_left3 hbl">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle4_char.png')}}">
                                <p class="hand-text"> Self Development</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('fitness'))}}">

                            <div class="hand_box_right1 hbr">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle5_char.png')}}">
                                <p class="hand-text"> Fitness</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('detox'))}}">

                            <div class="hand_box_right2 hbr">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle6_char.png')}}">
                                <p class="hand-text"> Detox</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('mindful living'))}}">

                            <div class="hand_box_right3 hbr">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle7_char.png')}}">
                                <p class="hand-text"> Mindful Living</p>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div> <!-- landing outer div end -->

            <!-- landing section 2 character  end ===============================-->

             </div> <!-- landing_new div end -->

            <div class="landing_outer" style="display:none;">

                <div class="landing">
                     <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo_home" alt="">
                  <div class="character">
                        <img class="enso" src="{{asset('assets/web/images/enso.png')}}" alt="">
                        <img class="hand_left_3" src="{{asset('assets/web/images/hand_left_3.png')}}" alt="">
                        <img class="hand_left_1" src="{{asset('assets/web/images/hand_left_1.png')}}" alt="">
                        <img class="hand_left_2" src="{{asset('assets/web/images/hand_left_2.png')}}" alt="">
                        <img class="hand_right_3" src="{{asset('assets/web/images/hand_right_3.png')}}" alt="">
                        <img class="hand_right_1" src="{{asset('assets/web/images/hand_right_1.png')}}" alt="">
                        <img class="hand_right_2" src="{{asset('assets/web/images/hand_right_2.png')}}" alt="">
                        <img src="{{asset('assets/web/images/characteer.png')}}" class="ch_body" alt="">
                        <!-- <a href="{{url('articleCategory/'.Crypt::encrypt('meditation'))}}">
                            <div class="hand_box_left1 hbl">

                                <img class="glow_ball" src="{{asset('assets/web/images/principle2_char.png')}}">
                                 <p class="hand-text"> Meditation</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('diet'))}}">

                            <div class="hand_box_left2 hbl">

                                <img class="glow_ball" src="{{asset('assets/web/images/principle3_char.png')}}">
                                <p class="hand-text"> Diet</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('self development'))}}">

                            <div class="hand_box_left3 hbl">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle4_char.png')}}">
                                <p class="hand-text"> Self Development</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('fitness'))}}">

                            <div class="hand_box_right1 hbr">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle5_char.png')}}">
                                <p class="hand-text"> Fitness</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('detox'))}}">

                            <div class="hand_box_right2 hbr">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle6_char.png')}}">
                                <p class="hand-text"> Detox</p>
                            </div>
                        </a>
                        <a href="{{url('articleCategory/'.Crypt::encrypt('mindful living'))}}">

                            <div class="hand_box_right3 hbr">
                                <img class="glow_ball" src="{{asset('assets/web/images/principle7_char.png')}}">
                                <p class="hand-text"> Mindful Living</p>
                            </div>
                        </a> -->
                    </div>
                </div>
            </div>




        <span class="streak_bottom_1"></span>
        </header>
        <section class="main-container home-content-section-1">
            <div id="dexel-circularImg-panel" style="display: none;">
                <div class="container" >
                    <div class="row animate-box">
                        <div class="col-md-10 col-md-offset-1 text-center dexel-heading">
                            <h2 style="text-transform: none;">Be Stress Free in 3 Steps</h2>
                            <label class="ad-text"> include stressed person illustraton for 4 steps</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-4 col-xs-12 animate-box" data-animate-effect="fadeIn">
                            <div class="dexel-stressfree">
                                <div class="dexel-avatarpanel">

                                    <img class="img-circle" src="{{asset('assets/web/images/progress1.jpeg')}}">
                                    <span class="dexel-postcounts animate-box">1</span>
                                </div>
                                <h2>Experience Free Content</h2>
                                <p>Read our articles, watch our videos, and listen to our audios - we have something for everyone.  We hope you like what you see and feel Stress Fit.</p>


                            </div>
                        </div>

                        <div class="col-md-4 col-sm-4 col-xs-12 animate-box" data-animate-effect="fadeIn">
                            <div class="dexel-stressfree">
                                <div class="dexel-avatarpanel">

                                    <img class="img-circle" src="{{asset('assets/web/images/progress2.jpeg')}}">
                                    <span class="dexel-postcounts animate-box">2</span>
                                </div>
                                <h2>Register and Subscribe</h2>
                                <p>We are sure you will enjoy the content and we look forward to having you in our community. Register and subscribe to our site and be the first to enjoy our latest uploads.</p>


                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12 animate-box" data-animate-effect="fadeIn">
                            <div class="dexel-stressfree">
                                <div class="dexel-avatarpanel">

                                    <img class="img-circle" src="{{asset('assets/web/images/progress3.jpg')}}">
                                    <span class="dexel-postcounts animate-box">3</span>
                                </div>
                                <h2>Relax and Grow</h2>
                                <p>Enjoy from our range of content. We have a strong community of coaches who are constantly putting together articles and material to help you tap into your subconscious self.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div id="dexel-videopanel" style="display: none;">
                <div class="container-fluid">
                    <div class="row animate-box">
                        <video id="my-video" class="video-js vjs-default-skin" controls preload="auto" poster="{{asset('assets/web/images/video-poster.jpeg')}}"  data-setup='{ "techOrder": ["youtube"], "sources": [{ "type": "video/youtube", "src": "https://www.youtube.com/watch?v=t7RhG0CEbVw"}] }'></video>

                    </div>
                </div>
            </div>
            <div id="dexel-audiopanel">
                <div class="container">
                    <div class="row animate-box">
                        <div class="col-md-10 col-md-offset-1 text-center dexel-heading">
                            <h2>Now Trending</h2>
                            <p> StressFit meditations are designed to help you achieve a calm and confident mind. Click on a playlist below to unwind and relax.</p>
                            <p class="dexel-heading-quote"> "New meditations uploaded weekly."</p>
                        </div>
                    </div>
                    <div class="row home-audio-panel-inner">
                        @foreach($playlists as $playlist)
                            @include('web.audio_card')
                        @endforeach
                        <div class="clearboth"></div>
                    </div>
                </div>
                <div class="clearboth"></div>
                <br/>
              
                     <div class="row animate-box">
                            <div class="col-md-10 col-md-offset-1 text-center">
                               <a href="{!!url('audios')!!}"> <button type="button" class="btn btn-default viewCoach-btn">View More</button></a>
                               <br/><br/>
                            </div>
                        </div>
            </div>


        <div class="home-science-section">


             <div class="row animate-box home-science-title">
              <div class="col-md-10 col-md-offset-1 text-center dexel-heading">
                <h2 style=" color: #fff;">StressFit Sciences
                </h2>
                <!--  <label class="ad-text"> include stressed person illustraton for 4 steps</label>  <sabrina>-->
              </div>
            </div>
            <div class="landing-science">
                 <div class="landing-science-inner">
                @foreach($science_category as $category)
                    <a href="{{url("science/".$category->slug)}}">
                    <div class="l-s-each">
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn animate-box">
                                <img src="{{asset('sciences/science'.$category->id.'.png')}}" alt="{{$category->title}}">
                            </div>
                            <p>{{$category->title}}</p>
                        </div>
                    </div></a>
                @endforeach
                    <div class="clearboth"> </div>
                </div>
            </div>
  </div>
            <div class="streak-section promotion-1 parallax-section">
                <span class="streak-top-squaretex-green"></span>
                <div class="promotion-1_inner">
                    <h3>Want to live a stress-free life</h3>
                    <a href="{{url('audios')}}" class="btn_om promotion_btn">
                    <span class="om_ring1"></span>
                    <span class="om_ring2"></span>
                    <span class="om_ring3"></span>
                    <span class="om_ring4"></span>
                    Start now</a>
                    {{-- <a href="{{url('audios')}}" class="btn btn-default viewCoach-btn promotion_btn">START NOW</a> --}}
                </div>

                <span class="streak-bottom-tex-violet"></span>
            </div>
            <div id="dexel-coachespanel">
                <div class="container">
                    <div class="row animate-box">
                        <div class="col-md-10 col-md-offset-1 text-center dexel-heading" style="color:#fff;">
                         {{-- <h2><a href="{!!url('coaches')!!}"> <button type="button" class="btn btn-default viewCoach-btn">Coaches</button></a></h2> --}}
                            <a class="home_coach_title" href="{!!url('coaches')!!}">Coaches</a>
                            <p class="color-white">Our world-class teachers are experienced, and equally passionate to deliver the very best studio quality content - to help you relax, grow, and evolve.</p>
                        </div>
                    </div>
                  {{--   <div class="row animate-box">
                                    <div class="col-md-10 col-md-offset-1 text-center">
                                       <a href="{!!url('coaches')!!}"> <button type="button" class="btn btn-default viewCoach-btn">View Coaches</button></a>
                                    </div>
                                </div> --}}
                    <div class="row animate-box">
                        <div class="col-md-12">
                            <div class="dexel-coach-grid">
                                <div class="hex grid" id="grid-row-1">
                                    <a href="{!!url('coache/'.base64_encode($coaches[0]->id))!!}" title="Coaches">
                                        @if(count($coaches)>0 && $coaches[0]->profile->photo) <?php $img1 = $coaches[0]->profile->photo; ?> @else <?php $img1 = 'assets/web/images/yoga9.jpeg'; ?> @endif
                                        <img src="{!!cdn($img1)!!}" class="animate-box" alt="Coach">
                                        <b class="after">
                                                <label>
                                                   {!! $coaches[0]->fname.' '.$coaches[0]->lname !!}
                                                </label>
                                            </b>
                                    </a>
                                </div>


                                <div id="grid-row-2">
                                    <div class="hex grid show-circle">
                                        <a href="{!!url('coache/'.base64_encode($coaches[1]->id))!!}" title="Coaches">
                                            @if(count($coaches)>1 && $coaches[1]->profile->photo) <?php $img2 = $coaches[1]->profile->photo; ?> @else <?php $img2 = 'assets/web/images/yoga8.jpeg'; ?>  @endif
                                            <img src="{{cdn($img2)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[1]->fname.' '.$coaches[1]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>
                                    <div class="hex grid hide-circle">
                                        <a href="{{url('coaches')}}" title="Coaches">
                                            <img src="{{asset('assets/web/images/baby.jpeg')}}" alt="Coach">
                                        </a>
                                    </div>

                                    <div class="hex grid show-circle">
                                        <a href="{!!url('coache/'.base64_encode($coaches[2]->id))!!}" title="Coaches">
                                            @if(count($coaches)>2 && $coaches[2]->profile->photo) <?php $img3 = $coaches[2]->profile->photo; ?>  @else <?php $img3 = 'assets/web/images/yoga7.jpeg'; ?> @endif
                                            <img src="{{cdn($img3)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[2]->fname.' '.$coaches[2]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>
                                </div>

                                <div id="grid-row-3">
                                    <div class="hex grid show-circle-coache1">
                                        <a href="{!!url('coache/'.base64_encode($coaches[3]->id))!!}" title="Coaches">
                                            @if(count($coaches)>3 && $coaches[3]->profile->photo) <?php $img4 = $coaches[3]->profile->photo; ?>  @else <?php $img4 = 'assets/web/images/yoga2.jpeg'; ?> @endif
                                            <img src="{{cdn($img4)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[3]->fname.' '.$coaches[3]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>
                                    <div class="hex grid hide-circle-coache1">
                                        <a href="{{url('coaches')}}" title="Coaches">
                                            <img src="{{asset('assets/web/images/yoga2.jpeg')}}" class="animate-box" alt="Coach">
                                        </a>
                                    </div>

                                    <div class="hex grid show-circle-coache1">
                                        <a href="{!!url('coache/'.base64_encode($coaches[4]->id))!!}" title="Coaches">

                                            @if(count($coaches)>4 && $coaches[4]->profile->photo) <?php $img5 = $coaches[4]->profile->photo; ?> @else <?php $img5 = 'assets/web/images/yoga1.jpeg'; ?> @endif
                                            <img src="{{cdn($img5)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[4]->fname.' '.$coaches[4]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>
                                    <div class="hex grid hide-circle-coache1">
                                        <a href="{{url('coaches')}}" title="Coaches">
                                            <img src="{{asset('assets/web/images/yoga2.jpeg')}}" class="animate-box" alt="Coach">
                                        </a>
                                    </div>

                                    <div class="hex grid show-circle-coache1">
                                        <a href="{!!url('coache/'.base64_encode($coaches[5]->id))!!}" title="Coaches">
                                            @if(count($coaches)>5 && $coaches[5]->profile->photo) <?php $img6 = $coaches[5]->profile->photo; ?> @else <?php $img6 = 'assets/web/images/yoga3.jpeg'; ?> @endif
                                            <img src="{{cdn($img6)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[5]->fname.' '.$coaches[5]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>
                                </div>

                                <div id="grid-row-4">
                                    <div class="hex grid show-circle-coache2">
                                        <a href="{!!url('coache/'.base64_encode($coaches[6]->id))!!}" title="Coaches">
                                            @if(count($coaches)>6 && $coaches[6]->profile->photo) <?php $img7 = $coaches[6]->profile->photo; ?> @else <?php $img7 = 'assets/web/images/yoga4.jpeg'; ?> @endif
                                            <img src="{{cdn($img7)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[6]->fname.' '.$coaches[6]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>


                                    <div class="hex grid show-circle-coache3">
                                        <a href="{!!url('coache/'.base64_encode($coaches[7]->id))!!}" title="Coaches">
                                            @if(count($coaches)>7 && $coaches[7]->profile->photo) <?php $img8 = $coaches[7]->profile->photo; ?> @else <?php $img8 = 'assets/web/images/yoga5.jpg'; ?> @endif
                                            <img src="{{cdn($img8)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[7]->fname.' '.$coaches[7]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>


                                    <div class="hex grid show-circle-coache2">
                                        <a href="{!!url('coache/'.base64_encode($coaches[8]->id))!!}" title="Coaches">
                                            @if(count($coaches)>8 && $coaches[8]->profile->photo) <?php $img9 = $coaches[8]->profile->photo; ?> @else <?php $img9 = 'assets/web/images/yoga6.jpg'; ?> @endif
                                            <img src="{{cdn($img9)}}" class="animate-box" alt="Coach">
                                            <b class="after">
                                                <label>{!! $coaches[8]->fname.' '.$coaches[8]->lname !!}</label>
                                            </b>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
<div class="streak-section promotion-2 parallax-section">
                <span class="streak-top-tex-violet"></span>
                <div class="promotion-1_inner">
                    <h3>Start your journey within.</h3>
                    <a href="{{url('audios')}}" class="btn_om promotion_btn">
                    <span class="om_ring1"></span>
                    <span class="om_ring2"></span>
                    <span class="om_ring3"></span>
                    <span class="om_ring4"></span>
                    Start now</a>
                </div>

                <span class="streak-bottom2"></span>
            </div>

                        <div id="dexel-quotes-slider">
                        <h2>Quotes</h2>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <ul class="responsive slider dexel-slider">
                                        @foreach($quotes as $quote)
                                            <li class="dexel-slide-img">
                                                <img src="{{cdn($quote->cover_img)}}" />
                                                <div class="text">{!!$quote->description!!} - {{$quote->author}}</div>
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
            <div class="col-md-12 col-sm-12 col-xs-12 dexel-heading2">
            <h2>News & Updates</h2>
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-sm-12"><img style="width:100%;" src="{{asset('sf_app_banner.png')}}" /></div>
                            </div>
                        </div>
                        {{--<div class="item">
                            <div class="row">
                                <div class="col-sm-12"><img style="width:100%;" src="{{asset('bg_coach_profile.jpg')}}" /></div>
                            </div>
                        </div>--}}
                    </div>
                </div>
            </div>
    @if(!Auth::guard('user')->check())
    <div class="col-md-12 col-sm-12 col-xs-12 dexel-heading2 dexel-section-subscribe">
        <h2>Subscribe</h2>
        <div id="subscribe-popup-home" class="message-subscribe" style="position:   relative;   z-index:    100; margin-top: 25px; background: none; "> 
       <p style="color:#424242">Enter your details in the form below to stay up to date with the latest news from StressFit</p>
        @include('user::subscribe')           
        </div>
    </div>
    @endif
</section>

@if(Session::has('logged_in'))
    <div class="message-popup" id="message-popup-login">
        <div class="message-popup-inner">
            @if(Session::get('logged_in') == 'yes')
                <div class="message-welcome">
                    <h2>Welcome to Stressfit</h2>
                    <p>Hi you have logged in successfully</p>
                    <button class="btn btn-default close-popup-message">Continue</button>
                </div>
            @elseif(Session::get('logged_in') == 'no')
                <div class="message-loggedout">
                    <h2>Thanks for joining us</h2>
                    {{-- <p>You have been logged out please login again</p> --}}
                    <p> You have been successfully logged out, <br/> please click the login button below to sign in again</p>
                    <a href="{{url('login')}}" class="btn btn-default">Log in</a>
                </div>
            @endif
            <div class="message-popup-close close-popup-message">
                <i class="fa fa-close"></i>
            </div>
        </div>
    </div>
@endif
@include('web.audio_player')
@stop
@section('script')
    <script src="{{asset('hls/video.js')}}"></script>
    <script src="{{asset('hls/Youtube.min.js')}}"></script>
    <script src="{{asset('hls/videojs-contrib-hls.js')}}"></script>
    <script src="{{asset('hls/player.js')}}"></script>
    <script src="{{asset('assets/web/js/slick.js')}}"></script>
    <script src="{{asset('assets/web/js/slick-lightbox.min.js')}}"></script>
    <script src="{{asset('rating/jquery.barrating.js')}}"></script>
    <script src="{{asset('rating/rating.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#carousel-example-generic').carousel({
                pause: "false",
                interval: 5000
            });
            $('.responsive').slick({
                dots: false,
                infinite: true,
                speed: 500,
                prevArrow:'<span style="cursor: pointer; position: absolute; top: 40%;left: -30px;z-index: 9999;"><i class="fa fa-2x fa-arrow-circle-left"></i></span>',
                nextArrow:'<span style="cursor: pointer; position: absolute; top: 40%;right: -10px;z-index: 9999;"><i class="fa fa-2x fa-arrow-circle-right"></i></span>',
                arrows: true,
                autoplay: true,
                slidesToShow: 4,
                slidesToScroll: 4,
                responsive: [{
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            infinite: true
                        }
                    }, {
                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2
                        }
                    }, {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                    // You can unslick at a given breakpoint now by adding:
                    // settings: "unslick"
                    // instead of a settings object
                ]
            });

            $('.responsive').slickLightbox({
                src: 'src',
                itemSelector: '.dexel-slide-img > img',
                caption: function(element) { return $(element).next('.text').html(); }
            });
        });
    </script>
@stop
