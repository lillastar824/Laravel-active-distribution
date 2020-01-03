<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\DoorHanger;
use App\Customer;
use App\ContactUs;
use DB;
use App\Admin;
use Session;
use Laravel\Socialite\Facades\Socialite;
use Mail;

class UserController extends Controller
{


  public function __construct()
  {
    $this->user = new User;
    $this->admin = new Admin;
    $this->mytime = date('Y-m-d H:i:s', time());
    

  }

  /*signup api*/
   public function signUp(Request $reuqest)
   {
    
    $user = new User;
   
    $password = request('password');
    $hashPassword = Hash::make($password);
    
    $rememberToken = str_random(9);

   $checkEmail = User::where('email', request('email'))->first();
   if(!empty($checkEmail))
   {
   	return response()->json(['message' => 'Email Already Exist'],409);
   }
   else
   {
   	$user->email = request('email');
    $user->password = $hashPassword;
    $user->device_id = request('device_id');
    $user->device_type = request('device_type');
    $user->remember_token = $rememberToken;
    $user->save();
    $user_id = $user->id;
    $getUserInfo  = User::find($user_id);
    return response()->json(['message' => 'Signup Successfully',
							'device_id'=>$user->device_id,
							'device_type'=>$user->device_type,
							'user_id'=>$user_id,
							'user_info'=>$getUserInfo]
							);
   }
   
   /* print '<pre>';
    print_r($getUserInfo);
    exit;*/
   }



  /*login api*/
   public function login(Request $reuqest)
   {

   	$email = request('email');
    $password = request('password');
    $device_id = request('device_id');
    $device_type = request('device_type');
    $latitude = request('latitude');
    $longitude = request('latitude');
    $rememberToken = str_random(9);
   if (Auth::attempt(['email' => $email, 'password' => $password,'user_type' => 'N'])) {

   	 $user_id = Auth::user()->id;
     $getSuspendStatus = DB::table('users')->select('is_suspended')->where('id',$user_id)->first();
     if($getSuspendStatus->is_suspended=='ON')
     {
  return response()->json(['message' => 'You can not logged in, since you are suspended by admin'],400);
     }
     else
     {
     $updateUserData = $this->user->updateUserData($user_id,$device_id,$device_type,$rememberToken,$latitude,$longitude);
     //$getUserInfo =  DB::table('users')->where('id',$user_id)->first();

     $getUserInfo = User::find($user_id);

     
  
    return response()->json(['message' => 'Successfully logged In',
              'user_info'=>$getUserInfo]
              );  
     }

      
    }
     else
     {
     	return response()->json(['message' => 'Invalid Email/password'],400);
     }
      
 }



/*create profile api*/
 public function createprofile(Request $request)
 {
    $token = $_SERVER['HTTP_TOKEN'];
     $user_id = $this->checkToken($token);


    if(is_object($user_id))
    {
      return $user_id;
    }
   $data['firstname'] = request('firstname');
   $data['lastname'] = request('lastname');
   $data['phone'] = request('phone');
   $data['address'] = request('address');
   $data['zipcode'] = request('zipcode');
   $data['dob'] = request('dob');
   $data['updated_at'] = $this->mytime;

     if ($request->hasFile('image'))
        {

        $file = $request->file('image');
         $filename = $file->getClientOriginalName();
         $uniq_no = mt_rand();
         $unique_image = $uniq_no.'img'.$filename;
         $move = $file->move(public_path().'/uploads/', $unique_image);
         $data['image'] = "/public/uploads/".$unique_image;
        }

         if ($request->hasFile('attach_id'))
        {

        $file = $request->file('attach_id');
         $filename = $file->getClientOriginalName();
         $uniq_no = mt_rand();
         $unique_attach = $uniq_no.'attachId'.$filename;
         $move = $file->move(public_path().'/uploads/', $unique_attach);
         $data['attach_id'] = "/public/uploads/".$unique_attach;
        }

   return $this->user->createProfile($user_id,$data);
   



 }




