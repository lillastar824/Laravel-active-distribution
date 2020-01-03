
@include('admin_layout.header');
@include('admin_layout.sidebar');
  <!-- Navigation-->
<div class="content-wrapper">

<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
          Admin Profile
        </li>
      </ol>


<div class="profile">
<div class="container">


    <form id="hangerForm" enctype='multipart/form-data' method='post' action='{{asset('')}}addBanner'>
          {{ csrf_field() }}
          <div class="col-md-6 form-line">
              <div class="form-group">
                Add Banner
                <input id="image" type="file" name='banner' accept="image/*"/>
                <label for="exampleInputUsername"></label>
              </div>


              <div class="form-group">
                <label for="exampleInputUsername">Description</label>
                <textarea name='description' placeholder="Enter Description" id='description'></textarea>
              </div>

        
       
            
            </div>
            <div class="col-md-6">
              <div class="form-group">
       <!--          <label for ="description"> State</label>
                <input type="text" class="form-control" name='state' id="state" placeholder="state" value="<?php //echo $adminInfo->state; ?>"> -->
              </div>
              <div>
              <input id="Update"  type='submit' name='submit' value='submit'>  
              
              </div>
              
          </div>
        </form>

      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
   
    <style>
    .adminImage{
     float:left;
     width:250px;
     height: 200px;

    }
    </style>
@include('admin_layout.footer');
    <!-- Bootstrap core JavaScript-->
   

