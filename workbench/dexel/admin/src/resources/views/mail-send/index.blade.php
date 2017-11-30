@extends("admin::main")
@section('css')
<link rel="stylesheet" href="{{asset('assets/coach/css/jquery-ui.css')}}">
<style type="text/css">
  #exist_coach { display: none; }
  h2{ font-size: 2em;  }
  h3{ font-size: 2em; border-top:solid 1px #d2d2d2; margin-top: 50px; padding-top: 20px; }
 
  .pn{  border-bottom:solid 1px #d2d2d2; margin-bottom: 20px;}
</style>
@stop
@section('content')
<nav class="navbar dexel-coach-navbar">
  <div class="container-fluid">
     <div class="navbar-header">
        <a class="navbar-brand header-brand" href="#">Send Mail</a>
     </div>
  </div>
</nav>


<div class="panel-body">
  <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content">

    <div class="tab-pane fade  in active" id="tab5primary">
      <div class="panel-body pn">
        <h3> Send Mail </h3>
        {!!Form::open(['id'=>'mailto_form'])!!}
        <div class="form-horizontal newsletter_form ">
          <div class="form-group">
            <label class="control-label col-lg-3"></label>
            <div class="col-lg-8">
              <div id="aditional_email_block">
                {{--@if(($email_count = count(old('emails'))) >= 1)
                  @foreach(range(1, $email_count-1) as $index)
                    <div class="newsletter_email_each">
                      <input type="text" name="emails[]" placeholder="email id" value="{{old('emails')[$index]}}">
                      {!!$errors->first("emails.".$index,'<span class="form-error">:message</span>')!!}
                    </div>
                  @endforeach
                @endif --}}
              </div>
              <span class="form-error" id="err_emails"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-3">Email Id</label>
            <div class="col-lg-8">
              <input type="text" name="email" class="form-control" value="{!!old('email',$email)!!}" placeholder="email id" autocomplete="off">
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-3">Subject</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" name="subject" value="{!!old('subject')!!}" autocomplete="off">
              <span class="form-error" id="err_subject"></span>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-lg-3">Message</label>
            <div class="col-lg-8">
              <textarea name="message" class="form-control" autocomplete="off" style="resize: vertical; height: 250px;">{!!old('message')!!}</textarea>
              <span class="form-error" id="err_message"></span>
            </div>
          </div>
          <div class="col-sm-8 col-md-offset-3 newsletter_form_btn_row" >
            
            <span class="btn btn-lg btn-primary" id="send_mailto">Send</span>
            <span class="btn btn-lg btn-primary" id="preview_mailto">Preview</span>
            <span class="form-success newsletter_form_success" id="message_mailto"></span>
          </div>
          </div>
        {!!Form::close()!!}
      </div>
    </div>
    <div class="col-sm-12">
      <iframe id="preview_block" style="width: 100%;height: 500px;"></iframe>
    </div>
  </div>
</div>
@stop
@section('script')
<script src="{{asset('assets/coach/js/jquery-ui.js')}}" type="text/javascript"></script>
<script type="text/javascript">
    $('#send_mailto').click(function(event) {
      $('.form-error').text('');
      $('.form-success').text('');
      $.ajax({
        url: base_url+'/coach/mailto',
        type: 'POST',
        dataType: 'json',
        data:$('#mailto_form').serialize() ,
      })
      .done(function(data) {
        if(data.code == 'validation')
        {
          $.each(data.errors, function(index, val) {
             $('#err_'+index).text(val[0]);
          });
        }
        else if(data.code == 'success')
        {
          $('.form-success').text('Mail sent!'); 
          $('.form-control').find(':input').val('');
          $('.remove_email').parent().remove();
        }
        // /$('#site_loding').hide();
      })
      .fail(function() {
      })
      .always(function() {
      });
    });
    $('#preview_mailto').click(function(event) {
      $('.form-error').text('');
      $('.form-success').text('');
      $.ajax({
        url: base_url+'/coach/mailto/preview',
        type: 'POST',
        data:$('#mailto_form').serialize() ,
      })
      .done(function(data) {
        $('#preview_block').contents().find( "body" ).html(data);
      })
      .fail(function() {
      })
      .always(function() {
      });
    });
  </script>
  @stop