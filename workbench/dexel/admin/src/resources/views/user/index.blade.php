@extends("admin::main")
@section('content')
<nav class="navbar dexel-coach-navbar">
    <div class="container-fluid">
       <div class="navbar-header">
          <a class="navbar-brand header-brand" href="#">Users</a>
       </div>
    </div>
 </nav>
 <div class="panel-body app-page table-page">
     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content  app-table-content">
        <div class="tab-pane fade  in active" id="tab5primary">  <div class="panel-body pn">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                          <th class="va-m">Avatar</th>
                          <th class="va-m">Email</th>
                          <th class="va-m">Name</th>
                          <th class="va-m">DOB</th>
                          <th class="va-m">Signup On</th>
                          <th class="va-m">Active</th>
                          <th class="va-m">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td><img width=40 src="{{cdn($user->profile->photo)}}" /></td>
                          <td>{{$user->email}}</td>
                          <td>{{$user->fname}} {{$user->lname}}</td>
                          <td>{{date('d-m-Y',strtotime($user->profile->dob))}}</td>
                          <td>{{date('d-m-Y',strtotime($user->created_at))}}</td>
                          <td>
                            @if($user->active)
                              <span class='fa fa-eye active_coach adm-coach-view' title="Active" data-action="user/deactivate/{{base64_encode($user->id)}}"></span>
                            @else
                              <span class='fa fa-eye-slash active_coach adm-coach-view' title="Inactive" data-action="user/activate/{{base64_encode($user->id)}}" ></span>
                            @endif
                          </td>
                          <td>
                            <a  href="{{url('coach/mailto?email='.$user->email)}}" class='fa fa-envelope adm-coach-mail' title='Send mail' ></a>
                          </td>
                        </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>

            </div></div>
     </div>
  </div>
{{ $users->links() }}
@stop
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('.active_coach').click(function(event) {
      /* Act on the event */
      current_div = $(this);
      var r = confirm("Are you sure? ");
      if (r == true) {
          action = current_div.attr('data-action');
          $.ajax({
            url: base_url+'/coach/'+action,
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