
  <!-- Navigation-->
@include('admin_layout.header');
@include('admin_layout.sidebar');

<?php /*print '<pre>'; print_r($onlineUsers); exit;*/ ?>
<style>
    .member_list li {
  border-bottom: 1px solid #dddddd;
  padding: 17px 10px;
  list-style: outside none none;
}
.chat-img img {
  height: 34px;
  width: 34px;
}
.img-circle {
  border-radius: 50%;
}
.member_list .chat-body {
  padding-left:47px;
  margin-top: 0;
}
.body_colrs {
    background-color: #00c0ef29;
}.body_colrs2 {
    background-color:#dd4b3933;
}.body_colrs3 {
    background-color: #9bbb58;
}
    </style>
  <div class="content-wrapper dshbord_sctn">

   <center> <h4>Number of Users Registered</h4> </center>
    <div class="container-fluid">

   <section class="content">
   <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12 ">
          <div class="info-box body_colrs">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total number of Clients</span>
              <span class="info-box-number"><?php echo $users['client']; ?></span></a>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
       <div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 10px;">
          <div class="info-box body_colrs2">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total number of Employee</span>
             
                
                 <span class="info-box-number"><?php echo $users['employee']; ?></span></a>
             
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>



   <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box body_colrs2">
            <span class="info-box-icon bg-red"><i class="fa fa-users"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total number of Flyer Distributed</span>
             
                
                 <span class="info-box-number"><?php echo $users['flyer_distributed']; ?></span></a>
             
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

      
      </div>
  
      <!-- Breadcrumbs-->
  
      <!-- Example DataTables Card-->
     
  
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
 </section>
      </div>
      </div>

         
  
    
    <!-- Logout Modal-->

    <!-- Bootstrap core JavaScript-->
 @include('admin_layout.footer');



<script type="text/javascript">
window.onload = function () {
  var chart = new CanvasJS.Chart("chartContainer",
  {
    title:{
      text: "Online Users"
    },
    legend: {
      maxWidth: 350,
      itemWidth: 120
    },
    data: [
    {
      type: "pie",
      showInLegend: true,
      legendText: "{indexLabel}",
      dataPoints: [
        { y: <?php echo $users['employee']; ?>, indexLabel: "Total Employee" },
        { y: <?php echo $users['client']; ?>, indexLabel: "Total Client" },
      ]
    }
    ]
  });
  chart.render();
}
</script>