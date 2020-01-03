
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

<?php /*print '<pre>'; print_r($users); die; */ ?>
  <div class="content-wrapper">
    <div class="container-fluid">
      <!-- Breadcrumbs-->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ url('admin/dashboard')}}">Dashboard</a>
        </li>
        <li class="breadcrumb-item active">Clients Listing</li>
    <li class="breadcrumb-item active">


    </li>
      </ol>
      <!-- Example DataTables Card-->

        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th style="width:10%" >#</th>
                  <th style="width:10%">Company Name</th>
                  <th style="width:20%">Address</th>
                  <th style="width:20%">Email</th>
                  <th style="width:10%">View Flyer Conversion</th>
               
               </tr>
              </thead>
             
              <tbody>
                <?php $i = 1;
                    foreach($users as $user){ ?>
                  <tr class="delete_{{$user->id}}">
                      <td><?php echo $i; $i++; ?></td>
                      <td><?php echo $user->companyname;  ?></td>
                      <td><?php echo $user->address;  ?></td>
                      <td><?php echo $user->email;  ?></td>
                      <td> 
                          <a href="{{ url('flyerconversiondta/'.$user->id) }}" class="view" style="text-decoration:none;"> View </a> 
                      </td>
                </tr>
                   <?php } ?>
                </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript-->
 @include('admin_layout.footer');
