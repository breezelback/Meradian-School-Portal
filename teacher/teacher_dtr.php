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

  <?php 
    $currentYear=date("Y");
    $currentDayOfMonth=date('j');
    $currentMonth=date('m');
    $maxDays=date('t');
 
    $selectExist = ' SELECT id FROM tbl_dtr1 WHERE teacher_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'].' AND month(dtr_date) = "'.$currentMonth.'" ';
    $execExist = $conn->query($selectExist);


    if ($execExist->num_rows == 0) 
    {
      for ($i=1; $i <= $maxDays; $i++) { 
        $sqlInsert = ' INSERT INTO `tbl_dtr1`(`teacher_id`, `dtr_date`, `academic_year_id`) VALUES ('.$_SESSION['id'].', "'.$currentYear.'-'.$currentMonth.'-'.$i.'", '.$active['id'].') ';
        $conn->query($sqlInsert);

      }
    }

  ?>

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
                      <th><center>DATE</center></th>
                      <th><center>TIME IN</center></th>
                      <th><center>TIME OUT</center></th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php  
                          date_default_timezone_set('Asia/Manila');
                          $button_in = '';
                          $button_out = '';

                          $selectSched = ' SELECT `id`, `teacher_id`, DATE_FORMAT(`time_in`, "%r") AS time_in, DATE_FORMAT(`time_out`, "%r") AS time_out, DATE_FORMAT(`dtr_date`, "%M %d, %Y") AS dtr_date, DATE_FORMAT(`dtr_date`, "%d") AS dtr_day, `status`, `academic_year_id` FROM tbl_dtr1 WHERE teacher_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'].' AND month(dtr_date) = "'.$currentMonth.'" ';
                          $execSched = $conn->query($selectSched);
                          while ($rowSched = $execSched->fetch_assoc()) {
                          
                          $time_in = ($rowSched['time_in'] == "12:00:00 AM" ? "00:00:00" : $rowSched['time_in']  );
                          $time_out = ($rowSched['time_out'] == "12:00:00 AM" ? "00:00:00" : $rowSched['time_out']  );
                          // if ($currentDayOfMonth > $rowSched['dtr_day']) 
                          if ($rowSched['time_in'] != "12:00:00 AM" || $currentDayOfMonth > $rowSched['dtr_day']) 
                          {
                            $button_in = 'style="pointer-events: none; cursor: not-allowed;"';
                          }
                          else
                          {
                            $button_in = '';
                          }

                          // if ($currentDayOfMonth > $rowSched['dtr_day']) 
                          if ($rowSched['time_in'] == "12:00:00 AM" || $rowSched['time_out'] != "12:00:00 AM") 
                          {
                            $button_out = 'style="pointer-events: none; cursor: not-allowed;"';
                          }
                          else
                          {
                            $button_out = '';
                          }

                      ?>
                        <tr style="font-size: 14px;">
                          <td><center><?php echo $rowSched['dtr_date']; ?></center></td>
                          <td>
                            <center>
                              <a href="../function_php/update_dtr_in.php?id=<?php echo $rowSched['id']; ?>" class="btn btn-success btn-sm" <?php echo $button_in; ?>> <?php echo $time_in; ?> <i class="fa fa-hourglass-start"></i></a>
                            </center>
                          </td>
                          <td>
                            <center>
                              <a href="../function_php/update_dtr_out.php?id=<?php echo $rowSched['id']; ?>" class="btn btn-danger btn-sm" <?php echo $button_out; ?>> <?php echo $time_out; ?> <i class="fa fa-hourglass-start"></i></a>
                            </center>
                          </td>
                        </tr>
                      <?php  }  ?>

                    </tbody>  
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
