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
            <h1 class="m-0">Students</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Students</li>
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
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <button class="nav-link btn-success text-white" data-toggle="modal" data-target="#modal_student_liability">Add Student Voucher &nbsp;<i class="fa fa-user-plus"></i></button>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- <h3>Current Academic Year: <span style="color: darkred; font-weight: bold;"><?php if(!empty($active['academic_year'])) { echo $active['academic_year'];} else {echo "";}  ?></span></h3> -->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th><center>ID NUMBER</center></th>
                      <th><center>FIRSTNAME</center></th>
                      <th><center>MIDDLENAME</center></th>
                      <th><center>LASTNAME</center></th>
                      <th><center>YEAR</center></th>
                      <th><center>SECTION</center></th>
                      <th><center>VOUCHER</center></th>
                      <th width="100"><center>ACTION</center></th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php 
                        // $sql = " SELECT `id`, `student_id`, `academic_year_id`, `amount`, `title`, `status`, `date_created` FROM `tbl_scholarship` WHERE academic_year_id = ".$active['id']." ";
                        $sql = " SELECT `id`, `student_id`, `academic_year_id`, `amount`, `title`, `status`, `date_created` FROM `tbl_scholarship` ";
                        $exec = $conn->query($sql);
                        while($row = $exec->fetch_assoc()){

                        $sqlStudent = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$row['student_id'];
                        $execStudent = $conn->query($sqlStudent);
                        $student = $execStudent->fetch_assoc();


                        $selectSection = 'SELECT `id`, `school_year`, `section`, `status`, `date_created` FROM `tbl_section` WHERE id = '.$student['section'];
                        $execSection = $conn->query($selectSection);
                        $section = $execSection->fetch_assoc();
                       ?>
                       <tr>
                         <td><center><?php echo $student['id_number']; ?></center></td>
                         <td><center><?php echo $student['firstname']; ?></center></td>
                         <td><center><?php echo $student['middlename']; ?></center></td>
                         <td><center><?php echo $student['lastname']; ?></center></td>
                         <td><center><?php echo $student['school_year']; ?></center></td>
                         <td><center><?php echo $section['section']; ?></center></td>
                         <td>
                            <center>
                            <p>₱<?php echo number_format($row['amount']); ?></p>
                            <p><?php echo $row['title']; ?></p>
                            </center>
                         </td>
                         <td>
                            <center>
                                <button class="btn btn-danger btn-sm" onclick="delete_scholarship(<?php echo $row['id']; ?>);">Remove <i class="fa fa-trash"></i></button>
                            </center>
                         </td>
                       </tr>

                     <?php } ?>

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


  <!-- Modal -->
  <form action="../function_php/add_scholarship.php" method="POST">
    <div class="modal fade" id="modal_student_liability" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Student Voucher</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" value="<?php echo $active['id']; ?> " name="year_id">
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th><center></center></th>
                  <th><center>ID NUMBER</center></th>
                  <th><center>FIRSTNAME</center></th>
                  <th><center>MIDDLENAME</center></th>
                  <th><center>LASTNAME</center></th>
                  <th><center>YEAR</center></th>
                  <th><center>SECTION</center></th>
                  <th><center>AMOUNT</center></th>
                  <th><center>VOUCHER NAME</center></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE user_type = "student" ';
                    $exec = $conn->query($sql);
                    while ( $sub = $exec->fetch_assoc() ) {


                        $selectSection = 'SELECT `id`, `school_year`, `section`, `status`, `date_created` FROM `tbl_section` WHERE id = '.$sub['section'];
                        $execSection = $conn->query($selectSection);
                        $section = $execSection->fetch_assoc();
                  ?>
                    <tr style="font-size: 14px;">
                      <!-- <td><center><input type="checkbox" value="<?php echo $sub['id']; ?>" name="check_id[]"></center></td> -->
                      <td>
                        <center>
                          <input type="checkbox" value="<?php echo $sub['id']; ?>" name="check_id[<?php echo $sub['id']; ?>]">
                          <!-- <input type="text" value="<?php echo $sub['id']; ?>"> -->
                        </center>
                      </td>
                      <td><center><?php echo $sub['id_number']; ?></center></td>
                      <td><center><?php echo $sub['firstname']; ?></center></td>
                      <td><center><?php echo $sub['middlename']; ?></center></td>
                      <td><center><?php echo $sub['lastname']; ?></center></td>
                      <td><center><?php echo $sub['school_year']; ?></center></td>
                      <td><center><?php echo $section['section']; ?></center></td>
                      <td><center><input type="text" class="form-control" name="amount[<?php echo $sub['id']; ?>]"></center></td>
                      <td><center><input type="text" class="form-control" name="title[<?php echo $sub['id']; ?>]"></center></td>
                    </tr>
                  <?php } ?>

                </tbody>  

              </table>

            <!-- modalbodyend -->
          </div>
          <div class="modal-footer">  
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });

  function delete_scholarship(id)
  {
    if (confirm('Are you sure you want to remove voucher?')) {
      window.location.href = "../function_php/delete_scholarship.php?id="+id;
    } else {
      // Do nothing!
    }
  }


</script>
</body>
</html>
