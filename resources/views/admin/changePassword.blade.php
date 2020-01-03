
@include('admin_layout.header');
@include('admin_layout.sidebar');
  <!-- Navigation-->
<div class="content-wrapper">

<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
         Change Password
        </li>
      </ol>

<div class="profile">
<div class="container">
<div class="profile_im text-center">
  
  </div>

    <form method='POST' id="changePassword" action='{{url('/changeAdminPassword')}}' enctype='multipart/form-data'>
       {{ csrf_field() }}
          <div class="col-md-6 form-line">
            <div class="form-group">
                <label for="exampleInputUsername">Old Password</label>
                <input type="password" class="form-control" name='oldPassword' id="oldPassword" placeholder="Enter Old Password">
              </div>
       
              <div class="form-group">
                <label for="telephone">New Password</label>
                <input type="password" class="form-control" name='newPassword' id="newPassword" placeholder="Enter New Password">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for ="description">Confirm Password</label>
                <input type="password" class="form-control" name='confirmPassword' id="confirmPassword" placeholder="Enter Confirm Password">
              </div>
              <div>
              <input type='submit' name='submit' value='submit'>  
              
              </div>

  @if(Session::has('message'))
  <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif


              
          </div>
        </form>

      </div>
    </div>
    <!-- /.container-fluid-->
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
    <!-- Bootstrap core JavaScript-->
   