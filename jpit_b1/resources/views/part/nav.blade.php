<!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
        <i class="fas fa-home"></i> <a href="http://myanmaritc.com/" target="_blank">Myanmar IT Bootcamp</a>
        <i class="fas fa-code pl-3"></i> Japanese & IT Batch - 1 
      </div>
      <div class="social-links float-right">
        <a href="https://www.facebook.com/micbootcamp/" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.messenger.com/" class="messenger" target="_blank"><i class="fab fa-facebook-messenger"></i></a>
        <a href="https://www.skype.com/en/" class="skype" target="_blank"><i class="fab fa-skype"></i></a>
      </div>
    </div>
  </section>
  <!-- End Top Bar-->

  <!-- ======= Header ======= -->
  <header id="header">
    <div class="container">
      <div id="logo" class="pull-left">
        <h1><a href="{{route('index')}}" class="scrollto">JP Online Corn<span>er</span></a></h1>
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="{{route('index')}}">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#course">Courses</a></li>
          <li><a href="#contact">Contact Us</a></li>
          @auth
          <li class="menu-has-children"><a href="javascript:void(0)">Welcome {{ Auth::user()->firstname }}</a>
            <ul>
              <li>
                <div class="d-flex justify-content-center">
                  <img src="{{ asset(Auth::user()->profile_pic) }}" class="rounded-circle" width="130" height="130">  
                </div>
              </li>
              <li>
                  <center class="text-dark pt-2 font-weight-bolder h5 my-2">
                    {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                  </center>
              </li>
              <li class="d-flex justify-content-start">
                <a href="{{ route('student.show') }}"><i class="fas fa-user-alt fa-lg mr-2"></i> Profile</a>
              </li>
              <li class="d-flex justify-content-start">
                <a href="@if(Auth::user()->is_Teacher){{ route('senseihome') }}@else{{ route('studenthome') }}@endif"><i class="fas fa-tachometer-alt fa-lg mr-2"></i> Dashboard</a>
              </li>
              <li class="d-flex justify-content-start">
                  <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt fa-lg mr-3"></i>{{ __('Logout') }}
                  </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
              </li>
            </ul>
          </li>
          @endauth

          <hr class="dropdown-divider" class="sub-menu-nav">

          <!-- for student -->
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-tv mr-3"></i>Dashboard</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-clipboard-list mr-3"></i>Vocabulary</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="far fa-bookmark mr-3"></i>Grammar</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-spell-check mr-3"></i>Kanji</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-book-open mr-3"></i>Reading</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-headphones-alt mr-3"></i>Listening</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-pen-alt mr-3"></i>Writing</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="far fa-bell mr-3"></i>Notification</a>
          </li>

          <!-- for sensei nav -->
          <!-- <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-tv mr-3"></i>Dashboard</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-clipboard-list mr-3"></i>Vocabulary</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="far fa-bookmark mr-3"></i>Grammar</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-spell-check mr-3"></i>Kanji</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-book-open mr-3"></i>Reading</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-headphones-alt mr-3"></i>Listening</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-pen-alt mr-3"></i>Writing</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-user-friends mr-3"></i>Student</a>
          </li>
          <li class="sub-menu-nav">
            <a href="#"><i class="fas fa-chalkboard-teacher mr-3"></i>Teacher</a>
          </li> -->

        </ul>
      </nav>
    </div>
  </header>
  <!-- End Header -->