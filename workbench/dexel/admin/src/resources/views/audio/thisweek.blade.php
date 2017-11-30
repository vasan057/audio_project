@extends("admin::main")
@section('css')
<link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">
@stop
@section('content')
<nav class="navbar dexel-coach-navbar">
    <div class="container-fluid">
       <div class="navbar-header">
          <a class="navbar-brand header-brand" href="#">This Week of Song</a>
       </div>
    </div>
 </nav>
<div id="add_song" class="bg in app-page2" role="dialog" >
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="background:rgba(255, 255, 255, 0.2);border:1px solid rgba(255, 255, 255, 0.4);border-radius:8px;margin:6% 0;">
      {{-- <div class="modal-header">
        <h4 class="modal-title" style="color:#424242">Quotes Information</h4>
      </div> --}}
      <div class="modal-body">
        <form id="form-ui" method="post" action="{{route('add_weeksong')}}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group" >
            <label for="email" style="color:#424242;">Select Song: <b style="color:red">*</b></label>
            <input type="hidden" name="id" id="edit_id">
            {!! Form::text('song_id', null, array('placeholder' => 'Search Song','class' => 'form-control','id'=>'search_text','required')) !!}
            {!!$errors->first("song_id","<span class='form-error'>:message</span>")!!}
            {!!$errors->first("playlist_id","<span class='form-error'>:message</span>")!!}
          </div>
          <div>
            <button type="submit" class="btn btn-bordered btn-primary mb5">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

 <div class="panel-body app-page table-page">
     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content app-table-content">
        <div class="tab-pane fade  in active" id="tab5primary">
          <a type="button" class="btn btn-info btn-lg" id="add_song_btn">Add Songs</a>
          <div class="panel-body pn">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th class="va-m">Playlist Name</th>
                          <th class="va-m">Status</th>
                          <th class="va-m">Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                          @if(!empty($playlists_count))
                          @foreach($playlist as $value)
                           @foreach($value['playlists'] as $key)
                        <tr>
                          <td>{{$key->name}}</td>
                          <td>
                             @if($value->active == 1)
                              <a href="{{route('activelist',[$value->id])}}"><span class='fa fa-eye active_coach adm-coach-view' title="Active"></span></a>
                              @else
                              <a href="{{route('activelist',[$value->id])}}"><span class='fa fa-eye-slash active_coach adm-coach-view' title="Inactive"></span></a>
                              @endif
                          </td>
                          <td>
                           <a href="{{route('deletelist',[$value->id])}}"> <span class="deletePlaylist pull-left" data-slug="stress_reduction_series" >remove</span></a>
                          </td>
                        </tr>
                        @endforeach
                        @endforeach
                        @else
                        <td></td>
                        <td>
                          No recort found
                        </td>
                        <td></td>
                        @endif
                        </tbody>

                    </table>

                </div>

            </div></div>
     </div>
  </div>
  {{$playlist->links()}}
@stop
@section('script')
   <script type="text/javascript">
    var error_1 = "{!!$errors->first('song_id')!!}";
    var error_2 ='{!!$errors->first("playlist_id")!!}';
    $(document).ready(function(){
      $('#add_song').hide();
        if(error_1 != '' || error_2 != ''){
          $('#add_song').fadeIn(1000);
          $('#add_song_btn').html('cancel');
        }
    });

      $(document).on('click','#add_song_btn',function(){
           $('#add_song').fadeIn(1000);
           $(this).html('cancel');
           $(this).attr('id','cancel_btn');
      });
      
      $(document).on('click','#cancel_btn',function(){
           $('#add_song').fadeOut(1000);
           $(this).html('Add Song');
           $(this).attr('id','add_song_btn');
      });
   </script>
   <script>
   $(document).ready(function() {
    src = "{{ route('searchsongs') }}";
     $("#search_text").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: src,
                dataType: "json",
                data: {
                    term : request.term
                },
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 3,
       
    });
});
</script>
<script src="http://demo.expertphp.in/js/jquery.js"></script>
<script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script>
@stop
