@extends('template')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/mmt/css/flaticon.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/mmt/css/magnific-popup.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/mmt/css/style.css') }}"/>
@endsection
@section('content')
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>
	<!-- Hero section start -->
	<section class="hero-section spad">
		<div class="container">
			<div class="row">
				<div class="col-xl-10 offset-xl-0">
					<div class="row">
						<div class="col-lg-4">
							<figure class="hero-image">
								<img src="{{ asset($user->profile_pic) }}" alt="5">
							</figure>
							<div class="edit_profile">
								<a href='{{url("/settings/security/{$user->id}")}}' class="myButton"><font color="white">Edit Profile</font></a>
							</div>
						</div>
						<div class="col-lg-1">
							
						</div>
						<div class="col-lg-7">
							<div class="hero-text">
								<h4>{{ $user->firstname }} {{ $user->lastname }}</h4>
								<h6>Student</h6>
							</div>
							<div id="send_message" onclick="showTextbox()">
								<button id="message">
									<img src="{{asset('assets/mmt/icon-fonts/message.png')}}" height="20px">
									<font color="black">Send Message</font>
								</button>
							</div>


							<div class="_secondary" id="send_text" style="display: none">
									<button class="post" id="send_button">Send</button>
									<textarea class="_twemoji_textarea" rows="7"></textarea>
							</div>


							<!-- <div id="send_text" style="display: none">
								<input type="text" value="Hey">
							</div> -->
							<hr>
							<div class="hero-info">
								<font size="-1" style="color: silver;">Basic Information</font>
								<br>
								<br>
								<ul>
									<li><span>Name</span>{{ $user->firstname }} {{ $user->lastname }}</li>
									<li><span>Date of Birth</span>{{ $user->dateofbirth->format('M j, Y') }}</li>
									<li><span>Address</span>{{ $user->address }}</li>
									<li><span>E-mail</span>{{ $user->email }}</li>
									<li><span>Phone </span>{{ $user->phone }}</li>
								</ul>


								
							</div>
						</div>
						
					</div>
				</div>
			</div>
			<div class="row" style="padding-top: 50px">
				<div class="col-xl-5">
					
				</div>
				<div class="col-xl-6 offset-xl-1">
					<div class="social-link-warp">
						<div class="social-links">
							<a href=""><img id="fb" src="{{asset('assets/mmt/img/facebook.png')}}" width="43px" height="43px"></a> &nbsp;
							<a href=""><img id="inst" src="{{asset('assets/mmt/img/instagram.png')}}"></a>
							<!-- <a href=""><i class="fa fa-instagram"></i></a>
							<a href=""><i class="fa fa-facebook"></i></a>
							<a href=""><i class="fa fa-twitter"></i></a> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('js')
<script src="{{ asset('assets/mmt/js/magnific-popup.min.js') }}"></script>
<script src="{{ asset('assets/mmt/js/circle-progress.min.js') }}"></script>
<script src="{{ asset('assets/mmt/js/main.js') }}"></script>
<script>
function showTextbox() {
	document.getElementById("send_message").style.display = "none";
	document.getElementById("send_text").style.display = "block";
}
</script>
@endsection