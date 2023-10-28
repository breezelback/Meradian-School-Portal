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
      padding: 2px;
      color: white;
      border-radius: 5px;
      margin: 1px;
      font-size: 12px;
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
                      <th><center>YEAR & SECTION</center></th>
                      <th><center>SCHEDULE</center></th>
                      <th><center>DTR DATE</center></th>
                      <th><center>TIME IN</center></th>
                      <th><center>TIME OUT</center></th>
                      <th><center>HOURS</center></th>
                      <th><center>REMARKS</center></th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                      $sql = ' SELECT `id`, `schedule_id`, `teacher_id`, DATE_FORMAT(`time_in`,"%M %d, %Y") AS dtr_date, time_out, DATE_FORMAT(`time_in`,"%W") AS dtr_day, DATE_FORMAT(`time_in`,"%r") AS time_in_time, DATE_FORMAT(`time_out`,"%r") AS time_out_time, ABS(TIMESTAMPDIFF(HOUR,`time_in`,`time_out`)) as Hour, ABS(TIMESTAMPDIFF(MINUTE,`time_in`,`time_out`)) as minute, `status`, `academic_year_id` FROM `tbl_dtr` WHERE teacher_id = '.$_GET['id'].' AND academic_year_id = '.$active['id'].' ';
                      $exec = $conn->query($sql);
                      while ($row = $exec->fetch_assoc()) {

                        $getSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE id = '.$row['schedule_id'].' ';
                        $execSched = $conn->query($getSched);
                        $sched = $execSched->fetch_assoc();
                      
                       ?>
                        <tr>
                          <td style="font-size: 13px;">
                            <center>
                            <?php echo $sched['school_year']; ?> | <?php echo $sched['section']; ?>
                            </center>
                          </td>
                          <td style="font-size: 13px;">
                            <center>
                              <?php echo ($sched['monday'] == true ? "<span class='schedule_day'>Monday</span>" : "" ); ?>
                              <?php echo ($sched['tuesday'] == true ? "<span class='schedule_day'>Tuesday</span>" : "" ); ?> 
                              <?php echo ($sched['wednesday'] == true ? "<span class='schedule_day'>Wednesday</span>" : "" ); ?> 
                              <?php echo ($sched['thursday'] == true ? "<span class='schedule_day'>Thursday</span>" : "" ); ?> 
                              <?php echo ($sched['friday'] == true ? "<span class='schedule_day'>Friday</span>" : "" ); ?> 
                              <?php echo ($sched['saturday'] == true ? "<span class='schedule_day'>Saturday</span>" : "" ); ?> 
                              <?php echo ($sched['sunday'] == true ? "<span class='schedule_day'>Sunday</span>" : "" ); ?>  |  <?php echo date('h:i A', strtotime($sched['teaching_time'])); ?> - <?php echo date('h:i A', strtotime($sched['teaching_time_to'])); ?>
                            </center>
                          </td>
                          <td style="font-size: 13px;">
                            <center>
                              <?php echo $row['dtr_date']; ?> | <span class='schedule_day' style="background-color: #0069ff;"><?php echo $row['dtr_day']; ?></span>
                            </center>
                          </td>
                          <td style="font-size: 13px;">
                            <center>
                              <?php echo $row['time_in_time']; ?>
                            </center>
                          </td>
                          <td style="font-size: 13px;">
                            <center>
                              <?php if ($row['time_out'] != "0000-00-00 00:00:00"): ?>
                                <?php echo $row['time_out_time']; ?>
                              <?php else: ?>
                                  ----
                              <?php endif ?>
                            </center>
                          </td>
                          <td style="font-size: 13px;">
                            <center>
                              <!-- <?php echo $row['Hour']; ?> Hours & <?php echo $row['minute']; ?> Minutes -->
                              <?php echo $hours = intdiv($row['minute'], 60).'hr : '. ($row['minute'] % 60); ?> Min
                            </center>
                          </td>
                          <td style="font-size: 13px;">
                            <center>
                              <?php //echo date('h:i A', strtotime($sched['teaching_time'])); ?>
                              <?php //echo date('h:i A', strtotime($sched['teaching_time_to'])); ?>

                              <?php //echo date('h:i A', strtotime($row['time_out_time'])); ?>
                              <br>
                              <?php if (date('h:i A', strtotime($row['time_in_time'])) > date('h:i A', strtotime($sched['teaching_time']))): ?>
                                <span style="  background-color: #dd0a34; padding: 2px; color: white; border-radius: 5px; margin: 1px; font-size: 13px;">- Late -</span>
                              <?php endif ?>

                              <?php if (date('h:i A', strtotime($sched['teaching_time_to'])) > date('h:i A', strtotime($row['time_out_time']))): ?>
                                <span style="  background-color: #b3bb12; padding: 2px; color: white; border-radius: 5px; margin: 1px; font-size: 13px;">- Undertime -</span>
                              <?php endif ?>

                              <?php if (date('h:i A', strtotime($row['time_out_time']) && $row['time_out'] != "0000-00-00 00:00:00") > date('h:i A', strtotime($sched['teaching_time_to']))): ?>
                                <span style="  background-color: seagreen; padding: 2px; color: white; border-radius: 5px; margin: 1px; font-size: 13px;">- Overtime -</span> 
                              <?php endif ?>

                              <?php if ($row['time_out'] == "0000-00-00 00:00:00"): ?>
                                <span style="  background-color: seagreen; padding: 2px; color: white; border-radius: 5px; margin: 1px; font-size: 13px;">- No Timeout -</span> 
                              <?php endif ?>
                            </center>
                          </td>
                        </tr>
                    
                     <?php } ?>
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
