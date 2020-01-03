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
	</head>
<body>

<!-- start login area here -->
	<section class="back-bg">
		<div class="login-outerbox text-center">
			<a href="#" class="logo-center"><img src="images/logo.png" alt="" /></a>
			<div class="white-box">
				<h4>Forgot Password</h4>
				<p>Please enter your registered email address below and we will send your reset password link.</p>
				<form name='forgetPassword' method='post' action="{{asset('')}}{{'forgetPass'}}">
					{{csrf_field()}}
					<div class="form-group">
				    	<label for="InputEmailAddress">Email Address</label>
				    	<input type="email" class="form-control" id="InputEmailAddress" placeholder="Enter Email Address" name='email' required="">
				  	</div>
				  	<input type="submit" class="btn btn-primary btn-block blue-btn">
				</form>
			@if(Session::has('message'))
			<p class="alert alert-info">{{ Session::get('message') }}</p>
			@endif
			</div>
		</div>
	</section>
<!-- end login area here -->

<!-- jquery files-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="{{asset('public/web')}}/js/popper.min.js" type="text/javascript"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="{{asset('public/web')}}/js/validate.js" type="text/javascript"></script>
<script src="{{asset('public/web')}}/js/validation.js" type="text/javascript"></script>

<!-- jquery files-->
</body>
</html>
