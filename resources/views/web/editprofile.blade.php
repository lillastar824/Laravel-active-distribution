
<!-- end header here -->
@include('web_layout.header')

<?php  //print_r($users); ?>
<!-- start edit profile area here -->
<section class="middle-content">
	<div class="container">
		<div class="padding75">
			<h4 class="middle-pagetitle">Edit Profile</h4>
			<div class="main-midbox edit_profile">
				<form class="input-form" action="{{asset('')}}webeditprofile" method='post' id='editProfile' enctype='multipart/form-data'>
				<div class="row">

					
					<aside class="col-lg-4 text-center">
						<div class="profile-image-box">
							<img src="{{asset('')}}{{$users->image}}" alt="" / id='imagess'> 
							<i class="fa fa-user" aria-hidden="true"></i>
							<input type="file"/ name="file" id='image' accept="image/*"/>
						</div>
						<p style="color:#c4c4c5; font-size: 12px;">Upload Image</p>
					</aside>
					<aside class="col-lg-8">
								{{ csrf_field() }}
							<div class="row">
								<div class="form-group col-md-6">
							    	<label for="InputFirstName">Company Name</label>
							    	<input type="text" class="form-control" id="companyname" name="companyname" placeholder="" value="{{$users->companyname}}">
							  	</div>
								
							</div>
							<div class="row">
								<div class="form-group col-md-6">
							    	<label for="InputEmailAddress">Email Address</label>
							    	<input type="email" class="form-control" id="email" name="email" placeholder="" value="{{$users->email}}" readonly>
							  	</div>
								<div class="form-group col-md-6">
							    	<label for="InputMobileNumber">Phone Number</label>
							    	<input type="text" class="form-control" id="phone" name="phone" placeholder="" value="{{$users->phone}}">
							  	</div>
							</div>


	                       <div class="row">
								<div class="form-group col-md-6">
							    	<label for="InputfrstName">First Name</label>
							    	<input type="text" class="form-control" id="fname" name="first_name" placeholder="" value="{{$users->firstname}}">
							  	</div>
								<div class="form-group col-md-6">
							    	<label for="InputLastName">Last Name</label>
							    	<input type="text" class="form-control" id="lname" name="last_name" placeholder="" value="{{$users->lastname}}">
							  	</div>
							</div>


							<div class="row">
								<div class="form-group col-md-6">
							    	<label for="InputAddress">Address</label>
							    	<input type="text" class="form-control" id="address" name="address" placeholder="" value="{{$users->address}}">
							  	</div>
								<div class="form-group col-md-6">
							    	<label for="InputZipCode">Zip code</label>
							    	<input type="text" class="form-control" id="zipcode" name="zipcode" placeholder="" value="{{$users->zipcode}}">
							  	</div>
							</div>
						
						  	<input type="submit" class="btn btn-primary blue-btn" value='submit'>
						</form>
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end edit profile area here -->

<!-- start footer here -->
@include('web_layout.footer')
<script type="text/javascript">
	$(function() {
        $( "#InputDateBirth" ).datepicker({
            dateFormat : 'mm/dd/yy',
            changeMonth : true,
            changeYear : true,
            yearRange: '-100y:c+nn',
            maxDate: '-1d'
        });
    });
</script>
<script type="text/javascript">
	$(window).scroll(function() {
	    if($(this).scrollTop()>400) {
	        $( ".header" ).addClass("fixed-me");
	    } else {
	        $( ".header" ).removeClass("fixed-me");
	    }
	});
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
