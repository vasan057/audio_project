@extends("admin::main")
@section('content')
<nav class="navbar dexel-coach-navbar">
            <div class="container-fluid">
               <div class="navbar-header">
                  <a class="navbar-brand header-brand" href="#">Messages</a>
               </div>
            </div>
         </nav>
         <div class="panel-body app-page table-page">
                     <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2 tab-content app-table-content">
                        <div class="tab-pane fade  in active" id="tab5primary">  <div class="panel-body pn">
                                <div class="table-responsive">

                                    <table class="table table-striped table-hover" id="datatable" cellspacing="0"

                                           width="100%">

                                        <thead>

                                        <tr>

                                            <th class="va-m">Email</th>

                                            <th class="va-m">Name</th>

                       <th class="va-m">Message</th>

                        <th class="va-m">Date</th>

                         <th class="va-m">Action</th>

                                        </tr>

                                        </thead>

                                        <tbody>
                                        @foreach($contacts as $contact)
                                        <tr>
                                          <td>{{$contact->email}}</td>
                                          <td>{{$contact->fname}} {{$contact->lname}}</td>
                                          <td>{!!$contact->message!!}</td>
                                          <td>{{date('d-m-Y',strtotime($contact->created_at))}}</td>
                                          <td>
                                            <a href="mailto:{{$contact->email}}" class='fa fa-envelope' title='View' ></a>
                                          </td>
                                        </tr>
                                        @endforeach
                                        </tbody>

                                    </table>

                                </div>

                            </div></div>
                     </div>
                  </div>
{{ $contacts->links() }}
@stop