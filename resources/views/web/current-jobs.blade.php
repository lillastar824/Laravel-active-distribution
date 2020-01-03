@include('web_layout.header')
<!-- end header here -->

<!-- start completed jobs area here -->
<section class="middle-content">
	<div class="container">
		<div class="padding75">
			<h4 class="middle-pagetitle">Current Jobs</h4>
			<div class="main-midbox">
				<?php foreach($jobs as $job){ /*print '<pre>'; print_r($jobs);*/?>
				<article class="jobs-area">
					<div class="row">
						<div class="col-md-8">
							<div class="job-imageouter">
								<img src="{{asset('/')}}<?php echo $job->image; ?>" alt="" class="job-image" />
								<p class="job-date"><img src="{{asset('/')}}public/admin_assets/images/Calendar_Check-512.png" alt="" /><?php echo $job->created_at; ?></p>
								 <h6>Job Id:</h6><?php echo $job->job_number; ?>
								
								
								<h6>Quantity of Flyers</h6>
								<p class="flyer-quantity"><?php echo $job->flyers; ?></p>
                                


							</div>
						</div>
						<div class="col-md-4 job-rightbox text-right">
							<a href="{{asset('')}}{{'job-details/'}}<?php echo $job->id; ?>" class="btn btn-primary blue-btn">View Details</a>
						</div>
					</div>
				</article>
				<?php } ?>
			
			</div>
			<ul class="pagination">
				<li class="page-item"><a class="page-link" href="#">Previous</a></li>
				<?php for($con=0; $con<$count; $con++) { ?>
				<li class="page-item <?php if($page==$con){echo 'active';} ?>"><a class="page-link" href="{{asset('')}}{{'current-jobs/'}}{{$con}}"><?php echo $con+1; ?></a></li>
				<?php } ?>
				<li class="page-item"><a class="page-link" href="#">Next</a></li>
			</ul>
		
		</div>
	</div>
</section>
<!-- end completed jobs area here -->

@include('web_layout.footer')