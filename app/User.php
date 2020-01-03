<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Redirect;
use Job;
use Notification;
use Mail;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];


  /*update user data during signup and login process*/
    public function updateUserData($user_id,$device_id,$device_type,$rememberToken,$latitude,$longitude)
    {
        
        $updateUserData = DB::table('users')->where([
            ['id','=',$user_id],
            ])->update(array(
            'remember_token' => $rememberToken,
            'device_id' => $device_id,
            'device_type' => $device_type,
            'latitude'=>$latitude,
            'longitude'=>$longitude

            ));



    }

   /*create profile*/
        public function createProfile($user_id,$data)
        {
        $createProfile = DB::table('users')->where('id', $user_id)->update($data);
        if($createProfile)
        {
        $getUserData = User::find($user_id);
        return response()->json(['message' => 'Profile Created Successfully','user_info'=>$getUserData]); 
        }


        }

     /*change password*/
        public function changePassword($user_id,$oldPassword,$confirmPassword)
        {
        $userPassword = User::find($user_id)->password;
        if (Hash::check($oldPassword, $userPassword)) {

          if(Hash::check($confirmPassword,$userPassword))
          {
             return response()->json(['message' => 'You have entered the same password as your current password'],409);        
          }

        $confirmPassword = Hash::make($confirmPassword);
         


        $updateUserPassword = DB::table('users')->where('id',$user_id)->update(array('password'=>$confirmPassword));
        return response()->json(['message' => 'Password Changed Successfully']); 
        }
        else
        {
        return response()->json(['message' => 'Password not matched'],409);                  
        }

        }




    
