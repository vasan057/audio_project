@extends("admin::main")
@section('content')
<nav class="navbar dexel-coach-navbar">
    <div class="container-fluid">
       <div class="navbar-header">
          <a class="navbar-brand header-brand" href="#">My Category</a>
       </div>
    </div>
 </nav>
 <div class="panel-body app-page table-page">
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content">
       <form role="form" class="col-sx-12 "  method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @if(Session::has('message'))
                <p>{{ Session::get('message') }}</p>
            @endif
            @if($playlist_category)
            <div class="tab-content">
                <div class="form-horizontal dexel-coach-form">
                  <div class="form-group">
                    <label for="inputName3" class="col-sm-3">Title</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{old('title',$playlist_category->title)}}">
                        {!!$errors->first('title','<span class="form-error">:message</span>')!!}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName3" class="col-sm-3">Icon</label>
                    <div class="col-sm-9 category-radio-list">
                       @foreach($icons as $icon)
                          <?php
                          if($playlist_category->icon == $icon)
                          {
                            $checked = 'checked="checked"';
                          }
                          else
                          {
                            $checked = '';
                          }
                          ?>
                          <div class="category-radio-list-each">
                            <img src="{{asset('categories/icn_category_'.$icon.'.png')}}" alt="" width="60" height="60">
                          <input {{$checked}} type="radio" name="icon" value="{{$icon}}" placeholder="">
                          </div>
                       @endforeach
                       <div class="clearboth"></div>
                       {!!$errors->first('icon','<span class="form-error">:message</span>')!!}
                    </div>
                  </div>              
                </div>
                <ul class="dexel-reg-btn">
                    <li class="col-md-12">
                        <button type="submit" class="btn btn-primary next-step">Update</button>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            @else
            @if(count($categories) <= 8)
            <div class="tab-content">
                <div class="form-horizontal dexel-coach-form">
                    <div class="form-group">
                        <label for="inputName3" class="col-sm-3">Title</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="title" name="title" placeholder="" value="{{old('title')}}">
                            {!!$errors->first('title','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputName3" class="col-sm-3">Icon</label>
                        <div class="col-sm-9 category-radio-list">
                           @foreach($icons as $icon)
                                <div class="category-radio-list-each">
                                <img src="{{asset('categories/icn_category_'.$icon.'.png')}}" alt="" width="60" height="60">
                              <input type="radio" name="icon" value="{{$icon}}" placeholder="">
                              </div>
                           @endforeach
                           <div class="clearboth"></div>

                           {!!$errors->first('icon','<span class="form-error">:message</span>')!!}
                        </div>
                    </div>              
                  </div>

                <ul class="dexel-reg-btn">
                    <li class="col-md-12">
                        <button type="submit" class="btn btn-primary next-step">Add</button>
                    </li>
                </ul>
                <div class="clearfix"></div>
                @endif
            </div>
        </form>
    </div>
    @endif
     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content app-table-content">
        <div class="tab-pane fade  in active"> 
            <div class="panel-body pn">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable" cellspacing="0"
                           width="100%">
                        <thead>
                          <tr>
                            <th class="va-m">Icon</th>
                            <th class="va-m">Title</th>
                            <th class="va-m">Playlist</th>
                            <th class="va-m">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($categories as $category)
                          <tr>
                          <td>
                            <div class="l-s-each_icn">
                              <img src="{{asset('categories/icn_category_'.$category->icon.'.png')}}" alt="" width="60" height="60">
                            </div>
                          </td>
                            <td>
                                {{$category->title}}
                            </td>
                            <td>{{$category->playlists->count()}}</td>
                            <td>
                              @if($category->active)
                                <span class='fa fa-eye active_category' title="Active" data-action="my_category/deactivate/{{base64_encode($category->id)}}"></span>
                              @else
                                <span class='fa fa-eye-slash active_category' title="Inactive" data-action="my_category/activate/{{base64_encode($category->id)}}" ></span>
                              @endif
                              <a href="{{url('coach/audios/my_category/'.$category->id)}}"><i class="fa fa-pencil"></i></a>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
     </div>
  </div>
{{ $categories->links() }}
@stop
@section('script')
<script type="text/javascript">
  $(document).ready(function() {
    $('.active_category').click(function(event) {
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