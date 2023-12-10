<?php 
  require('../function_php/conn.php'); 
  $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$_GET['id'].' ';
  $exec = $conn->query($sql);
  $row = $exec->fetch_assoc();


  $selectSection = 'SELECT `id`, `school_year`, `section`, `status`, `date_created` FROM `tbl_section` WHERE id = '.$row['section'];
  $execSection = $conn->query($selectSection);
  $section = $execSection->fetch_assoc();
?>

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
            <h1 class="m-0">Update Data</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Update Data</li>
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
                  <button class="nav-link btn btn-warning text-white" onclick="javascript:history.go(-1)"><i class="fa fa-arrow-left"></i> Back</button>  
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  
                  <form action="../function_php/update_data.php?id=<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-4">
                        Profile Picture
                        <?php if ($row['profile_picture'] == ""): ?>
                          <img src="../images/user_image.jpg" alt="" width="100">
                        <?php else: ?>
                          <img src="../images/user/<?php echo $row['profile_picture']; ?>" alt="" width="100">
                        <?php endif ?>
                        <input type="file" class="mt-2" name="profile_picture" id="profile_picture" value="<?php echo $row['profile_picture']; ?>">
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-4 form-group">
                        <label for="name-f">ID Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="id_number" value="<?php echo $row['id_number']; ?>" id="id_number" placeholder="Enter ID Number">
                      </div>
                      <div class="col-sm-4 form-group">
                        <label for="name-f">Password</label> &nbsp; <input type="checkbox" id="show_password" onclick="showPass()"> Show Password
                        <input type="password" class="form-control" name="password" value="<?php echo $row['password']; ?>" id="password">
                      </div>
                      <div class="col-sm-4 form-group">
                        <label for="name-f">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" value="<?php echo $row['password']; ?>" id="confirm_password">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-4 form-group">
                        <label for="name-f">First Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="firstname" value="<?php echo $row['firstname']; ?>" id="firstname" placeholder="Enter first name.">
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="name-l">Middle Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="middlename" value="<?php echo $row['middlename']; ?>" id="middlename" placeholder="Enter middle name.">
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="name-l">Last name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="lastname" value="<?php echo $row['lastname']; ?>" id="lastname" placeholder="Enter last name.">
                      </div>
                      <div class="col-sm-2 form-group">
                        <label for="name-l" style="color: grey;">Suffix <i>(ex. Jr. Sr. II.)</i></label>
                        <input type="text" class="form-control" name="suffix" value="<?php echo $row['suffix']; ?>" id="suffix" placeholder="Enter name extension.">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-2 form-group">
                        <label for="email">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                          <option value="Male" <?php if($row['gender'] == "Male") {echo 'selected';} ?>>Male</option>
                          <option value="Female" <?php if($row['gender'] == "Female") {echo 'selected';} ?>>Female</option>
                        </select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" value="<?php echo $row['email']; ?>" id="email" placeholder="Enter email.">
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Contact Number</label>
                        <input type="number" class="form-control" name="contact_number" value="<?php echo $row['contact_number']; ?>" id="contact_number" placeholder="Enter Contact Number.">
                      </div>
                      <div class="col-sm-2 form-group">
                        <label for="email">Telephone Number</label>
                        <input type="number" class="form-control" name="telephone" value="<?php echo $row['telephone']; ?>" id="telephone" placeholder="Enter Telephone Number.">
                      </div>
                      <div class="col-sm-2 form-group">
                        <label for="email">Date of Birth</label>
                        <input type="date" class="form-control" name="birthdate" value="<?php echo date('Y-m-d', strtotime($row['birthdate'])); ?>" id="birthdate">
                      </div>
                    </div>
                    <div class="row"><b class="text-primary">Home Address</b></div><hr>
                    <div class="row">
                      <div class="col-sm-3 form-group">
                        <label for="email">Province</label>
                        <select class="form-control" name="province" value="<?php echo $row['province']; ?>" id="my-province-dropdown"></select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">City</label>
                        <select class="form-control" name="city" value="<?php echo $row['city']; ?>" id="my-city-dropdown"></select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Barangay</label>
                        <select class="form-control" name="barangay" value="<?php echo $row['barangay']; ?>" id="my-barangay-dropdown"></select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Purok/House No./Sub</label>
                        <input type="text" class="form-control" name="house_no" value="<?php echo $row['house_no']; ?>" id="house_no">
                      </div>
                    </div>

                    <div class="row"><b class="text-primary">Academic Information</b></div><hr>
                    <div class="row">
                      <div class="col-sm-3 form-group">
                        <label for="email">Year</label>
                        <select class="form-control" name="school_year" id="school_year">
                          <option value="Kinder" <?php if($row['school_year'] == "Kinder") {echo 'selected';} ?>>Kinder</option>
                          <option value="Grade 1" <?php if($row['school_year'] == "Grade 1") {echo 'selected';} ?>>Grade 1</option>
                          <option value="Grade 2" <?php if($row['school_year'] == "Grade 2") {echo 'selected';} ?>>Grade 2</option>
                          <option value="Grade 3" <?php if($row['school_year'] == "Grade 3") {echo 'selected';} ?>>Grade 3</option>
                          <option value="Grade 4" <?php if($row['school_year'] == "Grade 4") {echo 'selected';} ?>>Grade 4</option>
                          <option value="Grade 5" <?php if($row['school_year'] == "Grade 5") {echo 'selected';} ?>>Grade 5</option>
                          <option value="Grade 6" <?php if($row['school_year'] == "Grade 6") {echo 'selected';} ?>>Grade 6</option>
                          <option value="Grade 7" <?php if($row['school_year'] == "Grade 7") {echo 'selected';} ?>>Grade 7</option>
                          <option value="Grade 8" <?php if($row['school_year'] == "Grade 8") {echo 'selected';} ?>>Grade 8</option>
                          <option value="Grade 9" <?php if($row['school_year'] == "Grade 9") {echo 'selected';} ?>>Grade 9</option>
                          <option value="Grade 10" <?php if($row['school_year'] == "Grade 10") {echo 'selected';} ?>>Grade 10</option>
                          <option value="Grade 11" <?php if($row['school_year'] == "Grade 11") {echo 'selected';} ?>>Grade 11</option>
                          <option value="Grade 12" <?php if($row['school_year'] == "Grade 12") {echo 'selected';} ?>>Grade 12</option>
                          <option value="First Year" <?php if($row['school_year'] == "First Year") {echo 'selected';} ?>>First Year</option>
                          <option value="Second Year" <?php if($row['school_year'] == "Second Year") {echo 'selected';} ?>>Second Year</option>
                          <option value="Third Year" <?php if($row['school_year'] == "Third Year") {echo 'selected';} ?>>Third Year</option>
                          <option value="Fourth Year" <?php if($row['school_year'] == "Fourth Year") {echo 'selected';} ?>>Fourth Year</option>
                        </select>
                      </div>
                      <div class="col-sm-3 form-group">
                        <label for="email">Section</label>
                        <!-- <input type="text" class="form-control" name="section" value="<?php echo $row['section']; ?>" id="section"> -->
                        <select type="text" class="form-control" name="section" id="section">
                          <option value="<?php echo $section['id']; ?>"><?php echo $section['section']; ?></option>
                        </select>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <center><button type="submit" class="btn btn-lg btn-success">Update <i class="fa fa-edit"></i></button></center>
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
  
  var delayInMilliseconds = 2000; //1 second


  $('#my-province-dropdown').ph_locations({'location_type': 'provinces'});
  $('#my-province-dropdown').ph_locations( 'fetch_list');
  $('#my-city-dropdown').ph_locations({'location_type': 'cities'});
  $('#my-city-dropdown').ph_locations( 'fetch_list', [{"province_code": '<?php echo $row['province']; ?>'}]);

  $('#my-barangay-dropdown').ph_locations({'location_type': 'barangays'});
  $('#my-barangay-dropdown').ph_locations( 'fetch_list', [{"city_code": '<?php echo $row['city']; ?>'}]);

  setTimeout(function() {
    $('#my-province-dropdown').val('<?php echo $row['province']; ?>');
    $('#my-city-dropdown').val('<?php echo $row['city']; ?>');
    $('#my-barangay-dropdown').val('<?php echo $row['barangay']; ?>');
  }, delayInMilliseconds);



  //-------------------------
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

  $('#school_year').on('change', function(){
    let year_val = $(this).val();
    
    $.ajax({  
      url:"../function_php/fetch_section.php?school_year="+year_val, 
      method:"POST",  
      contentType:false,
      cache:false,
      processData:false,

      beforeSend:function() {
      }, 

      success:function(data){  
        $('#section').empty();
        // $('#section')
        //   .append($("<option></option>")
        //   .attr("value", "")
        //   .text("All")); 

        if (data != '') 
        {
          var jsArray = JSON.parse(data);
          $.each(jsArray, function(key, value) {   
            $('#section')
            .append($("<option></option>")
            .attr("value", key)
            .text(value)); 
          });
        }
      }

    });  


  });

</script>

</body>
</html>
