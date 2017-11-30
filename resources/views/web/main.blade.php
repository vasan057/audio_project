<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Stress Fit</title>

    <!-- Mobile Specific Metas
    =================================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons
    =================================================================== -->
      <link rel="icon" type="image/png" href="{{asset('assets/web/images/favicon.png')}}">


    <!-- CSS
    =================================================================== -->
    <link rel="stylesheet" href="{{asset('fonts/custom_fonts.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/character.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/slick-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/sss.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('assets/web/css/owl.theme.css')}}">

    <!-- Script
    =================================================================== -->
    <script src="{{asset('assets/web/js/modernizr-2.6.2.min.js')}}"></script>
    <!-- If you'd like to support IE8 -->
    <script src="{{asset('assets/web/js/video-jsIE.js')}}"></script>

    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
        var base_url = "{{url('/')}}";
        var csrf_token = "{{ csrf_token() }}";
    </script>
<style>

.bg {

   background: url('{{asset("stressfit_bg_img.jpg")}}') no-repeat center center fixed #000;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;


}

td { font-size: 14px !important; }

.table-striped > tbody > tr:nth-child(odd) > td, .table-striped > tbody > tr:nth-child(odd) > th {
    background-color: #ffffff;
}


.modal-content .form-group{
    display:inline-block;
    width:46%;
    margin:0 1% 1%;
}

.modal-content .form-group.dexel-editor{
    width:100%;
    margin:1% 0 0;
}

.modal-content .form-control{
    border-radius: 2px;
    color: #FFF;
    background-color: rgba(255, 255, 255, 0.2);
    width:100%;
}

.modal-content .form-control option{
    color:#000;
}

.modal-content .form-control p{

  color:#000;

}

.dexel-fr-box.fr-basic .fr-wrapper{
    background: rgba(255, 255, 255, 0.2) !important;
}
.fr-toolbar{
    background: rgba(255, 255, 255, 0.6) !important;
}
.modal-content .fr-separator{
    display:none;
}

.fr-toolbar .fr-command.fr-btn.fr-disabled, .fr-popup .fr-command.fr-btn.fr-disabled{
    color:#797373 !important;
}

.dexel-fr-box.fr-basic .fr-element{
    height:280px !important;
    overflow-y:scroll;
    color:#ecf0f1 !important;
}

.fr-toolbar .fr-command.fr-btn.fr-dropdown.fr-selection, .fr-popup .fr-command.fr-btn.fr-dropdown.fr-selection{
    border:1px solid #949494;
}

.modal-header .close{
    color: #000000;
    opacity: 0.8;
}
.modal-body{
    padding:15px 45px !important;
}


.modal-content .cover img{
    width:100%;
    border:2px solid #FFF;
    border-radius:4px;
}

#cover_image{
    width: 46%;
    height: 121px;
    border: 1px solid #FFF;
    border-radius: 4px;
    float: right;
    margin-right: 4.6%;
}

@media (min-width: 768px){

.modal-dialog {
    width:58% !important;
    }
}

.dataTable a{
    font-size:16px;
    margin:0 4px;
    color:#34495e;
}

.dataTable a:hover{
    text-decoration:none;
}

#article_content p{
    margin:2.5% 0
}
#audio_player_container
{
    /* position: fixed;
    bottom: 0px;
    width: 100%;
    left:10px;
    display: none; */
}
#audio_player
{
    height: 90px;
}
#audio_player_container .play_audio:hover
{
    cursor: pointer;
}
#audio_player_container .video-js .vjs-control-bar {
    background-color: !important;
    color: null;
    font-size: 30px
}
.button
{
    width: 70%;
    margin: 12px auto;
    background: transparent;
    border: 3px solid #4a6668;
    color: #636363;
    padding: 2%;
}

#site_loding, #site_error{ position: fixed; top: 0px; width: 100%; z-index: 9999;   }

#site_error{ display: none; }
#site_loding{ display: none;}
#site_loding span{ background-color:#18b2d0; color: #fff; padding: 10px 20px 10px 20px; border-bottom-right-radius: 4px;   border-bottom-left-radius: 4px;
    box-shadow: 0px 0px 20px -4px #000; letter-spacing: .05em;   }
#site_error span{ background-color:#daa74a; color: #fff; padding: 10px 20px 10px 20px; border-bottom-right-radius: 4px;   border-bottom-left-radius: 4px;
    box-shadow: 0px 0px 20px -4px #000; letter-spacing: .05em; position: relative;  }
