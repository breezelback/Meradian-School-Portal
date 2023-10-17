

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
  $student = $exec->fetch_assoc();


  $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
  $exec1 = $conn->query($sql1);
  $active = $exec1->fetch_assoc();


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
            <h1 class="m-0">Pay Liabilities</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pay Liabilities</li>
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
                      <div class="col-md-12">
                        <!-- <h3>Current Academic Year: <span style="color: darkred; font-weight: bold;"><?php if(!empty($active['academic_year'])) { echo $active['academic_year'];} else {echo "";}  ?></span></h3> -->
                        
                       
                              <form action="../paypal/charge.php" method="post">
                                <div class="row">
                                  <div class="col-md-3"></div>
                                  <div class="col-md-6" style="border: 1px solid lightgrey; padding: 20px; border-radius: 10px;">
                                      <div class="text-center">
                                          <h3 class="text-danger">Review Payment</h3>
                                      </div>
                                      <table class="table table-hover">
                                          <thead>
                                              <tr>
                                                  <th>Name</th>
                                                  <th class="text-center">Price</th>
                                              </tr>
                                          </thead>
                                          <tbody>
                                            <?php 
                                            $sql = ' SELECT `id`, `student_id`, `academic_year_id`, `amount`, `status`, DATE_FORMAT(`date_created`, "%M %d, %Y") as date_created, `title` FROM `tbl_liabilities` WHERE id = '.$_GET['pay_id'].' ';
                                            $exec = $conn->query($sql);
                                            $row = $exec->fetch_assoc(); ?>
                                              <tr>
                                                  <td class="col-md-9"><em><?php echo $row['title']; ?></em></h4></td>
                                                  <td class="col-md-1 text-center"><input class="form-control" type="text" name="amount" value="<?php echo $row['amount']; ?>" readonly="" /></td>
                                                  <input type="hidden" value="<?php echo $_GET['pay_id']; ?>" name="pay_id">
                                                  <input type="hidden" value="<?php echo $student['id']; ?>" name="student_id">
                                                  <input type="hidden" value="<?php echo $active['id']; ?>" name="academic_year_id">
                                              </tr>
                                              <tr>
                                                  <td class="text-right"><h4><strong>Total: </strong></h4></td>
                                                  <td class="text-center text-danger"><h4><strong>₱<?php echo number_format($row['amount']); ?></strong></h4></td>
                                              </tr>
                                          </tbody>
                                      </table>
                                      <button type="submit" name="submit" class="btn btn-lg btn-block border-primary">
                                          Pay Using <img src="../images/paypal1.png" alt="" width="70">
                                      </button>
                                       
                                  </div>
                                  <div class="col-md-3"></div>
                                </div>
                              </form>
                       
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
