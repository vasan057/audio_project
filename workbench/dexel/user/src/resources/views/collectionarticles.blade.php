@extends("web.main")
@section('css')
<style>
            .owl-prev{ position: absolute!important;    left: -57px!important;    top: 169px!important;    z-index: 9999!important;    text-indent: -999em!important;    width: 50px!important;    height: 50px!important;     border-radius: 25px!important;    padding: 0px!important;
             background: url(images/icon_left.png)!important;    background-size: contain!important; }

                .owl-next{ position: absolute!important;    right: -57px!important;    top: 169px!important;    z-index: 9999!important;    text-indent: -999em!important;    width: 50px!important;    height: 50px!important;     border-radius: 25px!important;    padding: 0px!important;
             background: url(images/icon_right.png)!important;    background-size: contain!important; }
    </style>
    @stop
@section('content')


<div class="articlelist_layout0 ap_width">
    <div class="set1">
    <h3 class="slider-title"> MOST RECENT</h3>
        <div class="a2b_slider">
            <!-- slider article 1  -->
            <div id="owl-demo" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
            <div class="owl-wrapper-outer"><div class="owl-wrapper" style="width: 7200px; left: 0px; display: block;"><div class="owl-item" style="width: 1200px;"><div class="a2b_slide1 item">
                    <div class="a2b_slide1_cover">
                        <img src="images/cover1_full.jpg" alt="">
                    </div>
                    <div class="a2b_slide1_details">
                        <span class="ap_tag al1_txt_color">
                            <p class="likes_mini">123</p>
                            <p class="views_mini">123</p>
                            <span class="clearboth"></span>
                        </span>
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <span class="essense_mini">Love</span>
                    </div>
                </div></div><div class="owl-item" style="width: 1200px;"><div class="a2b_slide1 item">
                    <div class="a2b_slide1_cover">
                        <img src="images/cover2_full.jpg" alt="">
                    </div>
                    <div class="a2b_slide1_details">
                        <span class="ap_tag al1_txt_color">
                            <p class="likes_mini">123</p>
                            <p class="views_mini">123</p>
                            <span class="clearboth"></span>
                        </span>
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <span class="essense_mini">Love</span>
                    </div>
                </div></div><div class="owl-item" style="width: 1200px;"><div class="a2b_slide1 item">
                    <div class="a2b_slide1_cover">
                        <img src="images/cover3_full.jpg" alt="">
                    </div>
                    <div class="a2b_slide1_details">
                        <span class="ap_tag al1_txt_color">
                            <p class="likes_mini">123</p>
                            <p class="views_mini">123</p>
                            <span class="clearboth"></span>
                        </span>
                        <h4>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</h4>
                        <span class="essense_mini">Love</span>
                    </div>
                </div></div></div></div>


            <div class="owl-controls clickable"><div class="owl-pagination"><div class="owl-page active"><span class=""></span></div><div class="owl-page"><span class=""></span></div><div class="owl-page"><span class=""></span></div></div><div class="owl-buttons"><div class="owl-prev">prev</div><div class="owl-next">next</div></div></div></div>
        </div>
    </div>
</div>



<div class="articlelist_layout1 ap_width">
        <!--============================================================= category 1  Meditationx ======================================================== -->
        <div class="set1">
            <div class="ap_title">
                    <div class="ap_title_icn">
                        <img class="al1_bg_color" src="images/principle1_small.png" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Meditation </h3>
                    <div class="clearboth"></div>
            </div>
            <!-- Meditation content list item start -->
                        <div class="a2b_circle">
            <div class="a2b_circle_inner">
                <div class="a2b_circle_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=33">
                    <img src="images/ARTIMG1058651873cover4_full.jpg" alt="">
                    </a>
                </div>
                <div class="a2b_circle_details">
                    <span class="ap_tag al1_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Lorem ipsum Ash</h4>

                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum a blandit urna, sit amet facilisis magna. Maecenas id magna purus. Ph<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=33">...</a>                   </p>
                    <span class="essense_mini">Love</span>
                </div>
            </div>
            </div>
                        <div class="a2b_circle">
            <div class="a2b_circle_inner">
                <div class="a2b_circle_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=15">
                    <img src="images/ARTIMG1359998479green-nature-hd-wallpaper-1080p-wallpaper.jpg" alt="">
                    </a>
                </div>
                <div class="a2b_circle_details">
                    <span class="ap_tag al1_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Ashtanga</h4>

                    <p>
                        IntroductionLorem ipsum dolor sit amet, mea ea exerci constituam. Te cetero inermis suscipiantur sea, vim ad tantas rationibus, option di<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=15">...</a>                   </p>
                    <span class="essense_mini">Love</span>
                </div>
            </div>
            </div>

            <div class="clearboth"></div>
        </div>
        <!--=============================================================  Dietx  ======================================================== -->
        <div class="set2">
            <div class="ap_title">
                    <div class="ap_title_icn">
                        <img class="al2_bg_color" src=" images/principle2_small.png" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Diet </h3>
                    <div class="clearboth"></div>
            </div>

            <!-- Ashwin content for Diet category -->


            <div class="a2b_rect1">
                <div class="a2b_rect1_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=39">   <img src=" images/ARTIMG2076565260audio3.jpg" alt=""></a>
                    <span class="essense_mini al2_bg_color">stress </span>
                </div>
                <h4> Vinyasa</h4>
                <span class="ap_tag al2_txt_color">
                    <p class="likes_mini">123</p>
                    <p class="views_mini">123</p>
                    <span class="clearboth"></span><br>
                </span>
            </div>



            <div class="a2b_rect1">
                <div class="a2b_rect1_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=7">    <img src=" images/ARTIMG7922images.jpg" alt=""></a>
                    <span class="essense_mini al2_bg_color">Love</span>
                </div>
                <h4> THE WORLD OF QUANTUM PHYSIC’S</h4>
                <span class="ap_tag al2_txt_color">
                    <p class="likes_mini">123</p>
                    <p class="views_mini">123</p>
                    <span class="clearboth"></span><br>
                </span>
            </div>


                                <!-- end content -->

        </div>
        <div class="clearboth"></div>

