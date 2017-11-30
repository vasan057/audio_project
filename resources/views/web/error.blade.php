@extends("web.main")

@section('css')
<style>
.abc{ width: 60%; margin:0 auto; margin-top: 50px; }
.abc h2{ font-size: 40px; color: #3999d6; font-weight: bold; margin-bottom: 0px; }
.abc p{font-size: 25px; color: #828282;}
.abc img{ width: 400px; }
@media(max-width: 690px){
	.abc{ width: 90%; }
	.abc h2{ font-size: 30px;}
	.abc p{font-size: 20px;}
}
@media(max-width: 610px){
.abc{ margin-top: 150px;}
}
@media(max-width: 440px){
.abc img{ width: 300px; }
.abc h2{ font-size: 25px;}
	.abc p{font-size: 14px;}
}
</style>
@stop
@section('content')
<div class="abc">
<h2>Oh no! This page is missing.</h2>
<p>Well this is embarassing...</p>
<img src="{{asset('assets/web/images/404.png')}}" alt="">
<p>StessFit is a young community. We would greatly appreciate if you could please send us a message with any information you can provide on when this happened / which page you were trying to access, and we will do our best to attended to it at the earliest.</p>
<p>Thank you for supporting the StressFit Community!</p>
</div>

@stop
