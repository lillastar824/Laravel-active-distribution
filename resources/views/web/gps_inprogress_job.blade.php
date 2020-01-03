@include('web_layout.header')
<!-- end header here -->
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
      width: 100%;
}

.content-wrapper {
    margin-left: 264px !important;
}
.gps_jobs_dropdown {
    text-align: right;
    max-width: 400px;
    width: 100%;
    float: right;
    margin: 20px 0px 40px;
    position: relative;
}
select#totalseatsTyps {
    height: auto;
    font-size: 16px;
    color: #000;
    padding: 12px;
    float: left;
    width: 70%;
}
.gps_jobs_dropdown input#save {
    width: 100px;
    float: right;
    height: auto;
    font-size: 16px;
    padding: 10px;
}

.gps_jobs_dropdown label.error {
    position: absolute;
    left: 0px;
    top: 49px;
    font-size: 12px;
    width: 100%;
    text-align: left;
    font-weight: bold;
}
@media(max-width:599px){
.gps_jobs_dropdown, select#totalseatsTyps, .gps_jobs_dropdown{
    max-width: 100%;
width:100%;
}
.gps_jobs_dropdown input#save {
    width: 100%;
    margin-top: 25px;
}
}
</style>


 <script type="text/javascript">



function initMap() {

  var myLatLng = new google.maps.LatLng(37.090240, -95.712891);

  var mapOptions = {
    zoom: 12,
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

 </script>
<!-- start route marking area here -->
<section class="route-marking-area">
		<div class="container">
			<h1 class="section-title"><span>Route marking & Map</span></h1>
          <div class="gps_jobs_dropdown">
        <form method="post" id="gps_job" accept-charset="utf-8" id="map_form" action="{{asset('/')}}{{'gps_inprogress_job'}}" enctype='multipart/form-data'>
               {{csrf_field()}}
           <select name="myjobb_name" id="totalseatsTyps" onchange="myjob_name()">
            <option selected="true" disabled="disabled">Please Select job</option>
               <?php foreach ($my_jobs as $key => $value) { ?>
              <option value="{{$value->job_id}}">{{$value->job_name}}</option>     
                  <?php } ?>
          </select>
           <?php foreach ($my_jobs as $key => $value) { ?>
                <input type="hidden" name="user_id" value="{{$value->user_id}}" id="user_id" />
            <?php } ?>
          <input type="submit" class="btn btn-primary btn-block blue-btn" name="save" value="Submit" id="save"/>
         
        </form>
    </div>
		</div>
	
		<div class="map-outer">
			 <div id="map" ></div> 
		</div>
	</section>
<!-- end route marking area here -->


<!-- start gps custom map here -->
	<section class="about-area track_order">
		<div class="container">
			<h1 class="section-title"><span>Track your order</span></h1>
			<div class="row">
				<aside class="col-lg-7">
					<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
					<br/><br/>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions</p>
				</aside>
				<aside class="col-lg-5 text-center">
					<img src="images/track_order.png" alt="" />
				</aside>
			</div>
		</div>
	</section>
<!-- end route marking area here -->


<!-- start gps custom map here -->

<!-- end gps custom map here -->


@include('web_layout.footer')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCVzGh5nFNlFvsdYU726-j98eTeiWA1Xzk&libraries=drawing&callback=initMap"
         async defer></script>