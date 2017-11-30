@extends("admin::main")
@section('content')
<nav class="navbar dexel-coach-navbar">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand header-brand" href="#">Coaches</a>
               </div>
            </div>
         </nav>
         <div class="panel-body table-page">
                     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content app-table-content">
                        <div class="tab-pane fade  in active" id="tab5primary">  <div class="panel-body pn">
                                <div class="table-responsive">

                                    <table class="table table-striped table-hover" id="datatable" cellspacing="0"

                                           width="100%">

                                        <thead>

                                        <tr>
                                          <th class="va-m">Avatar</th>
                                          <th class="va-m">Name</th>
                                          <th class="va-m"></th>
                                          <th class="va-m">Action</th>
                                          <!-- <th class="va-m">Comments</th> -->
                                        </tr>

                                        </thead>

                                        <tbody>
                                        @foreach($followers as $follower)
                                        <tr>
                                          <td> <img width=40 src="{{cdn($follower->createdby->profile->photo)}}" /></</td>
                                          <td>{{$follower->createdby->fname}} {{$follower->createdby->lname}}</td>
                                          <td>{{date('d-m-Y',strtotime($follower->created_at))}}</td>
                                          <td>
                                            @if(!$follower->blocked)
                                              <span class='fa fa-eye active_user' title="Block" data-action="block/{{base64_encode($follower->id)}}"></span>
                                            @else
                                              <span class='fa fa-eye-slash active_user' title="Unblock" data-action="unblock/{{base64_encode($follower->id)}}" ></span>
                                            @endif
                                          </td>
                                          <!-- <td>
                                            <a class='fa fa-comment' title='Comments' ></a>
                                          </td> -->
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div></div>
                     </div>
                  </div>
{{ $followers->links() }}
@stop
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('.active_user').click(function(event) {
      /* Act on the event */
      current_div = $(this);
      var r = confirm("Are you sure? ");
      if (r == true) {
          action = current_div.attr('data-action');
          $.ajax({
            url: base_url+'/coach/followers/'+action,
            type: 'POST',
            dataType: 'json',
            data: {'_token': csrf_token},
          })
          .done(function(data) {
            if(data.code == 'success')
            {
              current_div.removeClass('fa-eye');
              current_div.removeClass('fa-eye-slash');
              current_div.addClass(data.text);
              current_div.attr('data-action',data.action);
            }
          })
          .fail(function() {
            //console.log("error");
          })
          .always(function() {
            //console.log("complete");
          });
      }      
    });
  });
</script>
@stop