@extends("web.main")
@section('css')
<style>
    .footer-panel {
    display: none;
   }
</style>
@stop
@section('content')
@include('web.category')
    <!-- Body of the Page -->
      <br></br>
<div class="article_page">
<div class="article_style1">
    <h3><?php echo $article->title; ?></h3>
    <p class="article-author"> Author: <?php echo $article->author; ?> <span>Date: <?php echo date("d-m-Y", strtotime($article->created_at)); ?></span></p>

    <div class="cover">
        <img src="{{cdn($article->cover_img)}}" alt="" width="920" height="387">
    </div>
    <div class="article-share">
    <div class="share2">
        <span class="s1-share"></span>
        <a href="" class="s1-fb s1-i"></a>
        <a href="" class="s1-tr s1-i"></a>
        <a href="" class="s1-gp s1-i"></a>
        <a href="" class="s1-pin s1-i"></a>
        <a href="" class="s1-mail s1-i"></a>

    </div>
</div>
    <span class="essense_mini i2">{{$article->essence->title}}</span>
    <span class="category_mini i2">{{$article->category->title}}</span>




                        <span class="likes_mini i2">0</span>
        <span class="views_mini i2">{{$article->views->count()}}</span>

                    <div class="clearboth"></div>
<p>
</p><div class="g" style="line-height: 1.2;
font-size: small; margin-bottom: 23px;
color: #222222; background-color: #ffffff">
<div class="rc" data-hveid="39" style="position: relative">
<div class="s" style="width:auto; color: #545454; line-height:none">
<span style="color: #000000; display:block; font-size: 16px; text-align: left; line-height:150%">
  <br></br><br></br>
<?php echo $article->description; ?>
</span></div></div></div><div class="g" style="line-height: 1.2; font-size: small;  margin-bottom: 23px; color: #222222; background-color: #ffffff"><div class="rc" data-hveid="45" style="position: relative"></div></div><p></p>

<div class="bottom-line">

</div>
<div class="article-share">
    <div class="share2">

{{-- @include('components.share', [
    'url' => request()->fullUrl(),
    'description' => 'This is really cool link',
    'image' => 'http://placehold.it/300x300?text=Cool+link'
]) --}}
    </div>
</div>
</div>

<div class="article_related">

<h3>Related Articles</h3>
@foreach($related_articles as $article)
<a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
    <div class="articlex">
                <img class="ax_thumb" src="{{cdn($article->cover_img)}}" alt="">
                <span class="ax_title">
                    <h4>{{$article->title}}</h4>
                </span>
                <div class="ax_details">
                    <p class="essense_mini">{{$article->essence->title}}</p>
                                        <p class="likes_mini">0</p>
                    <p class="views_mini">{{$article->views->count()}}</p>
                </div>
            </div>
            </a>
@endforeach
<div class="clearboth"></div>
</div>

</div>
@stop
