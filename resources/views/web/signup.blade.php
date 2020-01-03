<!DOCTYPE Html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="format-detection" content="telephone=no">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Flyer Distribution - Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="{{asset('public/web')}}/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
		<!--[if lt IE 9]>
			<script src="js/html5shiv.js"></script>
			<script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
			<script src="js/respond.js"></script>
		<![endif]-->
        <style>
        header.header.fixed-me {
    position: unset;
}
        </style>
	</head>
<body>

<!-- start login area here -->

    <div class="top-header">
        <div class="container">
            <div class="row">
                <aside class="col-md-6 d-flex justify-content-md-start justify-content-center">
                    <ul>
                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>+1  541-754-1245</a></li>
                        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>example.com</a></li>
                    </ul>
                </aside>
                <aside class="col-md-6 d-flex justify-content-md-end justify-content-center">
                    <ul>
                        <li class="notification">
                    <?php if(!Auth::guest()){?>
                          <a href="{{asset('notifications')}}">
                          <i class="fa fa-bell-o" aria-hidden="true"></i><span class="noti-badge">

                <?php  
                  $user_id =  Auth::user()->id;  if(!empty($user_id)){
                  $getNotificationCount = DB::table('notifications')
                              ->where('user_id',$user_id)->where('status','U')->get();
                    echo $count = count($getNotificationCount);
                } ?>
                  </span></a></li>
                <?php } ?>
                         <li><a href="{{asset('getStaticPages/aboutUs')}}">About US</a></li>
                        <li><a href="{{asset('')}}user-login">Login</a></li>
                       
                <!--         <li class="dropdown"><a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Setting</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{asset('myprofile')}}">Profile</a>
                                <a class="dropdown-item" href="{{asset('editprofile')}}">Edit Profile</a>
                                    <?php if(!Auth::guest())
                                    {     ?>
                                 <a class="dropdown-item" href="{{asset('webLogout')}}">Logout</a>
                                 <?php } ?>
                              </div>
                        </li> -->
                    </ul>
                </aside>
            </div>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <a class="navbar-brand" href="{{asset('')}}"><img src="{{asset('public/web/images/logo.png')}}" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                    <div class="collapse navbar-collapse justify-content-sm-end" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                          <li class="nav-item active">
                            <a class="nav-link" href="{{asset('')}}">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Become an Employee</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{asset('')}}door-hanger">Door Hangers</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{asset('')}}gps-map">GPS & Custom Map</a>
                          </li>
                     <!--      <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="JobsDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Track Job</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="JobsDrop">
                                    <a class="dropdown-item" href="{{asset('current-jobs/0')}}">Current Jobs</a>
                                    <a class="dropdown-item" href="{{asset('complete-jobs/0')}}">Completed Jobs</a>
                                    <a class="dropdown-item" href="{{asset('flyer-conversion')}}">Flyer Conversion</a>
                                </div>
                            </li> -->
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>

<!-- start login area here -->
	<section class="back-bg" style="height:100%;display: table;
    width: 100%;min-height: unset;padding: 50px 0px;background-attachment: unset;">
		<div class="login-outerbox text-center">
			<div class="white-box">
				<h4>Sign Up</h4>
				@if(Session::has('message'))
				<p class="alert alert-info">{{ Session::get('message') }}</p>
				@endif
				<form method='post' name='signup' id='signup' action="{{asset('')}}websignup">
					{{ csrf_field() }}
					<div class="form-group">
				    	<label for="InputEmailAddress">Email Address</label>
				    	<input type="email" class="form-control" name='email' id="email" placeholder="Enter Email Address">
				  	</div>
				  	<div class="form-group">
				    	<label for="InputPassword">Password</label>
				    	<input type="password" class="form-control" id='password' name="password" placeholder="Enter Password">
				  	</div>
				  	<div class="form-group">
				    	<label for="InputPassword">Password</label>
				    	<input type="password" class="form-control"  id="confirmPassword" name="confirmPassword" placeholder="Re-Enter Password">
				  	</div>
				  	<button type="submit"  class="btn btn-primary btn-block blue-btn">Sign Up</button>
				</form>
			</div>
			<p class="terms">By signing up, you agree with our <a href="{{asset('getStaticPages/termsAndConditions')}}">Terms & Conditions</a> and <a href="{{asset('getStaticPages/privacyPolicy')}}">Privacy Policy.</a></p>
		</div>
	</section>
<!-- end login area here -->

<!-- jquery files-->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('public/web')}}/js/popper.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{asset('public/web')}}/js/validate.js" type="text/javascript"></script>
<script src="{{asset('public/web')}}/js/validation.js" type="text/javascript"></script>
<script>
var lastIndex = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
var base_url ="<?php echo url('/web_login')  ?>";
if(lastIndex=='web_signup?timeout')
{
alert('Successfully signup');
window.location.href = base_url;	
}


$(function() {
    $('input').keypress(function(e) {
        if (e.which == 32) 
            e.preventDefault();
    });
});
</script>
</body>
</html>
 -->

 <!-- start footer here -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <aside class="col-md-7 d-flex justify-content-md-start justify-content-center">
                    <ul class="footer-links">
                        <li><a href="{{asset('getStaticPages/termsAndConditions')}}">Terms & Conditions</a></li>
                        <li><a href="{{asset('getStaticPages/privacyPolicy')}}">Privacy Policy</a></li>
                         <li><a href="#">Become an Employee</a></li>
                        <li><a href="{{asset('getStaticPages/aboutUs')}}">About US</a></li>
                        <li><a href="{{asset('contact-us')}}">Contact Us</a></li>
                    </ul>
                </aside>
                <aside class="col-md-5 d-flex justify-content-md-end justify-content-center">
                    <ul class="social-links">
                        <li><a href="#"><img src="{{asset('public/web')}}/images/facebook_icon.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{asset('public/web')}}/images/twitter_icon.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{asset('public/web')}}/images/google_icon.png" alt="" /></a></li>
                        <li><a href="#"><img src="{{asset('public/web')}}/images/linkedin_icon.png" alt="" /></a></li>
                    </ul>
                </aside>
            </div>
            <p class="text-center">&copy; 2018 Activ Flyer Distribution </p>
        </div>
    </footer>
<!-- end footer here -->
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.0/themes/smoothness/jquery-ui.css">
<!-- jquery files-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('public/web')}}/js/popper.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{asset('public/web')}}/js/validate.js" type="text/javascript"></script>
<script src="{{asset('public/web')}}/js/validation.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>



<script type="text/javascript">
    $(window).scroll(function() {
        if($(this).scrollTop()>300) {
            $( ".header" ).addClass("fixed-me");
        } else {
            $( ".header" ).removeClass("fixed-me");
        }
    });
</script>
<script>
var lastIndex = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
var base_url ="<?php echo url('/web_login')  ?>";
if(lastIndex=='web_signup?timeout')
{
alert('Successfully signup');
window.location.href = base_url;	
}


$(function() {
    $('input').keypress(function(e) {
        if (e.which == 32) 
            e.preventDefault();
    });
});
</script>
<!-- jquery files-->
</body>
</html>
