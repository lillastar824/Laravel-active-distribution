@include('web_layout.header')
<!-- end header here -->

<!-- start contact us here -->
<section class="middle-content">
	<div class="container">
		<div class="padding75">
			<h4 class="middle-pagetitle">Contact Us</h4>
			<div class="main-midbox">
				<div class="contact-us">
					<h2>Get in touch with us</h2>
					@if(Session::has('message'))
					<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
					@endif
					<form class="input-form" name='contactus' id='contactus' method='post' action='postContactForm'>
						{{ csrf_field() }}
						<div class="row">
								<div class="form-group col-md-6">
							    	<label for="InputfrstName">First Name</label>
							    	<input type="text" class="form-control" id="fname" name="first_name" placeholder="" value="">
							  	</div>
								<div class="form-group col-md-6">
							    	<label for="InputLastName">Last Name</label>
							    	<input type="text" class="form-control" id="lname" name="last_name" placeholder="" value="">
							  	</div>
						</div> 

						<div class="form-group">
					    	<label for="InputFirstName">Company Name</label>
					    	<input type="text" class="form-control" id="companyname" placeholder="" name='companyname'>
					  	</div>
						
                        <div class="form-group">
					    	<label for="InputMobileNumber">Phone Number</label>
					    	<input type="text" class="form-control" id="phone" placeholder="" name='phone'>
					  	</div>
						<div class="form-group">
					    	<label for="InputEmailID">Email ID</label>
					    	<input type="email" class="form-control" id="email" placeholder="" name='email'>
					  	</div>

					  
						
					<!-- 	<div class="form-group">
					    	<label for="InputMarketDistribute">Market for Distribution</label>
					    	<input type="text" class="form-control" id="markit_distribution	" placeholder="" name='markit_distribution'>
					  	</div> -->
						<div class="form-group">
					    	<label for="InputMessage">Message</label>
					    	<textarea class="form-control" id="message" placeholder="" name='message'></textarea>
					  	</div>
					  <input type='submit' value='submit'>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end contact us here -->

@include('web_layout.footer')