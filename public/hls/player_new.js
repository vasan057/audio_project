$(document).ready(function() {
  window.is_play = 'no';
  $('body').on('click','.play_audio_new',function(event)
              {
                playlist = '<h4>Playlist</h4><ul>'+$(this).parent('ul').html()+'</ul>';
                
                event.preventDefault();
                $('#dexel-audiopanel, #playlists').find("li.play_audio").removeClass('playing');
                current_audio = $(this);
                data_url = current_audio.attr('data-url');
                url = base_url+'/'+current_audio.attr('data-url');
                current_audio.addClass('playing');

                //remove old datas , incase get audio breaks
                $('#audio_player_singledesc').html('');
                  $('#audio_player_desc').html('');
                  $('#audio_player_playlist').html('');
                  $('#audio_player_info_text').html('');
                  $('#rate-audio1').html(''); 
                  $('#rate-audio').html('');
                  $('#audio_comment_submit').attr("data-url","");
                  $('#audio_comment').val('');
                  $('#audio_comment_result').html('');

                $.ajax({
                  url: url,
                  type: 'GET',
                  dataType: 'json',
                  //data: {param1: 'value1'},
                })
                .done(function(result) {
                  $('#audio_player_container').show();
                  var player = videojs('audio_player');
                          player.src({
                          src: result.url,
                          //type: 'audio/mpeg'
                          type: result.type
                        });
                  player.play();
                  window.is_play = 'yes';
                  player.on('ended', function() {
                    window.is_play = 'no';
                    var next = $('li.playing').next();
                    next.click();
                  });
                  $('#audio_player_img').attr('src',result.playlist.image);
                  $('#audio_player_singledesc').html('<h4>'+result.name+'</h4><p>'+result.description+'</p>');
                  $('#audio_player_desc').html('<h4>'+result.playlist.name+'</h4><p>'+result.playlist.description+'</p>');
                  $('#audio_player_playlist').html(playlist);
                  $('#audio_player_info_text').html('<h4>'+result.playlist.name+'</h4><h6>'+result.author+'</h6><p>'+result.name+'</p>');
                  var rating_htm = '<select class="rating" autocomplete="off" data-url="/playlist/'+result.playlist.slug+'/rate/'+result.audio_id+'" name="rating"><option value=""></option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option></select>';
                  $('#rate-audio1').html(rating_htm); 
                  $('#rate-audio').html(rating_htm+'<span class="rating_value">Overall Rating</span>');
                  rating_div(result.avg_rating);
                  if(result.my_rating.length)
                  {
                    rating_div1(result.my_rating[0]);
                  }
                  else
                  {
                    rating_div1(null);
                  }
                  //update the comment post url
                  $('#audio_comment_submit').attr("data-url","/playlist/"+result.playlist.slug+"/comment/"+result.audio_id);
                  if(result.my_comment.length)
                  {
                    var str = $("#mydiv").html();
                    var regex = /<br\s*[\/]?>/gi;
                    $('#audio_comment').val(result.my_comment[0].replace(regex, "\r"));
                  }

                  //chnage address bar
                  window.history.replaceState(null, null, "/"+data_url.replace('playlist', 'player'));

                  //update share url
                  $("#dexel-sharebox").html(" ");
                  $("#dexel-sharebox").sharebox({
                    url      : window.location.href,
                    //title    : "My awesome title",
                    services : "facebook google+ linkedin twitter pinterest"
                  });
                })
                .fail(function() {
                  //console.log("error");
                })
                .always(function() {
                  //console.log("complete");
                });

              });	

  $('#audio_player_show_menu').click(function(event) {
    /* Act on the event */
     $('#audio_player_playdesc').hide();
     $('#audio_player_rate').hide();
       $('#audio_player_menu').toggle();
  });
  $('#audio_player_show_singledesc').click(function(event) {
    /* Act on the event */
     $('#audio_player_menu').hide();
     $('#audio_player_rate').hide();
     $('#audio_player_playdesc').toggle();

  });
  $('.audio_player_menu_hide').click(function(event) {
    /* Act on the event */
     $('#audio_player_playdesc').hide();
     $('#audio_player_menu').hide();
      $('#audio_player_rate').hide();

  });
  $('#rate-audio').on('click', '.br-readonly', function(event) {
    event.preventDefault();
    $('#audio_player_menu').hide();
    $('#audio_player_playdesc').hide();
    $('#audio_player_rate').show();
  });
  $('#audio_player_container').on('click', '#audio_comment_submit', function(event) {
    event.preventDefault();
    $('#audio_comment_result').html('');
    data_url = $(this).attr('data-url');
    $.ajax({
      url: base_url+data_url,
      type: 'POST',
      dataType: 'json',
      data: {'comment': $('#audio_comment').val(),'_token':csrf_token},
    })
    .done(function(data){
      if(data.code == 'validation')
      {
        $('#audio_comment_result').html(data.errors.comment[0]);
      }
      else
      {
        $('#audio_comment_result').html('<span class="success-msg">Thank you!</span>'); 
      }
      //console.log("success");
    })
    .fail(function() {
      //console.log("error");
    })
    .always(function() {
      //console.log("complete");
    });
    
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
   /*$('.add_collection_login').click(function(event) {
     alert("please login");
   });*/
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
function rating_div(default_rate)
{  
  $('#rate-audio > select').barrating({
      allowEmpty: null,
      initialRating:default_rate,
      readonly: true,
      theme: 'fontawesome-stars'
    });
}
function rating_div1(default_rate)
{ 
  $('#rate-audio1 > select').barrating({
    allowEmpty: null,
    initialRating:default_rate,
    theme: 'fontawesome-stars',
  });
}
$('.dexel-flipper').click();