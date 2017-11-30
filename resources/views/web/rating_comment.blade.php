<div class="modal-custom-content">
    <div class="modal-custom-header">
        <h3><span>Rating & Comments</span> for {{$playlist->name}}</h3> {{-- Title --}}
        <span class="modal-custom-close "><b class="fa fa-close"></b></span>
    </div>

    <div class="modal-custom-body">
        <div class="modal-custom-body-inner">
            {{-- Content here --}}
            <div class="audio-comment-list">
            <?php $isempty=1 ?>
                @foreach($playlist->audios as $audio)
                    @if($audio->ratings->count())
                        <?php $isempty=0; ?>
                        @foreach($audio->ratings as $rating)
                                <div class="audio-comment-each">
                                    <div class="audio-comment-each-left">
                                        
                                        <div class="audio-comment-each-author">
                                            <img src="{{cdn($rating->createdby->profile->photo)}}" alt="">
                                            <p>{{$rating->createdby->fname}}<span> {{date('d-m-Y',strtotime($rating->created_at))}}</span></p>
                                        </div>
                                    </div>
                                    <div class="audio-comment-each-right">
                                        <h3>{{$audio->name}}</h3>
                                        <p class="audio-comment-each-rating">
                                        {!! Form::select('rating',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'],$rating->rate,['class'=>'rating-readonly','slug'=>$playlist->slug,'autocomplete'=>'off'])!!}
                                        </p>

                                        @if($rating->comment)
                                            
                                            <p class="audio-comment-each-comment"><span class="audio-comment-each-rating-seperator"></span>{!!$rating->comment->comment!!}</p>
                                        @endif
                                    </div>
                                </div>
                        @endforeach
                    @endif
                @endforeach
                @if($isempty)
                    No Comments
                @endif
            </div>

        </div>
    </div>
</div>