</div>
<!-- ====================================================================  Layout 2  ================================================================== -->
<div class="articlelist_layout2 ap_width">
        <!--=============================================================  self development selfx ======================================================== -->
        <div class="set1">
            <div class="ap_title">
                    <div class="ap_title_icn">

                        <img class="al3_bg_color" src=" images/principle3_small.png" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Self Development </h3>
                    <div class="clearboth"></div>
            </div>
            <!-- self development list item start-->
                        <div class="a2b_circle2">
            <div class="a2b_circle2_inner">
                <div class="a2b_circle2_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=1">
<img src=" images/ARTIMG23748Lighthouse.jpg" alt="">
</a>
                </div>
                <div class="a2b_circle2_details">

                    <span class="ap_tag al3_txt_color">

                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Test</h4>
                    <p>
                        test test test testtest test test testtest test test testtest test test testtest test test tf</p>
                    <span class="essense_mini al3_bg_color">Love</span>

                </div>
            </div>
            </div>
            <!-- self development list item end-->
                        <div class="a2b_circle2">
            <div class="a2b_circle2_inner">
                <div class="a2b_circle2_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=26">
<img src=" images/ARTIMG1044847651cover1_full.jpg" alt="">
</a>
                </div>
                <div class="a2b_circle2_details">

                    <span class="ap_tag al3_txt_color">

                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Lorem ispum 8</h4>
                    <p>
                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=26">...</a></p>
                    <span class="essense_mini al3_bg_color">Love</span>

                </div>
            </div>
            </div>
            <!-- self development list item end-->
                        <div class="a2b_circle2">
            <div class="a2b_circle2_inner">
                <div class="a2b_circle2_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=27">
<img src=" images/ARTIMG1300796712cover2_full.jpg" alt="">
</a>
                </div>
                <div class="a2b_circle2_details">

                    <span class="ap_tag al3_txt_color">

                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Lorem ispum 9</h4>
                    <p>
                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=27">...</a></p>
                    <span class="essense_mini al3_bg_color">energy</span>

                </div>
            </div>
            </div>
            <!-- self development list item end-->
                        <div class="a2b_circle2">
            <div class="a2b_circle2_inner">
                <div class="a2b_circle2_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=28">
<img src=" images/ARTIMG1240468952cover3_full.jpg" alt="">
</a>
                </div>
                <div class="a2b_circle2_details">

                    <span class="ap_tag al3_txt_color">

                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Lorem ispum 10</h4>
                    <p>
                        Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=28">...</a></p>
                    <span class="essense_mini al3_bg_color">presence</span>

                </div>
            </div>
            </div>

            <div class="clearboth"></div>
        </div>
    </div>

<!-- ====================================================================  Layout 2  ================================================================== -->
<div class="articlelist_layout3 ap_width">
<!--=============================================================  Category 4 Fitness fitnessx  ======================================================== -->
        <div class="set1">
            <div class="ap_title">
                    <div class="ap_title_icn">
                        <img class="al4_bg_color" src=" images/principle4_small.png" alt="">  <!-- Title icon -->
                    </div>
                    <h3> Fitness </h3>
                    <div class="clearboth"></div>
            </div>
        </div>
        <!-- fitness content list item start -->
                <div class="a2b_rect3">
            <!--Add anchor for posted article-->
            <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=2">
            <div class="a2b_rect3_cover">
<img src=" images/ARTIMG20771ws_Good_Morning_Sun_1280x1024-1280x640.jpg" alt="">

                <span class="essense_mini al4_bg_color">Love</span>

            </div>
        </a>
            <span class="ap_tag al4_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                </span>
                <h4>Affirmation</h4>

