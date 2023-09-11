
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Meradian School | Student Portal</title>

  <?php include '_include_header.php';

  require('../function_php/conn.php'); 
  $sql = ' SELECT `id`, `title`, `announcement`, `status`, `created_by`, DATE_FORMAT(`date_created`, "%M %d, %Y") AS date_created FROM `tbl_announcement` ';
  $exec = $conn->query($sql);


  ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <?php include '_sidebar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row"><div class="col-md-12"><h4>Announcements!</h4></div></div>
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">

            <?php   while($row = $exec->fetch_assoc()){?>
            <!-- Announcements -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  <?php echo $row['title']; ?>
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php echo $row['announcement']; ?>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <p style="font-size: 14px; font-family: revert;"><i>Posted: <?php echo $row['date_created']; ?></i></p>
              </div>
            </div>
            <!-- /.card -->


            <?php } ?>
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">

            
            <!-- Announcements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Profile - <?php echo $_SESSION['id_number']; ?>
                </h3> 
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col sm-12">
                    <center>
                      <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image" width="100">
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Name:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['lastname']; ?>, <?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['middlename']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Province:</span>
                        </div>
                        <select class="form-control" name="province" id="my-province-dropdown" disabled="" style="background-color: #fff;">
                        </select>
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">City:</span>
                        </div>
                        <select class="form-control" name="city" id="my-city-dropdown" disabled="" style="background-color: #fff;">
                        </select>
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Barangay:</span>
                        </div>
                        <select class="form-control" name="barangay" id="my-barangay-dropdown" disabled="" style="background-color: #fff;">
                        </select>
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">House # / Purok:</span>
                        </div>
                          <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['house_no']; ?>" readonly="" style="background-color: #fff;">
                      </div>

                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Gender:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['gender']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Email:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['email']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Contact:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['contact_number']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Birthday:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo date("M d, Y", strtotime($_SESSION['birthdate'])); ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Year:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['school_year']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Section:</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1" value="<?php echo $_SESSION['section']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      
                    </center>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                
              </div>
            </div>
            <!-- /.card -->

          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include'_footer.php'; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php include'_include_footer.php'; ?>

<script src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations-v1.0.0.js"></script>
<script>
  
  var delayInMilliseconds = 2000; //1 second


  $('#my-province-dropdown').ph_locations({'location_type': 'provinces'});
  $('#my-province-dropdown').ph_locations( 'fetch_list');
  $('#my-city-dropdown').ph_locations({'location_type': 'cities'});
  $('#my-city-dropdown').ph_locations( 'fetch_list', [{"province_code": '<?php echo $_SESSION['province']; ?>'}]);

  $('#my-barangay-dropdown').ph_locations({'location_type': 'barangays'});
  $('#my-barangay-dropdown').ph_locations( 'fetch_list', [{"city_code": '<?php echo $_SESSION['city']; ?>'}]);

  setTimeout(function() {
    $('#my-province-dropdown').val('<?php echo $_SESSION['province']; ?>');
    $('#my-city-dropdown').val('<?php echo $_SESSION['city']; ?>');
    $('#my-barangay-dropdown').val('<?php echo $_SESSION['barangay']; ?>');
  }, delayInMilliseconds);


</script>

</body>
</html>