
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
           <div class="slid">
             <a href="{{asset('aboutContentForm')}}" class='up_d'>Add Content</a> 
          </div>
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
               
                <tr>
               
                  <th style="width:10%">Image</th>
                  <th style="width:10%">Description</th>
                  <th style="width:10%">Active</th>
                  <th style="width:10%">Update</th>
                  <th style="width:10%">Delete</th>
               </tr>

              </thead>
             
              <tbody>
              <?php foreach($contents as $content){ ?>
                <tr id='banner_{{$content->id}}'>
                 <td><img src="{{asset('')}}/{{$content->image}}" width=200px; height=200px;></td>
                  <td><?php echo $content->description;  ?></td>
                  <td><input type='Radio' name='active' class='activeContent' data-id="{{$content->id}}" <?php if($content->is_active=='ON'){ echo "checked=checked"; } ?>></td>
                  <td><a href="{{asset('')}}updateAboutForm/{{$content->id}}" class='up_d'>Update</td>
                  <td><a href="#" class='deleteContent up_d' data-bannerId = "{{$content->id}}">Delete</td>
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

 $(document).on("click",".activeContent",function()
 {
   var id = $(this).attr('data-id');
   var base_url ="<?php echo url('/')  ?>";
    $.ajax({
      type:'POST',
      url: base_url+'/activeContent',
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      }
      ,
      success:function(data){
            

       }
    });


 });

  $(document).on("click",".deleteContent",function()
 {
   /* alert('hi');
   return false;*/
   var id = $(this).attr('data-bannerId');
   var base_url ="<?php echo url('/')  ?>";
    $.ajax({
      type:'POST',
      url: base_url+'/deleteContent',
      data: {
        "id": id,
        "_token": "{{ csrf_token() }}"
      }
      ,
      success:function(data){
        if(data=='false')
        {
          alert('Active Section can not be deleted');
          return false;
        }
        else
        {
        $( "#banner_"+id ).fadeOut( "slow" );

        }
  

       }
    });


 });



 
 

 </script>


