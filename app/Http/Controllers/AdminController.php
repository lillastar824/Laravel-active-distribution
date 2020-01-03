<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Admin;
use App\Job;
use App\DoorHanger;
use DB;
use Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Redirect;
class AdminController extends Controller
{

  public function __construct()
  {
    $this->admin = new Admin;
    $this->user = new User;
    $this->mytime = date('Y-m-d H:i:s', time());
  }


  /*Admin Login*/
 public function adminLogin(Request $request)
  {
    $email = request('email');
    $password = request('password');
    
   if(Auth::attempt(['email'=>$email,'password'=>$password,'user_type'=>'A']))
   {
    return Redirect('/dashboard');
   }
   else
   {
    Session::flash('message','Invalid email/password');
    return Redirect('/4admin');
   }

 }




public function adminLogout(Request $request) {
  Auth::logout();
  return redirect('/4admin');
}




 public function dashboard(Request $request)
{
/*if(empty(session('adminId')))
    {
      return redirect('4admin');
    }*/
$onlineUsers =  $this->admin->dashboard();
return view('admin.dashboard',['users'=>$onlineUsers]);


}




public function adminProfile()
{

   if(Auth::guest())
 {
  return redirect('4admin');
 }

 $user_id = Auth::user()->id;
 $user = new User;
 $getData = $user::find($user_id);

 return view('admin/profile',['adminInfo'=>$getData]);




}



public function editAdminProfile(Request $request)
{
 if(Auth::guest())
 {
  return redirect('4admin');
 }
$user = new User;
$user_id = Auth::user()->id;

    if ($request->hasFile('profile_image'))
    {
    $file         =   $request->file('profile_image');
    $filename     =   $file->getClientOriginalName();
    $uniq_no      =   mt_rand();
    $unique_name  =   $uniq_no.$filename;
    $move        =   $file->move(public_path().'/uploads/', $unique_name);
    $data['image'] = '/public/uploads/'.$unique_name;

    }
    else
    {
      $unique_name = $user::find($user_id)->image;
      $data['image'] = $unique_name;
    }

     $data['firstname'] = request('name');
     $data['address'] = request('address');  
   
     return  $this->admin->editAdminProfile($user_id,$data);
}




public function changeAdminPassword()
{

   if(Auth::guest())
 {
  return redirect('4admin');
 }
   $user_id = Auth::user()->id;
   $oldPassword = request('oldPassword');
   $confirmPassword = request('confirmPassword');

  return $result = $this->admin->changeAdminPassword($user_id,$oldPassword,$confirmPassword);
  

}


public function users($type)
{
   if(Auth::guest())
 {
  return redirect('4admin');
 }
  $data =  $this->admin->users($type);
 return view('admin.users',['users'=>$data]);

}



public function clients($type)
{
   if(Auth::guest())
 {
  return redirect('4admin');
 }
  $data =  $this->admin->clients($type);
 return view('admin.client',['users'=>$data]);

}




public function userProfile($id)
{

  if(Auth::guest())
 {
  return redirect('4admin');
 }
  $user = new User;
  $getData = $user::find($id);
 return view('admin.userProfile',['userProfile'=>$getData]);
}




public function clientProfile($id)
{

  if(Auth::guest())
 {
  return redirect('4admin');
 }
  $user = new User;
  $getData = $user::find($id);
 return view('admin.clientProfile',['userProfile'=>$getData]);
}













public function suspendUser(Request $request)
{


   $userId = request('id');

 $is_suspend = request('is_suspend');
 if($is_suspend=="OFF")
 {
  $suspendStatus = "ON";
  $msg = "ON";
  $videoDisappearStatus = 'ON';
 }
 else
 {
 $suspendStatus = "OFF";
 $msg = "OFF";
 $videoDisappearStatus = 'OFF';
 }

 


  $suspendUser = DB::table('users')->where('id', $userId)->update(array(
        'is_suspended' => $suspendStatus,
        'remember_token'=>''
      ));
 
 if($suspendUser)
  {
    echo $msg;
  }
   else
   {
    echo 'something went wrong';
   }

 }


public function updateBanner($id)
{
  if(Auth::guest())
 {
  return redirect('4admin');
 }
  $data = new DoorHanger;
  $getData = $data::find($id);
return view('admin.doorHangerForm',['data'=>$getData]);
}


/*Door hanger page upper section  */
 public function aboutDoorHanger(Request $request)
 {
  if(Auth::guest())
 {
  return redirect('4admin');
 }
  $data = $this->admin->aboutDoorHanger();
  return view('admin.aboutDoorHanger',['contents'=>$data]);



 }


