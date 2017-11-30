@extends("admin::main")
@section('css')
  @include("texteditor.css")
@stop
@section('content')

<nav class="navbar dexel-coach-navbar">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand header-brand" href="#">Video Uploads</a>
               </div>
            </div>
         </nav>
         <div class="dexel-coach-maincontainer container-fluid">
            <div class="row">
               <div class="panel with-nav-tabs panel-primary">
                  <div class="panel-heading">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-2">
                              <ul class="nav nav-tabs">
                                 <li><a href="{{url('coach/uploads')}}">All Content</a>
                                 </li>
                                 <li><a href="{{url('coach/upload/audios')}}">Audios</a>
                                 </li>
                                  <li class="active"><a href="#">Videos</a>
                                 </li>
                                 <li><a href="{{url('coach/upload/articles')}}">Articles</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel-body">
                     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content">
                        <div class="tab-pane fade  in active" id="tab5primary">  <div class="panel-body pn">
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" id="add_video">Add video</button>
                                <div class="table-responsive">

                                    <table class="table table-striped table-hover" id="datatable" cellspacing="0"

                                           width="100%">

                                        <thead>

                                        <tr>

                                            <th class="va-m">Title</th>

                                            <th class="va-m">Category</th>

                       <th class="va-m">Essence</th>

                        <th class="va-m">Created date</th>

                         <th class="va-m">Action</th>

                                        </tr>

                                        </thead>

                                        <tbody>
                                        @foreach($videos as $video)
                                        <tr>
                                          <td>{{$video->title}}</td>
                                          <td>{{$video->category->title}}</td>
                                          <td>{{$video->essence->title}}</td>
                                          <td>{{$video->created_at}}</td>
                                          <td>
                                            <a href='javascript:void(0)' class='fa fa-pencil' title='Edit' data-toggle='modal' data-target='#myModal'></a>
                                            <a href='javascript:void(0)' class='fa fa-eye view_video' title='View' data-slug="{{$video->slug}}" ></a>
                                            <a href='javascript:void(0)' data-slug="{{$video->slug}}" title='Delete' class='fa fa-trash-o remove_video'></a>
                                          </td>
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div></div>
                     </div>
                  </div>
               </div>
            </div>
         </div>

        <div id="myModal" class="modal fade bg" role="dialog">
          @include('admin::video.form')
        </div>
    <div id="successModals" class="modal fade" role="dialog" >

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">



      <div class="modal-body" style="padding:0 !important">

     <button type="button" class="btn btn-default pull-right" data-dismiss="modal">x</button>

       <div class="alert alert-success" style="margin-bottom:0;background-color:#67d3e0">

  <h4 style="text-align:center;color:#FFF"><b id="success_msg"></b></h4>

</div>
      </div>
    </div>
  </div>
</div>


<div id="video_details" class="modal fade bg" role="dialog">

</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('assets/datatables/media/js/jquery.dataTables.min.js')}}"></script>
@include("texteditor.js")

 <script type="text/javascript">
 $(document).ready(function()
 {
  $('#datatable').DataTable({
        "order": [[ 4, "desc" ]]
    });
  $("#add_video").click(function()
    {
      $('#myModal').modal('show');
    });
  $( "form" ).on( "submit", function( event )
  {
  event.preventDefault();
  $('.form-error').html('');
  var formData = new FormData(this);
  $.ajax({
        url: "{{url('coach/upload/video')}}",
        type: 'POST',
        dataType: 'json',
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
      })
      .done(function(output){
        if(output.code === "success")
        {
          location.reload();
        }
        else
        {
          $.each(output.errors, function(index, element)
          {
            $('#'+index+'_err').html(element)
          });
        }
      })
      .fail(function() {
        //console.log("error");
      })
      .always(function() {
        //console.log("complete");
      });
    });
    $('#page').on('click', '.view_video', function(event)
    {
      event.preventDefault();
      var url = "{{url('coach/view/video')}}";
      $.get( url+"/"+$(this).attr('data-slug'), function( data ) {
        $("#video_details").html(data);
        $("#video_details").modal('show');
      });
    });
    $('#page').on('click', '.remove_video', function(event)
    {
      event.preventDefault();
      var r = confirm("Are you sure about remove this item?");
      if (r == true)
      {
        var url = "{{url('coach/remove/video')}}";
        $.get( url+"/"+$(this).attr('data-slug'), function( data ) {
          location.reload();
        });
      }
    });
  });
      </script>
@stop