 public function changeLocation(Request $request)
 {
   $token = $_SERVER['HTTP_TOKEN'];
     $user_id = $this->checkToken($token);
     


    if(is_object($user_id))
    {
      return $user_id;
    }

  /* echo $user_id;
   exit;*/

  $lat = request('latitude');
   $long = request('longitude');

  return $this->user->changeLocation($user_id,$lat,$long);

 }


/*change user password*/
 public function changePassword(Request $request)
 {

     $token = $_SERVER['HTTP_TOKEN'];
     $user_id = $this->checkToken($token);
     


    if(is_object($user_id))
    {
      return $user_id;
    }
     $oldPassword = request('oldPassword');
     $confirmPassword = request('confirmPassword');

    return $result = $this->user->changePassword($user_id,$oldPassword,$confirmPassword);
  



 }


/*get jobs*/
 public function getJobs($type,$page)
 {

    
 
    $token = $_SERVER['HTTP_TOKEN'];
    $user_id = $this->checkToken($token); 

   if(is_object($user_id))
    {
      return $user_id;
    }

    return $result = $this->user->getJobs($user_id,$type,$page);




 }



   public function getJobDetail($id)
  {
      $token = $_SERVER['HTTP_TOKEN'];
    $user_id = $this->checkToken($token); 

   if(is_object($user_id))
    {
      return $user_id;
    }

   
    return $result = $this->user->getJobDetail($user_id,$id);
   
  }



 public function contactInfo(Request $request)
 {
    $token = $_SERVER['HTTP_TOKEN'];
     $user_id = $this->checkToken($token);
     


    if(is_object($user_id))
    {
      return $user_id;
    }
   $data['user_id'] = $user_id;
   $data['companyname'] = request('companyname');
   $data['firstname'] = request('firstname');
   $data['lastname']= request('lastname');
   $data['phone']= request('phone');
   $data['message']= request('message');

 return $this->user->contactInfo($data);




 }


/*accept reject jobs*/
 public function acceptRejectJobs(Request $request)
 {
  $token = $_SERVER['HTTP_TOKEN'];
    $user_id = $this->checkToken($token); 
    //echo $user_id;die;
     if(is_object($user_id))
    {
      return $user_id;
    }
   $request_id = request('request_id');
   $status = request('status');
   if($status=='A'){
      
      $job_requests =DB::table('job_requests')->where('id',$request_id)->select('job_id','id','status')->first();
   
   if($job_requests){
      $myjob_id=$job_requests->id;
     
      $job_requests =DB::table('job_requests')->where('id',$myjob_id)->whereIn('status',['S','C','I','A'])->select('job_id','id','status')->first();
      //print_r($job_requests);die;
      if(!empty($job_requests)){
        return response()->json(['message' => 'This Job is already accepted by another user'],400); 
      }
   }
  }

   return $result = $this->user->acceptRejectJobs($user_id,$request_id,$status); 



 }

/************************/
/* Get Notification list */
/************************/

 public function getNotifications($page)
 {
   $token = $_SERVER['HTTP_TOKEN'];
    $user_id = $this->checkToken($token); 
     if(is_object($user_id))
    {
      return $user_id;
    }

   return $result = $this->user->getNotifications($user_id,$page); 

 }






 public function changeNotification(Request $request)
 {
    $token = $_SERVER['HTTP_TOKEN'];

    $user_id = $this->checkToken($token); 
     if(is_object($user_id))
    {
      return $user_id;
    }
    $status = request('status');
    return $result = $this->user->changeNotification($user_id,$status);

 }






 /*pauseStartJobs*/
 public function pauseJobs(Request $request)
 {
   $token = $_SERVER['HTTP_TOKEN'];
    $user_id = $this->checkToken($token); 
     if(is_object($user_id))
    {
      return $user_id;
    }
   $request_id = request('request_id');
   $status = request('status');
   return $result = $this->user->pauseJobs($user_id,$request_id,$status); 




 }



