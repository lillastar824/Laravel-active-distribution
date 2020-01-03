
@include('admin_layout.header');
@include('admin_layout.sidebar');


<?php
  
/*print_r($employeeDetails);
  exit;*/

  $image = array();
  foreach($employeeDetails as $detail)
              {
  
    $locationss[]=array($detail->firstname, $detail->latitude, $detail->longitude );
        $markers = json_encode($locations);
        $image[] =    $detail->image;  
    }

 $image2 = json_encode($image); ?>


<style>
#map {
  height: 500px;
  margin-bottom: 0px;
}

.content-wrapper {
    margin-left: 264px !important;
}
</style>


 <script type="text/javascript">



function initMap() {

  var myLatLng = new google.maps.LatLng(37.090240, -95.712891);

  var mapOptions = {
    zoom: 8,
    center: myLatLng,
    mapTypeId: google.maps.MapTypeId.RoadMap
  };
  var map = new google.maps.Map(document.getElementById('map'),mapOptions);
  
    <?php if(!$locations->isEmpty()){  ?>
    var triangleCoords = [

    <?php foreach($locations as $location) { ?>

    new google.maps.LatLng(<?php echo "$location->latitude,'$location->longitude'"; ?>),

    <?php } ?>
       ]
    <?php } ?>

  myPolygon = new google.maps.Polygon({
    paths: triangleCoords,
    draggable: true, 
    editable: true,
    strokeColor: '#FF0000',
    strokeOpacity: 0.8,
    strokeWeight: 2,
    fillColor: '#FF0000',
    fillOpacity: 0.35
  });

  myPolygon.setMap(map);

  google.maps.event.addListener(myPolygon.getPath(), "insert_at", getPolygonCoords);

  google.maps.event.addListener(myPolygon.getPath(), "set_at", getPolygonCoords);


<?php  if(count($employeeDetails) != 0) { 

          if($employeeDetails[0]->status=='I') {  ?>
  
  var img = '<?php echo $image2;?>';
    img = JSON.parse(img);
  
  var locations = [
      <?php foreach($employeeDetails as $detail){ 
              $image[] =    $detail->image;  
           echo "['$detail->firstname','$detail->latitude','$detail->longitude'],";
        } ?>
    ]

 var marker, i;
       for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map,
        icon: {
    url: "<?php echo asset('') ?>"+img[i],
    scaledSize: new google.maps.Size(23, 23),


  }
      });
 var infowindow = new google.maps.InfoWindow();
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
<?php } }?>

}

//Display Coordinates below map
function getPolygonCoords() {
  var len = myPolygon.getPath().getLength();
  var htmlStr = "";
  for (var i = 0; i < len; i++) {
    htmlStr +=myPolygon.getPath().getAt(i).toUrlValue(5) +",";
    //Use this one instead if you want to get rid of the wrap > new google.maps.LatLng(),
    //htmlStr += "" + myPolygon.getPath().getAt(i).toUrlValue(5);
  }
  console.log(htmlStr);
  $('#vertices').val(htmlStr);
}
function copyToClipboard(text) {
  window.prompt("Copy to clipboard: Ctrl+C, Enter", text);
}







var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}


function showCheckboxesEmployee() {
  var checkboxes = document.getElementById("checkboxess");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}



 </script>


  <!-- Navigation-->
<div class="content-wrapper">


<input type='button' class='addEmployee sub_mit' value='Add Employee' data-toggle="modal" data-target="#myModal" >
<input type='button' class='addClient sub_mit' value='Add Company' data-toggle="modal" data-target="#myModalCompany" <?php if($existCompany!=0){echo 'disabled';} ?>>
<input type='button' class='addFlyers sub_mit' value='Submit Flyers' data-toggle="modal" data-target="#myModalFlyer">
<div class="profile">

  <div id="map"></div> 
<div class="container-fluid">


                 
   <div class="row">
   <div class="col-sm-3 job_d">              
         <div class="profile_im">
  <h3>Update Job</h3>
  </div>  
  <form method="post" accept-charset="utf-8" id="map_form" action="{{asset('/')}}{{'updateJob'}}" enctype='multipart/form-data'>
    {{csrf_field()}}
  <input type="hidden" name="vertices" value="" id="vertices" />
  <div class="form-group">
  <label>Job Name:-</label><input type="text" name="job_name" value="{{$jobDetails->job_name}}" id="job_name" placeholder='Job name'/>
