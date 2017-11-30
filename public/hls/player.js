function launchApplication(l_url, l_windowName)
        {
          if ( typeof launchApplication.winRefs == 'undefined' )
          {
            launchApplication.winRefs = {};
          }
          if ( typeof launchApplication.winRefs[l_windowName] == 'undefined' || launchApplication.winRefs[l_windowName].closed )
          {
            // var l_width = screen.availWidth;
            // var l_height = screen.availHeight;
            var l_width = screen.availWidth;
            var l_height = 400;

            var l_params = 'status=1' +
                           ',resizable=1' +
                           ',scrollbars=1' +
                           ',width=' + l_width +
                           ',height=' + l_height +
                           ',left=0' +
                           ',top=0';

            launchApplication.winRefs[l_windowName] = window.open(l_url, l_windowName, l_params);
            launchApplication.winRefs[l_windowName].moveTo(0,0);
            launchApplication.winRefs[l_windowName].resizeTo(l_width, l_height);
          } else {
            launchApplication.winRefs[l_windowName].focus();
            launchApplication.winRefs[l_windowName].window.location.href=l_url;
          }
        }
$(document).ready(function() {
  window.is_play = 'no';
  $('body').on('click','.play_audio',function(event)
    {
      current_audio = $(this);
          url = base_url+'/'+current_audio.attr('data-url');
      launchApplication(url,'stressfit_player');
      window.is_play = 'yes';

    });
  $('#playlists, #dexel-audiopanel, #page').on('click', '.br-readonly', function(event)
  {
    event.preventDefault();
    $.get(base_url+'/playlist_details/'+$(this).prev(".rating-readonly").attr('slug'), function(data)
    {
      $('#modal-custom-ratencomments').html(data);
      $('#modal-custom-ratencomments').show();
      $('#modal-custom-ratencomments .rating-readonly').barrating({
      readonly: true,
      allowEmpty: null,
          theme: 'fontawesome-stars',
        });
    });
   });
   $('#modal-custom-ratencomments').on('click', '.modal-custom-close', function(event) {
      event.preventDefault();
     $('#modal-custom-ratencomments').hide();
  });

   $('.audio-panel-locked').click(function(event) {
     /* Act on the event */
     playlist_img = $(this).attr('data-img');
     playlist_title = $(this).attr('data-title');
     $('#message-popup-img').attr('src',playlist_img);
     $('#message-popup-title').html(playlist_title);
     $('#message-popup').show();
   });

   $('.add_collection').click(function(event) {
    var current_div = $(this);
    var playlist_id = current_div.attr('data-id');
    var action = current_div.attr('data-action');
     $.ajax({
       url: base_url+'/collection',
       type: 'POST',
       dataType: 'json',
       data: {'_token': csrf_token,'playlist_id':playlist_id,'action':action},
     })
     .done(function(data) {
      if(data.code == 'success')
      {
        current_div.removeClass('add');
        current_div.removeClass('remove');
        current_div.attr('data-action',data.action);
        current_div.addClass(data.action);
      }
     })
     .fail(function() {
     })
     .always(function() {
     });
   });
});