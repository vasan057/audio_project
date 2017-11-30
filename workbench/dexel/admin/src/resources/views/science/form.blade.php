@extends("admin::main")
@section('css')
<!-- Include Editor style. -->
<link href="{{asset('editor/froala_editor.pkgd.css')}}" rel="stylesheet" type="text/css" />
 <link rel="stylesheet" href="{{asset('editor/froala_style.css')}}">
<style type="text/css">
 
    .fr-view ul li{ list-style: disc outside none;
display: list-item;
margin-left:2em;}
    .fr-view ol li{  list-style: decimal outside none;
display: list-item;
margin-left: 2em; }
    .fr-view em{ font-style: italic!important; }
    .fr-view a{ color:#4285f4!important; text-decoration: underline; cursor: pointer;}
.fr-view a *{ color:#4285f4!important; }
.fr-view a:hover{ color:#8a28c2!important; text-decoration: underline; }
.fr-view a:hover *{ color:#8a28c2!important; }
  .fr-view strong{ font-weight: bold!important; color: inherit; }
.fr-view strong *{  font-weight: bold!important;  color: inherit; }
.fr-view span * { color: inherit; }
  #imageManager-1, #insertFile-1, #videoUpload-1
  {
    display: none;
  }
.fr-view p, .fr-view p span, .fr-view strong span, .fr-view ul li span{ line-height: 1.5em; }
.fr-toolbar i{ color: inherit!important; }

</style>
@stop
@section('content')
<nav class="navbar dexel-coach-navbar2">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">Edit Science Article</a>
    </div>
  </div>
</nav>
<div id="progress_bar" class="modal-custom" style="width: 100%; height: 100%; position: fixed; top: 0; left: 0;
    background-color: rgba(255,255,255,.8); z-index: 9999;">
 <div class="progress" style="left: 25%; position: absolute; width: 50%; top: 40%;">
  <div class="progress-bar progress-bar-striped active" role="progressbar"
  aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:100%">Please wait ...</div>
</div>
</div> 
<div id="myModal" class="bg in  app-page2" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="background:rgba(255, 255, 255, 0.2);border:1px solid rgba(255, 255, 255, 0.4);border-radius:8px;margin:6% 0;">
     {{--  <div class="modal-header">
        <h4 class="modal-title" style="color:#424242">Science Article Information</h4>
      </div> --}}
      <div class="modal-body">
        <form id="form-ui" enctype="multipart/form-data" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group" >
            <label for="email" style="color:#424242;">Title: <b style="color:red">*</b></label>
            <input type="text" class="form-control" id="title" name="title" required value="{{$science->title}}">
            {!!$errors->first("title","<span class='form-error'>:message</span>")!!}
          </div>
          <div class="form-group">
            <label for="" style="color:#424242">Cover image: </label><br/>
            @if($science->cover_img)
              <img class="article-form-cover-view"  src="{{cdn($science->cover_img)}}" />
            @endif
            <input type="file" class="form-control" name="cover_img" id="cover_image_required" value="{{old('cover_img')}}">
            {!!$errors->first("cover_img","<span class='form-error'>:message</span>")!!}
          </div>
          <img id="cover_image" src="" style="display:none">
          <div class="form-group" style="width:100%" >
            <label for="short_description" style="color:#424242;">Short Description: <b style="color:red">*</b></label>
            <textarea class="form-control" maxlength="200" id="short_description" name="short_description" required autocomplete="off">{{$science->short_description}}</textarea>
            {!!$errors->first("short_description","<span class='form-error'>:message</span>")!!}
          </div>
          <div class="form-group" style="width:100%">
            <label for="description" style="color:#424242;">Description: <b style="color:red">*</b></label>
            <textarea id='description' name="description" required autocomplete="off"></textarea>
            {!!$errors->first('description','<span class="form-error">:message</span>')!!}
          </div>
          <div>
            <button type="submit" class="btn btn-bordered btn-primary mb5">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
<!-- Include Editor JS files. -->
<script type="text/javascript" src="{{asset('editor/get_s3_url.js')}}"></script>
<script type="text/javascript" src="{{asset('editor/froala_editor.pkgd.js')}}"></script>
<script> 
  $(document).ready(function()
  { 
    $.ajax({
      url: base_url+ '/coach/science/'+"{{$science->slug}}"+'/json',
      type: 'GET',
      dataType: 'html',
    })
    .done(function(data) {
      $('#description').html(data);
      $('#description').froalaEditor({
        fontFamily: {
          'Chalkduster': 'Chalkduster',
          'Optima': 'Optima',
          'Krungthep': 'Krungthep'
            },
            fontFamilySelection: true
          });
      $('#progress_bar').remove();
    })
    .fail(function() {
      //console.log("error");
    })
    .always(function() {
      //console.log("complete");
    });
  });
</script>
@stop