</div>
<div class="form-group">
  <label>Number Of Flyer:-</label><input type="text" name="flyers" value="{{$jobDetails->flyers}}" id="flyers" placeholder='Flyers'/>
</div>
<div class="form-group">
  <label>Image:-</label><input type="file" name="image" value="" id="image" />
</div>
  <input type="hidden" name="job_id" value="{{$job_id}}" id="job_id" />
  <input type="submit" name="save" value="Update Jobs" id="save"  />
  </form>
</div>
<div class="col-sm-3 job_d">
  <div class="profile_im">
  <h3>Employees Information</h3>
  </div>

    <div class="table-responsive">
          <table width="100%" cellpadding="0" cellspacing="0" class="employee-table">
            <thead>
              <tr>
                <th>Employee Name</th>
                <th>Phone Number</th>
                <th>Job Status</th>
              
              </tr>
            </thead>
            <tbody>
              <?php foreach($employeeDetails as $detail)
              {
                               
              ?>
              <tr>
                <td><?php echo $detail->firstname; ?></td>
                <td><?php echo $detail->phone; ?></td>
                <?php if($detail->status=='C'){$status='Completed';}else if($detail->status=='S'){$status='Pause';} else if($detail->status=='I'){$status='In-Progress';} else if($detail->status=='A'){$status='Not Started yet';}else if($detail->status=='P'){$status='Pending';} ?>
                <td><?php echo $status; ?></td>
              
              </tr>
              <?php 
                            
              $locations[]=array($detail->firstname, $detail->latitude, $detail->longitude );
                                 $markers = json_encode($locations);

  
               ?>
              <?php } ?>
              
            </tbody>
          </table>
        </div>
        </div>
        <div class="col-sm-3 job_d">
          <div class="profile_im">
  <h3>Job Information</h3>
  </div>
<div class="job-imageouter job-detail">

                <p class="job-date"><img src="{!! url('/public/admin_assets/images/Calendar_Check-512.png')!!}" alt=""><?php
                   $date=date_create($jobDetails->created_at);
                   echo date_format($date,"d F, Y");
                ?></p>
                
                <h6>Job Name</h6>
                <p class="flyer-quantity"><?php echo $jobDetails->job_name;?></p>
                <h6>Quantity of Flyers</h6>
                <p class="flyer-quantity"><?php echo $jobDetails->flyers;?></p>
                <h6>Flyer Distributed</h6>
                <p class="flyer-quantity"><?php  if(empty($jobDetails->flyer_distributed)) {echo 0;}else{echo $jobDetails->flyer_distributed;}?></p>
                 <h6>Job Completed</h6>
                  <div class="progress pink">
                    <?php if(empty($jobDetails->flyer_distributed)) 
                    {
                     $percent = 0;
                   } 
                     else 
                      { 
                         $percent=$jobDetails->flyer_distributed*100/$jobDetails->flyers;
                         $percent = round($percent,2); 
                      } 

                      ?>
                <div class="progress-bar" style="width:<?php echo $percent; ?>%; background:#ff4b7d;">
                    <div class="progress-value"><?php echo $percent.'%'; ?></div>
                </div>
               </div>
                <h6>Numbers of Employees</h6>
                <p class="flyer-quantity"><?php echo $jobDetails->job_employee; ?></p>
                <h6>Over All Job Status</h6>
                                <p class="flyer-quantity green">In Progress</p>
              </div>
        </div>



<div class="col-sm-3 job_d">
  <div class="profile_im">
  <h3>Submit Flyer Dates</h3>  
  </div>

    <div class="table-responsive">
          <table width="100%" cellpadding="0" cellspacing="0" class="employee-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Number of flyer</th>
               
              
              </tr>
            </thead>
            <tbody>
              <?php foreach($dates as $data)
              {
                               
              ?>
              <tr>
                <td><?php echo $data->date; ?></td>
                <td><?php echo $data->flyer_count; ?></td>
                  
              </tr>
              <?php 
                            
             // $locations[]=array($detail->firstname, $detail->latitude, $detail->longitude );
                                // $markers = json_encode($locations);

  
               ?>
              <?php } ?>
              
            </tbody>
          </table>
        </div>
        </div>









      </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->

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
@include('admin_layout.footer');
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVzGh5nFNlFvsdYU726-j98eTeiWA1Xzk&libraries=drawing&callback=initMap"
         async defer></script>



           <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h2>Send Request to Employees</h2>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body">
      
        
       <form id='addEmployee' method='post' action="{{asset('addEmployee')}}">
        {{csrf_field()}}
    <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
         <input type='hidden' id='job_id' name='job_id' value='{{$job_id}}'>
     
  
    </div>
    <div id="checkboxes" class="check_b">
      <?php foreach($employeeList as $list) {
          if($list->firstname){ ?>
            <label>
               <input type="checkbox" value="<?php echo $list->id;?>" name='employeeList[]'/><?php echo $list->firstname ?>
            </label>
     <?php  } }?>
    
   </div>
  </div>
   <input type='submit' value='Send Request' class="sub_mit">
