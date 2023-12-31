<?php 
  require('../function_php/conn.php'); 
  $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$_GET['id'].' ';
  $exec = $conn->query($sql);
  $row = $exec->fetch_assoc();



  $selectProvince = ' SELECT provDesc FROM refprovince WHERE provCode = "'.$row['province'].'" ';
  $execProvince = $conn->query($selectProvince);
  $province = $execProvince->fetch_assoc();

  $selectCityMun = ' SELECT citymunDesc FROM refcitymun WHERE citymunCode = "'.$row['city'].'" ';
  $execCityMun = $conn->query($selectCityMun);
  $citymun = $execCityMun->fetch_assoc();

  $selectBarangay = ' SELECT brgyDesc FROM refbrgy WHERE brgyCode = "'.$row['barangay'].'" ';
  $execBarangay = $conn->query($selectBarangay);
  $barangay = $execBarangay->fetch_assoc();

  $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
  $exec1 = $conn->query($sql1);
  $active = $exec1->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Meradian School | Admin Portal</title>

  <?php include '_include_header.php'; ?>
  <style>
    .schedule_day
    {
      background-color: seagreen;
      padding: 2.5px;
      color: white;
      border-radius: 5px;
      margin: 3px;
    }
  </style>
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
                  <a class="nav-link btn btn-warning text-white" href="teachers.php"><i class="fa fa-arrow-left"></i> Back</a>  
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  
                    <div class="row">
                      <div class="col-md-2">
                        <img src="../images/user_image.jpg" alt="" width="100">
                      </div>
                      <div class="col-sm-3 form-group">
                        ID Number: <label for="name-f"><?php echo $row['id_number']; ?></label><br>
                        Name:<label for="name-f"> <?php echo $row['firstname'].' '.$row['lastname']; ?></label><br>
                        Address:<label for="name-f"> <?php echo $row['house_no'].' '.$barangay['brgyDesc'].' '.$citymun['citymunDesc'].' '.$province['provDesc']; ?></label>
                      </div>
                      <div class="col-sm-3 form-group">
                        Contact Number:<label for="name-f"> <?php echo $row['contact_number']; ?></label><br>
                        Email:<label for="name-f"> <?php echo $row['email']; ?></label><br>
                        Gender:<label for="name-f"> <?php echo $row['gender']; ?></label><br>
                      </div>
                      <div class="col-sm-3 form-group">
                        Date of Birth:<label for="name-f"> <?php echo $row['birthdate']; ?></label><br>
                        Year | Section :<label for="name-f"> <?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></label><br>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                      <button type="button" class="btn btn-primary text-white float-sm-right" data-toggle="modal" data-target="#modal_add_schedule">Add New Schedule &nbsp;<i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th><center>SUBJECT NAME</center></th>
                            <th><center>CODE</center></th>
                            <th><center>YEAR</center></th>
                            <th><center>SECTION</center></th>
                            <th><center>SCHEDULE</center></th>
                            <th><center>ACTION</center></th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sql = ' 
                              SELECT a.id, 
                                    a.teacher_id, 
                                    a.subject_id, 
                                    a.teaching_day, 
                                    a.teaching_time, 
                                    a.schedule_code, 
                                    a.status,
                                    a.date_created , 
                                    a.teaching_time_to, 
                                    a.monday,
                                    a.tuesday,
                                    a.wednesday,
                                    a.thursday,
                                    a.friday,
                                    a.saturday,
                                    a.sunday,
                                    a.school_year,
                                    -- a.section,
                                    b.subject_name,
                                    b.subject_code,
                                    c.section
                                FROM tbl_schedule a
                                LEFT JOIN tbl_subject b ON b.id = a.subject_id
                                LEFT JOIN tbl_section c ON c.id = a.section
                                WHERE teacher_id = '.$_GET['id'].' ';
                              $exec = $conn->query($sql);
                              while ( $sub = $exec->fetch_assoc() ) {
                            ?>
                              <tr style="font-size: 14px;">
                                <td><center><?php echo $sub['subject_name']; ?></center></td>
                                <td><center><?php echo $sub['subject_code']; ?></center></td>
                                <td><center><?php echo $sub['school_year']; ?></center></td>
                                <td><center><?php echo $sub['section']; ?></center></td>
                                <td><center>  
                                  
                                  <?php echo ($sub['monday'] == true ? "<span class='schedule_day'>Monday</span>" : "" ); ?> 
                                  <?php echo ($sub['tuesday'] == true ? "<span class='schedule_day'>Tuesday</span>" : "" ); ?> 
                                  <?php echo ($sub['wednesday'] == true ? "<span class='schedule_day'>Wednesday</span>" : "" ); ?> 
                                  <?php echo ($sub['thursday'] == true ? "<span class='schedule_day'>Thursday</span>" : "" ); ?> 
                                  <?php echo ($sub['friday'] == true ? "<span class='schedule_day'>Friday</span>" : "" ); ?> 
                                  <?php echo ($sub['saturday'] == true ? "<span class='schedule_day'>Saturday</span>" : "" ); ?> 
                                  <?php echo ($sub['sunday'] == true ? "<span class='schedule_day'>Sunday</span>" : "" ); ?> 
                                | <b><?php echo date('h:i A', strtotime($sub['teaching_time'])); ?> - <?php echo date('h:i A', strtotime($sub['teaching_time_to'])); ?></b></center></td>
                                <td><center>
                                  <div class="btn-group">
                                    <!-- <a href="edit_user.php?id=<?php echo $sub['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> -->
                                    <a href="../function_php/delete_schedule.php?id=<?php echo $sub['id']; ?>&user_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                    <!-- <a href="view_teacher.php?id=<?php echo $sub['id']; ?>" class="btn btn-warning btn-sm text-white"><i class="fa fa-cog"></i></a> -->
                                  </div></center>
                                </td>
                              </tr>
                            <?php } ?>

                          </tbody>  

                        </table>
                      </div>
                    </div>  

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

   <!-- Modal -->
  <form action="../function_php/add_schedule.php" method="POST">
    <div class="modal fade" id="modal_add_schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Teacher Schedule </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input disabled="" type="text" class="form-control" name="subject_code" id="subject_code" placeholder="<?php echo $row['id_number']; ?> | <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>">
            <input type="hidden" name="teacher_id" value="<?php echo $row['id']; ?>">
            <label for="email" style="color: grey;">Year</label>
            <select class="form-control" name="school_year" id="school_year">
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
            <label for="name-l" style="color: grey;">Section</i></label>
            <select class="form-control" name="section" id="section" required="">
              
            </select>
            <label for="name-l" style="color: grey;">Subject</i></label>
            <select class="form-control" name="subject_id" id="subject" required="">
              
            </select>
            <label for="name-l" style="color: grey;">Time</i></label>
            <div class="row">
              <div class="col-sm-6">
                <input type="time" class="form-control" name="teaching_time">
              </div>
              <div class="col-sm-6">
                <input type="time" class="form-control" name="teaching_time_to">
              </div>
            </div>

            <label for="name-l" style="color: grey;">Day</i></label>
            <div class="row">
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="true" name="monday">Monday
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="sss" name="tuesday">Tuesday
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="true" name="wednesday">Wednesday
                  </label>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="true" name="thursday">Thursday
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="true" name="friday">Friday
                  </label>
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="true" name="saturday">Saturday
                  </label>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" value="true" name="sunday">Sunday
                  </label>
                </div>
              </div>
            </div>

          </div>
          <div class="modal-footer">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </div>
    </div>
  </form>

  <?php include'_footer.php'; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php include'_include_footer.php'; ?>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });


  $('#school_year').on('change', function(){
    let year_val = $(this).val();
    
    //section
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
    
    //subject
    $.ajax({  
      url:"../function_php/fetch_subject.php?school_year="+year_val, 
      method:"POST",  
      contentType:false,
      cache:false,
      processData:false,

      beforeSend:function() {
      }, 

      success:function(data){  
        $('#subject').empty();
        // $('#subject')
        //   .append($("<option></option>")
        //   .attr("value", "")
        //   .text("All")); 

        if (data != '') 
        {
          var jsArray = JSON.parse(data);
          $.each(jsArray, function(key, value) {   
            $('#subject')
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
