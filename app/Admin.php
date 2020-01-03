<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Redirect;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{



/********************************************************/
/*********************Admin Panel***********************************/
/********************************************************/

/*Dashboard*/
  public function dashboard()
  {

    $employee = DB::table('users')->where('user_type','N'
    )->count();
    $online['employee'] = $employee;

    $client = DB::table('users')->where('user_type','W'
    )->count();
    $online['client'] = $client;

    $flyers = DB::table('submit_flyers')->get();
    $totalCount = 0;
    foreach($flyers as $flyer)
    {
    $totalCount +=$flyer->flyer_count;
    }
    $online['flyer_distributed'] = $totalCount;

    return $online;


  }


/*Edit admin profile using ajax*/
public function editAdminProfile($user_id,$data)
{
  $update = DB::table('users')->where('id',$user_id)->update($data);
  return json_encode($data);
 
 
}


/*change admin password*/
public function changeAdminPassword($user_id,$oldPassword,$confirmPassword)
{
    $userPassword = User::find($user_id)->password;
    if (Hash::check($oldPassword, $userPassword)) {
    $confirmPassword = Hash::make($confirmPassword);
    $updateUserPassword = DB::table('users')->where('id',$user_id)->update(array('password'=>$confirmPassword));
    return Redirect::back()->with('message','Password Changed Successfully');

    }
    else
    { 
    return Redirect::back()->with('message','Password does not matched');              
    }

}





/*get employee list*/
public function users($type)
{

 return $getData = DB::table('users')->where('user_type','=',$type)->orderby('id','DESC')->get(); 

}


/*get client list*/
public function clients($type)
{

 return $getData = DB::table('users')->where('user_type','=',$type)->get(); 

}


/*Door hanger page upper section   U=upper section and L=lower section*/
public function aboutDoorHanger()
{
  return $getData = DB::table('door_hangers')->select('id','image','description','is_active')->get();

}



public function postHanger($id,$data)
{
  
       $image = $data['image'];
       $description = $data['description'];

 
  
  $update = DB::table('door_hangers')->where('id',$id)->update(array('image'=>$image,'description'=>$description));
   return redirect('aboutDoorHanger');
}

public function addBanner($data)
{
 $insert = DB::table('door_hangers')->insert($data);
  return redirect('aboutDoorHanger');
 
}


public function activeBanner($id)
{
  $updateActiveBanner = DB::table('door_hangers')->where('is_active','ON')->update(array('is_active'=>'OFF'));
  $updateDectiveBanner = DB::table('door_hangers')->where('id',$id)->update(array('is_active'=>'ON'));

}

/*delete banner from admin panel*/
public function deleteBanner($id)
{
 $data = new DoorHanger;
 $getStatus = $data::find($id)->is_active;
 if($getStatus=='ON')
 {
 	echo 'false';
 }
 else
 {
 	DB::table('door_hangers')->where('id',$id)->delete();
 	echo  'Successfully Deleted';
 }	

}




public function activeContent($id)
{
  $updateActiveBanner = DB::table('home_about')->where('is_active','ON')->update(array('is_active'=>'OFF'));
  $updateDectiveBanner = DB::table('home_about')->where('id',$id)->update(array('is_active'=>'ON'));

}

/*delete banner from admin panel*/
public function deleteContent($id)
{

 $getStatus = DB::table('home_about')->where('id',$id)->first();
 if($getStatus->is_active=='ON')
 {
  echo 'false';
 }
 else
 {
  DB::table('home_about')->where('id',$id)->delete();
  echo  'Successfully Deleted';
 }  

}








public function reports()
{
  $getData = DB::table('reports as r')->join('users as u','r.reporter_id','=','u.id')->join('users as u1','reportable_id','=','u1.id')->select('u.firstname as reporter_name','u1.firstname as reportable_name','r.description','u1.id as reportable_id')->get();
 return $getData;
}

/*add jobs*/
    public function addJob($data,$latLong)
    {

    $addJob = DB::table('jobs')->insertGetId($data);
    $latlongArray = explode('),(',$latLong);
    $latlongstring = implode($latlongArray,', ');
    $array = explode(', ',$latlongstring);
    $count = count($array);

    for($i=0; $i<$count;$i+=2)
    {
    $addVertices = DB::table('job_locations')->insert(array('job_id'=>$addJob,'latitude'=>$array[$i],'longitude'=>$array[$i+1]));

    } 
    return redirect("jobDetail/$addJob");
     
    }

/*get all jobs*/
public function joblist()
{
  $job = new Job;
  return $getJoblist = $job::orderBy('id','DESC')->get();
}

/*get job location*/
public function jobLocation($id)
{
 $jobLocation = DB::table('job_locations')->where('job_id',$id)->select('latitude','longitude')->get();
 return $jobLocation;
}

/*update job*/
public function updateJob($job_id,$data,$vertices)
{
  /* echo $job_id;
   exit;*/
/* print '<pre>';
 print_r($data);
 exit;*/
  $updateJob = DB::table('jobs')->where('id',$job_id)->update($data);
   if(!empty($vertices)) 
   {
      $deleteOldLocation = DB::table('job_locations')->where('job_id',$job_id)->delete();
       
       
       
       $vertices = rtrim($vertices,",");
      $array = explode(',',$vertices);
/*      print '<pre>';
      print_r($array);
      exit;*/
       $count = count($array);

      for($i=0; $i<$count;$i+=2)
      {
      $addVertices = DB::table('job_locations')->insert(array('job_id'=>$job_id,'latitude'=>$array[$i],'longitude'=>$array[$i+1]));
      } 


   }
   return redirect("jobDetail/$job_id");
   

}



public function employeeList($job_id)
{
 
 $getEmployeeList = DB::table('users as u')->where('u.user_type','=','N')
 ->select('u.id','u.firstname','u.user_type',DB::raw("CASE WHEN(SELECT count(*) from job_requests as jr where jr.job_id=$job_id and jr.user_id=u.id)>0 then 'true' else 'false' end as alreadyRequest"))->having('alreadyRequest','=','false')
->get();

return $getEmployeeList;
 print '<pre>';
 print_r($getEmployeeList);
 exit;

}



public function companyList($job_id)
{
 $companyList = DB::table('users as u')->where('u.user_type','=','W')->select('u.id','u.companyname','u.user_type',DB::raw("CASE WHEN(SELECT count(*) from job_clients as jc where jc.job_id=$job_id and jc.user_id=u.id)>0 then 'true' else 'false' end as alreadyAdded"))->having('alreadyAdded','=','false')->get();
return $companyList;
/*  print '<pre>';
 print_r($companyList);
 exit;*/

}




public function addEmployee($job_id,$employeeList)
{
  foreach($employeeList as $list)
  {
    $addEmployee = DB::table('job_requests')->insert(array('job_id'=>$job_id,'user_id'=>$list));
   
   
       $this->sendNotification($list,$job_id);
    

 }
  return redirect("jobDetail/$job_id");


}



public function checkNotification($user_id)
{
  $get = DB::table('users')->select('notification_status')->where('id',$user_id)->first();
  return $get->notification_status;
}



public function sendNotification($user_id,$job_id)
{ 
  $message = 'You have New job Request';
  $addNotification = DB::table('notifications')->insert(array(
                              'job_id'     => $job_id,
                              'user_id'    => $user_id,
                              'message'    => $message,
                              'created_at' => date('Y-m-d H:i:s'),
                              'updated_at' => date('Y-m-d H:i:s')));
  
   $label = 'New Job Request';
   $url = 'https://fcm.googleapis.com/fcm/send';
   $user = new User;
  $reg = $user::find($user_id)->device_id;



 $checkNotification = $this->checkNotification($user_id);
  if($checkNotification!=0)
    {
          if(!empty($reg)){
              $headers = array(
                'Content-Type:application/json',
                'Authorization:key=AIzaSyCDgJRgbqWFEvh1onfdArIZj8Q0BoqxMU8'
            );

           $device_type = $user::find($user_id)->device_type;
           if($device_type=='A')
           {
                     
                  $row = array(
                  'registration_ids' => array($reg),
                  'data' => array(
                  'label'=>$label,
                  'message' => $message,
                  'user_id'=>$user_id,
                  'job_id'=>$job_id
                  )
                  );
             }
             else if($device_type=='I')
             {
                  
                $row = array(
                'registration_ids' => array($reg),
                'notification'=>array(
                'body'=>$message,
                'sound'=>'default',
                "mutable-content"=> 1
                
                ),
                'data' => array(
                'label'=>$label,
                  'message' => $message,
                  'user_id'=>$user_id,
                  'job_id'=>$job_id
                )
                );


             }   


         /*    print '<pre>';
            print_r($row);
            exit;   */           
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($row));     
            $response = curl_exec($ch);

            curl_close($ch);
   }        
         }
/* print '<pre>';
            print_r($response);
            exit;
*/
}

