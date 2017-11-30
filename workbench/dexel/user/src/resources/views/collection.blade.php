@extends("web.main")
@section('content')


<div class="row">
   <div class="panel with-nav-tabs panel-primary">
      <div class="panel-heading">
         <div class="container">
            <div class="row">
               <div class="col-md-12 col-sm-12 col-xs-12">
                  <ul class="nav nav-tabs">
                     <li class="active"><a href="#tab1primary" data-toggle="tab">Articles</a>
                     </li>
                     <li><a href="#tab2primary" data-toggle="tab">Videos</a>
                     </li>
                     <li><a href="#tab3primary" data-toggle="tab">Audios</a>
                  </ul>
               </div>
            </div>
         </div>
      </div>
      <div class="panel-body">
         <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1 tab-content">
            <div class="tab-pane active" id="tab1primary">
              <label>
              <span></span> All Articles in your collection
              </label>
               @include('web.articles_list')
            </div>
            <div class="tab-pane" id="tab2primary">
               <div class="tab-content-header text-left">
                 <label>
                 <span></span> All Videos in your collection
                 </label>
                  @include('web.video_list')
               </div>
            </div>
            <div class="tab-pane" id="tab3primary">
               <div class="tab-content-header text-left">
                  <label>
                  <span></span> All Audios in your collection
                  </label>
                  @include('web.articles_list')
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!--- Playlist / audio card end --->

@stop