 public function checkToken($token)
 {
  if(empty($token))
  {    
    
    return response()->json(['message' => 'Token not found'], 404); 
        die;
    
      
  }
    else
  {
    $getUserId = DB::table('users')->select('id')->where('remember_token',$token)->first();
    if(empty($getUserId))
    {
     return response()->json(['message' => 'User has been logged in to another account'], 401); 
     exit;  
    }
    else
    {
      return $getUserId->id;
    }
  }

 }



/*view profile*/
 public function viewProfile()
{
   
     $token = $_SERVER['HTTP_TOKEN'];


    $user_id = $this->checkToken($token); 
     if(is_object($user_id))
    {
      return $user_id;
    }

    return $getdata = $this->user->viewProfile($user_id);



}




public function forgotPassword(request $req){

     $email = request('email');

if($email!=''){

$password_token = str_random(10);
$fake_token_one = str_random(2);
$fake_token_two = str_random(3);

 $update_user_data = DB::table('users')->where('email',$email)
                ->update(array('forget_token' => $password_token));

$useremail = DB::table('users')
                    ->where('email', $email)
                    ->select('*')->first();
if(!$useremail){
  return response()->json(['message' => 'Please Enter Valid Email!'],401);
}
else if($useremail->login_type == 'F' || $useremail->login_type == 'G')
{
return response()->json(['message' => 'Sorry This Account has been linked through Social Media'],401);
}
else
{
$userid = $useremail->id;
$base_url = url('/'); 
$content ="<p>We have received your request for change password.</p>
          <p>Please <a href='".$base_url."/resetPasswordForm/$fake_token_one-$fake_token_two-$userid-$password_token'>
          Click here </a> to change your password.</p><br/><br/>Thanks<br/>Active";
          
       Mail::send(array(), array(), function ($message) use ($content,$email) 
          {
            $from  = 'info@smallworld.com';
            $message->to($email ,'Forgot Password')
          ->subject('Request for change password')
          ->setBody($content, 'text/html');
          });
 
    
    $result['message']  = "Please check your mail address to reset your password";
    $result['user_id']  = $userid;
    return $result;

            }
           }

           else
           {
    return response()->json(['message' => 'Please Enter Email Address'],401);
   
           }

    }











 /***********************  webmodules      ******************************************/


/*signup functionality*/
public function websignup(Request $request)
{
      $user = new User;
      $email = request('email');
      $password = request('password');
      $confirmPassword = request('confirmPassword');
      
$hashPassword = Hash::make($password);

 $checkEmail = User::where('email', request('email'))->first();
   if(!empty($checkEmail))
   {
   Session::flash('message','Email already exist');
   return Redirect('signup');
   }
   else
   {
    $user->email = request('email');
    $user->password = $hashPassword;
    $user->user_type = 'W';  /*W=webuser or client*/
     
    $user->device_type = 'W';/*for webuser*/
    $user->save();
    
  

if(Auth::attempt(['email'=>$email,'password'=>$password,'user_type'=>'W']))
   {
    return Redirect('user-register');
   }

   
    

   }
}


/*login functionality*/
  public function weblogin(Request $request)
  {
    $email = request('email');
    $password = request('password');
    
   if(Auth::attempt(['email'=>$email,'password'=>$password,'user_type'=>'W']))
   {
    return Redirect('/');
   }
   else
   {
    Session::flash('message','Invalid email/password');
    return Redirect('/user-login');
   }

 }



 public function logout(Request $request)
 {
    $token = $_SERVER['HTTP_TOKEN'];
    $user_id = $this->checkToken($token); 
     if(is_object($user_id))
    {
      return $user_id;
    }

   return $this->user->logout($user_id);

 }


/*for edit profile*/
 public function webeditprofile(Request $request)
 {
  
  $user_id = Auth::user()->id;

  $data['companyname'] = request('companyname');
  $data['email'] = request('email');
  $data['phone'] = request('phone');
  $data['address'] = request('address');
  $data['zipcode'] = request('zipcode');
  $data['firstname'] = request('first_name');
  $data['lastname'] = request('last_name');
  $data['dob'] = request('dob');


    if ($request->hasFile('file'))
        {

        $file = $request->file('file');
         $filename = $file->getClientOriginalName();
         $uniq_no = mt_rand();
         $unique_image = $uniq_no.'img'.$filename;
         $move = $file->move('public/uploads/', $unique_image);
         $data['image'] = "/public/uploads/".$unique_image;
        }


 return $this->user->webeditprofile($user_id,$data);



 }

/******************************/
/* Email Toggel On Off */
/******************************/
public function emailnotidatatoggel(Request $req){
  $vartoggelvalue=$req->input('vartoggelvalue');
  $user_id=$req->input('user_id');
  DB::table('users')->where('id',$user_id)->update(['email_notification_status'=>$vartoggelvalue]);
}
/**********************/
/*for view webpage*/
/*********************/
 public function editprofile()
 {
   if (Auth::guest()){
              return redirect('user-login');
          }
  $user = new User;
  $user_id = Auth::user()->id;
  $getData = User::find($user_id);
  return view('web.editprofile',['users'=>$getData]);
 }