/*****************************/
/* Add Company */
/*****************************/

public function addCompany($job_id,$companyId)
{
      $data = array('job_id'       => $job_id,
                      'user_id'     => $companyId,
                      'created_at'  => date('Y-m-d H:i:s'),
                      'updated_at'  => date('Y-m-d H:i:s')
                   );
      //print_r($data);die;
      $addCompany = DB::table('job_clients')->insert($data);
       return redirect("jobDetail/$job_id");
}


/*****************************/
/*  */
/*****************************/

    public function getStaticPages($title){

    $getresult = DB::table('static_pages')->where('title','=',$title)->get();
    return $getresult;
    }


    public function UpdateStaticPages($title,$data){

    $UpdatestaticPages = DB::table('static_pages')
                ->where('title','=',$title)
                ->update($data);
    return $UpdatestaticPages;
    }


    public function existCompanyCount($job_id)
    {
      $get = DB::table('job_clients')->where('job_id',$job_id)->get();
      $count = count($get);
      if($get->isEmpty())
      {
        return 0;
      }
      else
      {
      return $count;  
      }
      
    }


    public function addSlider($data)
    {
    $insert = DB::table('home_sliders')->insert($data);
    return redirect('sliderContent');
    }


    public function updateSlider($id,$data)
    {
      $insert = DB::table('home_sliders')->where('id',$id)->update($data);
    return redirect('sliderContent');
    }

    public function deleteSlider($id)
    {
      $getCount = DB::table('home_sliders')->get();
      $count = count($getCount);
      if($count==1)
      {
        echo 'false';
      }
      else
      {
         $delete = DB::table('home_sliders')->where('id',$id)->delete();

      echo  'true';  
      }


    
    }


