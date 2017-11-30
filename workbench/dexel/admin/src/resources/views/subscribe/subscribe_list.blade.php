@extends("admin::main")
@section('content')
<nav class="navbar dexel-coach-navbar">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand header-brand" href="#">Subscribers</a>
               </div>
            </div>
         </nav>
         <div class="panel-body app-page table-page">
                     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content  app-table-content">
                        <div class="tab-pane fade  in active" id="tab5primary">  <div class="panel-body pn">
                                <div class="table-responsive">

                                    <table class="table table-striped table-hover" id="datatable" cellspacing="0"

                                           width="100%">

                                        <thead>

                                        <tr>
                                          <th class="va-m">Email <a href="{{url('coach/subscribe/list?').http_build_query(Request::only('page')).'&sortby=email&sortby_option=asc'}}"><i class="fa fa-chevron-up"></i></a> <a href="{{url('coach/subscribe/list?').http_build_query(Request::only('page')).'&sortby=email&sortby_option=desc'}}"><i class="fa fa-chevron-down"></i></a></th>
                                          <th class="va-m">Name  <a href="{{url('coach/subscribe/list?').http_build_query(Request::only('page')).'&sortby=name&sortby_option=asc'}}"><i class="fa fa-chevron-up"></i></a> <a href="{{url('coach/subscribe/list?').http_build_query(Request::only('page')).'&sortby=name&sortby_option=desc'}}"><i class="fa fa-chevron-down"></i></a></th>
                                          <th class="va-m">Date  <a href="{{url('coach/subscribe/list?').http_build_query(Request::only('page')).'&sortby=created_at&sortby_option=asc'}}"><i class="fa fa-chevron-up"></i></a> <a href="{{url('coach/subscribe/list?').http_build_query(Request::only('page')).'&sortby=created_at&sortby_option=desc'}}"><i class="fa fa-chevron-down"></i></a></th>
                                          <th class="va-m">Action</th>
                                        </tr>

                                        </thead>

                                        <tbody>
                                        @foreach($subscribers as $subscriber)
                                        <tr>
                                          <td>
                                            @if($subscriber->user)
                                              {{$subscriber->user->email}}
                                            @else
                                              {{$subscriber->email}}
                                            @endif
                                          </td>
                                          <td>
                                            @if($subscriber->user)
                                              {{$subscriber->user->fname}} {{$subscriber->user->lname}}
                                            @else
                                              {{$subscriber->name}}
                                            @endif
                                          </td>
                                          <td>
                                              {{date('d-m-Y',strtotime($subscriber->created_at))}}
                                          </td>
                                          <td>
                                            @if($subscriber->user)
                                              <a href="mailto:{{$subscriber->user->email}}" class='fa fa-envelope adm-coach-mail' title='Send mail' ></a>
                                            @else
                                              <a href="mailto:{{$subscriber->email}}" class='fa fa-envelope adm-coach-mail' title='Send mail' ></a>
                                            @endif
                                            <a class="remove_subscriber fa fa-trash adm-coach-mail" href="{{url('coach/subscribe/remove/'.$subscriber->id)}}"></a>
                                          </td>
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div></div>
                     </div>
                  </div>
{{ $subscribers->appends(\Request::except('page'))->links() }}
@stop
@section('script')
<script type="text/javascript">
  $('.remove_subscriber').click(function(event) {
    event.preventDefault();
    current_div = $(this);
      var r = confirm("Are you sure, you want to remove ?");
      if (r == true) {
        window.location = current_div.attr('href');
      }
  });
</script>
@stop