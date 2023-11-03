<?php require('../function_php/conn.php'); ?>

<?php 

$sql = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE id = '.$_GET['id'];
$exec = $conn->query($sql);
$row = $exec->fetch_assoc();

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
            <h1 class="m-0">Subjects</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Subjects</li>
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
                  <a href="subjects.php" class="btn btn-warning">Back</a>
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <!-- <li class="nav-item">
                      <button class="nav-link btn-success text-white"  data-toggle="modal" data-target="#modal_add_subject">Add New Subject &nbsp;<i class="fa fa-plus"></i></button>
                    </li> -->
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <div class="row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4" style="border: 1px solid lightgrey; padding: 10px; border-radius: 5px;">
                      <form action="../function_php/update_subject.php" method="POST">
                      <input type="hidden" value="<?php echo $_GET['id']; ?>" name="id">
                      <label for="name-l" style="color: grey;">Subject Code</i></label>
                      <input type="text" class="form-control" name="subject_code" id="subject_code" value="<?php echo $row['subject_code']; ?>">
                      <label for="name-l" style="color: grey;">Subject Name</i></label>
                      <input type="text" class="form-control" name="subject_name" id="subject_name" value="<?php echo $row['subject_name']; ?>">
                      <center>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                      </center>
                      </form>
                    </div>
                    <div class="col-md-4"></div>
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


   function delete_subject(id)
  {
    if (confirm('Are you sure you want to delete this record?')) {
      window.location.href = "../function_php/delete_subject.php?id="+id;
    } else {
      // Do nothing!
    }
  }
</script>
</body>
</html>
