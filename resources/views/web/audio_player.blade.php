<div id="audio_player_container">
    <div class="audio_player_menu col-md-12 space-bgx" id="audio_player_menu">
        <div class="audio_player_playlist col-md-4 col-sm-4 col-sx-4" id="audio_player_playlist">
            <!-- play list -->
        </div>
        <div class="audio_player_desc col-md-8 col-sm-8 col-sx-8" id="audio_player_singledesc">
            <!-- <h4>Playlist Description</h4> -->
               <!-- Description -->
        </div>
        <span class="audio_player_menu_hide"> X</span>  {{-- close both panel --}}
    </div>
    <div class="audio_player_singledesc space-bgx col-md-12" id="audio_player_desc">
        <div class="col-md-12" id="audio_player_singledesc">
            <!-- <h4>Description of the current track</h4> -->
               <!-- Description of the current track-->
        </div>
        <span class="audio_player_menu_hide">X</span> {{-- close both panel --}}
    </div>
    @if(!Auth::guard('admin')->check())
    <div class="audio_player_singledesc space-bgx col-md-12" id="audio_player_rate">
        <div class="col-md-8 col-md-offset-2">
            <h4>Rate and comment <span>Current track title</span></h4>
            @if(Auth::guard('user')->check())
                <div class="col-md-12">
                    <div class="form-group form-rate col-md-4">
                        <label>Rate</label>
                        <div class="form-rate-stars" id="rate-audio1">
                        </div>
                    </div>
                    <div class="form-group form-comment col-md-8">
                        <label>Comment</label>
                        <textarea id="audio_comment"></textarea>
                       
                    </div>
                    <div class="clearboth"></div>
                     <span id="audio_comment_result" style="display: block;"></span>
                    <button id="audio_comment_submit" type="submit" class="btn btn-default">Submit</button>
                </div>
            @else
            Please <a href="{{url('login')}}" >login</a> to rate.
            @endif

        </div>
        <span class="audio_player_menu_hide ">X</span> {{-- close both panel --}}
    </div>
    @endif
    <div class="audio_player_bar">
        <!-- <div class="audio_player_info col-md-6 col-sm-6">
            <div class="audio_player_info_thumb audio_infoparts">
                <img id="audio_player_img" src=" " alt="">     
                <div class="clearboth"></div>
            </div>
            <div class="audio_player_info_text audio_infoparts" id="audio_player_info_text">
                <h4>Playlist title</h4>
                <h6>Author</h6>
                <p>Current meditation</p>
            </div>
            <div class="audio_player_info_icons audio_infoparts">
                <i title="Show Playlist" class="audio_player_info_icon_menu" id="audio_player_show_menu"></i>
                <i title="Show Description" class="audio_player_info_icon_desc" id="audio_player_show_singledesc"></i>
                <div class="clearboth"></div>
            </div>
            <div title="Rate this playlist" class="audio_player_info_rating audio_infoparts" id="rate-audio">
            </div>
        </div> -->
        <audio id="audio_player" class="video-js vjs-default-skin" controls preload="auto"data-setup='{}'></audio>
    </div>

</div>

<!-- <:::::::::::::]==|  Modal-custom  Start |===[:::::::::::::>  -->
{{-- Rate&comments --}}
<div class="modal-custom" id="modal-custom-ratencomments">

</div>
<!-- <:::::::::::::]==|  Modal-custom  END |===[:::::::::::::>  -->
@if(!Auth::guard('user')->check())
    <div class="message-popup message-popup-large message-lockedx" id="message-popup" style="display: none;">
        <div class="message-popup-inner">
                <div class="message-locked">
                <div class="col-md-12">


                 {{-- <div class="col-md-6 message-locked-card">
                    <img id="message-popup-img" class="message-locked-playlistbg" src=""/>
                    <h3 id="message-popup-title"></h3>
                </div> --}}
                <div class="col-md-8 col-md-offset-2 message-locked-text">
                <p>Please Login to access</p>
                </div>
                <div class=" col-md-8  col-md-offset-2 col-xs-12 message-locked-buttons">
                        <a  class="gplus-login" href="{!! url('auth/redirect/google') !!}"><img src="{{asset('assets/web/images/signin_google.png')}}" alt=""></a>
                        <a class="fb-login" href="{!! url('auth/redirect/facebook') !!}"><img src="{{asset('assets/web/images/signin_facebook.png')}}" alt=""></a>
                        <a class="fb-login" href="{{url('login')}}"><img src="{{asset('assets/web/images/signin_mail.png')}}" alt=""></a>
                    </div>
                
                </div>
                </div>
            <div class="message-popup-close close-popup-message">
                <i class="fa fa-close"></i>
            </div>
        </div>
    </div>
@endif
