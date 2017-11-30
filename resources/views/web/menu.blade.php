<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
<div class="menu_bg_container">
  

<img class="menu-bg1" src="{{asset('assets/web/images/menu_bg1.png')}}">
<img class="menu-bg2" src="{{asset('assets/web/images/menu_bg2.png')}}">
</div>
    <ul class="nav sidebar-nav">
        <div class="sidebar-brand">
            <a href="{{url('/')}}">
                <img src="{{asset('assets/web/images/sf_home_menu_logo.png')}}" alt="logo">
            </a>
        </div>
        @if(Auth::guard('user')->check())
            <li>Hi, {{Auth::guard('user')->user()->fname}} {{Auth::guard('user')->user()->lname}}</li><a href="{{url('myprofile')}}" class='fa fa-pencil' title='Edit Profile'></a>
        @endif
        <li class="cl-effect-19">
            <a href="{{url('/')}}">
                <span data-hover="Home">Home</span>
            </a>
        </li>
        @if(Auth::guard('user')->check())
            <!-- <li class="cl-effect-19">
                <a href="{{url('dashboard')}}">
                    <span data-hover="Dashboard">Dashboard</span>
                </a>
            </li> -->
           <li class="cl-effect-19">
               <a href="{{url('collections')}}">
                   <span data-hover="Collections">Collections</span>
               </a>
           </li>
           <!--  <li class="cl-effect-19">
              <a href="{{url('profile')}}">
                  <span data-hover="Your Profile">Your Profile</span></a>
                      </li> -->
           <!-- <li class="cl-effect-19">
              <a href="{{url('transactions')}}">
                  <span data-hover="Credits">Credits</span></a>
                     </li> -->
        @endif
        <!-- <li class="cl-effect-19">
            <a href="{{url('articles')}}">
                <span data-hover="Articles">Articles</span>
            </a>
        </li>
        <li class="cl-effect-19">
            <a href="{{url('videos')}}">
                <span data-hover="Videos">Videos</span></a>
        </li> -->
        <li class="cl-effect-19">
            <a href="{{url('audios')}}">
                <span data-hover="Audios">Audios</span></a>
        </li>
        
         <li class="cl-effect-19">
            <a href="{{url('coaches')}}">
                <span data-hover="Coaches">Coaches</span></a>
        </li>
         <li class="cl-effect-19">
            <a href="{{url('contact')}}">
                <span data-hover="Contact Us">Contact Us</span></a>
        </li>
        @if(!Auth::guard('user')->check())
        <li>
            <div class="nav-btnpanel text-center">
            <a class="button" href="{!! url('login')!!}" id="coach-register">Register / Login</a>
            <!-- <a class="button" href="{!! url('register')!!}" id="coach-register">Register</a> -->
            <div class="Coach-nav-register">
                <label>Are you a Coach?</label>
                <a class="button" href="{!! url('login/coach')!!}" id="coach-register">Register / Login</a>
                <!-- <a class="button" href="{!! url('register/coach')!!}" id="coach-register">Register</a> -->
            </div>
        </div>
        </li>
        @else
        <li>
        <a class="button" href="{!! url('logout')!!}" id="coach-register">Logout</a>
        </li>
        @endif

    </ul>
</nav>
