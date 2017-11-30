<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Stress Fit | Login</title>
    <!-- Mobile Specific Metas
    =================================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons
    =================================================================== -->
    <link rel="icon" type="image/png" href="{{asset('assets/coach/images/favicon.png')}}">

    <!-- CSS
    =================================================================== -->
    <link rel="stylesheet" href="{{asset('assets/coach/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/coach/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/coach/css/editor.css')}}">

    <!-- Script
    =================================================================== -->
    <script src="{{asset('assets/coach/js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<style>

html{ height: 100%; background-color: #16234f;}
body{ height: 100%;   }

.loader{
    display: none;    background: rgba(0, 0, 0, 0.6);    position: fixed;    top: 0;    left: 0;
    right: 0;    bottom: 0;    z-index: 9999;}

.loader img{   margin-left: 0%;    margin-top: 15%;    width: 200px;    height: 200px;}

    /*   <:::::::::::::]==|  Header   |===[:::::::::::::>   */

   /* .streak-header{ display: block; width: 100%; height: 250px; background:url({{asset('assets/web/images/streak_bottom_1.png')}})no-repeat bottom center; background-size: 100% 100%; position: absolute;     bottom: 0; left: 0; }
    .streak_header{ position: relative; width: 100%; height: 250px; background: url({{asset('assets/web/images/streak_header_bg.jpg')}})no-repeat center center; background-size: cover;   }
    .landing_logo{ position: absolute;left: 150px; top:70px; width: 320px; z-index: 2;}
    .webx-page-title{  height: 250px;  }*/
    .webx-page-title h2{ font-size: 50px;  text-transform: uppercase; margin-top: 50px;  font-weight: 600; color: #fff; text-shadow: 0px 0px 10px #00f6ff; float: right;        margin-right: 200px;}
    .landing_logo {    position: absolute;    left: 150px;    top: 70px;    width: 320px;    z-index: 2;}
    .bg{ background:url({{asset('assets/web/images/bg_login{{-- happening_bgX --}}.jpg')}}) no-repeat top center; 
    background-size: cover;  color:#fff; overflow-y: auto; height: 100%; }
    .sidebar-brand-logo{    position: fixed;    top: 40px;    width: 70px;    height: 191px;    margin: 0;    padding: 0;
        list-style: none;    /*background: url(../images/sf_home_menu_abstract.png) no-repeat;*/    background-size: 100% 55%;    z-index: 9999;}
    .sidebar-brand-logo img{    width: 116px;    height: 116px;    margin-top: 10px;    margin-left: 24px;}

    /*   <:::::::::::::]==|  Form  |===[:::::::::::::>   */

    input{ height: 50px!important; line-height: normal!important; font-weight: 400; letter-spacing: .05em; 
            background-color: #fff; font-family: sans-serif; font-size: 1.1em; color: #525252!important; 
            -webkit-text-fill-color:#525252;}
    label{ font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.4em; text-align: left;}
    .checkbox label input[type="checkbox"]{ width: 20px; height: 30px!important; }
    .checkbox label{ font-size: 1em; line-height: 30px;} 
    .checkbox label span{ position: relative; top: 3px;  padding-left:15px;}
    .btn-box-border{ height: 50px; width: 150px; background-color: transparent; border-radius: 0px; border:solid 3px #fff; ;
        font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.4em;  margin:0 auto; display: block;}
    .btn-box-border:hover{ background-color: #fff; color: #0e0d2c;border:solid 3px #fff; }
    .anchor-box-border{  width: 100px; background-color: transparent; border-radius: 0px; border:solid 3px #fff;
        text-decoration: none; color: #fff; text-align: center; margin-left: 20px;
        font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.2em; line-height: 25px; display: inline-block;}
    .anchor-box-border:hover{ background-color: #fff; color: #0e0d2c; text-decoration: none; }
    .formx-each{ margin-top: 30px; }
    .formx-each label{ text-align: left!important; }

     /*   <:::::::::::::]==|  common  |===[:::::::::::::>   */

    
    .lrx-title{ display: inline-block; text-align: right; margin-right: 20px; margin-top: 40px;}
    .lrx-title label{ font-weight: 200; }
    .lrx-content{ margin-top: 200px; box-sizing: border-box; }
    .lrx-content-login{    background-color: rgba(255, 255, 255, 0.23);
    padding: 20px;
    border: solid 1px rgba(255, 255, 255, 0.25);
    box-shadow: 1px 1px 25px -5px rgba(0, 0, 0, 0.64);}
     .lrx-content-login h3{ border-bottom:solid 1px rgba(255,255,255,.2); padding-bottom: 10px; text-shadow: 0px 0px 10px #00f6ff;
        font-weight: 100; letter-spacing: .05em;  font-family: sans-serif; font-size: 2.2em; text-align: center; margin-top: 0px;}
  .btn-forgot-password{ color: #fff!important; }
.clearboth{ clear:both; }
     @media(max-width: 1600px){ 
     .btn-forgot-password{ float:left !important; }
}
  
     @media(max-width: 1440px){ 
     .lrx-content{ margin-top: 50px; } 
    input{ height: 40px!important;}
    .btn-box-border{ height: 40px; }
     .landing_logo{ width: 230px;     left: 120px;
    top: 80px; }
    }    
 

    @media(max-width: 1280px){ 
.sidebar-brand-logo{ top: 10px; }
   .landing_logo{ left: 70px; top: 30px; }
    .sidebar-brand-logo img{ width: 70px; height: 70px;}
    }
 @media(max-width: 675px){ 

    .lrx-title{ margin-top: 100px; }
    .lrx-content{ padding-bottom: 20px; }

}

@media(max-width:480px ){
.lrx-title{ text-align: center;}
.lrx-content-login h3{ font-size: 2em; }
}

.help-block{ width: 100%; text-align: center;color: #fff; }
	</style>

</head>

<body >
<div class="bg">
    <div class="container-fluid">
        <div class="row" style="position: relative;">
        <!--================== New header section start =================-->
       {{--  <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">
        <div class="streak_header col-md-12">
           <div class="webx-page-title col-md-5 pull-right" style="background: url({{asset('assets/web/images/streak-header-audio.png')}})no-repeat bottom right;">
               <h2>Customer login</h2>
           </div>
           <div class="clearboth"></div>
            <span class="streak-header"></span>
        </div> --}}
        <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">
        <div class="sidebar-brand-logo">
            <a href="{{url('/')}}">
                <img src="{{asset('assets/web/images/sf_home_menu_logo.png')}}" alt="logo">
            </a>
        </div>
        <!--================== New header section end =================-->
        <div class="col-md-6 col-sm-12  pull-right lrx-title">
                <label> Don't have an account? </label>
                <a href="{!! url('register/coach')!!}" class="anchor-box-border"> Register </a>
            </div>
        
                {{-- <p> Register now to experience the best in meditation and healthy living.</p> --}}
   </div>
   <div class="clearboth"></div>
   <div class="row lrx-content">
   <div class=" col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-sx-12 " >
   <div class="col-md-12  lrx-content-login">
        <h3 class="col-md-12">Coach Login</h3>
           <form role="form" class="form-horizontal "  method="post" enctype= multipart/form-data>
              	{{ csrf_field() }}
                 @if(Session::has('message'))
                    <span class="help-block">
                        <strong>{{ Session::get('message') }}</strong>
                    </span>
                @endif
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="col-md-4 control-label">E-mail ID</label>
                    <div class="col-md-8">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                    </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> <span>Remember Me</span>
                            </label>
                            <a class="btn btn-link btn-forgot-password pull-right" href="{{ url('/forgot/coach') }}">Forgot Your Password?</a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <button type="submit" class="btn-box-border">
                            <i class="fa fa-btn fa-sign-in"></i> Login
                        </button>
                    </div>
                </div>
            </form>
        </div>
        </div>
        </div>
   </div>
   <div class="clearboth"></div>
   <div class="loader" id="loader">
        <img src="{{asset('assets/user/images/totoro.gif')}}">
    </div>
</div>

  

    <!-- Script
    =================================================================== -->
    <script src="{{asset('assets/coach/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/coach/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/coach/js/main.js')}}"></script>
    <script src="{{asset('assets/coach/js/editor.js')}}"></script>


    <script type="text/javascript">
        $(document).ready(function() {
            var cardheight = window.innerHeight;
            $('#dexel-coach-formPanel').css('height', cardheight-80);
            $('.dexel-coachRegbg').css('height', cardheight - 80);
            $('.debel-Regwizard-inner').css('height', cardheight - 80);
            $('.tab-content').css('height', cardheight - 100);
            $('.nav-tabs > li a[title]').tooltip();

            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $("#expertise_next").click(function(){
			$("#first_last_name").html($("#fname").val()+" "+$("#lname").val());
			$("#first_last_name_bold").html($("#fname").val()+" "+$("#lname").val());
			$("#mail_details").html($("#email").val());
			$("#contact_number_details").html($("#phone").val());
			$("#contact_address_details").html($("#suburb").val()+", "+$("#postal_code").val()+", "+$("#state").val()+", "+$("#country").val());
			$("#about_details").html($("#about").val());

			var chkArray = [];
			$(".chk:checked").each(function() {
			chkArray.push($(this).attr('data'));
			});
			var selected;
			expert_in_details = chkArray.join(',') + ",";
			$("#expert_in_details").html(expert_in_details);

		});

        });

        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

    </script>
</body>
@include('analyticstracking.coach')
</html>
