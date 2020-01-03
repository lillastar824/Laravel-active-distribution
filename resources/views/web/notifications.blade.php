@include('web_layout.header')<!-- end header here -->
<!-- end header here -->

<!-- start notification area here -->
<section class="middle-content">
	<div class="container">
		<div class="padding75">
			<h4 class="middle-pagetitle">Notifications</h4>
			<div class="main-midbox">
				<ul class="notifications_area">
					<?php foreach($notifications as $notification) { ?>
                    <li>
                       <h5><?php echo $notification->message; ?></h5>  
                    	<p><?php echo $notification->timeago; ?></p>
                     </li> 
                  
					<?php } ?>
						
				</ul>

					<?php if(!$notifications->isEmpty()){ echo $notifications->links(); }	 ?>
			</div>
		</div>
	</div>
</section>
<!-- end notification area here -->

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
