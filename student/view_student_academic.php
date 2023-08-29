

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Meradian School | Student Portal</title>

  <?php include '_include_header.php'; 

  require('../function_php/conn.php'); 
  $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$_SESSION['id'].' ';
  $exec = $conn->query($sql);
  $row = $exec->fetch_assoc();


?>
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
            <h1 class="m-0">View Academic Record</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Academic Record</li>
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
                  <!-- <a class="nav-link btn btn-warning text-white" href="students.php"><i class="fa fa-arrow-left"></i> Back</a>   -->
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
                        Address:<label for="name-f"> <?php echo $row['house_no'].' '.$row['barangay'].' '.$row['city'].' '.$row['province']; ?></label>
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
                        <table id="example1" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th><center>CODE</center></th>
                            <th><center>SUBJECT NAME</center></th>
                            <th><center>PROFESSOR</center></th>
                            <th><center>SCHEDULE</center></th>
                            <th><center>ACTION</center></th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sql = ' 
                              SELECT 
                                    x.student_id,
                                    x.schedule_id,
                                    a.id, 
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
                                    b.subject_name,
                                    b.subject_code,
                                    c.id_number,
                                    c.firstname,
                                    c.lastname,
                                    c.middlename
                                FROM tbl_student_schedule x
                                LEFT JOIN tbl_schedule a ON a.id = x.schedule_id
                                LEFT JOIN tbl_subject b ON b.id = a.subject_id
                                LEFT JOIN tbl_user c ON c.id = a.teacher_id
                                WHERE student_id = '.$_SESSION['id'].' ';
                              $exec = $conn->query($sql);
                              while ( $sub = $exec->fetch_assoc() ) {
                            ?>
                              <tr style="font-size: 14px;">
                                <td><center><?php echo $sub['subject_code']; ?></center></td>
                                <td><center><?php echo $sub['subject_name']; ?></center></td>
                                <td><center><?php echo $sub['firstname']; ?> <?php echo $sub['lastname']; ?></center></td>
                                <td><center>

                                    <?php echo ($sub['monday'] == true ? "<span class='schedule_day'>Monday</span>" : "" ); ?>
                                    <?php echo ($sub['tuesday'] == true ? "<span class='schedule_day'>Tuesday</span>" : "" ); ?> 
                                    <?php echo ($sub['wednesday'] == true ? "<span class='schedule_day'>Wednesday</span>" : "" ); ?> 
                                    <?php echo ($sub['thursday'] == true ? "<span class='schedule_day'>Thursday</span>" : "" ); ?> 
                                    <?php echo ($sub['friday'] == true ? "<span class='schedule_day'>Friday</span>" : "" ); ?> 
                                    <?php echo ($sub['saturday'] == true ? "<span class='schedule_day'>Saturday</span>" : "" ); ?> 
                                    <?php echo ($sub['sunday'] == true ? "<span class='schedule_day'>Sunday</span>" : "" ); ?> 

                                | <?php echo date('h:i A', strtotime($sub['teaching_time'])); ?> - <?php echo date('h:i A', strtotime($sub['teaching_time_to'])); ?></center></td>
                                <td><center>
                                  <div class="btn-group">
                                    <a href="edit_user.php?id=<?php echo $sub['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="../function_php/delete_schedule.php?id=<?php echo $sub['id']; ?>&user_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                    <a href="view_teacher.php?id=<?php echo $sub['id']; ?>" class="btn btn-warning btn-sm text-white"><i class="fa fa-cog"></i></a>
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
  <form action="../function_php/add_student_schedule.php" method="POST">
    <div class="modal fade" id="modal_add_schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Subject Schedule </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
<!--             <input disabled="" type="text" class="form-control" name="subject_code" id="subject_code" placeholder="<?php echo $row['id_number']; ?> | <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>">
            <label for="name-l" style="color: grey;">Subject</i></label>
            <input type="hidden" name="teacher_id" value="<?php echo $row['id']; ?>">
            <select class="form-control" name="subject_id" id="subject_id">
              <?php 
                $sql = ' SELECT `id`, `subject_name`, `subject_code`, `date_created` FROM `tbl_subject` ';
                $exec = $conn->query($sql);
                while ($sub = $exec->fetch_assoc()) {
               ?>
               <option value="<?php echo $sub['id']; ?>"><?php echo $sub['subject_name']; ?></option>

              <?php } ?>
            </select>
            <label for="name-l" style="color: grey;">Day</i></label>
            <select class="form-control" name="teaching_day" id="teaching_day">
              <option value="Monday">Monday</option>
              <option value="Tuesday">Tuesday</option>
              <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
              <option value="Friday">Friday</option>
              <option value="Saturday">Saturday</option>
              <option value="Sunday">Sunday</option>
            </select>
            <label for="name-l" style="color: grey;">Time</i></label>
            <input type="time" class="form-control" name="teaching_time"> -->
            <input type="hidden" value="<?php echo $row['id']; ?> " name="student_id">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><center></center></th>
                  <th><center>CODE</center></th>
                  <th><center>SUBJECT NAME</center></th>
                  <th><center>PROFESSOR</center></th>
                  <th><center>SCHEDULE</center></th>
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
                          b.subject_name,
                          b.subject_code,
                          c.id_number,
                          c.firstname,
                          c.lastname,
                          c.middlename
                      FROM tbl_schedule a
                      LEFT JOIN tbl_subject b ON b.id = a.subject_id
                      LEFT JOIN tbl_user c ON c.id = a.teacher_id
                      WHERE a.id NOT IN (SELECT schedule_id FROM tbl_student_schedule WHERE student_id = '.$_GET['id'].')
                      ';
                    $exec = $conn->query($sql);
                    while ( $sub = $exec->fetch_assoc() ) {
                  ?>
                    <tr style="font-size: 14px;">
                      <td><center><input type="checkbox" value="<?php echo $sub['id']; ?>" name="check_id[]"></center></td>
                      <td><center><?php echo $sub['subject_code']; ?></center></td>
                      <td><center><?php echo $sub['subject_name']; ?></center></td>
                      <td><center><?php echo $sub['firstname']; ?> <?php echo $sub['lastname']; ?></center></td>
                      <td><center>
                          <?php echo ($sub['monday'] == true ? "<span class='schedule_day'>Monday</span>" : "" ); ?>
                          <?php echo ($sub['tuesday'] == true ? "<span class='schedule_day'>Tuesday</span>" : "" ); ?> 
                          <?php echo ($sub['wednesday'] == true ? "<span class='schedule_day'>Wednesday</span>" : "" ); ?> 
                          <?php echo ($sub['thursday'] == true ? "<span class='schedule_day'>Thursday</span>" : "" ); ?> 
                          <?php echo ($sub['friday'] == true ? "<span class='schedule_day'>Friday</span>" : "" ); ?> 
                          <?php echo ($sub['saturday'] == true ? "<span class='schedule_day'>Saturday</span>" : "" ); ?> 
                          <?php echo ($sub['sunday'] == true ? "<span class='schedule_day'>Sunday</span>" : "" ); ?> 

                      | <?php echo date('h:i A', strtotime($sub['teaching_time'])); ?> - <?php echo date('h:i A', strtotime($sub['teaching_time_to'])); ?></center></td>
                    </tr>
                  <?php } ?>

                </tbody>  

              </table>

            <!-- modalbodyend -->
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
</script>

</body>
</html>
