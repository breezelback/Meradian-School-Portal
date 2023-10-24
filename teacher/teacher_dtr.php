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
            <h1 class="m-0">Daily Time Record</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Daily Time Record</li>
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
                      <th><center>YEAR</center></th>
                      <th><center>SECTION</center></th>
                      <th><center>DAY</center></th>
                      <th><center>TIME</center></th>
                      <th><center>TIME IN</center></th>
                      <th><center>TIME OUT</center></th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php   

                       

                          echo $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created` FROM tbl_student_schedule WHERE teacher_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'];
                          $execStudSched = $conn->query($selectStudSched);

                          if ($execStudSched->num_rows > 0) {

                            while ($schedule = $execStudSched->fetch_assoc()) {

                             $selectSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE id = '.$schedule['schedule_id'];
                            $execSched = $conn->query($selectSched);
                            $sched = $execSched->fetch_assoc();

                            $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$schedule['student_id'];
                            $exec = $conn->query($sql);
                            $student = $exec->fetch_assoc();
                           
                      ?>
                        <tr style="font-size: 14px;">
                          <td><?php echo $sched['school_year']; ?></td>
                          <td><?php echo $sched['section']; ?></td>
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
