@extends("web.main")
@section('css')
@stop
@section('content')
@include('web.category')
      <section class="container dexel-video-maincontainer">
    <div class="row">

	  @foreach($videos as $video)
          <a href="{!!url('video/'.Crypt::encrypt($video->id))!!}">
            <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="video-card animate-box" data-animate-effect="fadeIn">
                <div class="img-Panel">
                  <img src="{{cdn($video->cover_img)}}" class="img-responsive" alt="video-img">
                </div>
                <div class="content-Panel text-left">
                  <h3>{{$video->title}}</h3>
                  <p><?php $description = strip_tags($video->description);
				  $description = (strlen($video->description) > 137) ? substr($video->description,0,137)."....." : $description;
				  echo $description; ?></p>
                </div>
                <div class="action-Panel container">
                    <div class="row">
                      <div class="col-md-4 col-sm-4 col-xs-4">
                        <label class="text-center"><span></span>{{$video->essence->title}}</label>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-4">
                        <label class="text-center"><span></span>{{$video->author}}</label>
                      </div>
                       <div class="col-md-4 col-sm-4 col-xs-4">
                        <label class="text-center"><span></span>{{$video->views->count()}}</label>
                      </div>

                    </div>
                </div>
            </div>
          </div></a>
	  @endforeach

      </div>
    </section>
@stop
@section('script')
<script src="{{asset('assets/web/js/video-js.js')}}"></script>
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
