@extends("admin::main")
@section('css')
  @include("texteditor.css")
@stop
@section('content')

<nav class="navbar dexel-coach-navbar">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand header-brand" href="#">Science Uploads</a>
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
                                 <li class="active"><a href="#">Sciences</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel-body table-page">
                     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content app-table-content">
                        <div class="tab-pane fade  in active" id="tab5primary">  
                        <div class="panel-body table-page pn">
                                <div class="table-responsive">

                                    <table class="table table-striped table-hover" id="datatable" cellspacing="0"

                                           width="100%">

                                        <thead>

                                        <tr>

                                            <th class="va-m">Title</th>

                                            <th class="va-m">Category</th>
                        <th class="va-m">Created date</th>

                         <th class="va-m">Action</th>

                                        </tr>

                                        </thead>

                                        <tbody>
                                        @foreach($sciences as $science)
                                        <tr>
                                          <td>{{$science->title}}</td>
                                          <td>{{$science->category->title}}</td>
                                          <td>{{$science->created_at}}</td>
                                          <td>
                                            <a href="{{url("coach/science/".$science->category->slug)}}" class='fa fa-pencil' title='Edit'></a>
                                            <a href="{{url("coach/view/science/".$science->category->slug)}}"  class='fa fa-eye view_science' title='View' data-slug="{{$science->slug}}" ></a>
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


<div id="science_details" class="modal fade bg" role="dialog">

</div>
@stop
@section('script')
<script type="text/javascript" src="{{asset('assets/datatables/media/js/jquery.dataTables.min.js')}}"></script>
@include("texteditor.js")

 <script type="text/javascript">
 $(document).ready(function()
 {
  $('#datatable').DataTable({
        "order": [[ 3, "desc" ]]
    });
  });
      </script>
@stop
