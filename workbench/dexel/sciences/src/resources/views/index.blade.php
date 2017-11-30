@extends("web.main")
@section('css')
   <link rel="stylesheet" href="{{asset('editor/froala_style.css')}}">
   <link rel="stylesheet" href="{{asset('share/jquery.sharebox.css')}}">
   <style>
    #page{height: auto!important;}
    .footerx-bottom{ margin-top: -2px!important; }
    .social-panel li a i{ line-height: 43px; }
    .fr-view ul li{ list-style: disc outside none;
display: list-item;
margin-left: 2em;}
    .fr-view ol li{  list-style: decimal outside none;
display: list-item;
margin-left: 2em; }

.fr-view a{ color:#4285f4!important; text-decoration: underline; cursor: pointer;}
.fr-view a *{ color:#4285f4!important; }
.fr-view a:hover{ color:#8a28c2!important; text-decoration: underline; }
.fr-view a:hover *{ color:#8a28c2!important; }
    .fr-view em{ font-style: italic!important; }
   .fr-view strong{ font-weight: bold!important; }
.fr-view strong *{  font-weight: bold!important;  }
.sticky {
     position: fixed;
     top: 0;
     width: 24%;
     height: 100%;
  }



.sticky .article_style1_right_box1, .sticky .article_style1_right_box2{ height: 47%; }
.sticky .ad-content-inner{ padding-top: 20%; }

.fr-view p, .fr-view p span, .fr-view strong span, .fr-view ul li span{ line-height: 1.5em; }

@media(max-width:1024px){
  .fr-fic{ height:auto!important; }
{{--.fr-view p span{ font-size: 19px!important; }  --}}
 }

{{--@media(max-width:600px){
.fr-view p span{ font-size: 16px!important; } 
 }
 --}}


    </style>
@stop
@section('content')

<!-- |===[:::::::::::::> New header section start -->
<div class="streak_header_space"></div>
    <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">
    <div class="streak_header col-md-12">
       <div class="webx-page-title pull-right" >
           <div class="header-character pull-right">
              <div class="char-book">
                  <img class="char_article_book_glow" src="{{asset('assets/web/images/char_article_book_glow.png')}}" alt="">
                  <img class="char_article_book" src="{{asset('assets/web/images/char_article_book.png')}}" alt="">
               </div>
               <img src="{{asset('assets/web/images/header-character-articele.png')}}" class="header-character-char" alt="">
            </div>
            <h2 class="pull-right webx-long-title">Stressfit Sciences</h2>
       </div>
       <div class="clearboth"></div>
        <span class="streak-header-space"></span>
    </div>
<!-- |===[:::::::::::::> New header section end -->
<div class="row animate-box">
  <div class="col-md-10 col-md-offset-1 text-center dexel-heading" style="margin-bottom: 0px;">
    <!-- <h2 style="text-transform: none;">StressFit Sciences
    </h2> -->
    <!--  <label class="ad-text"> include stressed person illustraton for 4 steps</label>  <sabrina>-->
  </div>
       <div class="clearboth"> </div>
</div>
<div class="article-science-inner inner-pagemenu audio-page" style="margin:0px; padding: 0px; height: 150px;">
    @foreach($science_category as $category)
        <?php $active_class = ""; if($categorySlug == $category->slug) { $active_class= 'lse_high'; } ?>
        <a class="l-s-each {{$active_class}} essense" href="{{url("science/".$category->slug)}}">
        <span class="high-flower active"></span>
            <div class="l-s-each_inner">
                <div class="l-s-each_icn ">
                    <img src="{{asset('sciences/science'.$category->id.'.png')}}" alt="{{$category->title}}">
                </div>
                <p>{{$category->title}}</p>
            </div>
        </a>
    @endforeach
        <div class="clearboth"> </div>

</div>
<div class="article_page">
<div class="article_style1">
     <div class="cover">
        <img src="{{cdn($science->cover_img)}}" alt="" width="920" height="387">
    </div>
    <div class="article_style1_inner">
    <div class="article_style1_left">


    <div class="article_style1_left_title">
        <h3>{{$science->title}}</h3>

     <div class="article_style1_left_title_details">
    <div class="article-share">
    <!-- <div class="share" id="dexel-sharebox" class="sharebox" data-services="digg facebook google+ linkedin pinterest pocket reddit stumbleupon tumblr twitter print"></ -->
    <span class="s1-share"></span>
    <div class="share" id="dexel-sharebox" class="sharebox" data-services="facebook google+ linkedin twitter pinterest" ></div>
    <div class="clearboth"></div>
        <!-- <div class="share2">
            <span class="s1-share"></span>
            <a href="#" class="s1-fb s1-i"></a>
            <a href="#" class="s1-tr s1-i"></a>
            <a href="#" class="s1-gp s1-i"></a>
            <a href="#" class="s1-pin s1-i"></a>
            <a href="#" class="s1-mail s1-i"></a>

        </div> -->
    </div>

        <!-- <span class="likes_mini i2"></span> -->
        <span class="views_mini views_mini_white  i2">{{$science->views->count()}}</span>
        <div class="clearboth"></div>
        </div>
        <div class="clearboth"></div>
    </div>


        <div class="article_style1_left_content">
        <div class="g" style="line-height: 1.2; font-size: small; margin-bottom: 23px; color: #222222; background-color: #ffffff">
            <div class="rc" data-hveid="39" style="position: relative">
                <div class="s" style="width:auto; color: #545454; line-height:none">
                    <span style="color: #000000; display:block; font-size: 16px; text-align: left; line-height:150%">
                        <div class="fr-view">
                            {!!$science->description!!}
                        </div>
                    </span>
                </div>
            </div>
        </div>
        </div>
          </div>
          <div ></div>
          <div class="article_style1_right" id="sticky-anchor">
            <div class="col-md-12" id="sticky-element">


              <div class="article_style1_right_box1 ">
                 <div class="ad-coaches">
                    <div class="ad-overlay"></div>
                      <div class="ad-content-inner">
                        <h2> We bring to you world-class teachers and coaches to help guide you on your path.  </h2>
                        <a href="{{url('coaches')}}" class="btn btn-primary"> View Coaches</a>
                      </div>
                    </div>
                  </div>
                <div class="article_style1_right_box2">
                   <div class="ad-audios">
                     <div class="ad-overlay2"></div>
                  <div class="ad-content-inner">
                   <h2>Experience our range of calming and healing guided meditations.  </h2>
                    <a href="{{url('audios')}}" class="btn btn-primary"> View Audios</a>
                  </div>
                 </div>
                   </div>
                </div>
              </div>
            </div>
          </div>
          <div class="clearboth"></div>
          </div>

    </div>
</div>
<div class="gototop js-top">
  <a href="#" class="js-gotop"><i class="fa fa-long-arrow-up"></i></a>
</div>
@stop
@section('script')
    <script src="{{asset('share/jquery.sharebox.js')}}"></script>
<script>
    function sticky_relocate() {
      var window_top = $(window).scrollTop();
      var div_top = $('#sticky-anchor').offset().top;
      if (window_top > div_top)
          $('#sticky-element').addClass('sticky');
      else
          $('#sticky-element').removeClass('sticky');
    }
    $(function() {
      $(window).scroll(sticky_relocate);
    sticky_relocate();
    });
</script>

<script>
$(document).ready(function()
    {
$("#dexel-sharebox").sharebox();
   if ($(window).width() < 768) {
     //alert('Less than 768');
$('.fr-view [style*="font-size"]').each(function(index, el) {
  var font_size  = $(el).css('font-size').match(/\d+/);
  var new_font_size =  parseInt(font_size)-parseInt(10);
  if( new_font_size <= 5)
  {
    $(el).css({'font-size': '5px'});
  }
  else
  {
    $(el).css({'font-size': parseInt(font_size)-parseInt(10)+'px'}); 
  }
  //$(el).css({'font-size': font_size+10+'px'});
  /*if( font_size > '36px')
  {
    $(el).css({'font-size': '30px'});
  }
  else if( font_size > '30px' && font_size <= '35px')
  {
    $(el).css({'font-size': '20px'});
  }
  else if( font_size <= '29px')
  {
    $(el).css({'font-size': '14px'});
  }*/
});

/*function range1() {
   alert('1');
         if ($(".fr-view p span").css('font-size') > '34px' )
        {
          alert('1 if');
          $(this).css({'font-size': '34px'});
        }
    }

     
function range2() {
 alert('2');
      if ($(".fr-view span").css('font-size') > '26px' && $("p span").css('font-size') < '33px')
      { 
        alert('2 if');
        $(".fr-view span").css({'font-size': '26px'});
      }
}

function range3() {
  alert('3');
      if ($(".fr-view p span").css('font-size') < '25px')
      { 
        alert('3 if');
        $(".fr-view p span").css({'font-size': '14px'});
      }
}
//$font_dom = $(".fr-view p span");
range1();
range2();
range3();*/
  }
 /*else {
    alert('More than 768');
 }*/
   });
</script>



@stop
