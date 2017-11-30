<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="icon" type="image/png" href="{{asset('favicon.png')}}">


    <title>Stressfit | Registration</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <!-- Calender Plugin -->
    <link rel="stylesheet" href="{{asset('assets/coach/css/jquery-ui.css')}}">

      <style>
        /*   <:::::::::::::]==|  Header   |===[:::::::::::::>   */

   /* .streak-header{ display: block; width: 100%; height: 250px; background:url({{asset('assets/web/images/streak_bottom_1.png')}})no-repeat bottom center; background-size: 100% 100%; position: absolute;     bottom: 0; left: 0; }
    .streak_header{ position: relative; width: 100%; height: 250px; background: url({{asset('assets/web/images/streak_header_bg.jpg')}})no-repeat center center; background-size: cover;   }
    .landing_logo{ position: absolute;left: 150px; top:70px; width: 320px; z-index: 2;}
    .webx-page-title{  height: 250px;  }*/
    .lrx-title h3{font-size: 30px;    text-transform: uppercase;    margin-top: 50px;    font-weight: 600;    color: #fff;
    text-shadow: 0px 0px 10px #00f6ff;    float: right;    margin-right: 20px;font-family: 'Lato', sans-serif;}
    .landing_logo {    position: absolute;    left: 150px;    top: 70px;    width: 320px;    z-index: 2;}
    .bg{ background:url({{asset('assets/web/images/bg_login{{-- happening_bgX --}}.jpg')}}) no-repeat top center; background-size: cover;  color:#fff;}
    .sidebar-brand-logo{    position: absolute;    top: 40px;    width: 70px;    height: 191px;    margin: 0;    padding: 0;
        list-style: none;    /*background: url(../images/sf_home_menu_abstract.png) no-repeat;*/    background-size: 100% 55%;    z-index: 9999;}
    .sidebar-brand-logo img{    width: 116px;    height: 116px;    margin-top: 10px;    margin-left: 24px;}

   /*   <:::::::::::::]==|  common  |===[:::::::::::::>   */

    .gplus-login { display: block; display: inline-block; cursor: pointer;}
    .fb-login{ display: block; display: inline-block; cursor: pointer;}
    .gplus-login img{  transition: all .3s; width: 225px;}
    .fb-login img{  transition: all .3s; width: 225px;}
    .gplus-login:hover>img{transform: scale(.95);  }
    .fb-login:hover>img{transform: scale(.95);  }
    .social-signin-div{ border-top:solid 1px rgba(255,255,255,.4); margin-top: 20px; margin-bottom: 20px;}
    .lrx-title{ display: inline-block; text-align: right; margin-right: 20px; margin-top: 40px;}
    .lrx-title label{ font-weight: 200; }
    .streak-bottom{ display: block; width: 100%; height: 150px; background:url({{asset('assets/web/images/streak_bottom_1.png')}})no-repeat bottom center;
    background-size: 100% 100%; }
 /*   <:::::::::::::]==|  unique to this layout  |===[:::::::::::::>   */
    .lrx-page{ margin-top: 0px; background-color: #fff; padding-bottom: 50px;}
    .lrx-page-inner{ margin-top: -50px; }
    .lrx-page-inner  h3{ color: #424242; }
    label{ color: #626262; }
    input{ color: #626262; }
    .white-patch{ position: absolute; width: 100%; height:100px; bottom: 0px; left: 0px; background-color: #fff; }
      #step1{ border-top: solid 1px #d2d2d2;    padding-top: 20px; }

            .lrx-radito-dark span{ color: #626262;  }
.form-error{ color: #d14734; }
.form-success{    
    color: #2faf7a;
    font-weight: bold;
    letter-spacing: .05em;  font-size: 20px;}

@media(max-width: 1600px){   .bg{ position: relative; } }


@media(max-width:1280px){
    .landing_logo{ left: 70px; top: 30px; width: 230px;}
    .sidebar-brand-logo img{ width: 70px; height: 70px;}
.sidebar-brand-logo{ top: 10px; }
}


@media(max-width:1024px ){
.streak-bottom{ height: 100px; }
    .lrx-title h3{ margin-bottom: 0px;  }
}
@media(max-width:768px ){
.lrx-title{     float: left!important;    margin-left: 90px; }
.streak-bottom{ height: 70px;  }
.lrx-page-inner  h3{ margin-top: 40px; }
}
@media(max-width:575px ){
    .lrx-title h3{ font-size: 24px; }
   .streak-bottom{ height: 50px;  }
}

</style>
</head>
<body id="app-layout" class="bg">
<div class="white-patch"></div>
<div class="container-fluid">
<div class="row">
<!--================== New header section start =================-->
       {{--  <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">
        <div class="streak_header col-md-12">
           <div class="webx-page-title col-md-5 pull-right" style="background: url({{asset('assets/web/images/streak-header-audio.png')}})no-repeat bottom right;">
               <h2>Customer Login</h2>
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
               <h3>Customer Registration</h3>
            </div>

</div>
<div class="streak-bottom row"></div>
    <div class="row admin-login-area lrx-page">


                <div class="lrx-page-inner ">
                  <form role="form" class="col-md-6 col-sm-8 col-xs-12 col-md-offset-2"  method="post" enctype= multipart/form-data>
                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          @if(Session::has('message'))
                              <p class="form-success">{{ Session::get('message') }}</p>
                          @endif
                    <h3>Register with</h3>
                    <div class="social-signin-div col-md-12">
                        <a  class="gplus-login" href="{!! url('auth/redirect/google') !!}"><img src="{{asset('assets/web/images/signin_google.png')}}" alt="Sign in with google plus"></a> |
                        <a class="fb-login" href="{!! url('auth/redirect/facebook') !!}"><img src="{{asset('assets/web/images/signin_facebook.png')}}" alt=""></a>
                      </div>
<h3>or with Email</h3>

                              <div class="tab-pane active" role="tabpanel" id="step1">

                                  <div class="form-horizontal dexel-coach-form">

                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">First name</label>
                                          <div class="col-sm-7">
                                              <input type="text" class="form-control" id="fname" name="fname" placeholder="" value="{{old('fname')}}">
                                              {!!$errors->first('fname','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">Last name</label>
                                          <div class="col-sm-7">
                                              <input type="text" class="form-control" id="lname" name="lname" placeholder="" value="{{old('lname')}}">
                                              {!!$errors->first('lname','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">Contact number</label>
                                          <div class="col-sm-7">
                                              <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{old('phone')}}">
                                              {!!$errors->first('phone','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">Email</label>
                                          <div class="col-sm-7">
                                              <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{old('email')}}">
                                              {!!$errors->first('email','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">Password</label>
                                          <div class="col-sm-7">
                                              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                              {!!$errors->first('password','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">Confirm Password</label>
                                          <div class="col-sm-7">
                                              <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                              {!!$errors->first('confirm_password','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">Gender</label>
                                          <div class="col-sm-7">
                                              <div class="lrx-radito-dark">
                                                  @foreach(['M'=>'Male','F'=>'Female','O'=>'Other'] as $key=>$value)
                                            <?php $selected=''; if(old('gender') == $key) { $selected ='checked="checked"'; } ?>
                                                <div class="col-xs-4 col-sm-4" >
                                                <input type="radio" name="gender" placeholder="" value="{{$key}}" {{$selected}}>&nbsp; <span>{{$value}}</span>
                                                </div>
                                            @endforeach
                                          </div>
                                                {!!$errors->first('gender','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>
                                      <div class="form-group">
                                          <label for="inputName3" class="col-sm-4">Date of birth</label>
                                          <div class="col-sm-7">
                                              <input type="text" class="form-control" id="dob" name="dob" placeholder="dd-mm-yyyy" value="{{old('dob')}}">
                                              {!!$errors->first('dob','<span class="form-error">:message</span>')!!}
                                          </div>
                                      </div>

                                      <div class="form-group">
                                      <label class="col-sm-4"></label>
                                        <div class="col-sm-7">
                                          {!!Recaptcha::render()!!}
                                          {!!$errors->first('g-recaptcha-response','<span class="form-error">:message</span>')!!}
                                        </div>
                                      </div>

                                  </div>
                              </div>

                              <button type="submit" class="btn btn-primary btn-lg next-step" id="register_id">Register <i  style="font-size:12px" class="fa fa-arrow-right" aria-hidden="true"></i> </button>
                              <div class="clearfix"></div>

                      </form>


                </div>



	</div>
</div>
{{-- <div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="fa fa-long-arrow-up"></i></a>
</div> --}}
@include('analyticstracking.user')
<script src="{{asset('assets/coach/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('assets/coach/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/coach/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/coach/js/main.js')}}"></script>
    <script src="{{asset('assets/coach/js/editor.js')}}"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            // var cardheight = window.innerHeight;
            // $('#dexel-coach-formPanel').css('height', cardheight - 80);
            // $('.dexel-coachRegbg').css('height', cardheight - 80);
            // $('.debel-Regwizard-inner').css('height', cardheight - 80);
            // $('.tab-content').css('height', cardheight - 100);
            // $('.dexel-coach-expertise').css('height', cardheight - 320);

            $('.nav-tabs > li a[title]').tooltip();


            $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {

                var $target = $(e.target);

                if ($target.parent().hasClass('disabled')) {
                    return false;
                }
            });

            $(".next-step").click(function(e) {

                var $active = $('.debel-Regwizard .nav-tabs li.active');
                $active.next().removeClass('disabled');
                nextTab($active);

            });
            $(".prev-step").click(function(e) {

                var $active = $('.debel-Regwizard .nav-tabs li.active');
                prevTab($active);

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
  			chkArray.push($(this).val());
  			});
  			var selected;
  			expert_in_details = chkArray.join(',') + ",";
  			$("#expert_in_details").html(expert_in_details);

		  });

      // Date Picker
        $( "#dob" ).datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "-100:+0"
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
</html>
