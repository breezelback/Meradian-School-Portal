<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Meradian School | Admin Portal</title>

  <?php include '_include_header.php'; ?>
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
            <h1 class="m-0">Add New <?php echo strtoupper($_GET['usertype']); ?></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Add New <?php echo strtoupper($_GET['usertype']); ?></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <?php if ($_GET['usertype'] == "student"): ?>
                    <a class="nav-link btn btn-warning text-white" href="students.php"><i class="fa fa-arrow-left"></i> Back</a> 
                  <?php else: ?>
                    <a class="nav-link btn btn-warning text-white" href="teachers.php"><i class="fa fa-arrow-left"></i> Back</a> 
                  <?php endif ?>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <form action="../function_php/insert_user_data.php?usertype=<?php echo $_GET['usertype']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        Profile Picture
                        <img src="../images/user_image.jpg" alt="" width="100">
                        <input type="file" class="mt-2" name="profile_picture" id="profile_picture">
                      </div>
                      <div class="col-md-4"></div>
                      <!-- <div class="col-md-4">
                         <?php if ($_GET['usertype'] == "student"): ?>
                          <label for="name-f">Enrollment Status <span class="text-danger">*</span></label>
                          <select name="enrollment_status" id="enrollment_status" class="form-control">
                            <option value="Enrolled">Enrolled</option>
                            <option value="Not Enrolled">Not Enrolled</option>
                          </select>
                        <?php endif ?>
                      </div> -->
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4 form-group">
                        <label for="name-f">ID Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="id_number" id="id_number" placeholder="Enter ID Number" required="">
                      </div>
                      <div class="col-sm-4 form-group">
                        <label for="name-f">Default Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter ID Number">
                      </div>
                      <div class="col-sm-1 form-group"></div>
                      <div class="col-sm-3 form-group">
                        <?php if ($_GET['usertype'] == "student"): ?>
                          <label for="name-f">Student Type <span class="text-danger">*</span></label>
                          <select name="student_status" id="student_status" class="form-control">
                            <option value="New">New</option>
                            <option value="Transferee">Transferee</option>
                          </select>
                        <?php endif ?>
                      </div>
                    </div>


                    
                    <div class="row">
                      <div class="col-sm-4 form-group">
                        <label for="name-f">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Enter first name." required="">
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="name-l">Middle Name</label>
                        <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Enter middle name.">
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="name-l">Last name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Enter last name." required="">
                      </div>
                      <div class="col-sm-2 form-group">
                        <label for="name-l" style="color: grey;">Suffix <i>(ex. Jr. Sr. II.)</i></label>
                        <input type="text" class="form-control" name="suffix" id="suffix" placeholder="Enter name extension.">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2 form-group">
                        <label for="email">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter email." required="">
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Contact Number <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="contact_number" id="contact_number" placeholder="Enter Contact Number." required="">
                      </div>
                      <div class="col-sm-2 form-group">
                        <label for="email">Telephone Number</label>
                        <input type="number" class="form-control" name="telephone" id="telephone" placeholder="Enter Telephone Number.">
                      </div>
                      <div class="col-sm-2 form-group">
                        <label for="email">Date of Birth <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" name="birthdate" id="birthdate" required="">
                      </div>
                    </div>
                    <div class="row"><b class="text-primary">Home Address <span class="text-danger">*</span></b></div><hr>
                    <div class="row">
                      <div class="col-sm-3 form-group">
                        <label for="email">Province</label>
                        <select class="form-control" name="province" id="my-province-dropdown"></select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">City</label>
                        <select class="form-control" name="city" id="my-city-dropdown" required=""></select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Barangay</label>
                        <select class="form-control" name="barangay" id="my-barangay-dropdown" required=""></select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Purok/House No./Sub</label>
                        <input type="text" class="form-control" name="house_no" id="house_no" required="">
                      </div>
                    </div>

                    <div class="row"><b class="text-primary">Academic Information</b></div><hr>
                    <div class="row">
                      <div class="col-sm-3 form-group">
                        <label for="email">Year</label>
                        <select class="form-control" name="school_year">
                          <option value="Kinder">Kinder</option>
                          <option value="Grade 1">Grade 1</option>
                          <option value="Grade 2">Grade 2</option>
                          <option value="Grade 3">Grade 3</option>
                          <option value="Grade 4">Grade 4</option>
                          <option value="Grade 5">Grade 5</option>
                          <option value="Grade 6">Grade 6</option>
                          <option value="Grade 7">Grade 7</option>
                          <option value="Grade 8">Grade 8</option>
                          <option value="Grade 9">Grade 9</option>
                          <option value="Grade 10">Grade 10</option>
                          <option value="Grade 11">Grade 11</option>
                          <option value="Grade 12">Grade 12</option>
                          <option value="First Year">First Year</option>
                          <option value="Second Year">Second Year</option>
                          <option value="Third Year">Third Year</option>
                          <option value="Fourth Year">Fourth Year</option>
                        </select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Section</label>
                        <input type="text" class="form-control" name="section" id="section">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <center><button type="submit" class="btn btn-lg btn-success">Save</button></center>
                      </div>
                    </div>    

                  </form>

                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
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
  $('#my-province-dropdown').ph_locations({'location_type': 'provinces'});
  $('#my-province-dropdown').ph_locations( 'fetch_list');


  $('#my-province-dropdown').on('change', function(){
    $('#my-city-dropdown').prop('selectedIndex',0);
    $('#my-barangay-dropdown').empty();
    $('#my-city-dropdown').ph_locations({'location_type': 'cities'});
    $('#my-city-dropdown').ph_locations( 'fetch_list', [{"province_code": this.value}]);
  });

  $('#my-city-dropdown').on('change', function(){
    $('#my-barangay-dropdown').prop('selectedIndex',0);
    $('#my-barangay-dropdown').ph_locations({'location_type': 'barangays'});
    $('#my-barangay-dropdown').ph_locations( 'fetch_list', [{"city_code": this.value}]);
  });

</script>

</body>
</html>
