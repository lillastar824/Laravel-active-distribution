







<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>SB Admin - Start Bootstrap Template</title>
  <!-- Bootstrap core CSS-->
<link href="{!! url('public/admin_assets/vendor/bootstrap/css/bootstrap.min.css')!!}" rel="stylesheet">
<link href="{!! url('public/admin_assets/css/sb-admin.css')!!}" rel="stylesheet">
<?php $baseurl = url('/').'/public/admin_assets/background/'; ?>
<style>
.bg-dark1 {

    /* background: url("<?php echo $baseurl; ?>/ic_bg.png");*/
     background-repeat: no-repeat;
     background-size: 100% 100%;
     background: #ccc;
}
.text-center.logo_new 
{
  padding: 50px 0 30px;
  background: #292a65;
}
.text-center.logo_new img
 {
  height: 70px;
}
#loginForm input {
  height: 50px;
  font-size: 20px;
  box-shadow: 0 0 25px 0 #ccc;
}
.login_sub {
  background: #292a65;
  border: none;
  width: 130px;
  color: #fff;
  font-size: 28px;
  border-radius: 4px;
}
.card-login 
{
  max-width: 35rem;
  box-shadow: 3px 8px 30px 0 #555;
}
#changeForgotPassword input {
  height: 50px;
  font-size: 20px;
  box-shadow: 0 0 25px 0 #ccc;
}
</style>



</head>

<body class="bg-dark1">
  <div class="container">
    <div class="card card-login mx-auto mt-5" style="margin-top: 111px !important;">
    @if(Session::has('message'))
<p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
@endif
      <!--div class="card-header">Login</div-->
      <div class="text-center logo_new">
           <img src="http://104.236.127.72/active-distribution/public/web/images/logo.png">
      </div>
      <div class="card-body">
      <form  method='post' id='changeForgotPassword' action={{url('/changeForgotPassword')}} >
             {{csrf_field()}}

             <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type='password' class="form-control" name='password'  placeholder='New Password' id='password'>
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
           <input type='password' class="form-control" name='confirm_password'  placeholder='Confirm Password' id='confirm_password'>
          </div>
          
              <br>
              <input type='hidden' value="<?php echo $user_id; ?>" name="user_id">   
              <input type='hidden'  value="<?php echo $token; ?>" name="password_token">   
  
              <input id="subm" class="login_sub" type='submit' name='submit' value="Submit">      
        </form>
      </div>
    </div>
  </div>
  <!-- Bootstrap core JavaScript-->
<script src="{!! url('public/admin_assets/vendor/jquery/jquery.min.js')!!}"></script>
<script src="{!! url('public/admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')!!}"></script>
<script src="{!! url('public/admin_assets/vendor/jquery-easing/jquery.easing.min.js')!!}"></script>
<script src="{!! url('public/admin_assets/vendor/jquery/validate.js')!!}"></script>
<script src="{!! url('public/admin_assets/vendor/jquery/validation.js')!!}"></script>

   

</body>

</html>
