@extends("admin::main")
@section('css')
  <link href="{{asset('hls/video-js.css')}}" rel="stylesheet">
  <link href="{{asset('hls/player.css')}}" rel="stylesheet">
@stop
@section('content')
<nav class="navbar dexel-coach-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">Audio Uploads</a>
    </div>
  </div>
</nav>
 <div class="dexel-coach-maincontainer container-fluid">
    <div class="row">
       <div class="panel with-nav-tabs panel-primary">
          {{-- <div class="panel-heading">
             <div class="container">
                <div class="row">
                   <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-2">
                      <ul class="nav nav-tabs">
                         <li class="active"><a href="#">Audios</a>
                         </li>
                      </ul>
                   </div>
                </div>
             </div>
          </div> --}}
          <div class="panel-body app-page">
             <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content">
                <div class="tab-pane fade in active" id="tab3primary">
                   
                   <label class="control-label col-lg-12">Trancoding Status</label>
                    <?php $errorCount = 0; $successCount = 0;?>
                    @foreach($jobs as $job)
                    <div class="row">
                      <div class="col-md-4">
                        {{$job['Status']}}
                      </div>
                      <div class="col-md-8">
                        @if($job['Status'] == 'Error')
                        <?php $errorCount = 1; ?>
                        <div class="progress">
                          <div class="progress-bar progress-bar-striped progress-bar-danger active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                          Failed . . .
                          </div>
                        </div>
                        @elseif($job['Status'] == 'Complete')
                        <?php $successCount = 1; ?>
                        <div class="progress">
                          <div class="progress-bar progress-bar-striped progress-bar-success active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            Completed . . .
                          </div>
                        </div>
                        @else
                        <?php $successCount = 0; ?>
                        <div class="progress">
                          <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                            Please wait . . .
                          </div>
                        </div>
                        @endif
                      </div>
                    @endforeach

                </div>
             </div>
          </div>
       </div>
       </div>
    </div>
 </div>

@stop
@section('script')
<script src="{{asset('assets/coach/js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('assets/coach/js/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/coach/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/coach/js/main.js')}}"></script>
<script type="text/javascript">
 <?php
if($errorCount)
{
  //stop reload the page
}
elseif($successCount)
{
  //redirect to list if all completed
?>
window.setTimeout(function()
{
  window.location.href = "{{url('coach/upload/audios') }}";
}, 10);
<?php
}
else
{
  //rfresh page
?>
window.setTimeout(function()
{
   window.location.reload(1);
}, 5000);
<?php
}
?>
</script>
@stop