public function postAboutHome($data)
{
$insert = DB::table('home_about')->insert($data);
return redirect('aboutContent');

}



public function getAboutHome()
{
  return $getData = DB::table('home_about')->get();
}


public function updateAboutHome($id,$data)
{
 $update = DB::table('home_about')->where('id',$id)->update($data);
return redirect('aboutContent');
}


public function deleteAboutHome($id)
{


 $getStatus = $data::find($id)->is_active;
 if($getStatus=='ON')
 {
  echo 'false';
 }
 else
 {
  DB::table('door_hangers')->where('id',$id)->delete();
  echo  'Successfully Deleted';
 }  

}


public function submitFlyerDate($job_id)
{
 return $getData = DB::table('submit_flyers')->where('job_id',$job_id)->get();
}



public function updateEmployeeData($user_id,$data)
{
  $updateData = DB::table('users')->where('id',$user_id)->update($data);
  return redirect('userProfile/'.$user_id);

}



public function updateClientData($user_id,$data)
{
  $updateData = DB::table('users')->where('id',$user_id)->update($data);
  return redirect('userProfile/'.$user_id);

}

/*******************************/
/* */
/******************************/
public function clientsflyers($type)
{

 $getData = DB::table('users')->where('user_type',$type)->get();

  return $getData;                

}
/*******************************/
/* clients flyers detail */
/******************************/
public function clientsflyersdetail($id)
{
    $getData = DB::table('job_clients as js')
            ->join('jobs as j','j.id','=','js.job_id')
            ->join('job_requests as jr','j.id','=','jr.job_id')
            ->whereIn('jr.status',['S','C','I'])
            ->where('js.user_id',$id)->select('js.*','j.job_name','j.flyers','jr.status')->get();
       //print_r($getData);die;
    foreach ($getData as $key => $value) {
      
      if($value){
         
         $recivedflyers=DB::table('customers')->where('job_id',$value->job_id)->where('user_id',$id)->count();
      /*   $job_requests=DB::table('job_requests')->where('job_id',$value->job_id)->select('status')->first();
         if($job_requests){
          $myjobreq=$job_requests->status;
         }else{
          $myjobreq='';
         }*/
         $getData[$key]->recivedflyers  = $recivedflyers;
        // $getData[$key]->job_requests   = $myjobreq;
      
      }else{
           $getData[$key]->recivedflyers='';
           //$getData[$key]->job_requests='';
      
      }
     
     }
    return $getData;                

}
/*******************************/
/* clients flyers jobs details*/
/******************************/
public function myjobsdetails($id)
{
    $getData = DB::table('job_clients as js')
            ->join('jobs as j','j.id','=','js.job_id')
            ->where('js.user_id',$id)->select('js.*','j.job_name','j.flyers')->get();
       
    foreach ($getData as $key => $value) {
      if($value){
         $recivedflyers=DB::table('customers')->where('job_id',$value->job_id)->where('user_id',$id)->count();
         $getData[$key]->recivedflyers=$recivedflyers;
      }else{
           $getData[$key]->recivedflyers='';
      }
     }
    return $getData;                

}

/*****/
   }
/*****/