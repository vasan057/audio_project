@extends("admin::main")
@section('content')
<nav class="navbar dexel-coach-navbar2">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">View Quote</a>
    </div>
  </div>
</nav>

    <!-- Modal content-->

 <div class="quote-view">
        <h4 style="color:#424242">Quotes Information</h4>

    
        <div class="form-group" style="text-align: center!important;">
           <!--  <label for="" style="color:#424242">Cover image: </label> -->
            <img src="{{cdn($quote->cover_img)}}" />
          </div>
          <div class="form-group"  style="text-align: center!important;">
            <label for="email" style="color:#424242;">Author: </label>
            {{$quote->author}}
          </div>
        
          <div class="form-group"  style="text-align: center!important;">
            <label for="description" style="color:#424242;">Description: </label>
            {!!$quote->description!!}
          </div>
          <div>
            <a href="{{url('coach/quotes')}}" class="btn btn-bordered btn-primary mb5">Back</a>
          </div>
       
  
 </div>

@stop