/************************/
/* My jobs */
/************************/


        public function getJobs($user_id,$type,$page)
        {
        $per_page = 10;
       if($page==0)
        {
        $offset = 0;
        }
        else
        {
        $offset = $page*$per_page;
        }


        if($type=='new_job')
        {
          $job_type='P';
        }
      
        else if($type=='completed_job')
        {
         $job_type='C';
        }




        if($type=='new_job' or $type=='completed_job')
        {
          $jobRequests = DB::table('job_requests as jr')
                   ->join('jobs as j','j.id','=','jr.job_id')
                   ->join('users as u','u.id','=','jr.user_id')
                   ->where('u.id','=',$user_id)
                   ->where('jr.status','=',$job_type)
                   ->select('jr.id','u.id as user_id','u.firstname','j.id as job_id','jr.status','j.flyers','j.created_at','j.image','j.job_number')
                   ->offset($offset)->limit($per_page)
                   ->orderby('jr.id','DESC')
                    ->get(); 

         $totalCount =  DB::table('job_requests as jr')
                   ->join('jobs as j','j.id','=','jr.job_id')
                   ->join('users as u','u.id','=','jr.user_id')
                   ->where('u.id','=',$user_id)
                   ->where('jr.status','=',$job_type)
                   ->select('jr.id','u.id as user_id','u.firstname','j.id as job_id','jr.status','j.flyers','j.created_at','j.image','j.job_number')
                    ->get(); 
                    $count = count($totalCount);


        }
        else
        {
         $jobRequests = DB::table('job_requests as jr')
                   ->join('jobs as j','j.id','=','jr.job_id')
                   ->join('users as u','u.id','=','jr.user_id')
                   ->where('u.id','=',$user_id)
                    ->where(
                      function ($query)
                      {
                      $query->where('jr.status', '=', 'I')->orWhere('jr.status', '=', 'S')->orWhere('jr.status', '=', 'A');
                      })
                   ->select('jr.id','u.id as user_id','u.firstname','j.id as job_id','jr.status','j.flyers','j.created_at','j.image','j.job_number')
                  ->offset($offset)->limit($per_page)
                   ->orderby('jr.id','DESC')
                   ->get(); 


                $totalCount = DB::table('job_requests as jr')
                   ->join('jobs as j','j.id','=','jr.job_id')
                   ->join('users as u','u.id','=','jr.user_id')
                   ->where('u.id','=',$user_id)
                    ->where(
                      function ($query)
                      {
                      $query->where('jr.status', '=', 'I')->orWhere('jr.status', '=', 'S');
                      })
                   ->select('jr.id','u.id as user_id','u.firstname','j.id as job_id','jr.status','j.flyers','j.created_at','j.image','j.job_number')
                  ->offset($offset)->limit($per_page)
                   ->get(); 
               /*    
                 $updateLatLong = DB::table('users')->where('id',$user_id)->update(array('latitude'=>$lat,'longitude'=>$long));  
            */     $count = count($totalCount);        




        }
       
               $jobArray = array();    
        if($jobRequests->isEmpty())
        {
          return response()->json(['data'=>array(),'message' => 'No Records found'],200);    
        }
        else
        {
          foreach($jobRequests as $jobRequest)
          {
            $jobs['id'] = $jobRequest->id;
            $jobs['user_id'] = $jobRequest->user_id;
            $jobs['firstname'] = $jobRequest->firstname;
            $jobs['job_id'] = (int)$jobRequest->job_id;
             $jobs['job_number'] = $jobRequest->job_number;
            $jobs['status'] = $jobRequest->status;
            $jobs['flyers'] = (int)$jobRequest->flyers;
            $jobs['created_at'] = $jobRequest->created_at;
            $jobs['images'] = $jobRequest->image; /*$this->getJobImages($jobRequest->job_id);*/
            $jobs['locations'] = $this->jobLocations($jobRequest->job_id);
            $jobs['notification_count'] = $this->notificationCount($jobRequest->user_id);
            $jobArray[] = $jobs;

          }
        }
        
        return response()->json(['data' => $jobArray,'job_count'=>$count]);             



        }


 

      public function getJobDetail($user_id,$job_id)
      {
       /* echo $user_id;
        exit;
*/
          $jobRequest = DB::table('job_requests as jr')
                   ->join('jobs as j','j.id','=','jr.job_id')
                   ->join('users as u','u.id','=','jr.user_id')
                   ->where('jr.user_id',$user_id)
                   ->where('j.id','=',$job_id)
                   ->select('jr.id','u.id as user_id','u.firstname','j.id as job_id','jr.status','j.flyers','j.created_at','j.image','j.job_number')->first(); 

     
            $jobs['id'] = $jobRequest->id;
            $jobs['user_id'] = $jobRequest->user_id;
            $jobs['firstname'] = $jobRequest->firstname;
            $jobs['job_id'] = (int)$job_id;
             $jobs['job_number'] = $jobRequest->job_number;
            $jobs['status'] = $jobRequest->status;
            $jobs['flyers'] = (int)$jobRequest->flyers;
            $jobs['created_at'] = $jobRequest->created_at;
            $jobs['images'] = $jobRequest->image; /*$this->getJobImages($jobRequest->job_id);*/
            $jobs['locations'] = $this->jobLocations($job_id);
          

         
        
        
        return response()->json(['data' => $jobs]);        




        
      }





  public function notificationCount($user_id)
  {

   $getCount = DB::table('notifications')->where('user_id',$user_id)->where('status','U')->count();
   return $getCount; 

  }




/*get job location*/
    public function jobLocations($job_id)
    {
      $getLocations = DB::table('job_locations')->select('id as location_id','latitude','longitude')->where('job_id',$job_id)->get();
      if($getLocations->isEmpty())
      {
        return array();
      }
      else
      {
        return $getLocations;
      }

    }



      /*get job images*/
      public function getJobImages($job_id)
      {
        $profile_path = '/public/uploads/';
      $getImages = DB::table('job_images')->select('id as image_id','is_active',DB::raw("CASE WHEN image is null or image='' THEN CONCAT('', image) ELSE image end as photo"))->where('job_id',$job_id)->get();
      if($getImages->isEmpty())
      {
        return array();
      }
      else
      {
        return $getImages;
      }
      }


/*view user profile*/
  public function viewProfile($user_id)
  {

  $getUserInfo = User::find($user_id);
  return $getUserInfo;

  }

/*******************************/
    /*accept reject jobs*/
