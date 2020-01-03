 


<?php 
echo session('adminId'); 

/*if(session('adminId')=='')
{
  echo 'hello';

  header('location:http://54.245.36.192/admin/login');
}
else
{
  echo 'hi';
  exit;
}*/



?>
 <nav class="nav_actvedis navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">

    <a class="navbar-brand" href="{{url('dashboard')}}"><img src="{{asset('')}}/public/web/images/logo.png"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
  <ul class="navbar-nav navbar-sidenav side_bar_main" id="exampleAccordion">

       
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link" href="{{url('dashboard')}}">
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
           <i class="fa fa-user"></i>
            <span class="nav-link-text"> Profile</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseComponents">
            <li>
              <a href="{{(url('adminProfile'))}}">Admin Profile</a>
            </li>
        
            <li>
              <a href="{{(url('changePasswordForm'))}}">Change Password</a>
            </li>
          </ul>
        </li>

        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePages" data-parent="#exampleAccordion">
           <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text"> Employee Management</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePages">
            <li>
              <a href="{{(url('users/N'))}}">List of Employess</a>
            </li>
          </ul>
        </li>  

      


          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#client" data-parent="#exampleAccordion">
           <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">Client Management</span>
          </a>
          <ul class="sidenav-second-level collapse" id="client">
            <li>
              <a href="{{(url('clients/W'))}}">List of Clients</a>
            </li>
          </ul>
        </li>

    


        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#booking" data-parent="#exampleAccordion">
            <i class="fa fa-book" aria-hidden="true"></i>
            <span class="nav-link-text"> Door Hanger Management</span>
          </a>
          <ul class="sidenav-second-level collapse" id="booking">
             <li>
              <a href="{{(url('addBannerForm'))}}">Add Banner</a>
            </li>
            <li>
              <a href="{{(url('aboutDoorHanger'))}}">Manage Content</a>
            </li>
              
          </ul>
        </li>


              <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
           <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#job" data-parent="#exampleAccordion">
            <i class="fa fa-briefcase" aria-hidden="true"></i>
            <span class="nav-link-text"> Job Management</span>
          </a>
          <ul class="sidenav-second-level collapse" id="job">
             <li>
              <a href="{{(url('addJobs'))}}">Add Job</a>
            </li>
            <li>
              <a href="{{(url('joblist'))}}">Job List</a>
            </li>
           
              
          </ul>
        </li>



    


          <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#home" data-parent="#exampleAccordion">
            <i class="fa fa-home" aria-hidden="true"></i>
            <span class="nav-link-text"> Manage Home Page</span>
          </a>
          <ul class="sidenav-second-level collapse" id="home">
           
               <li>
              <a href="{{(url('sliderContent'))}}">Manage Slider Content</a>
              </li>

               <li>
              <a href="{{(url('aboutContent'))}}">Manage About Content</a>
              </li>
          </ul>
        </li>      



        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseExamplePagesss" data-parent="#exampleAccordion">
           <i class="fa fa-users" aria-hidden="true"></i>
            <span class="nav-link-text">Flyer Conversion Management</span>
          </a>
          <ul class="sidenav-second-level collapse" id="collapseExamplePagesss">
            <li>
              <a href="{{(url('flyersconversion'))}}">Flyer Conversion</a>
            </li>
          </ul>
        </li>









        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Example Pages">
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#anc" data-parent="#exampleAccordion">
            <i class="fa fa-file" aria-hidden="true"></i>
            <span class="nav-link-text"> Static Pages</span>
          </a>
          <ul class="sidenav-second-level collapse" id="anc">
            <li>
              <a href="{{(url('staticPages/aboutUs'))}}">About Us</a>
              </li>
            <li>
              <a href="{{(url('staticPages/privacyPolicy'))}}">Privacy Policy</a>
              </li>
            <li>
              <a href="{{(url('staticPages/termsAndConditions'))}}">Terms and Conditions</a>
            </li>

          </ul>
        </li>   

 </ul>






      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
       <li class="nav-item right_nav_btn">
          <a href="{{url('adminLogout') }}">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>