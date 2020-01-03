
<!-- end header here -->

@include('web_layout.header')



<!-- start door hanger about here -->
	<section class="about-area about-door-hanger">
		<div class="container">
			<h1 class="section-title"><span>About the door hangers</span></h1>
			<div class="row">
				<aside class="col-md-5 text-center">
					<img src="{{asset('')}}{{$data->image}}" alt="" />
				</aside>
				<aside class="col-md-7">
					<p>{{$data->description}}</p>
					<a href="#" class="blue_btn">Learn More</a>
				</aside>
			</div>
		</div>
	</section>
<!-- end door hanger about here -->

<!-- start pricing here -->
	<section class="pricing-area">
		<div class="container">
			<h1 class="section-title"><span>Pricing</span></h1>
		</div>
		<div class="pricebox-area text-center">
			<div class="container">
				<div class="prices-outer">
					<div class="row">
						<aside class="col-lg-4">
							<div class="price-box">
								<div class="planbox">
									<h3>ADVANCE PLAN</h3>
									<p>Lorem ipsum</p>
									<hr/>
									<span class="plan-price">45$</span>
								</div>
								<div class="plan-description">
									<p>Lorem Ipsum dummy</p>
									<p>Lorem Ipsum dummy</p>
									<p>Lorem Ipsum dummy</p>
									<a href="#" class="blue_btn">BUY NOW</a>
								</div>
							</div>
						</aside>
						<aside class="col-lg-4">
							<div class="price-box">
								<div class="planbox">
									<h3>PREMIUM PLAN</h3>
									<p>Lorem ipsum</p>
									<hr/>
									<span class="plan-price">70$</span>
								</div>
								<div class="plan-description">
									<p>Lorem Ipsum dummy</p>
									<p>Lorem Ipsum dummy</p>
									<p>Lorem Ipsum dummy</p>
									<a href="#" class="blue_btn">BUY NOW</a>
								</div>
							</div>
						</aside>
						<aside class="col-lg-4">
							<div class="price-box">
								<div class="planbox">
									<h3>BASIC PLAN</h3>
									<p>Lorem ipsum</p>
									<hr/>
									<span class="plan-price">30$</span>
								</div>
								<div class="plan-description">
									<p>Lorem Ipsum dummy</p>
									<p>Lorem Ipsum dummy</p>
									<p>Lorem Ipsum dummy</p>
									<a href="#" class="blue_btn">BUY NOW</a>
								</div>
							</div>
						</aside>
					</div>
				</div>
				<a href="#" class="blue_btn get_quote">Get a quote</a>
			</div>
		</div>
	</section>
<!-- end service here -->

<!-- start footer here -->
@include('web_layout.footer')