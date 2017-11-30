@extends("web.main")
@section('css')
<link rel="stylesheet" href="{{asset('assets/web/css/base.css')}}">
<link rel="stylesheet" href="{{asset('assets/web/css/sss.css')}}">
<link rel="stylesheet" href="{{asset('assets/web/css/video-js.css')}}">
<link rel="stylesheet" href="{{asset('assets/web/css/owl.carousel.css')}}">
<link rel="stylesheet" href="{{asset('assets/web/css/owl.theme.css')}}">
<style>
.owl-prev{ position: absolute!important;    left: -57px!important;    top: 169px!important;    z-index: 9999!important;    text-indent: -999em!important;    width: 50px!important;    height: 50px!important;     border-radius: 25px!important;    padding: 0px!important;
             background: url({{asset('assets/web/images/icon_left.png')}})!important;    background-size: contain!important; }

                .owl-next{ position: absolute!important;    right: -57px!important;    top: 169px!important;    z-index: 9999!important;    text-indent: -999em!important;    width: 50px!important;    height: 50px!important;     border-radius: 25px!important;    padding: 0px!important;
             background: url({{asset('assets/web/images/icon_right.png')}})!important;    background-size: contain!important; }
   .dexel-customer-actionPanel .btn-collection{
      border: 1px solid #96549e;
      color: #96549e;
   }
   .footer-panel {
    display: none;
   }
</style>
@stop
@section('content')
@include('web.category')
    <section class="dexel-articlespanel">

      <div class="sitewrap article-page" style="background: #fff;">


<div class="articlelist_layout0 ap_width">
    <div class="set1">
    <h3 class="slider-title"> MOST RECENT</h3>
        <div class="a2b_slider">
            <!-- slider article 1  -->
            <div id="owl-demo" class="owl-carousel owl-theme">

            <?php $i=0; ?>
			@foreach($articles->take(4) as $article)
				<div class="a2b_slide1 item">
                    <div class="a2b_slide1_cover">
                        <a href="{!!url('article/'.Crypt::encrypt($article->id))!!}"><img src="{{cdn($article->cover_img)}}" alt=""></a>
                    </div>
                    <div class="a2b_slide1_details">
                        <span class="ap_tag al1_txt_color">
                            <p class="likes_mini">123</p>
                            <p class="views_mini">{{$article->views->count()}}</p>
                            <span class="clearboth"></span>
                        </span>
                        <h4><?php echo $article->short_description; ?></h4>
                        <span class="essense_mini"><?php echo $article->essence->title; ?></span>
                    </div>
                </div>
                @endforeach

			</div>
        </div>
    </div>
</div>



<div class="articlelist_layout1 ap_width">
        <!--============================================================= category 1  Meditationx ======================================================== -->
        <div class="set1">
            <div class="ap_title">
                    <div class="ap_title_icn">
                        <img class="al1_bg_color"
						src="{{asset('assets/web/images/principle1_small.png')}}" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Meditation </h3>
                    <div class="clearboth"></div>
            </div>
            <!-- Meditation content list item start -->

		   @foreach($articles->where('category_id',3)->take(2) as $article)
		   <div class="a2b_circle">
            <div class="a2b_circle_inner">
                <div class="a2b_circle_cover">
                    <a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
                    <img class="img-responsive" style="height:100%" src="{{cdn($article->cover_img)}}" alt="article cover">
                    </a>
                </div>
                <div class="a2b_circle_details">
                    <span class="ap_tag al1_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">{{$article->views->count()}}</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4><?php echo $article->title; ?></h4>

                    <p>
                        <?php echo $article->short_description; ?></p>
                    <span class="essense_mini"><?php echo $article->essence->title; ?></span>
                </div>
            </div>
            </div>
 @endforeach

        <!--=============================================================  End Section 1 ======================================================== -->

        <div class="clearboth"></div>
      </div>
        <!--=============================================================  Diet - Section 2  ======================================================== -->
        <div class="set2">
            <div class="ap_title">
                    <div class="ap_title_icn">
                        <img class="al2_bg_color"
src="{{asset('assets/web/images/principle2_small.png')}}" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Diet </h3>
                    <div class="clearboth"></div>
            </div>

		   @foreach($articles->where('category_id',1)->take(2) as $article)
            <div class="a2b_rect1">
                <div class="a2b_rect1_cover">
                    <a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
                      <img class="img-responsive" style="height:100%" src="{{cdn($article->cover_img)}}" alt="article cover">
                      </a>
                    <span class="essense_mini al2_bg_color"><?php echo $article->essence->title; ?></span>
                </div>
                <h4><?php echo $article->title; ?></h4>
                <span class="ap_tag al2_txt_color">
                    <p class="likes_mini">123</p>
                    <p class="views_mini">{{$article->views->count()}}</p>
                    <span class="clearboth"></span><br>
                </span>
            </div>
		   	   @endforeach
<!-- ====================================================================  End Section 2 ================================================================== -->
        <div class="clearboth"></div>
</div>
</div>
<!--=============================================================  Self development - Section 3 ======================================================== -->
<div class="articlelist_layout2 ap_width" style="height:auto">
        <div class="set1">
            <div class="ap_title">
                    <div class="ap_title_icn">

                        <img class="al3_bg_color" src="{{asset('assets/web/images/principle3_small.png')}}" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Self Development </h3>
                    <div class="clearboth"></div>
            </div>

		   @foreach($articles->where('category_id',5)->take(4) as $article)
                        <div class="a2b_circle2">
            <div class="a2b_circle2_inner">
                <div class="a2b_circle2_cover">
                    <a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