 public function myprofile()
 {
   if (Auth::guest()){
              return redirect('user-login');
                     }
  $user = new User;
  $user_id = Auth::user()->id;
  $getData = User::find($user_id);      
  return view('web.myprofile',['users'=>$getData]); 
 }

 /********************************/
 /*gps map*/
 /********************************/
 public function gpsmap(){
    if (Auth::guest()){
        return redirect('user-login');
     }
     $user_id = Auth::user()->id;  
     
     $jobs=DB::table('job_clients as js')
             ->join('jobs as j','js.job_id','=','j.id')
             ->join('job_requests as jr','jr.job_id','=','j.id')
             ->where('js.user_id',$user_id)
             ->where('jr.status','I')
             ->select('j.id as job_id','j.job_name','j.image','jr.user_id')->get();
   
    return view('web.gps-map',['my_jobs'=>$jobs]);

 }


  /********************************/
 /*gps inprogress job*/
 /********************************/
 public function gps_inprogress_job(Request $req){
    if (Auth::guest()){
          return redirect('user-login');
    }
     $user_id = Auth::user()->id;  
     $job_id=$req->input('myjobb_name');

     $service_provider_id=$req->input('user_id');
   
     $jobs=DB::table('job_clients as js')
             ->join('jobs as j','js.job_id','=','j.id')
             ->join('job_requests as jr','jr.job_id','=','j.id')
             ->where('js.user_id',$user_id)
             ->where('jr.status','I')
             ->select('j.id as job_id','j.job_name','j.image','jr.user_id')->get();
   
      $joblocation = $this->admin->jobLocation($job_id);
      $employeeList = $this->admin->employeeList($job_id);
      $getEmployeeDetails = $this->user->getEmployeeDetails($job_id);
   //print_r($getEmployeeDetails);die;
    return view('web.gps_inprogress_job',['my_jobs'=>$jobs,'locations'=>$joblocation,'employeeList'=>$employeeList,'employeeDetails'=>$getEmployeeDetails]);

 }
 /********************************/
 /*door hanger*/
 /********************************/


 public function doorhanger()
 {
  $data = $this->user->getHanngerData();
  return view('web.doorhanger',['data'=>$data]);
 }


 public function userRegister()
 {
     if (Auth::guest()){
              return redirect('user-login');
          }
  $user_id = Auth::user()->id;
  $getData = User::find($user_id); 

  return view('web.register',['users'=>$getData]);
 }



 /*for edit profile*/
 public function webuserRegister(Request $request)
 {
  
  $user_id = Auth::user()->id;

  
  $data['companyname'] = request('companyname');
  $data['email'] = request('email');
  $data['phone'] = request('phone');
  $data['address'] = request('address');
  $data['zipcode'] = request('zipcode');
  $data['dob'] = request('dob');


    if ($request->hasFile('file'))
        {

        $file = $request->file('file');
         $filename = $file->getClientOriginalName();
         $uniq_no = mt_rand();
         $unique_image = $uniq_no.'img'.$filename;
         $move = $file->move('public/uploads/', $unique_image);
         $data['image'] = "/public/uploads/".$unique_image;
        }


 return $this->user->webuserRegister($user_id,$data);



 }

/*view contact form page*/
 public function contactUs()
 {
  return view('web.contact-us');

 }

/*Post Contact Form*/
 public function postContactForm()
 {
    
  $user = new ContactUs;
  $user->firstname = request('first_name');
  $user->lastname = request('last_name');
  $user->companyname = request('companyname');
  $user->email = request('email');
  $user->mobile = request('phone');
  /*$user->markit_distribution = request('markit_distribution');*/
  $user->message = request('message');
  $user->save();
  


         $companyname =  request('companyname'); 
         $usermail    = request('email');
         $firstname   = request('first_name');
         $lastname    = request('last_name');
        /* $markit_distribution = request('markit_distribution');*/
         $phone = request('phone');
         $message = request('message');
         $email = 'phpteam368@gmail.com';

            $html = "User Name: ".$firstname.' '.$lastname.'<br>';
            $html = "Company Name: ".$companyname.'<br>';
            $html .= "Email: ".$usermail.'<br>';
            $html .= "Phone: ".$phone.'<br>';
         /*   $html .= "Market for Distribution: ".$markit_distribution.'<br>';*/
            $html .= "Message: ".$message;
             Mail::send(array(), array(), function ($message) use ($html,$email) 
            {
            $from  = 'info@smallworld.com';
            $message->to($email ,'Job Alert')
            ->subject('Job Alert')
            ->setBody($html, 'text/html');
            });





  Session::flash('message','Information has been posted successfully');
  return redirect('contact-us');

   

 }


/*social media login pending*/
 public function redirect($service) {
        return Socialite::driver ( $service )->redirect();
    }