/*****************************/
      public function acceptRejectJobs($user_id,$request_id,$status){
     $getRequestId = DB::table('job_requests as jr')->where('id',$request_id)->first();
      if(empty($getRequestId))
      {
        return response()->json(['message' => 'This Job is deleted by admin'],409); 
      }
         if($status == 'A')
         {
          $message = 'Job Accepted Successfully';
         }
         else if($status == 'S')
         {
          $message = 'Job Paused Successfully';
         }
         else if($status == 'C')
         {
           $message = 'Job Completed Successfully';
           //$this->sendNotification($user_id,$request_id,$status,'C');
         }
         else if($status == 'I')
         {
           $message = 'Job is in-process';
           //$this->sendNotification($user_id,$request_id,$status);
         }
    if($status=='R'){
        $reject = DB::table('job_requests')->where('id',$request_id)->where('user_id',$user_id)->delete(); /*default value of status='P'*/
          return response()->json(['message' => 'successfully rejected']); 
        }
        else
        {

  $reject = DB::table('job_requests')->where('id',$request_id)->where('user_id',$user_id)->update(array('status'=>$status)); 
  $data = $this->getJobDetailForApp($request_id);
 /* print '<pre>';
  print_r($data);
  exit;*/

   /************Email Notification ON/OFF**************/
   //echo $request_id;die;
   $job_requests =DB::table('job_requests')->where('id',$request_id)->whereIn('status',['S','C','I'])->select('job_id','id')->first();
  //print_r($job_requests);die;
   if($job_requests){
        $getClient = DB::table('job_clients')->where('job_id',$job_requests->job_id)->select('user_id')->first();
       //print_r($getClient->user_id);die;
        $getClientEmail = DB::table('users')->where('id',$getClient->user_id)->first();
     // print_r($getClientEmail->email_notification_status);die;
   if($getClientEmail->email_notification_status=='1'){
    
      $sendEmail = $this->sendEmail($job_requests->job_id,$status,$user_id);
   }
  }
   /***************************/
   return response()->json(['message' => $message,'data'=>$data]); 
        }


      }

/***************************/
/* Send eamil*/
/***************************/
 public function sendEmail($job_id,$status,$employeeId){


    $getClient = DB::table('job_clients')->where('job_id',$job_id)->select('user_id')->first();
    $job_number = DB::table('jobs')->where('id',$job_id)->select('job_number')->first();
    $getClient->user_id;
    $job_number=$job_number->job_number;
        
    if(!empty($getClient)){
             $getEmployeeName = DB::table('users')->where('id',$employeeId)->select('firstname')->first();
             $name = $getEmployeeName->firstname;

          if($status == 'A')
         {
          $msg = "$name has accepted job ".$job_number;
         }
         elseif($status == 'S')
         {
          $msg = "$name has Paused Job ".$job_number;
         }
         elseif($status == 'C')
         {
           $msg = "$name has Completed job ".$job_number;
           //$this->sendNotification($user_id,$request_id,$status,'C');
         }
         elseif($status == 'I')
         {
           $msg = "$name has stared job ".$job_number;
           //$this->sendNotification($user_id,$request_id,$status);
         }
          elseif($status == 'R')
         {
           $msg = "$name has rejected job ".$job_number;
           //$this->sendNotification($user_id,$request_id,$status);
         }

          $getClientEmail = DB::table('users')->where('id',$getClient->user_id)->select('email')->first();
          $email = $getClientEmail->email;

          $insertNotification = DB::table('notifications')->insert(array('user_id'=>$getClient->user_id,'job_id'=>$job_id,'message'=>$msg));
        //echo $email;die;
       Mail::send(array(), array(), function ($message) use ($msg,$email) 
      {
          $from  = 'info@active-distribution.com';
          $message->to($email ,'Job Alert')
          ->subject('Job Alert')
          ->setBody($msg, 'text/html');

      });
           /* Mail::send(array(), array(), function ($message) use ($msg,$email) 
            {
            $from  = 'info@smallworld.com';
            $message->to($email ,'Job Alert')
            ->subject('Job Alert')
            ->setBody($msg, 'text/html');
            });
           */
        return true;  
      }
       return false;
    }

