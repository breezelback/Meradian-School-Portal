<?php require('../function_php/conn.php'); ?>
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
            <h1 class="m-0">Teachers</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Teachers</li>
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
                  Information
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link btn-success text-white" href="add_user.php?usertype=teacher">Add New Teacher &nbsp;<i class="fa fa-user-plus"></i></a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th><center>ID NUMBER</center></th>
                      <th><center>NAME</center></th>
                      <th><center>GENDER</center></th>
                      <th><center>EMAIL</center></th>
                      <th><center>CONTACT NUMBER</center></th>
                      <!-- <th><center>BIRTHDATE</center></th> -->
                      <th><center>ADDRESS</center></th>
                      <th><center>YEAR & SECTION</center></th>
                      <th><center>ACTION</center></th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php 
                        $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE user_type = "teacher" ';
                        $exec = $conn->query($sql);
                        while ( $row = $exec->fetch_assoc() ) {


                        $selectProvince = ' SELECT provDesc FROM refprovince WHERE provCode = "'.$row['province'].'" ';
                        $execProvince = $conn->query($selectProvince);
                        $province = $execProvince->fetch_assoc();
                        
                        $selectCityMun = ' SELECT citymunDesc FROM refcitymun WHERE citymunCode = "'.$row['city'].'" ';
                        $execCityMun = $conn->query($selectCityMun);
                        $citymun = $execCityMun->fetch_assoc();

                        $selectBarangay = ' SELECT brgyDesc FROM refbrgy WHERE brgyCode = "'.$row['barangay'].'" ';
                        $execBarangay = $conn->query($selectBarangay);
                        $barangay = $execBarangay->fetch_assoc();


                        $selectSection = 'SELECT `id`, `school_year`, `section`, `status`, `date_created` FROM `tbl_section` WHERE id = '.$row['section'];
                        $execSection = $conn->query($selectSection);
                        $section = $execSection->fetch_assoc();
                      ?>
                        <tr style="font-size: 14px;">
                          <td><?php echo $row['id_number']; ?></td>
                          <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                          <td><?php echo $row['gender']; ?></td>
                          <td><?php echo $row['email']; ?></td>
                          <td><?php echo $row['contact_number']; ?></td>
                          <!-- <td><?php echo $row['birthdate']; ?></td> -->
                          <td><?php echo $row['house_no']; ?> <?php echo $barangay['brgyDesc']; ?> <?php echo $citymun['citymunDesc']; ?> <?php echo $province['provDesc']; ?></td>
                          <td><?php echo $row['school_year']; ?> | <?php echo $section['section']; ?></td>
                          <td>
                            <div class="btn-group">
                              <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Update Information"><i class="fa fa-edit"></i></a>
                              <!-- <a href="../function_php/delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                              <button onclick="delete_user(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm text-white" data-toggle="tooltip" data-placement="bottom" title="Delete Teacher"><i class="fa fa-trash"></i></button>

                              <a href="view_teacher.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm text-white" data-toggle="tooltip" data-placement="bottom" title="View"><i class="fa fa-cog"></i></a>

                              <a href="teacher_dtr.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Daily Time Record"><i class="fa fa-user-clock"></i></a>
                            </div>
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


   function delete_user(id)
  {
    if (confirm('Are you sure you want to delete this user?')) {
      window.location.href = "../function_php/delete_user.php?id="+id;
    } else {
      // Do nothing!
    }
  }
</script>
</body>
</html>
