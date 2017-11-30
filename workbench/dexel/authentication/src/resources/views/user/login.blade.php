<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <title>Stressfit | Login</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
     <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
html{ height: 100%; background-color: #16234f;}
body{ height: 100%; }
    /*   <:::::::::::::]==|  Header   |===[:::::::::::::>   */

   /* .streak-header{ display: block; width: 100%; height: 250px; background:url({{asset('assets/web/images/streak_bottom_1.png')}})no-repeat bottom center; background-size: 100% 100%; position: absolute;     bottom: 0; left: 0; }
    .streak_header{ position: relative; width: 100%; height: 250px; background: url({{asset('assets/web/images/streak_header_bg.jpg')}})no-repeat center center; background-size: cover;   }
    .landing_logo{ position: absolute;left: 150px; top:70px; width: 320px; z-index: 2;}
    .webx-page-title{  height: 250px;  }*/
    .webx-page-title h2{ font-size: 50px;  text-transform: uppercase; margin-top: 50px;  font-weight: 600; color: #fff; text-shadow: 0px 0px 10px #00f6ff; float: right;        margin-right: 200px;}
    .landing_logo {    position: absolute;    left: 150px;    top: 70px;    width: 320px;    z-index: 2;}
    .bg{ background:url({{asset('assets/web/images/bg_login{{-- happening_bgX --}}.jpg')}}) no-repeat top center; background-size: cover;  color:#fff; overflow-y: auto; height: 100%; }
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
    .btn-box-border{ height: 50px; width: 150px; background-color: transparent; border-radius: 0px; border:solid 3px #fff; 
        font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.4em; margin:0 auto; display: block;}
    .btn-box-border:hover{ background-color: #fff; color: #0e0d2c;  border:solid 3px #fff; }
    .anchor-box-border{  width: 100px; background-color: transparent; border-radius: 0px; border:solid 3px #fff;
        text-decoration: none; color: #fff; text-align: center; margin-left: 20px;
        font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.2em; line-height: 25px; display: inline-block;}
    .anchor-box-border:hover{ background-color: #fff; color: #0e0d2c; text-decoration: none; }
    .formx-each{ margin-top: 30px; }
    .formx-each label{ text-align: left!important; }

     /*   <:::::::::::::]==|  common  |===[:::::::::::::>   */

    .gplus-login { width: 49%; margin-top: 20px; display: inline-block; }
    .fb-login{ width: 49%; margin-top: 20px;  display: inline-block;}
    .gplus-login img{  transition: all .3s; width: 100%;}
    .fb-login img{  transition: all .3s; width: 100%;}
    .gplus-login:hover>img{transform: scale(.95);  }
    .fb-login:hover>img{transform: scale(.95);  }
    .social-signin-div{ border-top:solid 1px rgba(255,255,255,.4); margin-top: 20px;}
    .lrx-title{ display: inline-block; text-align: right; margin-right: 20px; margin-top: 40px;}
    .lrx-title label{ font-weight: 200; }
    .lrx-content{ margin-top: 150px; margin-right: 0px; box-sizing: border-box; }
    .lrx-content-login{    background-color: rgba(255, 255, 255, 0.23);
    padding: 20px;
    border: solid 1px rgba(255, 255, 255, 0.25);
    box-shadow: 1px 1px 25px -5px rgba(0, 0, 0, 0.64);
 }
     .lrx-content-login h3{ border-bottom:solid 1px rgba(255,255,255,.2); padding-bottom: 10px; text-shadow: 0px 0px 10px #00f6ff;
        font-weight: 100; letter-spacing: .05em;  font-family: sans-serif; font-size: 2.2em; text-align: center; margin-top: 0px;}
    .forgot-link a{ color: #fff; text-decoration: none; margin-left: -10px; display: block;  text-align: left; }
    .forgot-link a:hover{ color: #fff; text-decoration: none;   text-shadow: 0px 0px 10px #00f6ff; }
    .btn-forgot-password{ color: #fff!important; }


   @media(max-width: 1600px){
     .btn-forgot-password{ float:left !important; }
}


     @media(max-width: 1440px){
     .lrx-content{ margin-top: 50px; }
    input{ height: 40px!important; }
    .btn-box-border{ height: 40px; }
    .landing_logo{ width: 230px;     left: 120px;
    top: 80px; }
    }
.help-block{ width: 100%; text-align: center;color: #fff; }

    @media(max-width: 1280px){
.sidebar-brand-logo{ top: 10px; }
   .landing_logo{ left: 70px; top: 30px; }
    .sidebar-brand-logo img{ width: 70px; height: 70px;}
 .lrx-content{ margin-left: 0px; }
    }
    @media(max-width: 675px){

    .lrx-title{ margin-top: 100px; }
      .lrx-content-login h3{ font-size: 2em; }
      .lrx-content{ padding-bottom: 20px; }

    
}

 @media(max-width:480px){
.lrx-title{ text-align: center;}
    .fb-login, .gplus-login{     display: block;    width: 80%;    margin: 0 auto;  margin-top: 10px; }

}

}


}
    </style>

</head>
<body id="app-layout">
<div  class="bg" >
    <div class="container-fluid">
    <div class="row" style="position: relative;">
        <!--================== New header section start =================-->
       {{--  <!--<img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">-->
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

           <div class="col-md-4 pull-right lrx-title">
                <label> Don't have an account? </label>
                <a href="{!! url('register')!!}" class="anchor-box-border"> Register </a>
            </div>

                {{-- <p> Register now to experience the best in meditation and healthy living.</p> --}}
   </div>

    <div class="row lrx-content">

	    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-sx-12  lrx-content-login">
        <div class="col-md-12">


        <h3 class="col-md-12">Customer Login</h3>
            <form class="form-horizontal" role="form" method="POST" >
                {{ csrf_field() }}
                 @if(Session::has('message'))
                    <span class="help-block">
                        <strong>{{ Session::get('message') }}</strong>
                    </span>
                @endif
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} formx-each">
                    <label for="username" class="col-md-4 control-label">Email</label>
                    <div class="col-md-8">
                        <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}">
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }} formx-each">
                    <label for="password" class="col-md-4 control-label">Password</label>

                    <div class="col-md-8">
                        <input id="password" type="password" class="form-control" name="password">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <div class="checkbox forgot-link">
                            <label>
                                <input type="checkbox" name="remember"> <span>Remember Me</span>
                            </label>
                            <a class="btn btn-link btn-forgot-password pull-right" href="{{ url('/forgot') }}">Forgot Your Password?</a>

                        </div>
                    </div>
                </div>

                <div class="form-group formx-each">
                    <div class="col-md-12">
                        <button class="btn-box-border" type="submit" class="">
                            Login
                        </button>
                   <!-- <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a> -->
                    </div>
                </div>
            </form>
            </div>
            <div class="social-signin-div col-md-12">
                        <a  class="gplus-login" href="{!! url('auth/redirect/google') !!}"><img src="{{asset('assets/web/images/signin_google.png')}}" alt=""></a>
                        <a class="fb-login" href="{!! url('auth/redirect/facebook') !!}"><img src="{{asset('assets/web/images/signin_facebook.png')}}" alt=""></a>
                    </div>
        </div>
    </div>
</div>
</div>
@include('analyticstracking.user')
</body>
</html>
