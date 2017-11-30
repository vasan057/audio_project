<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content view-popup" style="background:rgba(255, 255, 255, 0.2);border:1px solid rgba(255, 255, 255, 0.4);border-radius:8px;margin:6% 0;height:600px;overflow-y:scroll">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#ffffff" id="video_title">{{$video->title}}</h4>
      </div>
      <div class="modal-body">
    <div class="video_style1">
    
    <p class="video-author" style="color:#ffffff;width:auto"> 
  <span style="margin-bottom:6px;color:#ffffff;width:100%;float:left;text-align:right" id="video_date">{{$video->created_at}}</span></p>

    <div class="cover">
 <iframe width="567" height="315" src="{{$video->video_url}}" id="view_youtube_url">
</iframe>    </div>
    <div class="video-share">
    <div class="share2">
        <span class="s1-share"></span>
        <a href="" class="s1-fb s1-i"></a>
        <a href="" class="s1-tr s1-i"></a>
        <a href="" class="s1-gp s1-i"></a>
        <a href="" class="s1-pin s1-i"></a>
        <a href="" class="s1-mail s1-i"></a>

    </div>
</div>
  <div style="margin-bottom:6px;color:#ffffff;width:50%;float:left;">
    <b style="color:#000000">Category: </b> <span class="category_mini i2" style="color:#ffffff;text-transform: capitalize;" id="video_category">{{$video->category->title}}</span>
  </div>  

    <span style="margin-bottom:6px;color:#ffffff;width:50%;float:left;text-align:right"><b style="color:#000000">Essence: </b> <span class="essense_mini i2" style="color:#ffffff;text-transform: capitalize;" id="video_essense">{{$video->essence->title}}</span></span>
  
                    
                    
                    
                    
                    
                    
                    
                    <div class="clearboth"></div>
<p> 
</p><div class="g" style="line-height: 1.2; font-size: 
small; margin-bottom: 23px; color: #222222;"><div class="rc" data-hveid="39" style="position: relative"><div class="s" 
style="max-width: 48em; color: #545454; line-height: 18px">
<span style="color: #ffffff; display:block; font-size: 14px; text-align: left" id="video_content">
{!!$video->description!!}
</span>
</div></div></div><div class="g" style="line-height: 1.2; font-size: small;  margin-bottom: 23px; color: #222222; background-color: #ffffff"><div class="rc" data-hveid="45" style="position: relative"></div></div><p></p>

<div class="bottom-line">
    
</div>
<div class="video-share">
    <div class="share2">
        <span class="s1-share"></span>
        <a href="" class="s1-fb s1-i"></a>
        <a href="" class="s1-tr s1-i"></a>
        <a href="" class="s1-gp s1-i"></a>
        <a href="" class="s1-pin s1-i"></a>
        <a href="" class="s1-mail s1-i"></a>

    </div>
</div>
</div>
      </div>
    </div>

  </div>