/**************************************/
/* Contact Info */
/**************************************/

    public function contactInfo($data)
        {

        
         $companyname =  $data['companyname']; 
         $firstname = $data['firstname'];
         $lastname = $data['lastname'];
         $phone = $data['phone'];
         $message = $data['message'];
         $email = 'phpteam368@gmail.com';


          $postInfo = DB::table('contact_infos')->insert($data);
          if(!$postInfo)
          {
            return response()->json(['message' => 'Somthing went wrong'],401); 
          }
          else
          {
            $html = "Company Name: ".$companyname.'<br>';
            $html .= "First Name: ".$firstname.'<br>';
            $html .= "Last Name: ".$lastname.'<br>';
            $html .= "Phone: ".$phone.'<br>';
            $html .= "Message: ".$message;
             Mail::send(array(), array(), function ($message) use ($html,$email) 
            {
            $from  = 'info@smallworld.com';
            $message->to($email ,'Job Alert')
            ->subject('Job Alert')
            ->setBody($html, 'text/html');
            });

            return response()->json(['message' => 'Information has been sent successfully']); 
          }
            
      
        }






      public function getJobDetailForApp($request_id)
      {
        $jobRequest = DB::table('job_requests as jr')
                   ->join('jobs as j','j.id','=','jr.job_id')
                   ->join('users as u','u.id','=','jr.user_id')
                   ->where('jr.id','=',$request_id)
                   ->select('jr.id','u.id as user_id','u.firstname','j.id as job_id','jr.status','j.flyers','j.created_at','j.image','j.job_number')
                    ->first();


            $jobs['id'] = $jobRequest->id;
            $jobs['user_id'] = $jobRequest->user_id;
            $jobs['firstname'] = $jobRequest->firstname;
            $jobs['job_id'] = $jobRequest->job_id;
            $jobs['status'] = $jobRequest->status;
            $jobs['flyers'] = $jobRequest->flyers;
            $jobs['job_number'] = $jobRequest->job_number;
            $jobs['created_at'] = $jobRequest->created_at;
             $jobs['notification_count'] = $this->notificationCount($jobRequest->user_id);

            $jobs['images'] = $jobRequest->image; /*$this->getJobImages($jobRequest->job_id);*/
            $jobs['locations'] = $this->jobLocations($jobRequest->job_id);
            return $jobArray[] = $jobs;




      }







      public function sendNotification($user_id,$request_id,$status,$type)
      {

        if($type=='C')
        {
         $message = 'Job has been completed successfully';
        }

        /*write notification code here*/
        /*write notification code here*/


        $addNotifications = DB::table('notifications')->insert(array('user_id'=>$user_id,'job_id'=>$request_id,'message'=>$message));
      

      }


/************************/
/* Get Notification list */
/************************/
    public function getNotifications($user_id,$page){
        $per_page = 10;
         if($page==0){
            $offset = 0;
        }else{
            $offset = $page*$per_page;
        }

        $readNotifications = DB::table('notifications')->where('user_id', $user_id)->update(array('status'=>'R'));
        $getData = DB::table('notifications')->where('user_id',$user_id)->offset($offset)->limit($per_page)->get();

        if(!$getData->isEmpty()){
             foreach ($getData as $key => $value) {
              $getData[$key]->timeago=$this->timeago($value->updated_at);
          }
          $getCount = DB::table('notifications')->where('user_id',$user_id)->where('status','U')->count();
          return response()->json(['data' => $getData,'count'=>$getCount]);
        
        }else{
          return response()->json(['data'=>array(),'message' => 'No Records Found'],200);
        }
      }


  


      public function changeNotification($user_id,$status)
      {
        if($status==1)
        {
          $message = 'Notification enabled Successfully';
        }
        else
        {
          $message = 'Notification disabled Successfully';
        }

        $changeNotification = DB::table('users')->where('id',$user_id)->update(array('notification_status'=>$status));
        if($changeNotification)
        {
      return response()->json(['message' => $message]);  

        }

      }


     /*logout*/
      public function logout($user_id)
      {
    
        $logout = DB::table('users')->where('id',$user_id)->update(array('device_id'=>'','device_type'=>'','remember_token'=>'sfdsgdsgds'));
         return response()->json(['message' => 'successfully logout']);    

      }



   


/*edit profile on website*/
    public function webeditprofile($user_id,$data)
    {
    
    $editprofile = DB::table('users')->where('id',$user_id)->update($data);
    return redirect('myprofile');

    }


    
/*edit profile on website*/
    public function webuserRegister($user_id,$data)
    {
    
    $editprofile = DB::table('users')->where('id',$user_id)->update($data);
    return redirect('myprofile');

    }


    public function getHanngerData()
    {
      return $getHanngerData  = DB::table('door_hangers')->where('is_active','ON')->first();
   
    }

/*add customer from website*/
    public function addCustomer($data)
    {
      $add = DB::table('customers')->insert($data);
      Session::flash('message','Customer Added Successfully');
      return redirect('flyer-conversion');
    }


