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
            <h1 class="m-0">Student Grading</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Student Grading</li>
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
                  <i class="fas fa-users"></i>
                  Student Information
                </h3>
                <div class="card-tools">
                 <!--  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link btn-success text-white" href="add_user.php?usertype=student">Add New Student &nbsp;<i class="fa fa-user-plus"></i></a>
                    </li>
                  </ul> -->
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <h3>Current Academic Year: <span style="color: darkred; font-weight: bold;"><?php if(!empty($active['academic_year'])) { echo $active['academic_year'];} else {echo "";}  ?></span></h3>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th><center>ID NUMBER</center></th>
                      <th><center>NAME</center></th>
                      <th><center>YEAR & SECTION</center></th>
                      <th><center>SUBJECT</center></th>
                      <th><center>1ST</center></th>
                      <th><center>2ND</center></th>
                      <th><center>3RD</center></th>
                      <th><center>4TH</center></th>
                      <th><center>AVERAGE</center></th>
                      <th><center>ACTION</center></th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php   


                          // $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id`, `teacher_id` FROM `tbl_student_schedule` WHERE teacher_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'];
                          $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id`, `teacher_id` FROM `tbl_student_schedule` WHERE student_id = '.$_GET['id'].' AND academic_year_id = '.$active['id'].' AND teacher_id = '.$_SESSION['id'];
                          $execStudSched = $conn->query($selectStudSched);

                          if ($execStudSched->num_rows > 0) {

                            while ($stud = $execStudSched->fetch_assoc() ) {

                          $selectSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE id = '.$stud['schedule_id'];
                          $execSched = $conn->query($selectSched);
                          $sched = $execSched->fetch_assoc();

                            $selectSub = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE id = '.$sched['subject_id'];
                            $execSub = $conn->query($selectSub);
                            $subject = $execSub->fetch_assoc();

                            $selectSched = ' SELECT `id`, `stud_schedule_id`, `first`, `second`, `third`, `fourth`, `average`, `academic_year_id`, `date_created` FROM tbl_grades WHERE stud_schedule_id = '.$stud['id'];
                            $execSched = $conn->query($selectSched);
                            $rowGrade = $execSched->fetch_assoc();

                            $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$stud['student_id'];
                            $exec = $conn->query($sql);
                            $row = $exec->fetch_assoc();
                           
                           //////////////
                            $selectSched = ' SELECT `id`, `stud_schedule_id`, `first`, `second`, `third`, `fourth`, `average`, `academic_year_id`, `date_created` FROM tbl_grades WHERE stud_schedule_id = '.$stud['id'];
                            $execSched = $conn->query($selectSched);

                            if ($execSched->num_rows > 0) 
                            {
                              $rowSched = $execSched->fetch_assoc();
                            }
                            else
                            {
                              $insertSched = ' INSERT INTO tbl_grades (stud_schedule_id, date_created) VALUES ('.$stud['id'].', NOW()) ';
                              $execInsertSched = $conn->query($insertSched);
                            }
                            ///////////////////////
                      ?>
                        <tr style="font-size: 14px;">
                          <td><?php echo $row['id_number']; ?></td>
                          <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                          <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td>
                          <td><?php echo $subject['subject_name']; ?></td>
                          <td><?php echo (empty($rowGrade['first']) ? 0 : $rowGrade['first']); ?></td>
                          <td><?php echo (empty($rowGrade['second']) ? 0 : $rowGrade['second']); ?></td>
                          <td><?php echo (empty($rowGrade['third']) ? 0 : $rowGrade['third']); ?></td>
                          <td><?php echo (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth']); ?></td>
                          <td>
                            <b>
                              <?php if ( empty($rowGrade['first']) || empty($rowGrade['second']) || empty($rowGrade['third']) || empty($rowGrade['fourth']) ): ?>
                                <?php echo 0; ?>
                              <?php else: ?>
                                <?php echo ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; ?>
                              <?php endif ?>
                            </b> 
                          </td>
                          <td>
                            <center>
                              <div class="btn-group">
                                <a href="view_student_grade.php?id=<?php echo $row['id']; ?>&sched_id=<?php echo $stud['id']; ?>" class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-placement="bottom" title="View Grades"><i class="fa fa-sync-alt"></i></a>
                              </div>
                            </center>
                          </td>
                        </tr>
                      <?php  } } ?>

                    </tbody>  

              <!--       <tfoot>
                    <tr>
                      <th><center>ID NUMBER</center></th>
                      <th><center>NAME</center></th>
                      <th><center>GENDER</center></th>
                      <th><center>EMAIL</center></th>
                      <th><center>CONTACT NUMBER</center></th>
                      <th><center>BIRTHDATE</center></th>
                      <th><center>ADDRES</center></th>
                      <th><center>YEAR & SECTION</center></th>
                      <th><center>ACTION</center></th>
                    </tr>
                    </tfoot> -->
                  </table>
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
    <!-- /.content --><!-- Previous -->

    <section class="col-lg-12">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-list"></i>
            All Grades
          </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link btn-success text-white" target="_blank" href="../student/print_all_grades.php?student_id=<?php echo $_GET['id']; ?>">Print All Records &nbsp;<i class="fa fa-print"></i></a>
              </li>
            </ul>
          </div>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content p-0">

            <?php 
              $sqlAcadYears = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` ORDER BY id ASC ';
              $execAcadYears = $conn->query($sqlAcadYears);
              while ($acadyears = $execAcadYears->fetch_assoc()) {
            ?>
                <h5><span style="color: darkred; font-weight: bold;"><?php echo $acadyears['academic_year']; ?></span></h5>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>CODE</th>
                    <th>SUBJECT</th>
                    <th>1ST</th>
                    <th>2ND</th>
                    <th>3RD</th>
                    <th>4TH</th>
                    <th>AVERAGE</th>
                  </tr>
                  </thead>
                    <tbody>

                      <?php   
                      $counter = 0;
                      $average_sum = 0;

                       

                          // $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id` FROM `tbl_student_schedule` WHERE student_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'];
                          $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id` FROM `tbl_student_schedule` WHERE student_id = '.$_GET['id'].' AND academic_year_id = '.$acadyears['id'];
                          $execStudSched = $conn->query($selectStudSched);
                          while ($stud = $execStudSched->fetch_assoc() ) {

                            $selectSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE id = '.$stud['schedule_id'];
                            $execSched = $conn->query($selectSched);
                            $sched = $execSched->fetch_assoc();

                            $selectSub = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE id = '.$sched['subject_id'];
                            $execSub = $conn->query($selectSub);
                            $subject = $execSub->fetch_assoc();

                            $selectSched = ' SELECT `id`, `stud_schedule_id`, `first`, `second`, `third`, `fourth`, `average`, `academic_year_id`, `date_created` FROM tbl_grades WHERE stud_schedule_id = '.$stud['id'];
                            $execSched = $conn->query($selectSched);
                            $rowGrade = $execSched->fetch_assoc();

                            $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$stud['student_id'];
                            $exec = $conn->query($sql);
                            $row = $exec->fetch_assoc();
                           
                      ?>
                        <tr style="font-size: 14px;">
                         <!--  <td><?php echo $row['id_number']; ?></td>
                          <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                          <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td> -->
                          <td><?php echo $subject['subject_code']; ?></td>
                          <td><?php echo $subject['subject_name']; ?></td>
                          <td><?php echo (empty($rowGrade['first']) ? 0 : $rowGrade['first']); ?></td>
                          <td><?php echo (empty($rowGrade['second']) ? 0 : $rowGrade['second']); ?></td>
                          <td><?php echo (empty($rowGrade['third']) ? 0 : $rowGrade['third']); ?></td>
                          <td><?php echo (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth']); ?></td>
                          <td>
                            <b>
                              <?php if ( empty($rowGrade['first']) || empty($rowGrade['second']) || empty($rowGrade['third']) || empty($rowGrade['fourth']) ): ?>
                                <?php echo 0; ?>
                              <?php else: ?>
                                <?php echo ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; ?>
                              <?php endif ?>
                            </b> 
                          </td>
                          <!-- <td>
                            <center>
                              <div class="btn-group">
                                <a href="view_student_grade.php?id=<?php echo $row['id']; ?>&sched_id=<?php echo $stud['id']; ?>" class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-placement="bottom" title="View Grades"><i class="fa fa-sync-alt"></i></a>
                              </div>
                            </center>
                          </td> -->
                        </tr>
                      <?php 
                      if ( empty($rowGrade['first']) || empty($rowGrade['second']) || empty($rowGrade['third']) || empty($rowGrade['fourth']) )
                      {
                        $average_sum = 0 ;
                      }
                      else
                      {
                        $average_sum = $average_sum + ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; 
                      }
                      $counter++; }  
                      ?>

                    </tbody>   
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>General Average:</b></td>
                        <?php if ($counter == 0): ?>
                          <td>0</td>
                        <?php else: ?>
                          <td><span style="color: darkred; font-weight: bold;"><?php echo number_format((float)$average_sum / $counter, 2, '.', ''); ?></span></td>
                        <?php endif ?>
                      </tr>
                    </tfoot>

                </table>

            <?php } ?>
          </div>
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
      <!-- /.card -->
    </section>
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
