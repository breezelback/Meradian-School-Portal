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
                          $selectStudSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE teacher_id = '.$_SESSION['id'].' AND id IN (SELECT schedule_id FROM tbl_student_schedule WHERE academic_year_id = '.$active['id'].') GROUP BY school_year, section ';
                          $execStudSched = $conn->query($selectStudSched);

                          if ($execStudSched->num_rows > 0) {

                            while ($schedule = $execStudSched->fetch_assoc()) {
                           
                      ?>
                        <tr style="font-size: 14px;">
                          <td><?php echo $schedule['school_year']; ?></td>
                          <td><?php echo $schedule['section']; ?></td>
                          <td>
                            <center>
                              <?php echo ($schedule['monday'] == true ? "<span class='schedule_day'>Monday</span>" : "" ); ?>
                              <?php echo ($schedule['tuesday'] == true ? "<span class='schedule_day'>Tuesday</span>" : "" ); ?> 
                              <?php echo ($schedule['wednesday'] == true ? "<span class='schedule_day'>Wednesday</span>" : "" ); ?> 
                              <?php echo ($schedule['thursday'] == true ? "<span class='schedule_day'>Thursday</span>" : "" ); ?> 
                              <?php echo ($schedule['friday'] == true ? "<span class='schedule_day'>Friday</span>" : "" ); ?> 
                              <?php echo ($schedule['saturday'] == true ? "<span class='schedule_day'>Saturday</span>" : "" ); ?> 
                              <?php echo ($schedule['sunday'] == true ? "<span class='schedule_day'>Sunday</span>" : "" ); ?> 
                            </center>
                          </td>
                          <td>
                            <center>
                              <?php echo date('h:i A', strtotime($schedule['teaching_time'])); ?> - <?php echo date('h:i A', strtotime($schedule['teaching_time_to'])); ?>
                            </center>
                          </td>
                          <td>
                            <center>

 <!-- TIMEONLY -->
                              <?php 
                              date_default_timezone_set('Asia/Manila');
                              $date_today = date("Y-m-d");
                              $button_value = "Time in";
                              $button_timeout_value = "Time out";
                              $button_stat = "";
                              $button_timeout = "";

                             $selectDtr = ' SELECT `id`, `schedule_id`, `teacher_id`, DATE_FORMAT(`time_in`,"%r") AS time_in, DATE_FORMAT(`time_out`,"%r") AS time_out, `status`, `academic_year_id` FROM `tbl_dtr` WHERE schedule_id = '.$schedule['id'].' AND academic_year_id = '.$active['id'].' AND time_in LIKE "'.$date_today.'%" ';
                              $execDtr = $conn->query($selectDtr);
                              if ($execDtr->num_rows > 0) 
                              {
                                $dtr = $execDtr->fetch_assoc();
                                if ($dtr['time_out'] != "12:00:00 AM") 
                                {
                                  $button_timeout_value = $dtr['time_out'];
                                  $button_timeout = 'style="pointer-events: none; cursor: not-allowed;"';
                                }
                                $button_value = $dtr['time_in'];
                                $button_stat = 'style="pointer-events: none; cursor: not-allowed;"';
                              }

                               ?>


                              <?php if ($schedule['monday'] == true AND strtolower(date('l')) == "monday"): ?>
                                <a href="../function_php/add_dtr.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_stat; ?>><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></a>
                              <?php elseif($schedule['tuesday'] == true AND strtolower(date('l')) == "tuesday"): ?>
                                <a href="../function_php/add_dtr.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_stat; ?>><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></a>
                              <?php elseif($schedule['wednesday'] == true AND strtolower(date('l')) == "wednesday"): ?>
                                <a href="../function_php/add_dtr.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_stat; ?>><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></a>
                              <?php elseif($schedule['thursday'] == true AND strtolower(date('l')) == "thursday"): ?>
                                <a href="../function_php/add_dtr.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_stat; ?>><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></a>
                              <?php elseif($schedule['friday'] == true AND strtolower(date('l')) == "friday"): ?>
                                <a href="../function_php/add_dtr.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_stat; ?>><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></a>
                              <?php elseif($schedule['saturday'] == true AND strtolower(date('l')) == "saturday"): ?>
                                <a href="../function_php/add_dtr.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_stat; ?>><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></a>
                              <?php elseif($schedule['sunday'] == true AND strtolower(date('l')) == "sunday"): ?>
                                <a href="../function_php/add_dtr.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_stat; ?>><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></a>
                              <?php else: ?>
                                <button class="btn btn-success btn-sm" disabled=""><?php echo $button_value; ?> <i class="fa fa-hourglass-start"></i></button>
                              <?php endif ?>

                            </center>
                          </td>
                          <td>
                            <center>
                              <!-- <button class="btn btn-danger btn-sm" <?php echo $button_timeout; ?>>Time out <i class="fa fa-hourglass-end"></i></button> -->
                              <a href="../function_php/add_dtr_out.php?schedule_id=<?php echo $schedule['id']; ?>&academic_year_id=<?php echo $active['id']; ?>" class="btn btn-danger btn-sm" <?php echo $button_timeout; ?>><?php echo $button_timeout_value; ?> <i class="fa fa-hourglass-end"></i></a>
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