<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy te<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=2">...</a></p>

            <span class="essense_mini al4_bg_color">Love</span>

        </div>
                <div class="a2b_rect3">
            <!--Add anchor for posted article-->
            <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=18">
            <div class="a2b_rect3_cover">
<img src=" images/ARTIMG727988210cover1_full.jpg" alt="">

                <span class="essense_mini al4_bg_color">Love</span>

            </div>
        </a>
            <span class="ap_tag al4_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                </span>
                <h4>Lorem ispum</h4>

<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=18">...</a></p>

            <span class="essense_mini al4_bg_color">Love</span>

        </div>
                <div class="a2b_rect3">
            <!--Add anchor for posted article-->
            <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=19">
            <div class="a2b_rect3_cover">
<img src=" images/ARTIMG285473850cover2_full.jpg" alt="">

                <span class="essense_mini al4_bg_color">energy</span>

            </div>
        </a>
            <span class="ap_tag al4_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                </span>
                <h4>Lorem ispum 1</h4>

<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=19">...</a></p>

            <span class="essense_mini al4_bg_color">energy</span>

        </div>
                <div class="a2b_rect3">
            <!--Add anchor for posted article-->
            <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=20">
            <div class="a2b_rect3_cover">
<img src=" images/ARTIMG2102108343cover3_full.jpg" alt="">

                <span class="essense_mini al4_bg_color">imagination</span>

            </div>
        </a>
            <span class="ap_tag al4_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                </span>
                <h4>Lorem ispum 2</h4>

<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=20">...</a></p>

            <span class="essense_mini al4_bg_color">imagination</span>

        </div>

        <div class="clearboth"></div>


</div>
<div class="articlelist_layout1 ap_width">
        <!--============================================================= category 5 Detox detoxx  ======================================================== -->
        <div class="set1">
            <div class="ap_title">
                    <div class="ap_title_icn">
                        <img class="al5_bg_color" src=" images/principle1_small.png" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Detox </h3>
                    <div class="clearboth"></div>
            </div>
            <!-- detox content list item start -->
                        <div class="a2b_circle">
            <div class="a2b_circle_inner">
                <div class="a2b_circle_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=3">
<img src=" images/ARTIMG1467237209cover3_full.jpg" alt="">
</a>
                </div>
                <div class="a2b_circle_details">
                    <span class="ap_tag al5_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Ahankara</h4>

<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=3">...</a></p>

                    <span class="essense_mini al5_bg_color">Love</span>
                </div>
            </div>
            </div>
                        <div class="a2b_circle">
            <div class="a2b_circle_inner">
                <div class="a2b_circle_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=30">
<img src=" images/ARTIMG1278230778cover4_full.jpg" alt="">
</a>
                </div>
                <div class="a2b_circle_details">
                    <span class="ap_tag al5_txt_color">
                        <p class="likes_mini">123</p>
                        <p class="views_mini">123</p>
                        <span class="clearboth"></span>
                    </span>
                    <h4>Lorem ispum 12</h4>

<p>Lorem Ipsum&nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text e<a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=30">...</a></p>

                    <span class="essense_mini al5_bg_color">energy</span>
                </div>
            </div>
            </div>
            <div class="clearboth"></div>
        </div>
        <!--=============================================================  mindful living mindfulx  ======================================================== -->
        <div class="set2">
            <div class="ap_title">
                    <div class="ap_title_icn">
                        <img class="al6_bg_color" src=" images/principle2_small.png" alt="">  <!-- Title icon -->
                    </div>
                    <h3>  Mindful Living </h3>
                    <div class="clearboth"></div>
            </div>
            <!-- mindful content list item start -->
                        <div class="a2b_rect1">
                <div class="a2b_rect1_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=4">
<img src=" images/ARTIMG26144images.jpg" alt="">
</a>

                    <span class="essense_mini al6_bg_color"> Peace</span>
                </div>
                <h4>Ahimsa</h4>
                <span class="ap_tag al6_txt_color">

                    <p class="likes_mini">123</p>
                    <p class="views_mini">123</p>
                    <span class="clearboth"></span><br>
                </span>
            </div>
                        <div class="a2b_rect1">
                <div class="a2b_rect1_cover">
                    <a href="http://dexelsolutions.com/stressfit_v4/articleDetails?articleId=31">
<img src=" images/ARTIMG1735259804cover1_full.jpg" alt="">
</a>

                    <span class="essense_mini al6_bg_color"> evolve</span>
                </div>
                <h4>Lorem ispum 13</h4>
                <span class="ap_tag al6_txt_color">

                    <p class="likes_mini">123</p>
                    <p class="views_mini">123</p>
                    <span class="clearboth"></span><br>
                </span>
            </div>

        </div>
        <div class="clearboth"></div>

</div>

@stop
@section('javascript')
<script type="text/javascript">
    $(document).ready(function() {

          $("#owl-demo").owlCarousel({

              navigation : true, // Show next and prev buttons
              slideSpeed : 300,
              paginationSpeed : 400,
              singleItem:true

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
