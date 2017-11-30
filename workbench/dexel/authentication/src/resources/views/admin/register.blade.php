<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Stress Fit | Registration</title>
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
    <link rel="stylesheet" href="{{asset('assets/coach/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/coach/css/editor.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Calender Plugin -->
    <link rel="stylesheet" href="{{asset('assets/coach/css/jquery-ui.css')}}">

    <!-- Script
    =================================================================== -->
    <script src="{{asset('assets/coach/js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="js/respond.min.js"></script>
    <![endif]-->
	<style>
	.form-2{
		height: 320px;
    overflow-y: scroll;
    overflow-x: hidden;
	}

.loader{
    display: none;
    background: rgba(0, 0, 0, 0.6);
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9999;
}

.loader img{
   margin-left: 0%;
    margin-top: 15%;
    width: 200px;
    height: 200px;
}

.header-text{

  padding-left: 45%;
  padding-top: 25px;
}
.header-text img{
  width: 250px;
  display: block;
}
/*   <:::::::::::::]==|  Header   |===[:::::::::::::>   */

   /* .streak-header{ display: block; width: 100%; height: 250px; background:url({{asset('assets/web/images/streak_bottom_1.png')}})no-repeat bottom center; background-size: 100% 100%; position: absolute;     bottom: 0; left: 0; }
    .streak_header{ position: relative; width: 100%; height: 250px; background: url({{asset('assets/web/images/streak_header_bg.jpg')}})no-repeat center center; background-size: cover;   }
    .landing_logo{ position: absolute;left: 150px; top:70px; width: 320px; z-index: 2;}
    .webx-page-title{  height: 250px;  }*/
    .lrx-title h3{font-size: 30px;    text-transform: uppercase;    margin-top: 50px;    font-weight: 600;    color: #fff;
    text-shadow: 0px 0px 10px #00f6ff;    float: right;    margin-right: 20px; font-family: 'Lato', sans-serif;}
    .landing_logo {    position: absolute;    left: 150px;    top: 70px;    width: 320px;    z-index: 2;}
    /*.bg{ background:url({{asset('assets/web/images/bg_login_top{{-- happening_bgX --}}.jpg')}}) no-repeat top center; background-size: cover;  color:#fff;}*/
    .bg{ background-color: #fff; color: #fff; }
    .sidebar-brand-logo{    position: absolute;    top: 40px;    width: 70px;    height: 191px;    margin: 0;    padding: 0;
        list-style: none;    /*background: url(../images/sf_home_menu_abstract.png) no-repeat;*/    background-size: 100% 55%;    z-index: 9999;}
    .sidebar-brand-logo img{    width: 116px;    height: 116px;    margin-top: 10px;    margin-left: 24px;}



    /*   <:::::::::::::]==|  common  |===[:::::::::::::>   */

    .lrx-title{ display: inline-block; text-align: right; margin-right: 20px; margin-top: 40px;}
    .lrx-title label{ font-weight: 200; }
    .streak-bottom{ display: block; width: 100%; height: 150px; background:url({{asset('assets/web/images/streak_bottom_1.png')}})no-repeat bottom center;
    background-size: 100% 100%;  position:absolute; bottom:0;}
 /*   <:::::::::::::]==|  unique to this layout  |===[:::::::::::::>   */
    .lrx-page{ margin-top: 0px; background-color: #fff; padding-bottom: 50px;}
    .lrx-page-inner{ margin-top: -50px; }
    .lrx-page-inner  h3{ color: #424242; }

    .white-patch{ position: absolute; width: 100%; height:100px; bottom: 0px; left: 0px; background-color: #fff; }
      #step1, #step2, #step3, #step4{    padding-top: 20px; /*border-bottom:solid 1px #d2d2d2;*/}

      #step1 legend, #step2 legend, #step3 legend, #complete legend{  border-bottom:solid 3px #6061cb; padding-left: 0px; padding-bottom: 10px;  }

 .instruct_txt{ float: left; color: #6061cb; text-align: left; }
 .instruct_txt2{ float: right; color: #6061cb; }
.clearboth { clear:both; }
textarea{ resize:vertical;  }
.about_textarea{ height: 200px!important; }
.form-group{ margin-top: 20px!important; }


.gender-select div{ display: inline-block;  margin-left: 20px; float: left; }
.gender-select div:first-child{ margin-left: 0px!important; }

.gender-select p { display: inline-block; }

.gender-select input{}

      @media(max-width: 1600px){   /*.bg{ position: relative; }*/ }
      .lrx-radito-dark span{ color: #626262;  }



/*overrides*/

/*#page{ height: auto; overflow: hidden; }
body{ overflow-x:initial; }*/

.bg-top{ position: relative; height: 360px;background:url({{asset('assets/web/images/bg_login_top{{-- happening_bgX --}}.jpg')}}) no-repeat top center; background-size: cover;  }
.form-error{ color: #d14734; }

.add-expertise{ border-top:solid 1px #d2d2d2; padding-top: 20px; text-align: left; }
.add-expertise-btn{
    width: 40px;    height: 31px; line-height: 31px;    font-size: 18px;    text-align: center;    background-color: #24b393;
    color: #fff;    border: solid 1px #1f9479;    position: relative;    top: 2px;    cursor: pointer;
 }
.add-expertise-btn:hover{ background-color: #1f9479;  }
.add-expertise input{ border:solid 1px #d2d2d2; background-color: #f8f8f8; padding-left: 4px; }
.expertise_text{ line-height: 1em; }

.remove_expertise{
    width: 32px;    height: 32px; line-height: 31px;    font-size: 18px;    text-align: center;        background-color: #d65959;
    color: #fff;    border: solid 1px #a63434;   position: relative;    top: 2px;    cursor: pointer; border-radius: 50%;
 }

.remove_expertise:hover{ background-color: #a63434; }
.exp_error{ display: block;    font-size: .8em;    line-height: 1.1em;    margin-top: 10px;     }
.btn-register{ height: 60px; font-size: 1.2em!important; }



@media(max-width:1367px){
.bg-top{ position: relative; height: 300px;}
.landing_logo{ width: 275px; top: 40px; left: 100px; }
.sidebar-brand-logo{ top: 10px; }
.form-group{ margin-top: 10px!important; }
.sidebar-brand-logo img{ width: 100px; height: 100px;}
}
.reg-success{ 
    color: #2faf7a!important;
    font-weight: bold;
    letter-spacing: .05em;  font-size: 20px; }


@media(max-width:1280px){
    .landing_logo{ left: 70px; top: 30px; width: 230px;}
    .sidebar-brand-logo img{ width: 70px; height: 70px;}
.sidebar-brand-logo{ top: 10px; }
}

@media(max-width:1024px ){
.streak-bottom{ height: 100px; }
.lrx-title h3{ margin-bottom: 0px;  }
.bg-top{ height: 200px; }
.instruct_txt2{ float: left; }
}

@media(max-width:768px ){
.lrx-title{     float: left!important;    margin-left: 90px; }
.streak-bottom{ height: 70px;  }
.lrx-title h3{ font-size: 24px; }
.form-group{ margin-top: 0px!important; margin-bottom: 0px; }
.form-control{ padding: 6px 10px; }
}

@media(max-width:575px ){
   .streak-bottom{ height: 50px;  }
}

	</style>

</head>

<body class="bg">
    <div id="page">
        <div class="container-fluid">
        <div class="row bg-top">
<!--================== New header section start =================-->
       {{--  <img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">
        <div class="streak_header col-md-12">
           <div class="webx-page-title col-md-5 pull-right" style="background: url({{asset('assets/web/images/streak-header-audio.png')}})no-repeat bottom right;">
               <h2>Coach login</h2>
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
               <h3>Coach Registration</h3>
            </div>
        <div class="streak-bottom row"></div>
</div>

            <div class="row">
                <div id="dexel-coach-formPanel">
                    <div class="debel-Regwizard">
                        <!-- <div class="debel-Regwizard-inner col-md-2 col-sm-2 col-xs-2">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
                                        <i class="fa fa-briefcase"></i>
                                    </a>
                                </li>

								<li role="presentation" class="disabled">
                                    <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab" title="Step 3">
                                        <i class="fa fa-briefcase"></i>
                                    </a>
                                </li>

                                <li role="presentation" class="disabled">
                                    <a href="#complete" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
                                        <i class="fa fa-rocket"></i>
                                    </a>
                                </li>
                            </ul>
                        </div> -->
                        <div class="col-md-2 col-sm-2 col-xs-2 "  >
                            <div class="reg_anchors " id="sticky-anchor">
                            <div class="reg_anchors_inner " id="sticky-element">
                                <ul>
                                    <li><p>Personal</p><a href="#step1" ><i class="fa fa-user"></i></a></li>
                                    <li><p>Contact</p><a href="#step2" ><i class="fa fa-phone"></i></a></li>
                                    <li><p>Expertise</p><a href="#step3" ><i class="fa fa-briefcase"></i></a></li>

                                </ul>
                            </div>
                            </div>
                         </div>


                        <form role="form" class="col-md-7 col-sm-10 col-xs-10"  method="post" enctype= multipart/form-data>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            @if(Session::has('message'))
                                <p class="reg-success">{{ Session::get('message') }}</p>
                            @endif

                                <div id="step1">
                                    <legend>Personal Information</legend>
                                    <label class="instruct_txt">Please enter your personal details in the following form.</label>
                                    <label class="instruct_txt2">*All fields are mandatory</label>
                                    <div class="clearboth"></div>
                                    <div class="form-horizontal dexel-coach-form">

                                        <div class="form-group">
                                            <label for="inputName3" class="col-sm-4">First name *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="fname" name="fname" placeholder="" value="{{old('fname')}}">
                                                {!!$errors->first('fname','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Last name *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="lname" name="lname" placeholder="" value="{{old('lname')}}">
                                                {!!$errors->first('lname','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>

										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Email *</label>
                                            <div class="col-sm-6">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="" value="{{old('email')}}">
                                                {!!$errors->first('email','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Password *</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                                {!!$errors->first('password','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Confirm Password *</label>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                                {!!$errors->first('confirm_password','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Gender *</label>
                                            <div class="col-sm-6 gender-select">
                                            @foreach(['M'=>'Male','F'=>'Female','O'=>'Others'] as $key=>$value)
                                            <?php $selected=''; if(old('gender') == $key) { $selected ='checked="checked"'; } ?>
                                               <div> <input type="radio" name="gender" placeholder="" value="{{$key}}" {{$selected}}>&nbsp;<p>{{$value}}</p></div>
                                            @endforeach
                                                {!!$errors->first('gender','<p class="form-error">:message</p>')!!}
                                            </div>
                                            <div class="clearboth"></div>
                                        </div>
										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Date of birth *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="dob" name="dob" placeholder="dd-mm-yyyy" value="{{old('dob')}}">
                                                {!!$errors->first('dob','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Profile Picture</label>
                                            <div class="col-sm-6">
                                                <input type="file" class="form-control" id="photo" name="photo" placeholder="" value="{{old('photo')}}">
                                                {!!$errors->first('photo','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputName3" class="col-sm-4">About *</label>
                                            <div class="col-md-6">
                                                <textarea id="about" class="form-control about_textarea" name="about">{{old('about')}}</textarea>
                                                {!!$errors->first('about','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>

                                        <!--<div class="form-group">
                                            <div id="txtEditor"></div>
                                        </div>-->

                                    </div>
                                   <!--  <ul class="dexel-reg-btn">
                                        <li class="pull-right">
                                            <button type="button" class="btn btn-primary next-step">Next <i  style="font-size:12px" class="fa fa-arrow-right" aria-hidden="true"></i> </button>
                                        </li>
                                    </ul> -->
                                </div>

								<div id="step2">
                                    <legend>Contact Details</legend>
                                    <label class="instruct_txt">All personal information kept private.</label>
                                    <label class="instruct_txt2">*All fields are mandatory</label>
                                    <div class="clearboth"></div>
                                    <div class="form-horizontal dexel-coach-form">
                                        <div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Contact number *</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{old('phone')}}">
                                                {!!$errors->first('phone','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>


										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Address</label>
                                            <div class="col-sm-6">
												<textarea class="form-control" id="address" name="address[street]">{{old('address.street')}}</textarea>
                                                {!!$errors->first('address.street','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Suburb</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="suburb" name="address[suburb]" placeholder="" value="{{old('address.suburb')}}">
                                                {!!$errors->first('address.suburb','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Postal code</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="postal_code" name="address[postal_code]" placeholder="" value="{{old('address.postal_code')}}">
                                                {!!$errors->first('address.postal_code','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">State</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="state" name="address[state]" placeholder="" value="{{old('address.state')}}">
                                                {!!$errors->first('address.state','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label for="inputName3" class="col-sm-4">Country</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="country" name="address[country]" placeholder="" value="{{old('address.country')}}">
                                                {!!$errors->first('address.country','<span class="form-error">:message</span>')!!}
                                            </div>
                                        </div>


                                        <!--<div class="form-group">
                                            <div id="txtEditor"></div>
                                        </div>-->

                                    </div>
                                   <!--  <ul class="dexel-reg-btn">
										<li class="pull-left">
                                            <button type="button" class="btn btn-primary prev-step"><i  style="font-size:12px" class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                                        </li>
                                        <li class="pull-right">
                                            <button type="button" class="btn btn-primary next-step">Next <i  style="font-size:12px" class="fa fa-arrow-right" aria-hidden="true"></i> </button>
                                        </li>
                                    </ul> -->
                                </div>



                                <div  id="step3">
                                    <div class="container-fluid dexel-coach-expertPanel">
                                        <div class="row">
                                            <legend>Expertise</legend>
                                            <label class="instruct_txt">*Select or add fields of expertise.</label>
                                            <div class="clearboth"></div>
                                            <div class="dexel-coach-expertise" id="dexel-coach-expertise">
                                                @foreach($expertise as $expert)
                                                    <div class="col-md-3 col-sm-3 col-xs-4 expert-circle">
                                                        <input type='checkbox' name='expert_in[]' value="{{$expert->id}}" data="expert{{$expert->title}}" id="expert{{$expert->id}}" class="chk expert"/>
                                                        <label for="expert{{$expert->id}}" class="expertise_icn"><img src="{{asset('expertise/images/'.str_replace(' ', '_', strtolower(trim($expert->title))).'.png')}}" alt=""></label>
                                                        <span class="text-center">{{$expert->title}}</span>
                                                    </div>
                                                @endforeach
                                                @if(($custom_expertise = count(old('custom_expertise'))))
                                                    @foreach(range(0, $custom_expertise-1) as $index)
                                                        <div class="col-md-3 col-sm-3 col-xs-4 expert-circle">
                                                            <input type='checkbox' name='custom_expertise[]' class="chk cust_expert" checked="" value="{{old('custom_expertise')[$index]}}"/>
                                                            <label class="expertise_icn"><img src="{{asset('expertise/images/default.png')}}" alt=""></label>
                                                            <span class="text-center">{{old('custom_expertise')[$index]}}</span>
                                                            <span class="remove_expertise fa fa-close"></span>
                                                            {!!$errors->first("custom_expertise.".$index,"<span class='form-error exp_error'>:message</span>")!!}
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        {!!$errors->first('expert_in','<div class="row pull-left"><span class="form-error">:message</span></div>')!!}
                                        <div class="clearboth"></div>
                                        <div class="row add-expertise" >
                                            <label>Additional Expertise</label>
                                            <input type="text" id="custom_expertise" maxlength="25"/>
                                            <span id="add_custom_expertise"  class="fa fa-plus add-expertise-btn"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-10 col-xs-12">
                                      {!!Recaptcha::render()!!}
                                      {!!$errors->first('g-recaptcha-response','<span class="form-error pull-left">:message</span>')!!}
                                    </div>
                                    <div class="clearboth"></div>
                                    <ul class="dexel-reg-btn">
                                        <!-- <li class="pull-left">
                                            <button type="button" class="btn btn-primary prev-step"><i  style="font-size:12px" class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                                        </li> -->
                                        <li class="pull-left">
                                            <button type="submit" class="btn btn-primary btn-register" id="register_id">Register <i  style="font-size:12px" class="fa fa-arrow-right" aria-hidden="true"></i> </button>
                                        </li>
                                    </ul>
                                </div>
                        </form>
                    </div>


                </div>


            </div>
        </div>

    </div>

    <div class="loader" id="loader">
   <img src="{{asset('assets/user/images/totoro.gif')}}">
</div>

    <div class="gototop js-top">
        <a href="#" class="js-gotop"><i class="fa fa-long-arrow-up"></i></a>
    </div>

    <!-- Script
    =================================================================== -->
    @include('analyticstracking.coach')
    <script src="{{asset('assets/coach/js/jquery-3.1.1.min.js')}}"></script>
    <script src="{{asset('assets/coach/js/jquery-ui.js')}}"></script>
    <script src="{{asset('assets/coach/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/coach/js/main.js')}}"></script>
    <script src="{{asset('assets/coach/js/editor.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function() {

            var cardheight = window.innerHeight;
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
    			$(".expert:checked").each(function() {
    			chkArray.push($(this).attr('data'));
    			});
                $(".cust_expert:checked").each(function() {
                chkArray.push($(this).val());
                });
    			var selected;
    			expert_in_details = chkArray.join(', ');
    			$("#expert_in_details").html(expert_in_details);

    		});

            // Date Picker
            $( "#dob" ).datepicker({
                dateFormat: 'dd-mm-yy',
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0"
            });
            $('#custom_expertise').keypress(function(e){
                if (e.keyCode === 10 || e.keyCode === 13)
                {
                    e.preventDefault();
                    add_cust_exp();
                }
            });
            $('#add_custom_expertise').click(function(event) {
                add_cust_exp();
                //return false;
            });
            $('#dexel-coach-expertise').on('click', '.remove_expertise', function(event) {
                event.preventDefault();
                $(this).parent().remove();
            });
        });
        function add_cust_exp()
        {
            var expert = $.trim($('#custom_expertise').val());
            if(expert.length > 0)
            {
                $('#dexel-coach-expertise').append('<div class="col-md-3 col-sm-3 col-xs-4 expert-circle"><input name="custom_expertise[]" data="expertDietician" class="chk cust_expert" type="checkbox" checked value="'+expert+'"> <label class="expertise_icn"><img src="{{asset('expertise/images/default.png')}}" alt=""></label><span class="text-center expertise_text">'+expert+'</span><span class="remove_expertise fa fa-close"></span></div>');
                $('#custom_expertise').val('');
            }
        }
        function nextTab(elem) {
            $(elem).next().find('a[data-toggle="tab"]').click();
        }

        function prevTab(elem) {
            $(elem).prev().find('a[data-toggle="tab"]').click();
        }

    </script>
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


</body>

</html>
