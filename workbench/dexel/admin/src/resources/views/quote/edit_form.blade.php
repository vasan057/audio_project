@extends("admin::main")
@section('css')
@include("texteditor.css")
@stop
@section('content')
<nav class="navbar dexel-coach-navbar2">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">Edit Quote</a>
    </div>
  </div>
</nav>
<div id="myModal" class="bg in app-page2" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content" style="background:rgba(255, 255, 255, 0.2);border:1px solid rgba(255, 255, 255, 0.4);border-radius:8px;margin:6% 0;">
      {{-- <div class="modal-header">
        
        <h4 class="modal-title" style="color:#424242">Quotes Information</h4>
      </div> --}}
      <div class="modal-body">
        <form id="form-ui" enctype="multipart/form-data" method="POST">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <div class="form-group" >
            <label for="email" style="color:#424242;">Author: <b style="color:red">*</b></label>
            <input type="text" class="form-control" id="author" name="author" required value="{{$quote->author}}">
            {!!$errors->first("author","<span class='form-error'>:message</span>")!!}
          </div>
          <div class="form-group">
            <label for="" style="color:#424242">Cover image: </label><br/>
            @if($quote->cover_img)
              <img class="quote-cover-view" src="{{cdn($quote->cover_img)}}" />
            @endif
            <input type="file" class="form-control" name="cover_img" id="cover_image_required" value="{{old('cover_img')}}">
            {!!$errors->first("cover_img","<span class='form-error'>:message</span>")!!}
          </div>
          
          <div class="form-group" style="width:100%">
            <label for="description" style="color:#424242;">Description: <b style="color:red">*</b></label>
            <textarea id='description' name="description" required>{{$quote->description}}</textarea>
            {!!$errors->first('description','<span class="form-error">:message</span>')!!}
          </div>
          <div>
          <a href="{{url('coach/quotes')}}" class="btn btn-bordered btn-primary mb5" >Back</a>
            <button type="submit" class="btn btn-bordered btn-primary mb5" >Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@stop
@section('script')
@include("texteditor.js")
@stop