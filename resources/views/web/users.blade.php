
  <!-- Navigation-->
@include('layout.header');
@include('layout.sidebar');



<style type="text/css">
 
.button1 {
  background: green;
  color: white;
  border: #0eba41 2px solid;
  border-radius: 5px;
  padding: 4px 14px;
}

.button2 {
background: #b21919;
color: white;
border:  2px solid #b21919;
border-radius: 5px;
padding: 4px 14px;
}

.view {
    background: #27a3a3;
    color: white;
    text-decoration: none;
    padding: 4px 14px;
    border: 2px #27a3a3 solid;
    border-radius: 10%;
}
.view:hover {
    color: #fff;
}

</style>

<?php /*print '<pre>'; print_r($users); die;*/  ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
  Users Listing
    </li>
    <li class="breadcrumb-item active">
 
   <select class="form-control" style="width:100px;display:inline-block;margin-left:5px;" id='getUser'>
     <option value="">Select User Type</option>
     <option value="all">All</option>
     <option value="T">Clients</option>
     <option value="N">Employees</option>

     </select>

    </li>
      </ol>
      <!-- Example DataTables Card-->

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="width:10%" >#</th>
                  <th style="width:10%">First Name</th>
                  <th style="width:10%">Last Name</th>
                  <th style="width:20%">Address</th>
                  <th style="width:20%">Email</th>
                  <th style="width:10%">View User Profile</th>
                  <th style="width:10%">Action</th>
               </tr>
              </thead>
             
              <tbody>
                <?php 
                  $i = 1;
                foreach($users as $user){ ?>
                <tr>
                   <?php  if($user->is_suspended=='ON'){
                    $status= 'Suspended';
                    $class ='btn btn-danger';
                  }else{
                    $status= 'Active';
                    $class ='btn btn-success';
                  } ?>

                  <td><?php echo $i; $i++; ?></td>

                  <td><?php echo $user->firstname;  ?></td>
                  <td><?php echo $user->lastname;  ?></td>
                  <td><?php echo $user->address;  ?></td>
                  <td><?php echo $user->email;  ?></td>
       <td>  <a href="{{ url('userProfile/'.$user->id) }}" class="view" style="text-decoration:none;"> View </a> </td>
              <td><a href='javascript:void(0)' id='suspendUser_<?php echo $user->id; ?>' class='suspendUser btn <?php echo $class; ?>' data-id="<?php echo $user->id; ?>" data-suspend = "<?php echo $user->is_suspended; ?>">
                
                    <?php echo $status; ?>
                  </a></td>


                

                </tr>
                <?php } ?>
                 </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    
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
    <!-- Bootstrap core JavaScript-->
 @include('layout.footer');

<script>
  
  $(document).on("click",".suspendUser",function(){
    var id = $(this).attr('data-id');
    var suspend = $(this).attr('data-suspend');
     var classs ='btn-danger';
     var class_s ='btn-success';
    if(suspend=='ON')
    {

      is_suspend = 'OFF';
      suspend_class = 'Active';
      
        $("#suspendUser_"+id).addClass('btn');
        
         
      if(!confirm("Are You sure you want to remove this user from suspened list"))
      {
        return false;
      }
    }
    else
    {
      is_suspend = 'ON';
      suspend_class = 'Suspended';
       $("#suspendUser_"+id).addClass('btn');
       
      if(!confirm("Are You sure you want to suspend this user"))
      {
        return false;
      }
    }
    var base_url ="<?php echo url('/')  ?>";
    $.ajax({
      type:'POST',
      url: base_url+'/suspendUser',
      data: {
        "id": id,
        "is_suspend":suspend
      }
      ,
      success:function(data){
        if(data=='ON')
        {
           $("#suspendUser_"+id).addClass(classs);
        $("#suspendUser_"+id).removeClass(class_s);
      $("#changeUserPass_"+id).addClass('change');  
         
        }
        else
         {
           $("#suspendUser_"+id).addClass(class_s);
        $("#suspendUser_"+id).removeClass(classs);
       $("#changeUserPass_"+id).removeClass('change');

       

         } 

        $("#suspendUser_"+id).text(suspend_class);
       //  $("#suspendUser_"+id).addClass(suspend_class);
 
        $("#suspendUser_"+id).attr('data-suspend', is_suspend);


      }
    });

  });
</script>

<script type="text/javascript">
 var base_url ="<?php echo url('/')  ?>";
 $(document).on("change","#getUser",function(){

  var type = $('#getUser').val();

  
  
  if(type=='N')
  {
  window.location = base_url+'/allUsers/N';
   
  }
  else if(type=='T')
  {
  window.location = base_url+'/allUsers/T';
   
  }
  else if(type=='all')
  {
  window.location = base_url+'/allUsers/all';
   
  }
          
  });






</script>