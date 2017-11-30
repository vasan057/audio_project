<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">
    <title>Stressfit | Activation</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
     <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
    html{ height: 100%; background-color: #16234f;}
body{ height: 100%;   }

    /*   <:::::::::::::]==|  Header   |===[:::::::::::::>   */

   /* .streak-header{ display: block; width: 100%; height: 250px; background:url({{asset('assets/web/images/streak_bottom_1.png')}})no-repeat bottom center; background-size: 100% 100%; position: absolute;     bottom: 0; left: 0; }
    .streak_header{ position: relative; width: 100%; height: 250px; background: url({{asset('assets/web/images/streak_header_bg.jpg')}})no-repeat center center; background-size: cover;   }
    .landing_logo{ position: absolute;left: 150px; top:70px; width: 320px; z-index: 2;}
    .webx-page-title{  height: 250px;  }*/
    .webx-page-title h2{ font-size: 50px;  text-transform: uppercase; margin-top: 50px;  font-weight: 600; color: #fff; text-shadow: 0px 0px 10px #00f6ff; float: right;        margin-right: 200px;}
    .landing_logo {    position: absolute;    left: 150px;    top: 70px;    width: 320px;    z-index: 2;}
    .bg{ background:url({{asset('assets/web/images/bg_login{{-- happening_bgX --}}.jpg')}}) no-repeat top center; background-size: cover;  color:#fff;  overflow-y: auto; height: 100%;}
    .sidebar-brand-logo{    position: fixed;    top: 40px;    width: 70px;    height: 191px;    margin: 0;    padding: 0;
        list-style: none;    /*background: url(../images/sf_home_menu_abstract.png) no-repeat;*/    background-size: 100% 55%;    z-index: 9999;}
    .sidebar-brand-logo img{    width: 116px;    height: 116px;    margin-top: 10px;    margin-left: 24px;}

    /*   <:::::::::::::]==|  Form  |===[:::::::::::::>   */

    input{ height: 50px!important; line-height: 50px!important; font-weight: 400; letter-spacing: .05em;
            background-color: #fff; font-family: sans-serif; font-size: 1.1em;}
    label{ font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.4em; text-align: left;}
    .checkbox label input[type="checkbox"]{ width: 20px; height: 30px!important; }
    .checkbox label{ font-size: 1em; line-height: 30px;}
    .checkbox label span{ position: relative; top: 3px;  padding-left:15px;}
    .btn-box-border{ height: 50px; width: 150px; background-color: transparent; border-radius: 0px; border:solid 3px ;
        font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.4em;}
    .btn-box-border:hover{ background-color: #fff; color: #0e0d2c; }
    .anchor-box-border{  width: 100px; background-color: transparent; border-radius: 0px; border:solid 3px #fff;
        text-decoration: none!important; color: #fff!important; text-align: center;
        font-weight: 200; letter-spacing: .05em;  font-family: sans-serif; font-size: 1.2em; line-height: 35px; display: block;
        margin-top: 10px;}

    .anchor-box-border:hover{ background-color: #fff; color: #0e0d2c!important; text-decoration: none; }
    .formx-each{ margin-top: 30px; }
    .formx-each label{ text-align: left!important; }

     /*   <:::::::::::::]==|  common  |===[:::::::::::::>   */

    .gplus-login { margin-top: 20px; display: block;}
    .fb-login{ margin-top: 20px;  display: block;}
    .gplus-login img{  transition: all .3s; width: 225px;}
    .fb-login img{  transition: all .3s; width: 225px;}
    .gplus-login:hover>img{transform: scale(.95);  }
    .fb-login:hover>img{transform: scale(.95);  }
    .social-signin-div{ border-top:solid 1px rgba(255,255,255,.4); margin-top: 20px;}
    .lrx-title{ display: inline-block; text-align: right; margin-right: 20px; margin-top: 40px;}
    .lrx-title label{ font-weight: 200; }
    .lrx-content{ margin-top: 150px; margin-right: 0px; box-sizing: border-box; }
    .lrx-content-login{    /*  background-color: rgba(0,0,0,.4); border:solid 1px rgba(0,0,0,.5); padding:40px 0 40px 0;
        box-sizing: border-box;   */  }
     .lrx-content-login h3{ border-bottom:solid 1px rgba(255,255,255,.2); padding-bottom: 10px; text-shadow: 0px 0px 10px #00f6ff;
        font-weight: 100; letter-spacing: .05em;  font-family: sans-serif; font-size: 2.6em; text-align: left;}

         @media(max-width: 1440px){ 
        .lrx-content{ margin-top: 150px; } 
        input{ height: 40px!important; line-height: 40px!important;}
        .btn-box-border{ height: 40px; }
        .landing_logo{ width: 230px;     left: 120px; top: 20px;
    }

  .sidebar-brand-logo{ top: 10px; }
   }
 @media(max-width: 1280px){ 

   .landing_logo{ left: 70px; top: 30px; }
    .sidebar-brand-logo img{ width: 70px; height: 70px;}
    }       

 @media(max-width: 480px){ 
    .landing_logo {    width: 200px;    left: 88px; }

  
}
    </style>

</head>
<body id="app-layout">

<div  class="bg">
    <div class="container-fluid">
    <div class="row">
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
   </div>

    <div class="row lrx-content">
         <div class="col-md-6 col-md-offset-4 col-xs-12 lrx-content-login">
        <h3 class="col-xs-12">Account Activation</h3>
        <div class="form-group formx-each">
                    <label for="password_confirmation" class="col-md-12 control-label">Thank you, your account has been activated successfuly! <br/><br/><a class="anchor-box-border" href={{url('/login/coach')}}>login</a></label>
                </div>
        </div>
    </div>
</div>
</div>
</body>
@include('analyticstracking.coach')
</html>
