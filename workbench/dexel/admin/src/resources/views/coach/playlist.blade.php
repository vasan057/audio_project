@extends("admin::main")
@section('css')
<link href="{{asset('hls/video-js.css')}}" rel="stylesheet">
<link href="{{asset('hls/player.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('assets/playlist/css/dexel-audio-card.css')}}">
<link rel="stylesheet" href="{{asset('rating/fontawesome-stars.css')}}">
@stop
@section('content')

<nav class="navbar dexel-coach-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="{{url('coach/profile/'.base64_encode($coach->id))}}">{{$coach->fname}} {{$coach->lname}}- Audio Uploads</a>
    </div>
  </div>
</nav>
<div class="dexel-coach-maincontainer container-fluid">
  <div class="row">
    <div class="panel with-nav-tabs panel-primary">
     
<div class="panel-body">
<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1 tab-content coach-music-card">
  <div class="tab-pane fade in active" id="tab3primary">
    <div class="dexel-addplaylistpanel">
      <div class="row" id="dexel-audiopanel">
      <div class="col-md-12 col-sm-12 col-xs-12 adm-audio-info">
       
        <div class="adm-audio-info-category">
        Select Category:<select id="category_select" class="selectpicker " data-coach="{{base64_encode($coach->id)}}" autocomplete="off">
          @foreach($categories as $category)
            @if($category->id == $category_id)
              <option value="{{$category->id}}" selected="selected">{{$category->title}}</option>
            @else
              <option value="{{$category->id}}" >{{$category->title}}</option>
            @endif
          @endforeach
        </select>
        </div>
         <p class="adm-audio-info-count">Total Playlist : {{$playlists_count}}</p>
        <div class="clearboth"></div>
      </div>
        @foreach($playlists as $playlist)
        <div class="dexel-addplaylist-audiocard">
         <div class="adm-playlistcard-control">
           <a class="editPlaylist pull-left" href="{{url('coach/'.base64_encode($coach->id).'/upload/audio/'.$playlist->slug.'/edit')}}">edit</a>
           <span class="deletePlaylist pull-left" data-coach="{{base64_encode($coach->id)}}" data-slug="{{$playlist->slug}}">remove</span>
           <?php
            if($playlist->active == '-1') 
            {
              $action = 'approve';
              $lable = 'pending';
            }
            elseif($playlist->active == '1') 
            {
              $action = 'deactivate';
              $lable = 'active';
            }
            else
            {
              $action = 'activate';
              $lable = 'inactive';
            }
           ?>
           <span class="{{$lable}} freebadge approvePlaylist pull-left" data-action="{{$action}}" data-coach="{{base64_encode($coach->id)}}" data-slug="{{$playlist->slug}}" style="cursor: pointer;">{{$lable}}</span>
           <span class="freebadge pull-right text-right">Free</span>
         </div>
           @include('web.audio_card')
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
@include('web.audio_player')
@stop
@section('script')
  <script src="{{asset('hls/video.js')}}"></script>
  <script src="{{asset('hls/videojs-contrib-hls.js')}}"></script>
  <script src="{{asset('hls/player.js')}}"></script>
  <script src="{{asset('rating/jquery.barrating.js')}}"></script>
  <script src="{{asset('rating/rating.js')}}"></script>
<script type="text/javascript">
$('#dexel-audiopanel').on('click', '.deletePlaylist', function(event)
{
  event.preventDefault();
  slug = $(this).attr('data-slug');
  coach_id = $(this).attr('data-coach');
  var result = confirm("Are you sure, want to delete?");
  if(result)
  {
    $.ajax({
      url: base_url+'/coach/'+coach_id+'/remove/playlist/'+slug,
      type: 'GET',
      //dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
      //data: {param1: 'value1'},
    })
    .done(function() {
      location.reload();
      //console.log("success");
    })
    .fail(function() {
      //console.log("error");
    })
    .always(function() {
      //console.log("complete");
    });
  }
});

$('#dexel-audiopanel').on('click', '.approvePlaylist', function(event)
{
  event.preventDefault();
  current_div = $(this);
  slug = current_div.attr('data-slug');
  coach_id = current_div.attr('data-coach');
  action = current_div.attr('data-action');
  var result = confirm("Are you sure, to "+action+"?");
  if(result)
  {
    $.ajax({
      url: base_url+'/coach/'+coach_id+'/action/playlist/'+slug,
      type: 'POST',
      dataType: 'json',
      data: {'_token': csrf_token,'action':action},
    })
    .done(function(data) {
      //location.reload();
      //console.log("success");
      if(data.code == 'success')
      {
        current_div.text(data.state);
        current_div.attr('data-action',data.action);
      }
    })
    .fail(function() {
      //console.log("error");
    })
    .always(function() {
      //console.log("complete");
    });
  }
  
});

$('#category_select').change(function() {
  coach_id = $(this).attr('data-coach');
  // set the window's location property to the value of the option the user has selected
  window.location = base_url+'/coach/'+coach_id+'/upload/audios/'+$(this).val();
});
</script>
@stop