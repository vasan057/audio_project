@extends("web.main")
@section('content')
<!-- |===[:::::::::::::> New header section start -->
<div class="streak_header_space"></div>
    <!--<img src="{{asset('assets/web/images/stressfit_logo_text.png')}}" class="landing_logo" alt="">-->
    <div class="streak_header col-md-12">
       <div class="webx-page-title pull-right" >
           <div class="header-character pull-right">
            <div class="halo">
                    <span class="halo_ring1"></span>
                    <span class="halo_ring3"></span>
                    <span class="halo_ring4"></span>
                </div>
               <img src="{{asset('assets/web/images/header-character.png')}}" class="header-character-char" alt="">
            </div>
            <h2 class="pull-right">Coaches</h2>
       </div>
       <div class="clearboth"></div>
        <span class="streak-header-space"></span>
    </div>
<!-- |===[:::::::::::::> New header section end -->
            <div id="page" class="coach-list-page">
             <div class="container dexel-customercoach-Container">
             {{--<div class="row">
               <div class="col-md-12 coach-list-page-block">
                 <p>Our coaches have a varied range of skills and have expert knowledge to share with you. Browse through our list of coaches, and visit their pages to see what each of them has to offer. Their feature rich content is sure to provide you with guidance you may be looking for.

                 </p>
               </div>
             </div>--}}
               <div class="row">
                 @foreach($coaches as $coach)
                     <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="dexel-coachImgcontainer animate-box">
                        {{-- <a  href="{!!url('coache/'.base64_encode($coach->id).'/audios')!!}"> --}}
                             <a  href="{!!url('coache/'.base64_encode($coach->id).'/')!!}">
                              <img src="{{cdn($coach->profile->photo)}}" alt="img">
                           </a>
                           <span><b class="fa fa-check"></b></span>
                           <label>{!! $coach->fname.' '.$coach->lname !!}</label>
                        </div>
                     </div>
                  @endforeach

               </div>
                <div class="col-md-12  coach-list-page-block2">
                <h4> The StressFit family is constantly growing; if you would like to join us as a Coach, we welcome you to register here. </h4>

                  <a href="{{url('register/coach')}}" class="btn btn-primary btn-large"> Join now</a>
               </div>
            </div>
            <div class="gototop js-top">
               <a href="#" class="js-gotop"><i class="fa fa-long-arrow-up"></i></a>
            </div>
      @stop
      @section('javascript')
      <!-- Script=================================================================== -->
      <script>
   $(document).ready(function(){customer
      $('.dexel-coachImgcontainer').find('a').on('click', function(){
         $(this).parent().find('span').toggle();

      });
   });
</script>
@stop