<img class="img-responsive" style="height:100%;margin-left:0" src="{{cdn($article->cover_img)}}" alt="">
</a>
                </div>
                <div class="a2b_circle2_details">

                    <span class="ap_tag al3_txt_color">

                        <p class="likes_mini">123</p>
                        <p class="views_mini">{{$article->views->count()}}</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4><?php echo $article->title; ?></h4>
                    <p class="circle-text">
                      <?php echo $article->short_description; ?></p>
                    <span class="essense_mini al3_bg_color"><?php echo $article->essence->title; ?></span>

                </div>
            </div>
            </div>
            @endforeach
            </div>
            <!-- ====================================================================  Self Development - End Section  ================================================================== -->

            <div class="clearboth"></div>
            </div>
        </div>
        <!-- ====================================================================  Fitness - Section 4 ================================================================== -->
        <div class="articlelist_layout3 ap_width">
                <div class="set1">
                    <div class="ap_title">
                            <div class="ap_title_icn">
                                <img class="al4_bg_color"
        						src="{{asset('assets/web/images/principle4_small.png')}}" alt="">  <!-- Title icon -->
                            </div>
                            <h3> Fitness </h3>
                            <div class="clearboth"></div>
                    </div>
                </div>
        		@foreach($articles->where('category_id',6)->take(4) as $article)
                <!-- fitness content list item start -->
                        <div class="a2b_rect3">
                    <!--Add anchor for posted article-->
                    <a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
                    <div class="a2b_rect3_cover">
        <img class="img-responsive" style="height:100%" src="{{cdn($article->cover_img)}}"
        alt="">

                        <span class="essense_mini al4_bg_color"><?php echo $article->essence->title; ?></span>

                    </div>
                </a>
                    <span class="ap_tag al4_txt_color">
                                <p class="likes_mini">123</p>
                                <p class="views_mini">{{$article->views->count()}}</p>
                                <span class="clearboth"></span>
                        </span>
                        <h4><?php echo $article->title; ?></h4>

        <p>
        <span class="rect-text"><?php echo $article->short_description; ?></span>
        </p>

                    <span class="essense_mini al4_bg_color"><?php echo $article->essence->title; ?></span>

                </div>
                @endforeach

                <div class="clearboth"></div>


        </div>
        <div class="articlelist_layout1 ap_width">
                <!--============================================================= category 5 Detox detoxx  ======================================================== -->
                <div class="set1">
                    <div class="ap_title">
                            <div class="ap_title_icn">
                                <img class="al5_bg_color" src="{{asset('assets/web/images/principle1_small.png')}}" alt="">  <!-- Title icon -->
                            </div>
                            <h3>  Detox </h3>
                            <div class="clearboth"></div>
                    </div>
                    <!-- detox content list item start -->
@foreach($articles->where('category_id',1)->take(2) as $article)
                                <div class="a2b_circle">
                    <div class="a2b_circle_inner">
                        <div class="a2b_circle_cover">
                            <a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
        <img class="img-responsive" style="height:100%" src="{{cdn($article->cover_img)}}" alt="">
        </a>
                        </div>
                        <div class="a2b_circle_details">
                            <span class="ap_tag al5_txt_color">
                                <p class="likes_mini">123</p>
                                <p class="views_mini">>{{$article->views->count()}}</p>
                                <span class="clearboth"></span>
                            </span>
                            <h4><?php echo $article->title; ?></h4>

        <p><?php echo $article->short_description; ?></p>

                            <span class="essense_mini al5_bg_color"><?php echo $article->essence->title; ?></span>
                        </div>
                    </div>
                    </div>
                @endforeach
                    <div class="clearboth"></div>
                </div>
                <!--=============================================================  mindful living mindfulx  ======================================================== -->
                <div class="set2">
                    <div class="ap_title">
                            <div class="ap_title_icn">
                                <img class="al6_bg_color"
        						src="{{asset('assets/web/images/principle2_small.png')}}" alt="">  <!-- Title icon -->
                            </div>
                            <h3>  Mindful Living </h3>
                            <div class="clearboth"></div>
                    </div>
                    <!-- mindful content list item start -->
@foreach($articles->where('category_id',2)->take(2) as $article)
                                <div class="a2b_rect1">
                        <div class="a2b_rect1_cover">
                            <a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
        <img class="img-responsive" style="height:100%" src="{{cdn($article->cover_img)}}" alt="">
        </a>

                            <span class="essense_mini al6_bg_color"> <?php echo $article->essence->title; ?></span>
                        </div>
                        <h4><?php echo $article->title; ?></h4>
                        <span class="ap_tag al6_txt_color">

                            <p class="likes_mini">123</p>
                            <p class="views_mini">>{{$article->views->count()}}</p>
                            <span class="clearboth"></span><br>
                        </span>
                    </div>
                @endforeach

                </div>
                <div class="clearboth"></div>

        </div>
    </div>

@stop
@section('script')
<script src="{{asset('assets/web/js/owl.carousel.min.js.download')}}"></script>
<script type="text/javascript">
        $(document).ready(function() {

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
    </script>
@stop