   public function callback($service) {
        $user = Socialite::with ($service )->user();
        return view ( 'home' )->withDetails ( $user )->withService ( $service );
    }
/*social media login pending*/

  

/*flyer conversion module*/
  public function flyerConversion()
  {  

     if (Auth::guest()){
              return redirect('user-login');
          }
     $user_id = Auth::user()->id;  
    //echo $user_id ;die;  
     $customerData = new Customer;
    // $getData = $customerData::where('user_id', $user_id)->orderby('id','DESC')->Paginate(3);
     $getData = DB::table('customers as c')
               ->join('jobs as j','c.job_id','=','j.id')
               ->where('c.user_id', $user_id)->select('c.*','j.job_name','j.image')
               ->orderby('c.id','DESC')->Paginate(3);

     $jobs=DB::table('job_clients as js')
             ->join('jobs as j','js.job_id','=','j.id')
             ->where('js.user_id',$user_id)
             ->select('j.id as job_id','j.job_name','j.image')->get();
     
     // print_r($jobs);die;
     $randomWords =  str_random(9);
    return view('web.flyer-conversion',['rand'=>$randomWords,'customers'=>$getData,'my_jobs'=>$jobs]);
  }



  public function addCustomer(Request $request)
  {
     if (Auth::guest()){
        return redirect('user-login');
      }

    $data['user_id']            = Auth::user()->id;      
    $data['name']               = request('name');
    $data['last_name']          = request('lastname');
    $data['zipcode']            = request('zipcode');
    $data['phone']              = request('phone');
    $data['email']              = request('email');
    $data['address']            = request('address');
    $data['flyer_recived_date'] = request('flyerdate');
    $data['flyer_count']        = request('flyerCount');
    $data['job_id']             = request('myjobName');
    return $result = $this->user->addCustomer($data);

  }


/*flyer conversion module*/

  public function completeJobs($page)
  {
    if (Auth::guest()){
              return redirect('user-login');
          }
   $user_id = Auth::user()->id;    
   $perpage = 3;
   $getData = $this->user->completeJobs($page,$perpage,$user_id);
   $count = $this->user->completeJobCount($user_id);
   $totalCount = $count/$perpage;

   return view('web.complete-jobs',['jobs'=>$getData,'count'=>$totalCount]);

  }



