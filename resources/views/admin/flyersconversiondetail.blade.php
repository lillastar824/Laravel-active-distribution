
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
  Manage About Content
    </li>

     
    <li class="breadcrumb-item active">
 

    </li>
      </ol>
      <!-- Example DataTables Card-->

        <div class="card-body">
          
          <?php// print_r($data);die; ?>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
               
                <tr>
               
                  <th style="width:10%">Job Name</th>
                  <th style="width:10%">Number of flyers distributed</th>
                  <th style="width:10%">Number of flyers received</th>
                  <th style="width:10%">Job Status</th>
                 <!--  <th style="width:10%">Complete job</th> -->
            
               </tr>

              </thead>
             
              <tbody>
              <?php foreach($data as $content){ ?>
                <tr>
                  <td><?php echo $content->job_name;?></td>
                  <td><?php echo $content->flyers;?></td>
                  <td><?php echo $content->recivedflyers;?></td>
                 
                            <td>
                 <div class="btn-group">
                
                  <?php if(($content->status=='S')|| ($content->status=='I')){
                    $result='Inprogress';
                    $buttonStyle="label-primary";
                    
                
                 }elseif($content->status=='C'){
                    $result='Completed';
                    $buttonStyle="label-success";
                   
                }
                elseif($content->status=='P'){
                    $result='Pending';
                    $buttonStyle="label-warning";
                    
                 }
                elseif($content->status=='A'){
                    $result='Accepted';
                    $buttonStyle="label-info";
                    
                }
               
                else{
                    $result='Blank';
                    $buttonStyle="label-danger";
              }
                 ?>  

               <span class="label <?php echo $buttonStyle;?>"><?php echo $result;?></span>
              
          
              </div>  
              </td>

                 <!--  <td> 
                      <a href="{{ url('myjobsdetails/'.$content->job_id.'/Com') }}" class="view" style="text-decoration:none;"> Complete jobs </a> 
                  </td>  -->
                  
                </tr>
                <?php } ?>
                 </tbody>
            </table>
          </div>


        </div>
      </div>
    </div>
    <!-- /.container-fluid-->
    

    <!-- Bootstrap core JavaScript-->
 @include('admin_layout.footer');




