@include('web_layout.header')
<!-- end header here -->

<!-- start edit profile area here -->
<section class="middle-content">
	<div class="container">
		<div class="padding75">
		<?php //print_r($users);die; ?>
			<h4 class="middle-pagetitle">My Profile</h4>
			<div class="main-midbox edit_profile">
				<div class="row">

					<aside class="col-lg-12 bootstraptoggle_outter">
						<div class="bootstraptoggle pull-right">
							<label class="checkbox-inline">
							Email Notifications </label> 
							<?php if($users->email_notification_status=='1'){ 
                                     $isChecked='checked';
  								 }else{ 
                                     $isChecked='';
									 } ?>
							<input id="emaildatatoggel" type="checkbox" <?php echo $isChecked;?> data-toggle="toggle"> 
							<input id="getclientuser_id" type="hidden" value="{{$users->id}}"> 
							
						</div>	
					</aside>

					<aside class="col-lg-4 text-center">
						<div class="profile-image-box">
							<img src="{{asset('')}}{{$users->image}}" alt="" />
						</div>
						
					</aside>
					<aside class="col-lg-8">
						<div class="row">
							<div class="col-md-6">
						    	<p>Company Name</p>
						    	<h5>{{$users->companyname}}</h5>
						  	</div>
						  
						</div>
						<div class="row">
							<div class="col-md-6">
						    	<p>Email Address</p>
						    	<h5>{{$users->email}}</h5>
						  	</div>
						  	<div class="col-md-6">
						    	<p>mobile Number</p>
						    	<h5>{{$users->phone}}</h5>
						  	</div>
						</div>
						<div class="row">
							<div class="col-md-6">
						    	<p>Address</p>
						    	<h5>{{$users->address}}</h5>
						  	</div>
						  	<div class="col-md-6">
						    	<p>Zip code</p>
						    	<h5>{{$users->zipcode}}</h5>
						  	</div>
						</div>
					
					</aside>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end edit profile area here -->

<!-- start footer here -->

	@include('web_layout.footer')