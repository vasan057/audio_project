@extends("admin::main")
@section('css')
   <link rel="stylesheet" href="{{asset('editor/froala_style.css')}}">
   <style>
   .fr-view p{ line-height: inherit; }
    .fr-view ul li{ list-style: disc outside none;
display: list-item;
margin-left: 2em;}
    .fr-view ol li{  list-style: decimal outside none;
display: list-item;
margin-left: 2em; }
    .fr-view em{ font-style: italic!important; }
    .fr-view a{ color:#4285f4!important; text-decoration: underline; cursor: pointer;}
.fr-view a *{ color:#4285f4!important; }
.fr-view a:hover{ color:#8a28c2!important; text-decoration: underline; }
.fr-view a:hover *{ color:#8a28c2!important; }
.fr-view strong{ font-weight: bold!important;  color: inherit;}
.fr-view strong *{  font-weight: bold!important;  color: inherit; }
.fr-view span * { color: inherit; }
     #page{height: auto!important;}
.fr-view p, .fr-view p span, .fr-view strong span, .fr-view ul li span{ line-height: 1.5em; }
@media(max-width:920px){
  .fr-fic{ height:auto!important; }
.fr-view p span{ font-size: 20px!important; } 
.article-view-page{ padding: 20px!important;
 }
}
@media(max-width:768px){

.article-view-cover{ margin-top: 60px; }
}
@media(max-width:512px){
.fr-view p span{ font-size: 16px!important; } 
.article-view-page{ padding: 10px!important;
 }
 }


    </style>
@section('content')
<nav class="navbar dexel-coach-navbar2">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand header-brand" href="#">View Science Article</a>
    </div>
  </div>
</nav>


 <div class="form-group">
           
            <img class="cover article-view-cover col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-12"  src="{{cdn($science->cover_img)}}" />
          </div>
    <!-- Modal content-->
<div class="article-view col-md-10 col-md-offset-1 col-sm-11 col-sm-offset-1 col-xs-12 app-page2" >
 <h2 class="article-view-title"> {{$science->title}}</h2>
      {{-- <h4 class="modal-title" style="color:#424242; font-size: 30px;">Science Article Information</h4> --}}
      <div class="article-view-page">
          <div class="form-group" >
            <!-- <label for="email" style="color:#424242; font-size: 30px;">Title: </label> -->
          
          </div>
         
          <img id="cover_image" src="" style="display:none">
          <div class="form-group" style="width:100%" >
         <h3>Short Description:</h3>
           <p> {!!$science->short_description!!}</p>
          </div>
          <div class="form-group" style="width:100%">
           <h3> Description:</h3>
              <div class="fr-view">
                            {!!$science->description!!}
                        </div>
          </div>
     
          </div>
          <br/>
               <a href="{{url('coach/sciences')}}" class="btn btn-bordered btn-primary mb5" >Back</a>
</div>

@stop

@section('script')
<script>
$(document).ready(function()
 //    {

 //   if ($(window).width() < 768) {
   
 //      if ($(".fr-view span").css('font-size') > '34px' )
 //      {
 //          alert('1');
 //        $(".fr-view span").css({'font-size': '23px'});
 //      } 


 //      if ($(".fr-view span").css('font-size') >= '23px' && $("p span").css('font-size') <= '34px')
 //      {
 //          alert('2');
 //        $(".fr-view span").css({'font-size': '18px'});
 //      }

 //      if ($(".fr-view span").css('font-size') < '24px')
 //      {
 //          alert('3');
 //        $(".fr-view span").css({'font-size': '12px'});
 //      }


 //  }
 // else {

 // }
 //   });
</script>
@stop