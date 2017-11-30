@extends("admin::main")
@section('content')
<nav class="navbar dexel-coach-navbar">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">Audio Uploads</a>
    </div>
  </div>
</nav>
<div class="dexel-coach-maincontainer container-fluid app-page">
  <div class="row">
    <div class="panel with-nav-tabs panel-primary">
      <div class="panel-heading">
        <div class="container">
          <div class="row">
            <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-2">
              <ul class="nav nav-tabs">
                <!-- <li><a href="{{url('coach/uploads')}}">All Content</a>
                              </li> -->
              <li class="active"><a href="#">Audios</a>
            </li>
            <!-- <li><a href="{{url('coach/upload/videos')}}">Videos</a>
                      </li>
                      <li><a href="{{url('coach/upload/articles')}}">Articles</a>
                    </li> -->
      </ul>
    </div>
  </div>
</div>
</div>
<div class="panel-body">
<div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content">
  <div class="tab-pane fade in active" id="tab3primary">
    <div class="dexel-addplaylistpanel">
      <div class="dexel-addplaylist row">
        <legend class="text-left">Playlist</legend>
        {!! Form::open(['method' => 'post','class'=>"form-horizontal",'role'=>"form",'files' => true, 'id'=>'edit_form']) !!}
        <div class="form-group">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <label class="control-label col-lg-3">Title</label>
          <div class="col-lg-8">
            <input required="true" type="text" class="form-control" name="name" id="name" value="{{$playlist->name}}">
            {!!$errors->first("name","<div class='pager col-md-12 text-warning'>:message</div>")!!}
            {!!$errors->first("slug","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-lg-3">Description</label>
          <div class="col-lg-8">
            <textarea required="true" name="description" class="form-control">{!!$playlist->description!!}</textarea>
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
            <img width="100px" src={{cdn($playlist->image)}} />
            <input type="file"  name="image" id="name" value="{{old('image')}}">
            {!!$errors->first("image","<div class='pager col-md-12 text-warning'>:message</div>")!!}
          </div>
        </div>
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
        <a  href="{{url('coach/'.base64_encode($coach->id).'/upload/audios')}}" type="submit" class="btn btn-lg btn-primary" name="" value="Submit">Back</a>
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

<script type="text/javascript">
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