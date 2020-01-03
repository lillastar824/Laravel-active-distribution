
@include('admin_layout.header');
@include('admin_layout.sidebar');
<style>
#map {
  height: 500px;
  margin-bottom: 0px;
}
</style>
  <!-- Navigation-->
<div class="content-wrapper">

<ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">
         Add Job
        </li>
      </ol>

<div class="profile">
  <div id="map"></div> 
<div class="container">
<div class="profile_im text-center">
  
  </div>

                 
                 
           
  <form method="post" accept-charset="utf-8" id="map_form" action="{{asset('/')}}{{'addJob'}}" enctype='multipart/form-data' class="job_det">
    {{csrf_field()}}
  <input type="hidden" name="vertices" value="" id="vertices"  />
  <div class="form-group">
     <label>Job Name:-</label>
  <input type="text" name="job_name" value="" id="job_name" placeholder='Job name'/>
  </div>
   <div class="form-group">
     <label>Flyers-</label>
  <input type="text" name="flyers" value="" id="flyers" placeholder='Flyers'/>
   </div>
    <div class="form-group">
     <label>Image-</label>
  <input type="file" name="image" value="" id="image" accept="image/*"/>
  </div>
    <div class="form-group">
     <label>Job Number-</label>
  <input type="text" name="job_number" value="<?php echo '#'.str_random(8); ?>" readonly>
</div>

  <input type="submit" name="save" value="Add Job" id="save"  />
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDHA-yTJe-iXd_GQk0Cbtb7Raql_skf8Gk&libraries=drawing&callback=initMap"
         async defer></script>






 <script>
      // This example requires the Drawing library. Include the libraries=drawing
      // parameter when you first load the API. For example:
      // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=drawing">

$('#vertices').val('');/*it is needed because on soft reload it does not clean value of this field*/
$( "#map_form" ).submit(function( event ) {
 var vertices = $('#vertices').val();
 if(vertices=='')
 {
    alert('Please Choose an Area in the Map');
      return false;
 }

});
    
var map; // Global declaration of the map
      var iw = new google.maps.InfoWindow(); // Global declaration of the infowindow
      var lat_longs = new Array();
      var markers = new Array();
      var drawingManager;
      function initMap() {
         var myLatlng = new google.maps.LatLng(37.090240, -95.712891);
        var myOptions = {
            zoom: 8,
          center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP}
        map = new google.maps.Map(document.getElementById("map"), myOptions);
        drawingManager = new google.maps.drawing.DrawingManager({
        drawingMode: google.maps.drawing.OverlayType.POLYGON,
          drawingControl: true,
          drawingControlOptions: {
            position: google.maps.ControlPosition.TOP_CENTER,
          drawingModes: [google.maps.drawing.OverlayType.POLYGON]
        },
            polygonOptions: {
              editable: true
            }
      });
      drawingManager.setMap(map);
      
      google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
        var newShape = event.overlay;
        newShape.type = event.type;
      });

            google.maps.event.addListener(drawingManager, "overlaycomplete", function(event){
              drawingManager.setDrawingMode(null);
             
                overlayClickListener(event.overlay);
                console.log(event.overlay.getPath().getArray());
                $('#vertices').val(event.overlay.getPath().getArray());
            });
        }
function overlayClickListener(overlay) {
    google.maps.event.addListener(overlay, "mouseup", function(event){
        $('#vertices').val(overlay.getPath().getArray());
    });
}
 initialize();



    </script>