 public function postHanger(Request $request)
 {
  if(Auth::guest())
 {
  return redirect('4admin');
 }
  $data = new DoorHanger;
 
  $id  = request('id');
  if ($request->hasFile('banner'))
        {

        $file = $request->file('banner');
         $filename = $file->getClientOriginalName();
         $uniq_no = mt_rand();
         $unique_image = $uniq_no.'img'.$filename;
         $move = $file->move(public_path().'/web/images/', $unique_image);
         $data['image'] = "/public/web/images/".$unique_image;
        }
        else
        {
           
           $data['image'] =   $data::find($id)->image;
        }

        $data['description']= request('description');
        
        
          return $res = $this->admin->postHanger($id,$data);
        
         
         
    
 }


 public function addBannerForm()
 {
  return view('admin.addBannerForm');
 }


 public function addBanner(Request $request)
 {
   
   if(Auth::guest())
 {
  return redirect('4admin');
 }
   if ($request->hasFile('banner'))
        {

        $file = $request->file('banner');
         $filename = $file->getClientOriginalName();
         $uniq_no = mt_rand();
         $unique_image = $uniq_no.'img'.$filename;
         $move = $file->move(public_path().'/web/images/', $unique_image);
         $data['image'] = "/public/web/images/".$unique_image;
        }
         $data['description']= request('description');
          return $res = $this->admin->addBanner($data);
 }



 public function activeBanner(Request $request)
 {
  
  $id = request('id');
  $this->admin->activeBanner($id);



 }


 public function deleteBanner(Request $request)
 {
  if(Auth::guest())
 {
  return redirect('4admin');
 }
   $id = request('id'); 
  return $this->admin->deleteBanner($id);


 }




  public function activeContent(Request $request)
 {

  $id = request('id');
  $this->admin->activeContent($id);



 }


 public function deleteContent(Request $request)
 {
   $id = request('id'); 
  return $this->admin->deleteContent($id);


 }







  public function reports(Request $request)
  {
    $getData = $this->admin->reports();
    return view('admin.reports',['reports'=>$getData]);



  }


  public function addJob(Request $request)
  {
     if(Auth::guest())
 {
  return redirect('4admin');
 }
     $data['flyers'] = request('flyers');
     $data['job_name'] = request('job_name');
     $data['job_number'] = request('job_number');
     if ($request->hasFile('image'))
    {
    $file         =   $request->file('image');
    $filename     =   $file->getClientOriginalName();
    $uniq_no      =   mt_rand();
    $unique_name  =   $uniq_no.$filename;

    $move        =   $file->move(public_path().'/uploads/', $unique_name);
    $data['image'] = '/public/uploads/'.$unique_name;

    }
    $vertices = request('vertices');

    $latLong =  substr($vertices, 1, -1);



   return $addJob = $this->admin->addJob($data,$latLong);

  }




  public function joblist()
  {
    if(Auth::guest())
 {
  return redirect('4admin');
 }
    $joblist = $this->admin->joblist();
    return view('admin.joblist',['jobs'=>$joblist]);

  }