/*get all complete jobs*/
    public function completeJobs($page,$per_page,$user_id)
    {


         if($page==0)
        {
        $offset = 0;
        }
        else
        {
        $offset = $page*$per_page;
        }

        return $getData = DB::table('jobs as j')->join('job_clients as jc','jc.job_id','=','j.id')
        ->where('jc.user_id',$user_id)
      ->select('j.id','j.job_name','j.flyers','j.image','j.created_at','j.job_number')->havingRaw("((select count(*) from job_requests where job_id=j.id and status='C' and status!='P') = (select count(*) from job_requests where job_id=j.id and status!='P' group by job_id)) and ((select count(*) from job_requests where job_id=j.id and status!='P' and status='C') != 0)")->offset($offset)->limit($per_page)->get();
   /*   $jobArray = array();

         if(!$getData->isEmpty())
         {
          
              foreach($getData as $job)
              {
              $getCompleteCount = $this->getCompleteJobCount($job->id);
              $getTotalCount = $this->getTotalCount($job->id);          
              if($getCompleteCount==$getTotalCount && $getCompleteCount!=0)
              {
                $array['id'] = $job->id; 
                $array['job_name'] = $job->job_name; 
                $array['flyers'] = $job->flyers; 
                $array['image'] = $job->image; 
                $array['created_at'] = $job->created_at; 
                $jobArray[] = $array;

              }
              }
           }
*/
             
      return $jobArray;


    }


/*get all complete job count for pagination*/
    public function completeJobCount($user_id)
    {

      $getData = DB::table('jobs as j')->join('job_clients as jc','jc.job_id','=','j.id')
        ->where('jc.user_id',$user_id)
      ->select('j.id','j.job_name','j.flyers','j.image','j.created_at')->havingRaw("((select count(*) from job_requests where job_id=j.id and status='C' and status!='P') = (select count(*) from job_requests where job_id=j.id and status!='P' group by job_id)) and ((select count(*) from job_requests where job_id=j.id and status!='P' and status='C') != 0)")->get();
        return count($getData);
    }


/*get inprocess or current job*/
    public function currentJobs($page,$per_page,$user_id)
    {

     /* echo $user_id;
      exit;
   */
      
        if($page==0)
        {
        $offset = 0;
        }
        else
        {
        $offset = $page*$per_page;
        }

        return $getData = DB::table('jobs as j')->join('job_clients as jc','jc.job_id','=','j.id')
        ->where('jc.user_id',$user_id)
      ->select('j.id','j.job_name','j.flyers','j.image','j.created_at','j.job_number')->havingRaw("((select count(*) from job_requests where job_id=j.id and status='C' and status!='P') != (select count(*) from job_requests where job_id=j.id and status!='P' group by job_id)) OR ((select count(*) from job_requests where job_id=j.id and status!='P') = 0)")->offset($offset)->limit($per_page)->get();
     /* $jobArray = array();*/
/*
      print '<pre>';
      print_r($getData);
      exit;*/

         /*if(!$getData->isEmpty())
         {
          
              foreach($getData as $job)
              {
              $getCompleteCount = $this->getCompleteJobCount($job->id);
              $getTotalCount = $this->getTotalCount($job->id);          
              if($getCompleteCount!=$getTotalCount || $getTotalCount==0)
              {
                $array['id'] = $job->id; 
                $array['job_name'] = $job->job_name; 
                $array['flyers'] = $job->flyers; 
                $array['image'] = $job->image; 
                $array['created_at'] = $job->created_at; 
                $jobArray[] = $array;

              }
              }
           }*/

             
      //return $jobArray;


    }



/*get current job count for pagnation*/
      public function currentJobCount($user_id)
      {
      
     $getData = DB::table('jobs as j')->join('job_clients as jc','jc.job_id','=','j.id')
        ->where('jc.user_id',$user_id)
      ->select('j.id','j.job_name','j.flyers','j.image','j.created_at')->havingRaw("((select count(*) from job_requests where job_id=j.id and status='C' and status!='P') != (select count(*) from job_requests where job_id=j.id and status!='P' group by job_id)) OR ((select count(*) from job_requests where job_id=j.id and status!='P') = 0)")->get();


      return count($getData);

      }





   public function getCompleteJobCount($job_id)
   {
     $count = DB::table('job_requests')->where('job_id',$job_id)->where('status','C')->get();
     return count($count);

   }

    public function getTotalCount($job_id)
   {
     $count = DB::table('job_requests')->where('job_id',$job_id)->where('status','!=','P')->get();
     return count($count);

   }
 





