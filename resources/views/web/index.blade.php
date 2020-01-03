
<!-- end header here -->
@include('web_layout.header')
<!--start banner here -->
		<div id="carouselExampleIndicators" class="carousel slide banner" data-ride="carousel">
		  <div class="carousel-inner">
		  	<?php /*print '<pre>'; print_r($sliders); exit; */ $i = 1;?>
		  	<?php foreach($sliders as $slider){
           
		  		?>
		    <div class="carousel-item <?php if($i==1){echo " active";} ?>">
		      	<img class="d-block w-100" src="{{asset('')}}{{$slider->image}}" alt="First slide">
		      	<div class="carousel-caption">
		      		<div class="container">
			      		<div class="table_box">
			      			<div class="table_box_inner">
				    			<h1>{{$slider->content}}</h1>
				    			<a href="#" class="blue_btn">Learn More</a>
				    		</div>
				    	</div>
				    </div>
			  	</div>
		    </div>
		    <?php   $i++; } ?>
		 <!--    <div class="carousel-item">
		      	<img class="d-block w-100" src="{{asset('public/web')}}/images/banner2.jpg" alt="First slide">
		      	<div class="carousel-caption">
		      		<div class="container">
			      		<div class="table_box">
			      			<div class="table_box_inner">
				    			<h1>Door to Door <span>Flyer Delivery</span> with <span>GPS Tracking</span></h1>
				    			<a href="#" class="blue_btn">Learn More</a>
				    		</div>
				    	</div>
				    </div>
			  	</div>
		    </div> -->
		  </div>
		  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
		    <span class="sr-only">Previous</span>
		  </a>
		  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		    <span class="carousel-control-next-icon" aria-hidden="true"></span>
		    <span class="sr-only">Next</span>
		  </a>
	</div>
<!--end banner here -->

<!-- start about here -->
	<section class="about-area">
		<div class="container">
			<h1 class="section-title"><span>About</span></h1>
			<div class="row">
				<aside class="col-lg-7">
					<p>{{$about->description}}</p>
				</aside>
				<aside class="col-lg-5 text-center">
					<img src="{{asset('')}}{{$about->image}}" alt="" />
				</aside>
			</div>
		</div>
	</section>
<!-- end about here -->

<!-- start service here -->
	<section class="service-area">
		<div class="container">
			<h1 class="section-title"><span>Service Area</span></h1>
		</div>
		<div class="map-outer">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3082.846000723953!2d-76.60016404901741!3d39.40498997939492!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c80fabb2ce900f%3A0x53add1bd2dd5064d!2sTowson%2C+MD!5e0!3m2!1sen!2sin!4v1544781972650" width="100%" height="210" frameborder="0" style="border:0" allowfullscreen></iframe>
		</div>
		<div class="locations-area">
			<div class="container">
				<h3 class="text-center">AREAS COVERED</h3>
				<p>Service Area: Alabama, Alaska, Arizona, Arkansas, California, Colorado, Connecticut, Delaware, Florida, Georgia, Hawaii, Idaho, Illinois, Indiana, Iowa, Kansas, Kentucky, Louisiana, Maine, Maryland, Massachusetts, Michigan, Minnesota, Mississippi, Missouri, Montana, Nebraska, Nevada, New Hampshire, New Jersey, New Mexico, New York, North Carolina, North Dakota, Ohio, Oklahoma,  Oregon, Pennsylvania, Rhode Island, South Carolina, South Dakota, Tennessee, Texas, Utah, Vermont, Virginia, Washington, West Virginia, Wisconsin, Wyoming.</p>
				<p>Washington D.C, Maryland, Virginia, Georgetown, Petworth, Silver Spring, Greenbelt, Laurel, Landover, Largo, District Heights, Capitol Heights, Temple Hills, Chevy Chase, Rockville, Potomac, Gaithersburg, Frederick, Hagerstown, Waldorf, Upper Marlboro, Salisbury, College Park, Bowie, Columbia, Annapolis, Baltimore, Towson, Glen Burnie, Ellicott City, Catonsville, Woodlawn, Gywnn Oak, Milford Mill, Lochearn, Pikesville, Owings Mills, Reisterstown, Cockeysville, Towson, Carney, Parkville, </p>
			</div>
		</div>
	</section>
<!-- end service here -->
@include('web_layout.footer')
