@include('web_layout.header')<!-- end header here -->

<!-- start job detail area here -->
<?php //print_r($jobDetails);die; ?>
<section class="middle-content">
	<div class="container">
		<div class="padding75">
			<h4 class="middle-pagetitle">Job Details</h4>
			<div class="main-midbox">
				<article class="jobs-area">
					<div class="row">
						<div class="col-md-4">
							<div class="job-imageouter job-detail">
								
								<p class="job-date"><img src="{{asset('/')}}public/admin_assets/images/Calendar_Check-512.png" alt="" /><?php
								$date=date_create($jobDetails->created_at);
								echo date_format($date,"d F, Y");
								?></p>
								
								<h6>Job Id</h6>
								<p class="flyer-quantity"><?php echo $jobDetails->job_number; ?></p>	
								
								<h6>Quantity of Flyers</h6>
								<p class="flyer-quantity"><?php echo $jobDetails->flyers; ?></p>
								
								<h6>Flyers Distributed</h6>
								<?php if($jobDetails->flyer_distributed > 0){ ?>
								
								<p class="flyer-quantity"><?php echo $jobDetails->flyer_distributed; ?></p>
								<?php }else{ ?> 
                                <p class="flyer-quantity">0</p>
								<?php } ?>
								
								<h6>Numbers of Employees</h6>
								<p class="flyer-quantity"><?php echo $jobDetails->job_employee; ?></p>
								
								<h6>Numbers of Customers</h6>
								<p class="flyer-quantity"><?php echo $jobDetails->num_customers; ?></p>
								
								<h6>Job Status</h6>

								<?php 
								    if($jobDetails->com_request!=$jobDetails->job_request || $jobDetails->job_request==0)
								    {
									    $jobStatus = 'In Progress';
									}else{
									  	$jobStatus = 'Complete';
									} 
							    ?>

								<p class="flyer-quantity green"><?php echo $jobStatus; ?></p>
								   <h6>Job Completion</h6>
							
							<div class="progress pink">
							<?php if(empty($jobDetails->flyer_distributed)) 
							{
							$percent = 0;
							} 
							else 
							{ 
							$percent=$jobDetails->flyer_distributed*100/$jobDetails->flyers;
							$percent = round($percent,2); 
							} 

							?>
							<div class="progress-bar" style="width:<?php echo $percent; ?>%; background:#ff4b7d;">
							<div class="progress-value"><?php echo $percent.'%'; ?></div>
							</div>
							</div>
							</div>
						</div>
						<div class="col-md-8">
							<div id="map"></div>	
						</div>
					</div>

					<div class="table-responsive">
					<table width="100%" cellpadding="0" cellspacing="0" class="employee-table">
						<thead>
							<tr>
								<th>Employee Name</th>
								<!-- <th>Phone Number</th> -->
								<th>Job Status</th>
								
							</tr>
						</thead>
						<tbody>
							<?php 
							$image = array();
							foreach($employeeDetails as $detail)
							{
                               
							?>
							<tr>
								<td><?php echo $detail->firstname; ?></td>
								<!-- <td><?php echo $detail->phone; ?></td> -->
								<?php if($detail->status=='C'){$status='Completed';}else if($detail->status=='S'){$status='Paused';} else if($detail->status=='I'){$status='In-Progress';} else if($detail->status=='A'){$status='Not Started yet';}else if($detail->status=='P'){$status='Pending';} ?>
								<td><?php echo $status; ?></td>
								
							</tr>
							<?php 
                            
							$locations[]=array($detail->firstname, $detail->latitude, $detail->longitude );
                                 $markers = json_encode($locations);
                            $image[] =    $detail->image;  

  
							 ?>
							<?php } ?>
							
						</tbody>
					</table>
				</div>

				</article>

				
			</div>
		</div>
	</div>
</section>
<!-- end job detail area here -->

<!-- start footer here -->
	@include('web_layout.footer')
	<!DOCTYPE html>

  <meta http-equiv="content-type" content="text/html; charset=UTF-8" /> 


     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVzGh5nFNlFvsdYU726-j98eTeiWA1Xzk&libraries=drawing&callback=initMap"
         async defer></script>
<body>
	<?php
  $image2 = json_encode($image);  ?>

  <script type="text/javascript">
   function initMap(){

<?php  if(count($employeeDetails) != 0) { 

          if($employeeDetails[0]->status=='I') {  ?>

    var img = '<?php echo $image2;?>';
    img = JSON.parse(img);
    console.info('---------',img[0]);

    var locations = [
      <?php foreach($employeeDetails as $detail){ 
				$image[] =    $detail->image;  
            echo "['$detail->firstname','$detail->latitude','$detail->longitude'],";
       } ?>
	]
<?php } } ?>
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 8,
      center: new google.maps.LatLng(37.090240, -95.712891),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;
       for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: {
		url: "<?php echo asset('') ?>"+img[i],
		scaledSize: new google.maps.Size(23, 23),
	}
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }

     }

  </script>
<style>
.gm-svpc {
    margin-top: 29px;
}
</style>

</body>