/*get full job detail*/
      public function jobDetails($id)
      {
        
        $getData = DB::table('jobs as j')->where('id',$id)->select('j.id','j.job_name','j.flyers','j.job_number','j.created_at',DB::raw("(select count(*) from job_requests as jr where jr.job_id=j.id and jr.status!='P') as job_employee"),DB::raw("(select SUM(flyer_count) from submit_flyers as sf  where sf.job_id=$id) as flyer_distributed"),DB::raw("(select count(*) from job_requests where job_id=j.id and status='C' and status!='P') as com_request"),DB::raw("(select count(*) from job_requests where job_id=j.id and status!='P' group by job_id) as job_request"))->first();
         /* print '<pre>';
      print_r($getData);
      exit;*/
          $data=DB::table('customers')->where('job_id',$id)->count();
          $getData->num_customers=$data; 
          
       return $getData;
      }


/*get all employees in single job*/
      public function getEmployeeDetails($id)
      {
        $getData = DB::table('job_requests as jr')
                 ->join('users as u','u.id','=','jr.user_id')
                 ->join('jobs as j','j.id','=','jr.job_id')
                 ->where('jr.job_id',$id)
                 ->where('jr.status','!=','P')
                 ->select('u.id','jr.job_id','u.firstname','jr.status','u.phone','u.latitude','u.longitude','u.image')->get();

        return $getData;
       /*print '<pre>';
      print_r($getData);
      exit;*/
      }

/***********************************/
/* Web Site ForgotPassword */
/***********************************/
  public function forgetPass($email){
       
    if($email!=''){
          $password_token = str_random(10);
          $fake_token_one = str_random(2);
          $fake_token_two = str_random(3);

          $update_user_data = DB::table('users')->where('email',$email)->where('user_type','W')
          ->update(array('forget_token' => $password_token));

          $useremail = DB::table('users')
          ->where('email', $email)->where('user_type','W')
          ->select('*')->first();
      if(!$useremail){
          Session::flash('message','Please Enter Valid Email');
          return redirect('forgetPassword');
    }else if($useremail->login_type == 'F' || $useremail->login_type == 'G'){
    
        Session::flash('message','Sorry This Account has been linked through Social Media');
        return redirect('forgetPassword');
    }else{
      $userid = $useremail->id;
      $base_url = url('/'); 
      $content ="<p>We have received your request for change password.</p>
      <p>Please <a href='".$base_url."/resetPasswordForm/$fake_token_one-$fake_token_two-$userid-$password_token'>
      Click here </a> to change your password.</p><br/><br/>Thanks<br/>Active Distribution";
    

      Mail::send(array(), array(), function ($message) use ($content,$email) {
          $from  = 'info@active-distribution.com';
          $message->to($email ,'Forgot Password')
          ->subject('Request for change password')
          ->setBody($content, 'text/html');
      });

          Session::flash('message','Please check your mail address to reset your password');
          return redirect('forgetPassword');
      }
    }else{
        Session::flash('message','Please Enter Email Address');
        return redirect('forgetPassword');
      }
   }

  /**********************/
  /* Web Notifications */
  /*********************/

      public function getWebNotifications($user_id)
      {
        /*echo $user_id;
        exit;*/
          $readNotifications = DB::table('notifications')->where('user_id', $user_id)->update(array('status'=>'R'));
       return  $getNotifications = DB::table('notifications')->where('user_id', $user_id)->orderby('id','DESC')->Paginate(10);

      }



      public function changeLocation($user_id,$lat,$long)
      {
         $updateLatLong = DB::table('users')->where('id',$user_id)->update(array('latitude'=>$lat,'longitude'=>$long)); 
          return response()->json(['message' => 'successfully Changed Location']);  
              
      }


      public function getSliderContent()
      {
        return $getData = DB::table('home_sliders')->get();
      }



      public function getAboutContent()
      {
        return $getData = DB::table('home_about')->where('is_active','ON')->first();

      }

/*********************/
/* Time Ago */
/********************/
   function timeago($time_ago){
//echo date('Y-m-d H:i:s');die;
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
    //echo $time_ago;die;
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
   




   


/********/
     }
/********/