@extends("web.main")
@section('css')
<style type="text/css">
	.footer-panel
	{
		display: none;
	}
</style>
@stop
@section('content')
@include('web.category')
@include('web.articles_list')
@stop
