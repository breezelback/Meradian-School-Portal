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
            <h1 class="m-0">Academic Year</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Academic Year</li>
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
                      <button class="nav-link btn-success text-white"  data-toggle="modal" data-target="#modal_add_subject">Add New Academic Year &nbsp;<i class="fa fa-plus"></i></button>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <h3>Current Academic Year: <span style="color: darkred; font-weight: bold;"><?php if(!empty($active['academic_year'])) { echo $active['academic_year'];} else {echo "";}  ?></span></h3>
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th><center>ACADEMIC YEAR</center></th>
                      <th><center>ACTION</center></th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php 
                        $sql = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status != "Active" ';
                        $exec = $conn->query($sql);
                        while ( $row = $exec->fetch_assoc() ) {
                      ?>
                        <tr style="font-size: 14px;">
                          <td><center><?php echo $row['academic_year']; ?></center></td>
                          <td><center>
                            <div class="btn-group">
                              <!-- <a href="../function_php/active_year.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm"><i class="fa fa-check"></i></a> -->
                              <button onclick="active_year(<?php echo $row['id']; ?>)" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                              <!-- <a href="../function_php/delete_year.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a> -->
                              <button onclick="delete_year(<?php echo $row['id']; ?>)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
  <form action="../function_php/add_year.php" method="POST">
    <div class="modal fade" id="modal_add_subject" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Year</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <label for="name-l" style="color: grey;">Academic Year</i></label>
            <input type="text" class="form-control" name="academic_year" id="academic_year" placeholder="">
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


  function delete_year(id)
  {
    if (confirm('Are you sure you want to delete this record?')) {
      window.location.href = "../function_php/delete_year.php?id="+id;
    } else {
      // Do nothing!
    }
  }


  function active_year(id)
  {
    if (confirm('Are you sure you want to set this Academic Year?')) {
      window.location.href = "../function_php/active_year.php?id="+id;
    } else {
      // Do nothing!
    }
  }
</script>
</body>
</html>
