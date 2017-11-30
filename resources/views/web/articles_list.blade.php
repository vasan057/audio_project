      <section class="dexel-articlespanel">
				<div class="articlelist_layout3 ap_width"  style="padding-bottom:100px;">
<!--=============================================================  All articles  ======================================================== -->
		<?php Request::segment(1) ?>
    <div class="set1">
			<div class="ap_title">
					<div class="ap_title_icn">
						<img class="al1_bg_color" src="{{asset('assets/web/images/principle1_small.png')}}" alt="">  <!-- Title icon -->
					</div>
					<h3><?php //echo $category_id; ?></h3>
					<div class="clearboth"></div>
			</div>
		</div>
		<?php $i=0; ?><!-- articles content list item start -->
		@foreach($articles as $article)
		<div class="a2b_rect3">
			<div class="a2b_rect3_cover">
				<a href="{!!url('article/'.Crypt::encrypt($article->id))!!}">
<img src="{{cdn($article->cover_img)}}" alt="">
</a>
			</div>
			<span class="ap_tag al1_txt_color">
						<p class="likes_mini">123</p>
						<p class="views_mini">{{$article->views->count()}}</p>
						<span class="clearboth"></span>
				</span>
			<h4><?php echo $article->title; ?></h4>
			<p><?php	echo $article->short_description;	?></p>
			<span class="essense_mini"><?php echo $article->essence->title; ?></span>
		</div>
		@endforeach
		<div class="clearboth"></div>
</div>
</section>