</form>
  </div>      

        
       <!--  <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div> -->
      </div>
      
    </div>
  </div>




   <div class="modal fade" id="myModalCompany" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
         <div class="modal-body">
          <form id='addCompany' method='post' action="{{asset('addCompany')}}">
        {{csrf_field()}}
         <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxesEmployee()">
         <input type='hidden'  name='job_id' value='{{$job_id}}'>
      <select name="companyId" id="companyId" required>
        <option value=''>Select Company</option>
       <?php foreach($companyList as $list)
      { ?>
        
        <option value='<?php echo $list->id; ?>'><?php echo $list->companyname; ?></option>
        <?php } ?>
      </select>
     
    </div>
 
    <input type='submit' value='Add Company'>
  </div>
  </form>
</div>
       
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>






  <div class="modal fade" id="myModalFlyer" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        
        </div>
        <div class="modal-body">
        <div id='errorMsg'></div>
            <form id='addFlyers' method='post' action="{{asset('addFlyers')}}">
            {{csrf_field()}}
           
            <input type='hidden'  name='job_id' value='{{$job_id}}' id='jobId'>
            <input type='text' name='date' id='date' placeholder='Select Date'>
            <input type='text' name='flyerCount' id='FlyerCount' Placeholder='Flyers' >
            <input type='button' value='Add Flyers' class='flyerDistributed'>
            
            </form>
          </div>
       
        
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <?php /*print '<pre>'; print_r($jobDetails); exit;*/?>
  <script>
  $( function() {
    $( "#date" ).datepicker({ dateFormat: 'yy-mm-dd' });

  } );


 $(document).on("click",".flyerDistributed",function(){
  var FlyerCount = $('#FlyerCount').val();
    var date = $('#date').val();
    var job_id = $('#jobId').val();

  if(date=='')
  {
    alert('Please Add Date');
    return false;
  }
  else if(FlyerCount=='')
  {
    alert('Please Add Number of Flyer Distributed');
    return false;
  }
  else if(!/^\d*$/.test(FlyerCount))
  {
  alert('Please provide a valid Number');
  return false;
  }
var base_url ="<?php echo url('/')  ?>";
   $.ajax({
      type:'POST',
      url: base_url+'/submitFlyers',
      data: {
        "date":date,
        "flyer":FlyerCount,
        "job_id":job_id,
        "_token": "{{ csrf_token() }}"
      }
      ,
      success:function(data){
       if(data=='True')
       {
        alert('Flyers has been added successfully');
        location.reload();
       }
       else
       {
        alert('You can not add flyers more than the permissible limit');
       }
     }
    });






 });


$( "#map_form" ).submit(function( event ) {
  var flyers = $("#flyers").val();
 /* alert(flyers);
  return false;*/
/**/
  var flyersdistributed = "<?php echo  $jobDetails->flyer_distributed ?>";

 var flyersdistributed =  Number(flyersdistributed);
/*    alert(flyersdistributed);
  return false;*/
  if(flyers==0)
  {
    alert('Number Of flyers can not be set to zero');
    return false;
  }
  else if(flyers<flyersdistributed)
  {
    alert('Invalid Total Number of Flyers');
    return false;
  }



});



  </script>

<style>
.job_l {

    border-left: 1px solid #ccc;

}
.compny_info .save {

    margin-top: 30px;

}
.save {

    background: #292a65;
    border: none;
    padding: 20px 22px;
    line-height: 0px;
    color: #fff;
    border-radius: 4px;
    margin-bottom: 10px;

}
</style>