  public function jobDetail($id)
  {

    if(Auth::guest())
 {
  return redirect('4admin');
 }
    /* echo $id;
     exit;*/
$getJobDetails = $this->user->jobDetails($id);

/*print '<pre>';
print_r($getJobDetails);
exit;*/
$getEmployeeDetails = $this->user->getEmployeeDetails($id);/*in user model function is already there*/
/*print '<pre>';
print_r($getEmployeeDetails);
exit;*/
$joblocation = $this->admin->jobLocation($id);

$employeeList = $this->admin->employeeList($id);
/*print '<pre>';
print_r($employeeList);
exit;*/

$companyList = $this->admin->companyList($id); /*or we can call it client list, since name has been changed from client to company*/
/*print '<pre>';
print_r($companyList);
exit;
*/
$existCompanyCount = $this->admin->existCompanyCount($id);

$submitFlyerDate = $this->admin->submitFlyerDate($id);

/*print '<pre>';
print_r($submitFlyerDate);
exit;*/


return view('admin.job-detail',['jobDetails'=>$getJobDetails,'employeeDetails'=>$getEmployeeDetails,'locations'=>$joblocation,'job_id'=>$id,'employeeList'=>$employeeList,'companyList'=>$companyList,'existCompany'=>$existCompanyCount,'dates'=>$submitFlyerDate]); 


  }







  public function updateJob(Request $request)
  {

   if(Auth::guest())
 {
  return redirect('4admin');
 }

    $job_id = request('job_id');
    $data['flyers'] = request('flyers');
   
     $data['job_name'] = request('job_name');
   if ($request->hasFile('image'))
    {
    $file         =   $request->file('image');
    $filename     =   $file->getClientOriginalName();
    $uniq_no      =   mt_rand();
    $unique_name  =   $uniq_no.$filename;

    $move        =   $file->move(public_path().'/uploads/', $unique_name);
    $data['image'] = '/public/uploads/'.$unique_name;

    }
   $vertices = request('vertices');
   return $this->admin->updateJob($job_id,$data,$vertices);


  }


  public function addEmployee(Request $request)
  {
    if(Auth::guest())
 {
  return redirect('4admin');
 }
    $employeeList  = request('employeeList');
    $job_id = request('job_id');
   return $this->admin->addEmployee($job_id,$employeeList);

  }


  public function addCompany(Request $request)
  {
    if(Auth::guest())
 {
  return redirect('4admin');
 }
     $companyId  = request('companyId');
     $job_id = request('job_id');
     return $this->admin->addCompany($job_id,$companyId);
    
  }

  public function submitFlyers(Request $request)
  {

    if(Auth::guest())
 {
  return redirect('4admin');
 }
  $job = new Job;
  $job_id = request('job_id');

  $jobDetail = $job::find($job_id);

 /* print '<pre>';
  print_r($jobDetail);
  exit;*/

  $totalFlyerInJob = $jobDetail->flyers;

  
   $flyer_count = request('flyer');
   $date = request('date');

    $destributedFlyers = $this->getDestributedFlyers($job_id);

   $countFlyer =  $destributedFlyers + $flyer_count;

   if($countFlyer>$totalFlyerInJob)
   {
    echo 'false';
   }
   else
   {
 $addFlyers = DB::table('submit_flyers')->insert(array('date'=>$date,'job_id'=>$job_id,'flyer_count'=>$flyer_count));
 echo 'True';
   }


  

 

  }



  public function getDestributedFlyers($job_id)
  {
    if(Auth::guest())
 {
  return redirect('4admin');
 }

    $getTotalPrice = DB::table('submit_flyers')->select(DB::raw("(select SUM(flyer_count) from submit_flyers as sf  where sf.job_id=$job_id) as flyer_distributed"))->first();
    if(empty($getTotalPrice))
    {
      return 0;
    }
    else
    {
    return $getTotalPrice->flyer_distributed;
  
    }
    

  }

