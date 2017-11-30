@extends("admin::main")
@section('css')
  @include("texteditor.css")
@stop
@section('content')

<nav class="navbar dexel-coach-navbar">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand header-brand" href="#">Quotes Uploads</a>
               </div>
            </div>
         </nav>
         <div class="dexel-coach-maincontainer container-fluid app-page table-page">
            <div class="row">
               <div class="panel with-nav-tabs panel-primary">
                  <div class="panel-heading">
                     <div class="container">
                        <div class="row">
                           <div class="col-md-10 col-sm-10 col-xs-10 col-md-offset-2">
                              <ul class="nav nav-tabs">
                                 <li class="active"><a href="#">Quotes</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="panel-body table-page">
                     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content app-table-content">
                     <a type="button" class="btn btn-info btn-lg" href="{{url('coach/quote/new')}}" >Add Quote</a>
                        <div class="tab-pane fade  in active" id="tab5primary">  <div class="panel-body pn">
                                <div class="table-responsive">

                                    <table class="table table-striped table-hover" id="datatable" cellspacing="0"

                                           width="100%">

                                        <thead>

                                        <tr>

                                            <th class="va-m">Author</th>

                                            <th class="va-m">Description</th>
                        <th class="va-m">Created date</th>

                         <th class="va-m">Action</th>

                                        </tr>

                                        </thead>

                                        <tbody>
                                        @foreach($quotes as $quote)
                                        <tr>
                                          <td>{{$quote->author}}</td>
                                          <td>{!!$quote->description!!}</td>
                                          <td>{{$quote->created_at}}</td>
                                          <td>
                                            <a href="{{url("coach/quote/".$quote->id)}}" class='fa fa-pencil' title='Edit'></a>
                                            <a href="{{url("coach/view/quote/".$quote->id)}}"  class='fa fa-eye view_quote' title='View' ></a>
                                            <span class='fa fa-trash-o remove_quote' data-id="{{$quote->id}}" title='View' ></span>
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
 $('#page').on('click', '.remove_quote', function(event)
  {
    event.preventDefault();
    id = $(this).attr('data-id');
    var result = confirm("Are you sure, want to delete?");
    if(result)
    {
      $.ajax({
        url: base_url+'/coach/remove/quote/'+id,
        type: 'GET',
        //dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        //data: {param1: 'value1'},
      })
      .done(function() {
        location.reload();
        //console.log("success");
      })
      .fail(function() {
        //console.log("error");
      })
      .always(function() {
        //console.log("complete");
      });
    }
  });
  </script>
@stop
