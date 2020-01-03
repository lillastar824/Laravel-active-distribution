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
				<h4>Registration</h4>
				@if(Session::has('message'))
				<p class="alert alert-info">{{ Session::get('message') }}</p>
				@endif
				<form method='post' id='register' name='register' enctype='multipart/form-data' action='webuserRegister'>
					{{ csrf_field() }}
					<div class="text-center">
						<div class="profilepic-outer">
							<div class="profilepic-inner">

								<img src="images/camera_icon.png" alt="" class="camera_icon" id='imagess'/>
								<!-- <img src="images/job-image.jpg" alt="" class="profile-image" /> -->
								<input type="file" name="file" id='image' accept="image/*"/>
							</div>
						</div>
					</div>
					<div class="form-group">
				    	<label for="InputEmailAddress">Company Name</label>
				    	<input type="text" class="form-control" id="companyname" name="companyname" placeholder="Enter Company Name">
				  	</div>
					
					<div class="form-group">
				    	<label for="InputEmailAddress">Email Address</label>
				    	<input type="email" class="form-control" id="email" name="email" value="{{$users->email}}" readonly>
				  	</div>
				  	<div class="form-group">
				    	<label for="InputAddress">Address</label>
				    	<input type="text" class="form-control" id="address" name="address" placeholder="Enter Address">
				  	</div>
				  	<div class="form-group">
				    	<label for="InputMobileNumber">Mobile Number</label>
				    	<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Mobile Number">
				  	</div>
				  	<div class="form-group">
				    	<label for="InputZipCode">Zip Code</label>
				    	<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="Enter Zip Code">
				  	</div>
				  	<input type="submit" class="btn btn-primary btn-block blue-btn" value='submit'>
				</form>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="{{asset('public/web')}}/js/jquery-ui.js" type="text/javascript"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<script>
function initialize() {
  var input = document.getElementById('address');
  new google.maps.places.Autocomplete(input);
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>

<script type="text/javascript">
function readURL(input){
  if (input.files && input.files[0]){
    var reader = new FileReader();
    reader.onload = function(e){
      $('#imagess').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
    }
  }
  $("#image").change(function(){
  readURL(this);
});
</script>


<!-- jquery files-->
</body>
</html>
