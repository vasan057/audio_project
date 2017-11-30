@extends("web.main")
@section('content')
@include('web.category')
                <div class="dexel-inner-videoCntpanel">
                <div class="container-fluid">
                <div class="row animate-box">
                <video id="my-video" class="video-js vjs-default-skin vjs-tech"
                controls preload="auto"
                poster="{{asset('assets/frontend/images/video-poster.jpeg')}}"
                data-setup='{"techOrder":["youtube"],
                "src":"https://www.youtube.com/watch?v=JfVmsih7Gfg"}'>
                </video>
                </div>
                </div>
                <div class="dexel-inner-videoCntpanel">
            <div class="container">
                <div class="row animate-box dexel-inner-videoCntHeader">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <h1 class="text-left">Surya Namaskar</h1>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label class="text-center"><span></span>40 mins</label>
                        <label class="text-center"><span></span>10.00</label>
                        <label class="pull-right"><span></span>Principle</label>
                    </div>
                </div>
                <div class="row animate-box dexel-inner-videoCnt">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <p class="text-left">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sapien erat, consectetur nec purus id, semper congue diam. Duis volutpat convallis ligula, sit amet eleifend tellus suscipit eu. Ut nec sagittis ligula, non convallis dolor. Fusce sed ipsum id metus ullamcorper rutrum. Integer porta, libero sed mattis iaculis, nisl velit tmaximus enim, vel commodo dolor sem vitae arcu. Nullam rutrum quam nec magna tristique efficitur. Duis ornare sed nunc nec aliquam. Maecenas vel rhoncus lorem. Maecenas dapibus, ante vel fringilla hendrerit, tortor nunc tincidunt sem, nec ornare metus arcu in augue. Mauris ipsum nulla, consectetur sit amet dolor vel, tempus mattis metus. Sed eget ligula at arcu dictum lobortis tempus et arcu. Praesent eleifend facilisis tortor, at sodales tellus. Nunc feugiat vehicula malesuada. Maecenas ac nisl id enim efficitur porta. Cras scelerisque augue quis nunc maximus, in convallis lorem hendrerit. Integer vitae tortor ullamcorper dui tristique cursus vel ut eros. Nullam maximus pellentesque elit, eget hendrerit lectus faucibus sed. Aenean pulvinar, augue non sollicitudin vehicula, dui sem lobortis tortor, vel tristique nibh mauris nec nulla. Sed auctor volutpat congue. Aliquam molestie mi at consequat vulputate. Fusce fringilla dolor ut nibh venenatis malesuada. Suspendisse auctor turpis lacus, non consectetur justo aliquet laoreet. Cras nec tempor urna. Etiam mollis libero vel tortor venenatis finibus. Phasellus sodales blandit fermentum.</p>
                    </div>
                </div>
                <div class="row animate-box dexel-feature-videoCnt">
                    <div class="col-md-12 col-sm-12 col-xs-12 dexel-feature-videoCntHeader">
                        <label>RELATED VIDEOS</label>
                    </div>
                    <div class="col-md-10 col-sm-12 col-xs-12 ">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="video-card animate-box">
                                    <div class="video-Badge"></div>
                                    <div class="img-Panel">
                                        <img src="images/yoga.jpeg" class="img-responsive" alt="video-img">
                                    </div>
                                    <div class="content-Panel text-left">
                                        <h3>Surya Namskar</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
                                    </div>
                                    <div class="action-Panel container">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>40 mins</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>Lvl 2-5</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>33425</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">

                                <div class="video-card animate-box">
                                    <div class="video-Badge"></div>
                                    <div class="img-Panel">
                                        <img src="images/yoga.jpeg" class="img-responsive" alt="video-img">
                                    </div>
                                    <div class="content-Panel text-left">
                                        <h3>Surya Namskar</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
                                    </div>
                                    <div class="action-Panel container">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>40 mins</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>Lvl 2-5</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>33425</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">

                                <div class="video-card animate-box">
                                    <div class="video-Badge"></div>
                                    <div class="img-Panel">
                                        <img src="images/yoga.jpeg" class="img-responsive" alt="video-img">
                                    </div>
                                    <div class="content-Panel text-left">
                                        <h3>Surya Namskar</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore</p>
                                    </div>
                                    <div class="action-Panel container">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>40 mins</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>Lvl 2-5</label>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <label class="text-center"><span></span>33425</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
@stop
@section('javascript')
<script src="{{asset('assets/frontend/js/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('assets/frontend/js/main.js')}}"></script>
<script src="{{asset('assets/frontend/js/video-js.js')}}"></script>
<script src="{{asset('assets/frontend/js/youtube.js')}}"></script>
<script src="{{asset('assets/frontend/js/owl.carousel.min.js.download')}}"></script>

@stop
