@include('web_layout.header')
<!-- end header here -->

<!-- start Flyer Conversion area here -->
<?php //print_r($customers);die; ?>
<section class="middle-content">
	<div class="container">
		<div class="padding75">
			<h4 class="middle-pagetitle">Flyer Conversion</h4>
			<div class="main-midbox flyer-conversion">
				<div class="row">
					<div class="col-lg-7 border-right">
						<?php foreach($customers as $customer){ ?>
						<article class="jobs-area">
							<div class="job-imageouter">
								<img src="{{asset('')}}{{$customer->image}}" alt="" class="job-image" />
								<label><span>Job Name: </span><?php echo $customer->job_name; ?></label>
								<label><span>First Name: </span><?php echo $customer->name; ?></label>
								<label><span>Last Name: </span><?php echo $customer->last_name; ?></label>
								<label><span>Zip Code: </span><?php echo $customer->zipcode; ?></label>
								<label><span>Address: </span><?php echo $customer->address; ?></label>
								<label><span>Phone: </span><?php echo $customer->phone; ?></label>
								<label><span>Email: </span><?php echo $customer->email; ?></label>
								<label><span>Flyer Count: </span><?php echo $customer->flyer_count; ?></label>
								<label><span>Flyer Recived Date: </span><?php echo $customer->flyer_recived_date; ?></label>
							</div>
						</article>
						<?php } ?>
                        
					<?php if(!$customers->isEmpty()){ echo $customers->links(); }	 ?>
					
						
					</div>

					<div class="col-lg-5">
						@if(Session::has('message'))
					<p class="alert alert-info">{{ Session::get('message') }}</p>
					@endif
						<form class="input-form" id='addNewCustomer' name='addCustomer' method='post' action="{{asset('')}}{{'addCustomer'}}">
							{{csrf_field()}}

							<div class="row">
						         <aside class="col-sm-6">
									<div class="form-group">
										<label class="text-uppercase">Job Name</label>
										<div class="custom_select">
											<select name="myjobb_name" id="totalseatsTyps" onchange="myjob_name()">
												<option selected="true" disabled="disabled">Please Select job name</option>
												<?php foreach ($my_jobs as $key => $value) { ?>
													<option value="{{$value->job_id}}">{{$value->job_name}}</option>
												<?php } ?>
											</select>
										<input type="hidden" value="" placeholder="Total Seats" class="form-control" name="myjobName" id="myjobconversion"/>
										</div>
									</div>
								</aside>	
						  	</div>	

						  	<div class="row">
								<div class="form-group col-sm-6">
							    	<label for="InputCustomerName">First Name</label>
							    	<input type="text" name="name" class="form-control" id="name" placeholder="" value="">
							  	</div>
							  	<div class="form-group col-sm-6">
							    	<label for="InputLastName">Last Name</label>
							    	<input type="text" name="lastname" class="form-control" id="fname" placeholder="" value="">
							  	</div>
						  	</div>
							<div class="row">
								<div class="form-group col-sm-6">
							    	<label for="InputZipCode">Zip Code</label>
							    	<input type="text" name='zipcode' class="form-control" id="zipcode" placeholder="" value="">
							  	</div>
							  	<div class="form-group col-sm-6">
							    	<label for="InputAddressCode">Address</label>
							    	<input type="text" name='address' class="form-control" id="address" placeholder="" value="">
							  	</div>
						  	</div>
                          <div class="row">
	                            <div class="form-group col-sm-6">
							    	<label for="InputPhone">Phone Number</label>
							    	<input type="text" name='phone' class="form-control" id="phone" placeholder="" value="">
							  	</div>
							  	<div class="form-group col-sm-6">
							    	<label for="InputEmail">Email Address</label>
							    	<input type="text" name='email' class="form-control" id="email" placeholder="" value="">
							  	</div>
						  	</div>
                             <div class="row">
							  	 <div class="form-group col-sm-6">
							    	<div class='input-group date' id='datetimepicker13'>
							    	<label for="InputFlyerdateCode">Date Flyer Received</label>
					                    <input type='text' class="form-control" name='flyerdate'/>
					                    <span class="input-group-addon">
					                        <span class="glyphicon glyphicon-time"></span>
					                    </span>
               						</div>
							  	</div>
							  	 <div class="form-group col-sm-6">
							    	<label for="InputFlyercountCode">Flyer Count</label>
							    	<input type="number" name='flyerCount' class="form-control" id="flyerCount" placeholder="" value="" min="1">
							  	</div>
						  	</div>

						  	<button type="submit" class="btn btn-primary btn-block blue-btn">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- end Flyer Conversion area here -->

<!-- start footer here -->
@include('web_layout.footer')
<!-- end footer here -->

<!-- jquery files-->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/popper.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script type="text/javascript">
	$(window).scroll(function() {
	    if($(this).scrollTop()>400) {
	        $( ".header" ).addClass("fixed-me");
	    } else {
	        $( ".header" ).removeClass("fixed-me");
	    }
	});
</script>
<!-- jquery files-->
</body>
</html>
