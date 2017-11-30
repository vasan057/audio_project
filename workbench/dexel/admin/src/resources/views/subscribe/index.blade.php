@extends("admin::main")
@section('css')
<!-- Include Editor style. -->
<link href="{{asset('editor/froala_editor.pkgd.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{asset('editor/froala_style.css')}}">
<link rel="stylesheet" href="{{asset('assets/coach/css/jquery-ui.css')}}">
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
  .fr-view strong{ font-weight: bold!important;  color: inherit;}
.fr-view strong *{  font-weight: bold!important;  color: inherit; }
.fr-view span * { color: inherit; }

  #imageManager-1, #insertFile-1, #videoUpload-1, #insertVideo-1, #fontFamily-1
  {
    display: none;
  }
  #imageAlign-1, #imageStyle-1
  {
    display: none;
  }
.fr-toolbar i{ color: inherit!important; }

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
        <a class="navbar-brand header-brand" href="#">News Letter</a>
     </div>
  </div>
</nav>


<div class="panel-body app-page2 app-subscribe-page2">
  <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content ">
  <h2> View </h2>
 
    <a class="btn btn-primary subs-btn" href="{{url('coach/subscribe/list')}}">All Subscribers</a>
    <a class="btn btn-primary subs-btn" href="{{url('coach/users/all')}}">All Users</a>
    <a  class="btn btn-primary subs-btn" href="{{url('coach/all')}}">All Coaches</a>
 
  </div>
  <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content">

    <div class="tab-pane fade  in active" id="tab5primary">
      <div class="panel-body pn">
        <h3> Send News letter </h3>
        {!!Form::open(['id'=>'newsletter_form'])!!}
        <div class="form-horizontal newsletter_form ">
          <div class="form-group">
          <label class="control-label col-lg-3"> Select Group </label>
            <div class="col-lg-8">
            <div class="col-md-4  checkbox-each-outer text-left">
                <?php $checked=''; if(old('subscribers')) { $checked="checked=checked"; } ?>
                <input name="subscribers" type="checkbox" value="yes" {{$checked}} autocomplete="off"/>
                <label class="control-label">All Subscribers</label>
                <span class="form-error" id="err_subscribers"></span>
            </div>
            <div class="col-md-4 checkbox-each-outer  text-left">
              <input name="users" type="checkbox" value="yes" autocomplete="off"/>  
              <label class="control-label">All Users</label>
              <span class="form-error" id="err_users"></span>
            </div>
            <div class="col-md-4   checkbox-each-outer  text-left">
              <input name="coaches" type="checkbox" value="yes" autocomplete="off"/>
              <label class="control-label">All Coaches</label>
              <span class="form-error" id="err_coaches"></span>
            </div>
            </div>
          </div>
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
            <label class="control-label col-lg-3">Email Id's</label>
            <div class="col-lg-8">
              <input type="text" class="form-control" id="aditional_email" placeholder="Type email id's spereated by comma" autocomplete="off">
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
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <textarea id="message" name="message" class="form-control" autocomplete="off" style="resize: vertical; height: 250px;">{!!old('message')!!}</textarea>
              <span class="form-error" id="err_message"></span>
            </div>
          </div>
          <div class="col-sm-8 col-md-offset-3 newsletter_form_btn_row" >
            
            <span class="btn btn-lg btn-primary" id="send_newletter">Send</span>
            <span class="btn btn-lg btn-primary" id="preview_newletter">Preview</span>
            <span class="form-success newsletter_form_success" id="message_newletter"></span>
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
<script type="text/javascript" src="{{asset('editor/get_s3_url.js')}}"></script>
<script type="text/javascript" src="{{asset('editor/froala_editor.pkgd.js')}}"></script>
<script src="{{asset('assets/coach/js/jquery-ui.js')}}" type="text/javascript"></script>
<script type="text/javascript">
$('#message').froalaEditor();

    $("#aditional_email").autocomplete({
      source: base_url+'/coach/find/user',
      minLength: 2,
      select: function( event, ui ) {
        //log( "Selected: " + ui.item.value + " aka " + ui.item.id );
        $('#aditional_email_block').append('<div><input type="text" name="emails[]" placeholder="email id" value="'+ui.item.email+'" readonly><span class="remove_email">X</span></div>');
        $('#aditional_email').val("");
      }
    });
    $('#aditional_email_block').on('click', '.remove_email', function(event) {
      event.preventDefault();
      $(this).parent('div').remove();
    });
    $("#aditional_email").keyup(function(event) {
      /* Act on the event */
      //alert(event.which);
      if(event.which == '188')
      {
        var input_str = $("#aditional_email").val();
        var str_array = input_str.split(',');
        for(var i = 0; i < str_array.length; i++) {
           if( isValidEmailAddress(str_array[i]))
          {
            $('#aditional_email_block').append('<div><input type="text" name="emails[]" placeholder="email id" value="'+str_array[i]+'" readonly><span class="remove_email">X</span></div>');
          }
        }
       $("#aditional_email").val("");
      }
    });
    $('#send_newletter').click(function(event) {
      $('.form-error').text('');
      $('.form-success').text('');
      $.ajax({
        url: base_url+'/coach/subscribe',
        type: 'POST',
        dataType: 'json',
        data:$('#newsletter_form').serialize() ,
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
    $('#preview_newletter').click(function(event) {
      $('.form-error').text('');
      $('.form-success').text('');
      $.ajax({
        url: base_url+'/coach/newsletter/preview',
        type: 'POST',
        data:$('#newsletter_form').serialize() ,
      })
      .done(function(data) {
        $('#preview_block').contents().find( "body" ).html(data);
      })
      .fail(function() {
      })
      .always(function() {
      });
    });
    function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};
  </script>
  @stop