#site_error span b{  position: absolute; width: 40px; height: 100%; background-color: #323232; display: block; right: -37px; top: 0px;
border-bottom-right-radius: 4px; box-sizing: border-box;    padding-top: 7px; cursor: pointer;  color: #fff!important; }
#site_error span b:hover{ background-color: #8c1d1d;}


    .btn-box-border{ height: 50px; width: 120px; background-color: transparent; border-radius: 0px; border:solid 2px #fff;
        font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.4em; color:#fff;  display: inline-block; text-align: center; line-height: 50px; cursor:pointer; }
    .btn-box-border:hover{ background-color: #fff; color: #0e0d2c; }
    .form-horizontal .control-label{ color:#fff; font-size: 1.2em; }
    .subscribe-btn-row{ text-align: center; }
/*
.formx-each{ padding-top: 20px; }*/
.g-recaptcha{ margin:0 auto; width:302px; }
.control-label{ text-align: center!important; }
.message-subscribe h2{ margin-bottom: 0px;     text-shadow: 0px 0px 10px #00f6ff;
    font-weight: 100;
    letter-spacing: .05em;
    font-family: sans-serif;}
.message-subscribe p{ width: 80%; margin:0 auto; }


</style>
@yield('css')



</head>

<body>
    <div id="page">
        <div id="wrapper">
            <!-- Sidebar -->
            @include('web.menu')
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="sidebar-brand-logo">
                    <a href="{{url('/')}}">
                        <img src="{{asset('assets/web/images/sf_home_menu_logo.png')}}" alt="logo">
                    </a>
                </div>
                <button type="button" class="hamburger is-closed" id="menu_btn" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
                <div class="landing_logo_main">
                    <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" alt="logo">
                </div>
            </div>
            <!-- /#page-content-wrapper -->
        </div>
        <!-- /#wrapper -->
        <!-- <header id="dexel-header-bg" class="dexel-header-bg">

        <img src="{{asset('assets/web//images/header-Bg.jpg')}}" class="dexel-header-bg-fill" alt="">
          <div class="header-text">
            <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" alt="">
          </div>
        </header> -->
        @yield('content')
    </div>

    <!-- Footer Starts -->
<div class="footer-panel">
    <div class="footerx-top">
        <img class="footerx-artwork" src="{{asset('assets/web/images/sf_footerX.jpg')}}" alt="">
    </div>
    <div class="col-md-12 footerx-bottom">
        <div class="footerx-bottom-inner">
            <div class="col-md-3">
                <h4>General</h4>
                <ul>
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><a href="{{url('audios')}}">Audio</a></li>
                    <li><a href="{{url('science')}}">StressFit Sciences</a></li>
                    <li><a href="{{url('contact')}}">Contact Us</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                 <h4>Customer</h4>
                 <ul>
                    <li><a href="{!! url('login')!!}">Login</a></li>
                    <li><a href="{{url('register')}}">Register</a></li>
                    <?php if(Auth::guard('user')->check())
                    {
                        if(Auth::guard('user')->user()->subscribe)
                        {
                            echo "<li><span id='subscribe' action='unsubscribe'>Unsubscribe</span></li>";
                        }
                        else
                        {
                            echo "<li><span id='subscribe' action='subscribe'>Subscribe</span></li>";
                        }
                    }
                    else
                    {

                        echo "<li><span id='subscribe-login' action='subscribe'>Subscribe</span></li>";
                    }
                    ?>
                </ul>
            </div>
            <div class="col-md-2">
                 <h4>Coach</h4>
                  <ul>
                    <li><a href="{!! url('login/coach')!!}">Login</a></li>
                    <li><a href="{{url('register/coach')}}">Register</a></li>
                </ul>
            </div>
            <div class="col-md-4 col-sx-12">
                 <h4>Social</h4>

                    <ul class="social-panel pull-left">
                        <li><a href="https://www.facebook.com/stressfit.com.au" target="_blank" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                       <!--  <li><a href="#" target="_blank" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> -->
                        <li><a href="https://www.instagram.com/stressfit/" target="_blank" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                   </ul>
                   <div class="clearboth"></div>
            </div>
             <div class="col-md-12">
                <div class="footerx-bottom-copyright">
                 <div class="col-md-6 col-sm-6 col-xs-6 pull-left" >
                    <label class="footer-Content-label">&copy; <a href="#">www.stressfit.com.au</a> | All Rights Reserved</label>
                </div>
                    <div class="col-md-6 pull-right footer-logo">
                        <span class=" pull-right">by <a href="http://www.dexeldesigns.com" target="_blank" title="dexel">
                        <img src="{{asset('assets/web/images/sf_footer_dexel_logo.png')}}" alt="logo"></a></span>
                    </div>
                </div>
     </div>
        </div>
    </div>


    <!-- <div class="container-fluid">
    <div class="footer-Content">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-6">
                <label class="footer-Content-label">&copy; <a href="#">www.stressfit.com.au</a> ! All Rights Reserved</label>
            </div>
            <div class="col-md-6 col-sm-6 col-xs-6">

                    <ul class="social-panel pull-right">
                        <li><a href="https://www.facebook.com/stressfit.com.au" target="_blank" title="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" target="_blank" title="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.instagram.com/stressfit/" target="_blank" title="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                   </ul>
                    <ul class="social-panel pull-right" style="display:none">
                    <li><a href="#" title="mail"><i class="fa fa-envelope-o" aria-hidden="true"></i></a></li>
                    <li><a href="#" title="maps"><i class="fa fa-map-marker" aria-hidden="true"></i></a></li>
                    <li><a href="#" title="pinterest"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>
                    </ul>
            </div>
            <div class="col-md-6 pull-right footer-logo">
                <span class=" pull-right">by <a href="#" title="dexel">
                <img src="{{asset('assets/web/images/sf_footer_dexel_logo.png')}}" alt="logo"></a></span>
            </div>
        </div>
    </div>
    </div> -->

</div>
    <!-- Footer Ends -->

<div id="site_loding"><span>loading...</span></div>
<div id="site_error"><span>error...... <b id="close_site_error">X</b></span></div>


<div class="message-popup subscribe-popup" id="subscribe-popup" style="display: none;">
    <div class="message-popup-inner">

        <div class="message-subscribe">
        <h2>Subscribe</h2>
        <p>Enter your details in the below form to stay up to date with the latest news from StressFit  </p>
            <div id="subscribe-popup-div">
            @include('user::subscribe')
            </div>
        </div>
    <div class="message-popup-close close-popup-message">
        <i class="fa fa-close"></i>
    </div>
</div>
</div>

    <!-- Script
    =================================================================== -->
    @include('analyticstracking.user')
    <script src="{{asset('assets/web/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/web/js/jquery-ui.min.js')}}"></script>
    <script src="{{asset('assets/web/js/jquery.easing.1.3.js')}}"></script>
    <script src="{{asset('assets/web/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/web/js/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/web/js/main.js')}}"></script>
    @yield('script')
</body>

</html>
