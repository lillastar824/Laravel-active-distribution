@include('admin_layout.header');
@include('admin_layout.sidebar');


    <div class="content-wrapper">
      <div class="profile">
          <div class="container">
              <div class="profile_im text-center"></div>
                <form method='POST' id="#" action="<?php echo url('/')?>/staticPages/{{$pages[0]->title}}/update" enctype='multipart/form-data'>
                   {{ csrf_field() }}
                      <div class="col-md-12 form-line">
                          @if(Session::has('message'))
                          <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                          @endif
                         	<h4><center><b>{{ ucfirst($pages[0]->title) }}</b></center></h4><br>
							 <textarea rows="4"  cols="50" class="form-control control2 summernote" name="description" id="summernotes" placeholder="Type here..."> 	{{(strip_tags(html_entity_decode($pages[0]->description)))}}</textarea>
								<script>
									$('#summernotes').summernote({
									tabsize: 2,
									height: 200,
									});
								</script>
								<br><br>
								<input type='submit' name='submit' value='submit'>
							</div>
						</form>
             	   </div>
        	 </div>
     	</div>

		<!-- /.content-wrapper-->
		<footer class="sticky-footer">
		<div class="container">
		  <div class="text-center">
		    <small>Copyright © Your Website 2018</small>
		  </div>
		</div>
		</footer>
		<!-- Scroll to Top Button-->
		<a class="scroll-to-top rounded" href="#page-top">
		<i class="fa fa-angle-up"></i>
		</a>
		<!-- Logout Modal-->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		  <div class="modal-content">
		    <div class="modal-header">
		      <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
		      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
		        <span aria-hidden="true">×</span>
		      </button>
		    </div>
		    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
		    <div class="modal-footer">
		      <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
		      <a class="btn btn-primary" href="login.html">Logout</a>
		    </div>
		  </div>
		</div>
		</div>
		@include('admin_layout.footer');