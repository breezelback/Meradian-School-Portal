<?php require('../function_php/conn.php'); 

  $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
  $exec1 = $conn->query($sql1);
  $active = $exec1->fetch_assoc();
?>

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

  $studLia = ' SELECT `id`, `student_id`, `academic_year_id`, `amount`, `status`, `date_created` FROM `tbl_liabilities` WHERE student_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'].' ';
  $execLia = $conn->query($studLia);


  require('../function_php/conn.php'); 
  $sqlX = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$_SESSION['id'].' ';
  $execX = $conn->query($sqlX);
  $rowX = $execX->fetch_assoc();


  $selectProvince = ' SELECT provDesc FROM refprovince WHERE provCode = "'.$rowX['province'].'" ';
  $execProvince = $conn->query($selectProvince);
  $province = $execProvince->fetch_assoc();

  $selectCityMun = ' SELECT citymunDesc FROM refcitymun WHERE citymunCode = "'.$rowX['city'].'" ';
  $execCityMun = $conn->query($selectCityMun);
  $citymun = $execCityMun->fetch_assoc();

  $selectBarangay = ' SELECT brgyDesc FROM refbrgy WHERE brgyCode = "'.$rowX['barangay'].'" ';
  $execBarangay = $conn->query($selectBarangay);
  $barangay = $execBarangay->fetch_assoc();

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
      <!--   <div class="row">
          <div class="col-lg-3 col-6">
            
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
          
          <div class="col-lg-3 col-6">
            
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
          ./col
          <div class="col-lg-3 col-6">
            
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
          
          <div class="col-lg-3 col-6">
            
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
          
        </div> -->
        <div class="row">

           <div class="col-lg-6 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $active['academic_year']; ?></h3>
                <p>Current Academic Year</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>

           <div class="col-lg-6 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>
                  <?php 
                  $sql1 = 'SELECT `id`, `academic_year_id`, `student_id`, `status`, `date_created`, `date_drop` FROM `tbl_enrollment` WHERE academic_year_id = '.$active['id'].' AND student_id = '.$_SESSION['id'].' ';
                  $exec1 = $conn->query($sql1);
                  if ($exec1->num_rows > 0) 
                  {
                    $stud = $exec1->fetch_assoc();
                    if ($stud['status'] == 'Drop') 
                    {
                      echo "Dropped";
                    }
                    else if ($stud['status'] == 'Enrolled')
                    {
                      echo "Enrolled";
                      echo '&nbsp;<a href="certificateofenrollment.php" target="_blank" class="btn btn-warning text-white">Print Certificate of Enrollment <i class="fa fa-print"></i></a>';
                    }
                    else
                    {
                      echo "Pending Enrollment";
                    } 
                  }
                  else
                  {
                    ?>
                     Not Enrolled
                     <?php if ($execLia->num_rows > 0): ?>
                      <button class="btn btn-warning btn-sm text-white" disabled="" onclick="enroll_now(<?php echo $_SESSION['id']; ?>);">Enroll Now!</button>
                     <?php else: ?>
                      <!-- <button class="btn btn-warning btn-sm text-white" onclick="enroll_now(<?php echo $_SESSION['id']; ?>);">Enroll Now!</button> -->
                      <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#modalInformation">Enroll Now!</button>
                     <?php endif ?>
                    <?php
                  }

                  ?>
                </h3>
                <p>Academic Status</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
            </div>
          </div>

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
                    <?php if ($_SESSION['profile_picture'] == ""): ?>
                      <img src="../images/user_image.jpg" class="img-circle elevation-2" alt="User Image" width="100">
                    <?php else: ?>
                      <img src="../images/user/<?php echo $_SESSION['profile_picture']; ?>" class="img-circle elevation-2" alt="User Image" width="100">
                    <?php endif ?>
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
                          <input type="text" class="form-control" placeholder="House No." aria-describedby="basic-addon1" value="<?php echo $province['provDesc']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">City:</span>
                        </div>
                          <input type="text" class="form-control" placeholder="House No." aria-describedby="basic-addon1" value="<?php echo $citymun['citymunDesc']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">Barangay:</span>
                        </div>
                          <input type="text" class="form-control" placeholder="House No." aria-describedby="basic-addon1" value="<?php echo $barangay['brgyDesc']; ?>" readonly="" style="background-color: #fff;">
                      </div>
                      <div class="input-group my-2">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1">House # / Purok:</span>
                        </div>
                          <input type="text" class="form-control" placeholder="House No." aria-describedby="basic-addon1" value="<?php echo $_SESSION['house_no']; ?>" readonly="" style="background-color: #fff;">
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

  <!-- Modal -->
  <div class="modal fade" id="modalInformation" tabindex="-1" role="dialog" aria-labelledby="modalInformationLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalInformationLabel">Enrollment</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-sm-12">
              <center>
                Subject List
                <?php
                $selectSubject = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE school_year = "'.$_SESSION['school_year'].'" ';
                $execSubject = $conn->query($selectSubject);
                while($subject = $execSubject->fetch_assoc()){
                ?>
                  <input class="form-control my-1" type="text" value="<?php echo $subject['subject_code'];?> | <?php echo $subject['subject_name'];?>" readonly="">
                <?php } ?>
                <hr>
                Tuition Fee
                <table class="table table-bordered">
                  <tr>
                    <td>Tuition Fee</td>
                    <td>₱10,000</td>
                  </tr>
                  <tr>
                    <td>Other School Fee</td>
                    <td>₱3,000</td>
                  </tr>
                  <tr>
                    <td>Miscellaneous Fees</td>
                    <td>₱1,500</td>
                  </tr>
                  <tr></tr>
                  <tr>
                    <td><b>TOTAL</b></td>
                    <td><b>₱14,500</b></td>
                  </tr>
                </table>
              </center>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <?php if ($execSubject->num_rows > 0): ?>
            <button type="button" class="btn btn-primary" onclick="enroll_now(<?php echo $_SESSION['id']; ?>);">Enroll Now</button>
          <?php else: ?>
            <button type="button" class="btn btn-primary" disabled="" onclick="enroll_now(<?php echo $_SESSION['id']; ?>);">Enroll Now</button>
          <?php endif ?>
        </div>
      </div>
    </div>
  </div>

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
  
  // var delayInMilliseconds = 2000; //1 second


  // $('#my-province-dropdown').ph_locations({'location_type': 'provinces'});
  // $('#my-province-dropdown').ph_locations( 'fetch_list');
  // $('#my-city-dropdown').ph_locations({'location_type': 'cities'});
  // $('#my-city-dropdown').ph_locations( 'fetch_list', [{"province_code": '<?php echo $_SESSION['province']; ?>'}]);

  // $('#my-barangay-dropdown').ph_locations({'location_type': 'barangays'});
  // $('#my-barangay-dropdown').ph_locations( 'fetch_list', [{"city_code": '<?php echo $_SESSION['city']; ?>'}]);

  // setTimeout(function() {
  //   $('#my-province-dropdown').val('<?php echo $_SESSION['province']; ?>');
  //   $('#my-city-dropdown').val('<?php echo $_SESSION['city']; ?>');
  //   $('#my-barangay-dropdown').val('<?php echo $_SESSION['barangay']; ?>');
  // }, delayInMilliseconds);

  function enroll_now(id)
  {
    if (confirm('Are you sure you want to enroll for Academic Year'+ ' <?php echo $active['academic_year']; ?>?')) {
      window.location.href = "../function_php/submit_enrollment.php?id="+id+"&academic_year_id="+"<?php echo $active['id']; ?>";
    } else {
      // Do nothing!
    }
  }
</script>

</body>
</html>