  public function currentJobs($page)
  {
    if (Auth::guest()){
              return redirect('user-login');
          }

    $user_id = Auth::user()->id;   
   $perpage = 3;
   $getData = $this->user->currentJobs($page,$perpage,$user_id);
/*   print '<pre>';
   print_r($getData);
   exit;*/
   $count = $this->user->currentJobCount($user_id);
  /* print '<pre>';
   print_r($count);
   exit;*/
   $totalCount = $count/$perpage;

   return view('web.current-jobs',['jobs'=>$getData,'count'=>$totalCount,'page'=>$page]);

  }


/*Note status=P in jobrequests table will not effect overall job status*/

/************************/
/*  job Details*/
/*************************/
  public function jobDetails($id)
  {
    $getJobDetails = $this->user->jobDetails($id);
    $getEmployeeDetails = $this->user->getEmployeeDetails($id);
    return view('web.job-details',['jobDetails'=>$getJobDetails,'employeeDetails'=>$getEmployeeDetails]);

  }
/************************/
/*  forgot password */
/*************************/
  public function forgetPassword()
  {
    return view('web.forgot-password');
  }

/************************/
/*  forgetPass */
/*************************/
  public function forgetPass()
  {
   $email = request('email');
   return $this->user->forgetPass($email);

  }
/************************/
/*  resetPasswordForm */
/*************************/
  public function resetPasswordForm($content){

  $data = explode('-',$content);
  $user_id    =  $data[2];
  $token      =  $data[3];

  return view('forgetpassword',['user_id'=>$user_id , 'token'=> $token]);

  }

/************************/
/*  changeForgotPassword */
/*************************/
    public  function changeForgotPassword(Request $req){
      
      $user_id                  = request('user_id');
      $password_token           = request('password_token');

      $password                 = request('password');
      $password  =               Hash::make($password);
      

       
   

      $getPassToken             =     DB::table('users')->where('id',$user_id)->first();
       if($password_token       !=    $getPassToken->forget_token)
       {
         Session::flash('message','Change Password Process is already done');
          return redirect('resetPasswordForm/0sxa-jYasxL-1-RlsaxsStLsejSA');

       }else
       {
        $changePassword = DB::table('users')->where([
              ['id','=',$user_id]
           ])->update(array(
              'password' => $password,'forget_token'=>""
            ));

  

           /*$jsonArray = array('status'=>200,'message'=>'Password has been changed');
          echo json_encode($jsonArray);
          exit;*/
          Session::flash('message','Password has been changed, Please login to confirm');
          return redirect('resetPasswordForm/0sxa-jYasxL-1-RlsaxsStLsejSA');

        }

    }


    public function addJobs()
    {
      return view('admin.add-job');
    }


    public function notifications()
    {
        if (Auth::guest()){
        return redirect('user-login');
        }
        $user_id = Auth::user()->id;

       $notifications = $this->user->getWebNotifications($user_id);
        foreach ($notifications as $key => $value) {
              $notifications[$key]->timeago=$this->timeago($value->created_at);
          }
       //print_r($notifications);die;

       return view('web.notifications',['notifications'=>$notifications]);
    }

    public function index()
    {
     $getSliderImage = $this->user->getSliderContent();
     $getAboutContent = $this->user->getAboutContent();
     return view('web.index',['sliders'=>$getSliderImage,'about'=>$getAboutContent]);

    }



    public function webLogout(Request $request) {
      /*echo 'hi';
      exit;*/
    Auth::logout();
    return redirect('user-login');
    }



  /*********************/
/* Time Ago */
/********************/
   function timeago($time_ago){

    $time_ago     = strtotime($time_ago);
    $cur_time     = strtotime(date('Y-m-d H:i:s'));
    $time_elapsed = $cur_time - $time_ago;
    $seconds      = $time_elapsed ;
    $minutes      = round($time_elapsed / 60 );
    $hours        = round($time_elapsed / 3600);
    $days         = round($time_elapsed / 86400 );
    $weeks        = round($time_elapsed / 604800);
    $months       = round($time_elapsed / 2592000);
    $years        = round($time_elapsed / 31536000);
        
    // Seconds
    if($seconds <= 60){
      return "just now";
    }
    //Minutes
    else if($minutes <=60){
      if($minutes==1){
        return "one min ago";
      }else{
        return "$minutes min ago";
      }
    }
    //Hours
    else if($hours <=24){
      if($hours==1){
        return "an hour ago";
      }else{
        return "$hours hours ago";
      }
    }
      //Days
    else if($days <= 7){
        if($days==1){
        return "yesterday";
        }else{
        return "$days days ago";
        }
    }
        //Weeks
      else if($weeks <= 4.3){
        if($weeks==1){
        return "1 week ago";
        }else{
        return "$weeks weeks ago";
        }
      }
      //Months
    else if($months <=12){
        if($months==1){
        return "1 month ago";
        }else{
        return "$months months ago";
        }
    }
      //Years
      else{
        if($years==1){
        return "1 year ago";
        }else{
        return "$years years ago";
        }
      }
    }  
   
    


/***********/
     }
/***********/

