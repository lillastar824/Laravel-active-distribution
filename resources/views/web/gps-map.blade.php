@include('web_layout.header')
<!-- end header here -->
<style>
.gps_jobs_dropdown {
    text-align: right;
    max-width: 400px;
    width: 100%;
    float: right;
    margin: 20px 0px 40px;
    position: relative;
}
select#totalseatsTyps {
    height: auto;
    font-size: 16px;
    color: #000;
    padding: 12px;
    float: left;
    width: 70%;
}
.gps_jobs_dropdown input#save {
    width: 100px;
    float: right;
    height: auto;
    font-size: 16px;
    padding: 10px;
}

.gps_jobs_dropdown label.error {
    position: absolute;
    left: 0px;
    top: 49px;
    font-size: 12px;
    width: 100%;
    text-align: left;
    font-weight: bold;
}
@media(max-width:599px){
.gps_jobs_dropdown, select#totalseatsTyps, .gps_jobs_dropdown{
    max-width: 100%;
width:100%;
}
.gps_jobs_dropdown input#save {
    width: 100%;
    margin-top: 25px;
}
}
</style>
<!-- start route marking area here -->
<section class="route-marking-area">
		<div class="container">
			<h1 class="section-title"><span>Route marking & Map</span></h1>
			<div class="gps_jobs_dropdown">
		    <form method="post" id="gps_job" accept-charset="utf-8" id="map_form" action="{{asset('/')}}{{'gps_inprogress_job'}}" enctype='multipart/form-data'>
               {{csrf_field()}}
			      <select name="myjobb_name" id="totalseatsTyps" onchange="myjob_name()">
				    <option selected="true" disabled="disabled">Please Select job</option>
					     <?php foreach ($my_jobs as $key => $value) { ?>
					 		<option value="{{$value->job_id}}">{{$value->job_name}}</option>     
					        <?php } ?>
			    </select>
			     <?php foreach ($my_jobs as $key => $value) { ?>
			          <input type="hidden" name="user_id" value="{{$value->user_id}}" id="user_id" />
			      <?php } ?>
			    <input type="submit" class="btn btn-primary btn-block blue-btn" name="save" value="Submit" id="save"/>
		    </form>
		</div>
		</div>
		
		<div class="map-outer">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3082.846000723953!2d-76.60016404901741!3d39.40498997939492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c80fabb2ce900f%3A0x53add1bd2dd5064d!2sTowson%2C+MD!5e0!3m2!1sen!2sin!4v1544781972650" width="100%" height="500" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
	</section>
<!-- end route marking area here -->


<!-- start gps custom map here -->
	<section class="about-area track_order">
		<div class="container">
			<h1 class="section-title"><span>Track your order</span></h1>
			<div class="row">
				<aside class="col-lg-7">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
					<br/><br/>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions</p>
				</aside>
				<aside class="col-lg-5 text-center">
					<img src="images/track_order.png" alt="" />
				</aside>
			</div>
		</div>
	</section>
<!-- end route marking area here -->


<!-- start gps custom map here -->

<!-- end gps custom map here -->

@include('web_layout.footer')