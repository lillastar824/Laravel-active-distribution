
<?php   //print_r($booking_info); die;  ?>


@include('admin_layout.header');
@include('admin_layout.sidebar');
<style type="text/css">
label {
  width: 100%;
  border-bottom: 1px solid #ddd;
  padding: 4px 0;
}
.adminImage {
  float: left;
  width: 100% !important;
  height: 269px !important;
  border: 1px solid #ddd;
  box-shadow: 0 1px 6px 1px #ddd;
  border-radius: 100%;
}
.adminImage1 {
  height: 200px;
  width: 300px;
}
.admin_bot {
  /* border: ipx solid #ddd; */
  padding: 0;
  text-align: center;
}

.button1 {
  background: green;
  color: white;
  border: #0eba41 2px solid;
}

.button2 {
background: #e91717;
color: white;
border: red 2px solid;
}
</style>

<div class="content-wrapper">


<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="#">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">

                  
                      User Profile
        </li>
      </ol>



<div class="row">
	<div class="col-md-12">

			<div class="col-md-4 float-left">

				<div class="col-md-12" >
		

              <img class='adminImage' src="<?php echo url('').'/'.$userProfile->image ?>" >
	  					
	  					<label style="text-align: center;"> Profile Image </label>
	  				
				</div>

			

			</div>	

			<div class="col-md-8 float-left">
   

        <label>  <span style="color: #000; font-weight: bold;">Name :</span> <?= $userProfile->firstname ?> <?= $userProfile->lastname; ?> </label>
        <label>  <span style="color: #000; font-weight: bold;">address :</span> <?= $userProfile->address ?> </label>
        <label>  <span style="color: #000; font-weight: bold;">phone : </span><?= $userProfile->phone ?> </label>
        <label>  <span style="color: #000; font-weight: bold;">email : </span><?= $userProfile->email ?> </label>
       
  
</div>

	</div>
  </div>
  <hr>
  
</div>





 
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
    <style>
    .adminImage{
     float:left;
     width:250px;
     height: 200px;

    }
    </style>


@include('admin_layout.footer');





