
@include('admin_layout.header');
@include('admin_layout.sidebar');
  <!-- Navigation-->
<div class="content-wrapper">

<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
          Admin Profile
        </li>
      </ol>


<div class="profile">
<div class="container">


    <form id="hangerForm" enctype='multipart/form-data' method='post' action='{{asset('')}}postHanger'>
          {{ csrf_field() }}
          <div class="col-md-6 form-line">
              <div class="form-group">
                Add Banner
                <input id="image" type="file" name='banner' accept=".png ,.jpg ,.jpeg">
                <label for="exampleInputUsername"></label>
              </div>


              <div class="form-group">
                <label for="exampleInputUsername">Description</label>
                <textarea name='description' placeholder="Enter Description" id='description'>{{$data->description}}</textarea>
              </div>

              <input type='hidden' name='id' value='{{$data->id}}'>
       
            
            </div>
            <div class="col-md-6">
              <div class="form-group">
       <!--          <label for ="description"> State</label>
                <input type="text" class="form-control" name='state' id="state" placeholder="state" value="<?php //echo $adminInfo->state; ?>"> -->
              </div>
              <div>
              <input id="Update"  type='submit' name='submit' value='submit'>  
              
              </div>
              
          </div>
        </form>

      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
   
    <style>
    .adminImage{
     float:left;
     width:250px;
     height: 200px;

    }
    </style>
@include('admin_layout.footer');
    <!-- Bootstrap core JavaScript-->
   


<script>


/*$(document).on("click",".update",function(e){

          
                    e.preventDefault();    
                    var base_url ="<?php //echo url('/')  ?>";
                        $.ajax({
                          type:'POST',
                          url: base_url+'/editAdminProfile',
                          data:$('#formData').serialize(),
                          success:function(data){
                              alert(data); 
                            }
                        });                                  
            }); 
*/


$("form#data").submit(function(e) {
/*  alert('hi');
  return false;*/
    e.preventDefault();  
    var base_url ="<?php echo url('/')  ?>";
  //   alert(base_url);
   // return false;
      var img_url ="<?php echo url('/public/uploads/') ?>";

    var formData = new FormData(this);
  /*  alert(formData);
    return false;*/
  /* alert(base_url);*/
    $.ajax({

        url: base_url+'/editAdminProfile',
        type: 'POST',
        data: formData,
        dataType: "json",
        success: function (data) {
         console.log(data);

             $("#imagess").attr("src",base_url+data.image);    
             $("#admin_name").attr("value",data.name);
             $("#city_name").attr("value",data.city);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});






</script>
