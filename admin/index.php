<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>The Meradian School | Admin Portal</title>

  <?php include '_include_header.php'; ?>
  <?php 
  require '../function_php/conn.php';

  $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
  $exec1 = $conn->query($sql1);
  $active = $exec1->fetch_assoc();

  $sqlTeacher = ' SELECT COUNT(id) AS total_teacher FROM tbl_user WHERE user_type = "teacher" ';
  $execTeacher = $conn->query($sqlTeacher);
  $teachers = $execTeacher->fetch_assoc();

  $sqlStudent = ' SELECT COUNT(id) AS total_student FROM tbl_user WHERE user_type = "student" ';
  $execStudent = $conn->query($sqlStudent);
  $student = $execStudent->fetch_assoc();

  $sqlEnrolled = ' SELECT COUNT(id) AS total_enrolled FROM tbl_enrollment WHERE academic_year_id = '.$active['id'].' AND status = "Enrolled" ';
  $execEnrolled = $conn->query($sqlEnrolled);
  $enrolled = $execEnrolled->fetch_assoc();

  $sqlDropped = ' SELECT COUNT(id) AS total_dropped FROM tbl_enrollment WHERE academic_year_id = '.$active['id'].' AND status = "Dropped" ';
  $execDropped = $conn->query($sqlDropped);
  $dropped = $execDropped->fetch_assoc();



  ?>
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
          <div class="col-sm-8">
            <h1 class="m-0">Dashboard | Current Academic Year: <span style="color: darkred; font-weight: bold;"><?php if(!empty($active['academic_year'])) { echo $active['academic_year'];} else {echo "";}  ?></span></h1>
          </div><!-- /.col -->
          <div class="col-sm-4">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?php echo $teachers['total_teacher']; ?></h3>

                <p>Teahers</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?php echo $student['total_student']; ?></h3>

                <p>Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?php echo $enrolled['total_enrolled']; ?></h3>

                <p>Enrolled Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?php echo $dropped['total_dropped']; ?></h3>

                <p>Dropped Students</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  User Monthly Registration
                </h3>
                <div class="card-tools">
                  <!-- <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul> -->
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->


          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-6 connectedSortable">


             <!-- Map card -->
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart mr-1"></i>
                    Newly Enrolled Students
                  </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Address</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>John Doe</td>
                          <td>1A</td>
                          <td>Lipa</td>
                        </tr>
                        <tr>
                          <td>Blake Griffin</td>
                          <td>1B</td>
                          <td>Lipa</td>
                        </tr>
                        <tr>
                          <td>Portgas Ace</td>
                          <td>1A</td>
                          <td>Lipa</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <!-- /.card-body-->
              </div>
              <!-- /.card -->
        


              <!-- Map card -->
              <div class="card bg-gradient-primary" style="display: none;">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart mr-1"></i>
                    Student Analytics
                  </h3>
                </div>
                <div class="card-body">
                  <!-- <div id="world-map" style="height: 250px; width: 100%;"></div> -->
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div id="sparkline-1"></div>
                      <div class="text-white">All</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">New</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="text-white">Transferee</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
              <!-- /.card -->


          </section>
          <section class="col-lg-6 connectedSortable">


             <!-- Map card -->
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart mr-1"></i>
                    Newly Registered Teachers
                  </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <th>Name</th>
                        <th>Section</th>
                        <th>Address</th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>John Doe</td>
                          <td>1A</td>
                          <td>Lipa</td>
                        </tr>
                        <tr>
                          <td>Blake Griffin</td>
                          <td>1B</td>
                          <td>Lipa</td>
                        </tr>
                        <tr>
                          <td>Portgas Ace</td>
                          <td>1A</td>
                          <td>Lipa</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <!-- /.card-body-->
              </div>
              <!-- /.card -->
        


              <!-- Map card -->
              <div class="card bg-gradient-primary" style="display: none;">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart mr-1"></i>
                    Student Analytics
                  </h3>
                </div>
                <div class="card-body">
                  <!-- <div id="world-map" style="height: 250px; width: 100%;"></div> -->
                </div>
                <!-- /.card-body-->
                <div class="card-footer bg-transparent">
                  <div class="row">
                    <div class="col-4 text-center">
                      <div id="sparkline-1"></div>
                      <div class="text-white">All</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-2"></div>
                      <div class="text-white">New</div>
                    </div>
                    <!-- ./col -->
                    <div class="col-4 text-center">
                      <div id="sparkline-3"></div>
                      <div class="text-white">Transferee</div>
                    </div>
                    <!-- ./col -->
                  </div>
                  <!-- /.row -->
                </div>
              </div>
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

  <?php $datax = 100; ?>


  <?php include'_footer.php'; ?>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->


<?php include'_include_footer.php'; ?>
</body>
</html>