   public function staticPages($title){

          if(Auth::guest())
          {
          return redirect('4admin');
          }      
            $getPages['pages'] = $this->admin->getStaticPages($title);
            return view('admin.staticpages',$getPages);
      }


   public function UpdateStaticPages(Request $req,$title){
          if(Auth::guest())
          {
          return redirect('4admin');
          }   
          $data = array(
                  'description'  =>htmlentities($req->input('description')),
          );
          $result = $this->admin->UpdateStaticPages($title,$data);
            if($result){
              $response['message'] = 'Data Added Successfully';
              $response['error'] = false;
              return Redirect('/staticPages/'.$title.'')->with($response);
            } else {
              $response['message'] = 'Data Updated Successfully.';
              $response['error'] = false;
            }
            return Redirect('/staticPages/'.$title.'')->with($response);
      }


   public function getStaticPagesView($title){

            //echo 'hiiiiii' ;die;
            /*if(Auth::guest())
          {
          return redirect('4admin');
          }   */
          $getPageView['view'] = $this->admin->getStaticPages($title);
          return view('admin.staticpage_view',$getPageView);
      }

 public function homeSliderForm()
 {
   return view('admin.homeSliderForm');

 }  


 public function sliderContent()
 {
  if(Auth::guest())
 {
  return redirect('4admin');
 }
  $getSliderData = DB::table('home_sliders')->get();
  return view('admin.sliderContent',['contents'=>$getSliderData]);
 }



 public function addSlider(Request $request)
 {
    if(Auth::guest())
 {
  return redirect('4admin');
 }
  if ($request->hasFile('banner'))
        {

        $file = $request->file('banner');
         $filename = $file->getClientOriginalName();
         $uniq_no = mt_rand();
         $unique_image = $uniq_no.'img'.$filename;
         $move = $file->move(public_path().'/web/images/', $unique_image);
         $data['image'] = "/public/web/images/".$unique_image;
        }
        

        $data['content']= request('description');
        
        
          return $res = $this->admin->addSlider($data);
 }   


      public function updateSlider(Request $request)
      {
       $id = request('id');
      if ($request->hasFile('banner'))
      {

      $file = $request->file('banner');
      $filename = $file->getClientOriginalName();
      $uniq_no = mt_rand();
      $unique_image = $uniq_no.'img'.$filename;
      $move = $file->move(public_path().'/web/images/', $unique_image);
      $data['image'] = "/public/web/images/".$unique_image;
      }


      $data['content']= request('description');


      return $res = $this->admin->updateSlider($id,$data);
      } 



      public function updateSliderForm($id)
      {

           
        return view('admin.updateSliderForm',['id'=>$id]);
      }  



      public function deleteSlider(Request $request)
      {
         

         $id = request('id');
         $this->admin->deleteSlider($id);
      }


      public function aboutContent()
      {
        $getAboutContent = $this->admin->getAboutHome();
        return view('admin.aboutContent',['contents'=>$getAboutContent]);
      }
   
    public function aboutContentForm()
      {
        return view('admin.aboutContentForm');
      }

      public function postAboutHome(Request $request)
      {
     
        if(Auth::guest())
        {
        return redirect('4admin');
        }
     
      if ($request->hasFile('banner'))
      {

      $file = $request->file('banner');
      $filename = $file->getClientOriginalName();
      $uniq_no = mt_rand();
      $unique_image = $uniq_no.'img'.$filename;
      $move = $file->move(public_path().'/web/images/', $unique_image);
      $data['image'] = "/public/web/images/".$unique_image;
      }
     

      $data['description']= request('description');


      return $res = $this->admin->postAboutHome($data);




      }




      public function updateAboutHome(Request $request)
      {
     
      if(Auth::guest())
 {
  return redirect('4admin');
 }
      $id  = request('id');
      if ($request->hasFile('banner'))
      {

      $file = $request->file('banner');
      $filename = $file->getClientOriginalName();
      $uniq_no = mt_rand();
      $unique_image = $uniq_no.'img'.$filename;
      $move = $file->move(public_path().'/web/images/', $unique_image);
      $data['image'] = "/public/web/images/".$unique_image;
      }
     
      $data['description']= request('description');


      return $res = $this->admin->updateAboutHome($id,$data);




      }



