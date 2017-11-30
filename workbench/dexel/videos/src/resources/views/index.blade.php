@extends("web.main")

@section('content')
@section('css')
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,500,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="{{asset('assets/videos/css/display.css')}}">
    @stop

@include('web.category')
<div class="container">
  <div class="row">
<div class="col col-md-8">
  <div class="grid">
  <figure class="effect-goliath">
    <img src="{{asset('assets/videos/images/cover1_full.jpg')}}" alt="img24"/>
    <figcaption>
      <h2>Thoughtful <span>Goliath</span></h2>
      <a href="#"><p>When Goliath comes out, you should run.</p></a>
    </figcaption>
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4">
        <label class="text-center"><span></span>40 mins</label>
      </div>
       <div class="col-md-4 col-sm-4 col-xs-4">
        <label class="text-center"><span></span>Lvl 2-5</label>
      </div>
       <div class="col-md-4 col-sm-4 col-xs-4">
        <label class="text-center"><span></span>33425</label>
      </div>
    </div>
  </figure>
  <figure class="effect-goliath">
    <img src="{{asset('assets/videos/images/cover1_full.jpg')}}" alt="img24"/>
    <figcaption>
      <h2>Thoughtful <span>Goliath</span></h2>
      <p>When Goliath comes out, you should run.</p>
      <a href="#">View more</a>
    </figcaption>
    <div class="row">
      <div class="col-md-4 col-sm-4 col-xs-4">
        <label class="text-center"><span></span>40 mins</label>
      </div>
       <div class="col-md-4 col-sm-4 col-xs-4">
        <label class="text-center"><span></span>Lvl 2-5</label>
      </div>
       <div class="col-md-4 col-sm-4 col-xs-4">
        <label class="text-center"><span></span>33425</label>
      </div>
    </div>
  </figure>
</div>
<div class="grid">
<figure class="effect-goliath">
  <img src="{{asset('assets/videos/images/cover1_full.jpg')}}" alt="img24"/>
  <figcaption>
    <h2>Thoughtful <span>Goliath</span></h2>
    <p>When Goliath comes out, you should run.</p>
    <a href="#">View more</a>
  </figcaption>
  <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
      <label class="text-center"><span></span>40 mins</label>
    </div>
     <div class="col-md-4 col-sm-4 col-xs-4">
      <label class="text-center"><span></span>Lvl 2-5</label>
    </div>
     <div class="col-md-4 col-sm-4 col-xs-4">
      <label class="text-center"><span></span>33425</label>
    </div>
  </div>
</figure>
<figure class="effect-goliath">
  <img src="{{asset('assets/videos/images/cover1_full.jpg')}}" alt="img24"/>
  <figcaption>
    <h2>Thoughtful <span>Goliath</span></h2>
    <p>When Goliath comes out, you should run.</p>
    <a href="#">View more</a>
  </figcaption>
  <div class="row">
    <div class="col-md-4 col-sm-4 col-xs-4">
      <label class="text-center"><span></span>40 mins</label>
    </div>
     <div class="col-md-4 col-sm-4 col-xs-4">
      <label class="text-center"><span></span>Lvl 2-5</label>
    </div>
     <div class="col-md-4 col-sm-4 col-xs-4">
      <label class="text-center"><span></span>33425</label>
    </div>
  </div>
</figure>
</div>
</div>
</div><!--sabrina-->
</div>

@stop
@section('javascript')
<script>
  // For Demo purposes only (show hover effect on mobile devices)
  [].slice.call( document.querySelectorAll('a[href="#"') ).forEach( function(el) {
    el.addEventListener( 'click', function(ev) { ev.preventDefault(); } );
  } );
</script>

@stop
