<!DOCTYPE Html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Flyer Distribution - Home</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <link href="{{asset('public/web')}}/css/style.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" />
        <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
         <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
   
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
        <!--[if lt IE 9]>
            <script src="js/html5shiv.js"></script>
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
            <script src="js/respond.js"></script>
        <![endif]-->
    </head>
<body>
<!-- start header here -->
    <div class="top-header">
        <div class="container">
            <div class="row">
                <aside class="col-md-6 d-flex justify-content-md-start justify-content-center">
                    <ul>
                        <li><a href="#"><i class="fa fa-phone" aria-hidden="true"></i>+1  541-754-1245</a></li>
                        <li><a href="#"><i class="fa fa-envelope" aria-hidden="true"></i>example.com</a></li>
                        
                    </ul>
                </aside>
                <aside class="col-md-6 d-flex justify-content-md-end justify-content-center">
                    <ul>
                        <li class="notification">

                       <?php if(!Auth::guest()){ ?>
                          <a href="{{asset('notifications')}}">
                          <i class="fa fa-bell-o" aria-hidden="true"></i><span class="noti-badge">
                      <?php  
                         $user_id =  Auth::user()->id;  if(!empty($user_id)){
                         $getNotificationCount = DB::table('notifications')->where('user_id',$user_id)->where('status','U')->get();
                         echo $count = count($getNotificationCount);
                        }
                ?>
                        </span></a></li>
                  <?php } if(Auth::guest()){ ?>
                        <li><a href="{{asset('getStaticPages/aboutUs')}}">About US</a></li>
                        <li><a href="{{asset('')}}signup">Create Account</a></li>
                        <li><a href="{{asset('')}}user-login">Login</a></li>
                        <?php } if(!Auth::guest()) { ?>
                        <li class="dropdown"><a href="#" class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Setting</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{asset('myprofile')}}">Profile</a>
                                <a class="dropdown-item" href="{{asset('editprofile')}}">Edit Profile</a>
                                    <?php if(!Auth::guest()){ ?>
                                 <a class="dropdown-item" href="{{asset('webLogout')}}">Logout</a>
                                 <?php } } ?>
                              </div>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>
    </div>
    <header class="header">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-dark">
                    <a class="navbar-brand" href="{{asset('')}}"><img src="{{asset('public/web/images/logo.png')}}" alt="" /></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                    <div class="collapse navbar-collapse justify-content-sm-end" id="navbarSupportedContent">
                        <ul class="navbar-nav">
                          <li class="nav-item active">
                            <a class="nav-link" href="{{asset('')}}">Home</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="#">Become an Employee</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{asset('')}}door-hanger">Door Hangers</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" href="{{asset('')}}gps-map">GPS & Custom Map</a>
                          </li>
                          <?php if(!Auth::guest()) { ?>
                          <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="JobsDrop" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Track Job</a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="JobsDrop">
                                    <a class="dropdown-item" href="{{asset('current-jobs/0')}}">Current Jobs</a>
                                    <a class="dropdown-item" href="{{asset('complete-jobs/0')}}">Completed Jobs</a>
                                    <a class="dropdown-item" href="{{asset('flyer-conversion')}}">Flyer Conversion</a>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
    </header>