      public function updateAboutForm($id)
      {
       return view('admin.updateAboutContentForm',['id'=>$id]); 
      }


        public function deleteAboutHome(Request $request)
        {
        $id = request('id'); 
        return $this->admin->deleteAboutHome($id);


        }



      public function deleteUser(Request $request)
      {
         $id = request('id');
         $deleteUser = DB::table('users')->where('id',$id)->delete();
      } 

/************************/
/* Bulk delete  */
/***********************/
  public function bulkdeletion(Request $request){
         $users_id = request('users_id');
         if(empty($users_id)){
           return Redirect::back()->withErrors(['Please Select atleast one check box', 'Please Select atleast one check box']);          
         }
         $table_name = request('table_name');
         $deleteUser = DB::table($table_name)->whereIn('id',explode(',',$users_id))->delete();

     return Redirect::back()->withErrors(['Your data has been deleted successfully', 'Your data has been deleted successfully']);
  }

/**************************/
  public function getUserEditData(Request $request){
        $user_id = request('id');
        $getData = DB::table('users')->select('firstname','lastname','address','phone','companyname')->where('id',$user_id)->first();

        echo json_encode($getData);
      }



      public function updateEmployeeData(Request $request)
      {

        $user_id = request('user_id');
        $data['firstname'] = request('firstname');
        $data['lastname']= request('lastname');
        $data['address']= request('address');
        $data['phone'] = request('phone');


        if ($request->hasFile('file'))
        {
        $file         =   $request->file('file');
        $filename     =   $file->getClientOriginalName();
        $uniq_no      =   mt_rand();
        $unique_name  =   $uniq_no.$filename;
        $move        =   $file->move(public_path().'/uploads/', $unique_name);
        $data['image'] = '/public/uploads/'.$unique_name;

        }


        return $this->admin->updateEmployeeData($user_id,$data);  


      }




      public function updateClientData(Request $request)
      {
         $user_id = request('user_id');

        $data['companyname'] = request('companyname');
        $data['address']= request('address');
        $data['phone'] = request('phone');
          if ($request->hasFile('file'))
        {
        $file         =   $request->file('file');
        $filename     =   $file->getClientOriginalName();
        $uniq_no      =   mt_rand();
        $unique_name  =   $uniq_no.$filename;
        $move        =   $file->move(public_path().'/uploads/', $unique_name);
        $data['image'] = '/public/uploads/'.$unique_name;

        }
       return $this->admin->updateClientData($user_id,$data);  


      }


/*********************/
  /*ajax call*/
/****************/
  public function deleteJobs(Request $request){
        $id = request('id');
        $delete = DB::table('jobs')->where('id',$id)->delete();
         if($delete){
           echo "Done";
         } 
      }
/**********************/
/*  flyersconversion */
/*********************/
  public function flyersconversion(){
    if(Auth::guest()){
      return redirect('4admin');
     }
       $type='W';
       $data =  $this->admin->clientsflyers($type);
   return view('admin.flyersconversion',['users'=>$data]);
}
/*************************/
/*flyer conversion data*/
/*************************/
public function flyerconversiondta($id){
   if(Auth::guest()){
      return redirect('4admin');
     }
    $data =  $this->admin->clientsflyersdetail($id);
   return view('admin.flyersconversiondetail',['data'=>$data]);
}
/************************/
/*my jobs details */
/************************/
public function myjobsdetails($id,$type){

   if(Auth::guest()){
      return redirect('4admin');
     }
    $data =  $this->admin->myjobsdetails($id);
   return view('admin.myjobsdetails',['data'=>$data]);


}

/********/
    }
/*******/