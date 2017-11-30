@extends("admin::main")
@section('css')
<link rel="stylesheet" href="{{asset('assets/coach/css/jquery-ui.css')}}">
@stop
@section('content')
<nav class="navbar dexel-coach-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">Edit Playlist</a>
    </div>
  </div>
</nav>
<div class="dexel-coach-maincontainer container-fluid">
  <div class="row">
    <div class="panel with-nav-tabs panel-primary">
      <!-- <div class="panel-heading">
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
      </div> -->
<div class="panel-body app-page">
<div class="col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12 tab-content">
  <div class="tab-pane fade in active" id="tab3primary">
    <div class="dexel-addplaylistpanel">
      <div class="dexel-addplaylist row">
        <legend class="text-left">Playlist</legend>
        {!! Form::open(['method' => 'post','class'=>"form-horizontal",'role'=>"form",'files' => true, 'id'=>'edit_form']) !!}
        <div class="form-group">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <label class="control-label col-lg-3">Title</label>
          <div class="col-lg-8">
            <input required="true" type="text" class="form-control" name="name" id="name" value="{{old('name',$playlist->name)}}">
            {!!$errors->first("name","<div class='pager col-md-12 text-warning'>:message</div>")!!}
            {!!$errors->first("slug","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-3">Description</label>
          <div class="col-lg-8">
            <textarea required="true" name="description" class="form-control">{!!old('description',$playlist->description)!!}</textarea>
            {!!$errors->first("description","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-3">Category</label>
          <div class="col-lg-8">
            <select required="true" id="category" name="category" autocomplete="off">
              <option value="">Select Category</option>
              @foreach($categories as $item)
              @if($playlist->category_id == $item->id)
              <option value="{{$item->id}}" selected="selected">{{$item->title}}</option>Category
              @else
              <option value="{{$item->id}}">{{$item->title}}</option>
              @endif
              @endforeach
            </select>
            {!!$errors->first("category","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
        </div>
        <div class="form-group">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <label class="control-label col-lg-3">Image</label>
          <div class="col-lg-8">
            <img class="audio_playlist_photo_edit" src={{cdn($playlist->image)}} />
            <input type="file"  name="image" id="name" value="{{old('image')}}">
            {!!$errors->first("image","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
        </div>
        @if(Auth::guard('admin')->user()->usertype == 'admin')
        @if($playlist->author)
          <div class="form-group" id="new_coach" style="display:none;">
        @else
          <div class="form-group" id="new_coach">
        @endif
          <label class="control-label col-lg-3">Author Name</label>
          <div class="col-lg-8">
            <input autocomplete="off" type="text" class="form-control" name="author_detail[name]" id="author_name" value="{{old('author_detail.name',$playlist->author_detail['name'])}}">
            {!!$errors->first("author_detail.name","<div class='pager col-md-12 text-warning'>:message</div>")!!}
            {!!$errors->first("author_id","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
          <label class="control-label col-lg-3">Author Picture</label>
          <div class="col-lg-8">
            <img class="audio_author_photo_edit" src="{{cdn($playlist->author_detail['photo'])}}"/>
            <input type="file"  name="author_detail[photo]" id="author_photo">
            {!!$errors->first("author_detail.photo","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
        </div>
        @if($playlist->author)
          <div id="exist_coach">
        @else
          <div id="exist_coach" style="display:none;">
        @endif
          <div class="form-group audio_author_name">
              
              <label class="control-label col-lg-3">Author Name</label>
              <div class="col-lg-8">
                  <input id="author_id" type="hidden" value="" name="author"/>
              <p id="author_label">@if($playlist->author) {{$playlist->custom_author->fname}} @endif</p>
              <span class="fa fa-close audio_author_name_close" id="close_exist_coach"></span>
            </div>
          </div>
          <div class="form-group audio_author_picture">
              <label class="control-label col-lg-3">Author Picture</label>
              <div class="col-lg-8">
              <img class="audio_author_photo_edit" id="author_photo_img" @if($playlist->author) src="{{cdn($playlist->custom_author->profile->photo)}}" @endif/>
            </div>
          </div>
        </div>
        @endif
        <hr>
        <legend class="text-left">Each Audio</legend>
        <div id="more_audio_form">
          <?php $i=0; ?>
          @foreach($playlist->audios()->get() as $audio)
          <div class="another_audio">
            <div class="text-right remove_audio" data-id="{{$audio->id}}"><sapn class="btn btn-primary">Remove</sapn></div>
            <div class="form-group">
              <label class="control-label col-lg-3">Audio Name</label>
              <div class="col-lg-8">
              <input type="hidden" class="form-control" name="audio_id[]" value="{{$audio->id}}">
                <input type="text" required="true" class="form-control" name="audio_name[]" value="{{$audio->name}}">
                {!!$errors->first("audio_name.".$i,"<div class='pager col-md-12 text-warning'>:message</div>")!!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Description</label>
              <div class="col-lg-8">
                <textarea required="true" name="audio_description[]" class="form-control">{!! $audio->description !!}</textarea>
                {!!$errors->first("audio_description.".$i,"<div class='pager col-md-12 text-warning'>:message</div>")!!}
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-lg-3">Choose File</label>
              <div class="col-lg-8">
              {{$audio->path}}
                <input type="file" class="gui-file" name="audio[]">
                {!!$errors->first("audio.".$i,"<div class='pager col-md-12 text-warning'>:message</div>")!!}
              </div>
            </div>
            <hr>
          </div>
          <?php $i++; ?>
          @endforeach
        </div>
        <div class="text-right">
          <sapn class="btn btn-primary" id="add_audio">+ Next Audio</sapn>
        </div>
        <div class="pager">
        <a  href="{{url('coach/upload/audios')}}" type="submit" class="btn btn-lg btn-primary" name="" value="Submit">Back</a>
          <input type="submit" class="btn btn-lg btn-primary" name="" value="Submit">
        </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</div>
<div id="audio_form" style="display:none">
  <div class="form-group">
    <label class="control-label col-lg-3">Audio Name</label>
    <div class="col-lg-8">
      <input required="true" type="text" class="form-control" name="audio_name[]" value="">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Description</label>
    <div class="col-lg-8">
      <textarea required="true" name="audio_description[]" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-lg-3">Choose File</label>
    <div class="col-lg-8">
      <input required="true" type="file" class="gui-file" name="audio[]">
    </div>
  </div>
  <hr>
</div>
@stop
@section('script')
<script src="{{asset('assets/coach/js/jquery-ui.js')}}" type="text/javascript"></script>
<script type="text/javascript">
var cdn_url = "{{cdn('/')}}";
  cdn_url = cdn_url.replace(/\/$/, '');
    $( "#author_name" ).autocomplete({
      source: base_url+'/coach/find',
      minLength: 2,
      select: function( event, ui ) {
        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
        $('#author_photo_img').attr('src',cdn_url+ui.item.photo);
        $('#author_id').val(btoa(ui.item.id));
        $('#author_label').text(ui.item.label);
        $('#author_name , #author_photo').val('');
        $('#new_coach').hide();
        $('#exist_coach').show();
      }
    });
$('#close_exist_coach').click(function(event) {
    $('#author_photo_img').attr('src','');
    $('#author_label').text('');
    $('#author_id , #author_name , #author_photo').val('');
    $('#new_coach').show();
    $('#exist_coach').hide();
});
$('#add_audio').on('click', function(event) {
event.preventDefault();
audio_html =  '<div class="another_audio"><div class="text-right remove_audio"><sapn class="btn btn-primary">Remove</sapn></div>';
audio_html += $('#audio_form').html();
$('#more_audio_form').append(audio_html+'</div>');
});
$('#more_audio_form').on('click','.remove_audio',function(event) {
event.preventDefault();
var attr_id = $(this).attr('data-id');
if (typeof attr_id !== typeof undefined && attr_id !== false) {
    $('#edit_form').prepend("<input type='hidded' name='unset_aduios[]' value='"+attr_id+"'/>");
}
$(this).parent( ".another_audio").remove();
});
</script>
@stop