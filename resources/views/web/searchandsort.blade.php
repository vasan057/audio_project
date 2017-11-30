<!-- CSS
=================================================================== -->
<link rel="stylesheet" href="{{asset('assets/customer/css/animate.css')}}">
<link rel="stylesheet" href="{{asset('assets/customer/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('assets/customer/css/bootstrap.css')}}">
<link rel="stylesheet" href="{{asset('assets/customer/css/style.css')}}">

<!-- Script
=================================================================== -->
<script src="{{asset('assets/customer/js/modernizr-2.6.2.min.js')}}"></script>
<!-- FOR IE9 below -->
<!--[if lt IE 9]>
<script src="js/respond.min.js"></script>
<![endif]-->
<style>
   .dexel-customer-actionPanel .btn-collection{
      border: 1px solid #96549e;
      color: #96549e;
   }
</style>
  <!--sabrina-->
<!-- <section class="container dexel-maincontainer">

  <div class="row">
     <div class="dexel-customer-actionPanel">
        <div class="col-md-3 col-sm-3 col-xs-12">
           <div id="custom-search-input" style="border: solid 1px #96549e;">
              <div class="input-group col-md-12">
                 <span class="input-group-btn">
                 <button style="color:#96549e" class="btn btn-info btn-md" type="button">
                 <i class="fa fa-search"></i>
                 </button>
                 </span>
                 <input type="text" class="form-control input-md" placeholder="Search">
              </div>
           </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 col-md-offset-5">
           <div class="dropdown">
              <button class="btn btn-collection dropdown-toggle btn-lg text-left" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width:100%;text-align:left;">
              Sort by
              <span class=" pull-right caret" style="margin-top:8%"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                 <li><a href="#">Item 1</a></li>
                 <li role="separator" class="divider"></li>
                 <li><a href="#">Item 2</a></li>
                 <li role="separator" class="divider"></li>
                 <li><a href="#">Item 3</a></li>
              </ul>
           </div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6">
           <div class="dropdown">
              <button class="btn btn-collection dropdown-toggle btn-lg text-left" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="width:100%;text-align:left;">
              Duration
              <span class=" pull-right caret" style="margin-top:8%"></span>
              </button>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                 <li><a href="#">Item 1</a></li>
                 <li role="separator" class="divider"></li>
                 <li><a href="#">Item 2</a></li>
                 <li role="separator" class="divider"></li>
                 <li><a href="#">Item 3</a></li>
              </ul>
           </div>
        </div>

     </div>
  </div>
  </section> -->

  <!-- Script
  =================================================================== -->
  <script src="js/jquery-3.1.1.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/main.js"></script>
  <script>
     $(document).ready(function(){
        $('.dexel-coachImgcontainer').find('a').on('click', function(){
           $(this).parent().find('span').toggle();

        });
     });
  </script>
  <!--sabrina-->
