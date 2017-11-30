    <div class="container">
        <div class="row" >
            <div class="col-md-12 text-center">
        <?php $type = Request::segment(1);

        if($type==('articles') || $type==('article'))
        {
          $url = 'articles';
      ?>
      <a class="l-s-each" href="{{url($url.'/'.Crypt::encrypt('3'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle1_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Meditation</p>
                        </div>
                    </a>

                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('4'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle2_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Diet</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('5'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle3_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Self Development</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('6'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle4_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Fitness</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('1'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle5_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Detox</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('2'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle6_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Mindful Living</p>
                        </div>
                    </a>

      <?php
  }
        else
        {
          $url = 'videos';
      ?>

<a class="l-s-each" href="{{url($url.'/'.Crypt::encrypt('1'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle1_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Meditation</p>
                        </div>
                    </a>

                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('6'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle2_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Diet</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('3'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle3_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Self Development</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('7'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle4_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Fitness</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('5'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle5_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Detox</p>
                        </div>
                    </a>
                    <a class="l-s-each " href="{{url($url.'/'.Crypt::encrypt('2'))}}">
                        <span class="high-flower"></span>
                        <div class="l-s-each_inner">
                            <div class="l-s-each_icn">
                                <img src="{{asset('assets/web/images/principle6_small.png')}}" alt="" width="60" height="60">
                            </div>
                            <p>Mindful Living</p>
                        </div>
                    </a>

           <?php } ?>
            </div>
        </div>
    </div>
