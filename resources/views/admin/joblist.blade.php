
  <!-- Navigation-->
@include('admin_layout.header');
@include('admin_layout.sidebar');



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
.bulk_sctn > ol.breadcrumb {
    margin-bottom: 0px;
}
.textmsg_bulk {
    padding: 20px 35px;
    background-color: #f7f7f7;
}
.textmsg_bulk h4.error_messagesBox {
    background-color: #e91f1f;
    color: #fff;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    margin-bottom: 15px;
}
</style>

<?php /*print '<pre>'; print_r($users); die;*/  ?>
  <div class="content-wrapper">
    <div class="container-fluid bulk_sctn">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
  Job Listing
    </li>
    <li class="breadcrumb-item active">
 


    </li>
      </ol>

      <div class="textmsg_bulk">
      @if($errors->any())
         <h4 class="error_messagesBox" id="navigationcontainer">{{$errors->first()}}</h4>
      @endif
      <!-- Example DataTables Card-->
    <form role="form" method="post" id="admin_profile" action="{{url('bulkdeletion')}}" enctype="multipart/form-data">
                  {{ csrf_field() }}
                <div class="forword_job">
                    <input type="hidden" id="sublistids" name="users_id">
                    <input type="hidden" id="table_name" name="table_name" value="jobs">
                </div>

                <div class="forword_submitbtn">
                      <input type="submit" id="btn_multiuser" class="btn btn-success multiuserrouteforword " value="Multiple Delete" name="submit">
                </div>
      </form>

</div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="width:10%" >#</th>
                    <th style="width:10%" >Check</th>
                  <th style="width:10%">Job Name</th>
                  <th style="width:10%">Total flyers</th>
                  <th style="width:10%">flyer Image</th>
                  <th style="width:10%">View</th>
                   <th style="width:10%">Delete</th>
               </tr>
              </thead>
             
              <tbody>
                <?php 
                  $i = 1;
                foreach($jobs as $job){ ?>
                <tr class="deleteJob_{{$job->id}}">
                  <td><?php echo $i; $i++; ?></td>
                  <td><input type="checkbox" name="" class="routeasscheckbox" value="{{$job->id}}" ></td>
                  <td><?php echo $job->job_name;  ?></td>
                
                  <td><?php echo $job->flyers;  ?></td>
                  <td><img src="{{asset('')}}{{$job->image}}" height='200px' width='200px'></td>
                  <td><a href="{{'jobDetail/'}}{{$job->id}}" class="btn btn-info">View</a></td>
                  <td><a href="#"  id='deleteJob' data-id="{{$job->id}}" class="btn btn-info">Delete</a></td>
                 
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
 @include('admin_layout.footer');

<script>


$(document).on("click","#deleteJob",function(){
 var id = $(this).attr('data-id');
 
if(!confirm("Are You sure you want to Delete this Job"))
      {
        return false;
      }

    var base_url ="<?php echo url('/')  ?>";
    $.ajax({
      type:'POST',
      url: base_url+'/deleteJobs',
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      },
      success:function(data){
      
       if(data=='Done')
       {
         $(".deleteJob_"+id).fadeOut();
       }


      }
    });





});

















  
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
        "_token": "{{ csrf_token() }}",
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

  <script>
      $(document).on( "click", '#btn_multiuser',function(e) {
        
        var checkedValue = []; 
        var inputElements = document.getElementsByClassName('routeasscheckbox');
        var key = 0;
        for(var i=0; inputElements[i]; ++i){
              if(inputElements[i].checked){
                   checkedValue[key] = inputElements[i].value;  
                   key++;          
              }
        }
        
        $('#sublistids').val(checkedValue);
    }); 
   $("#navigationcontainer").fadeOut(7000);
    
  </script> 