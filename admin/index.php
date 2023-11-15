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

  $sqlDropped = ' SELECT COUNT(id) AS total_dropped FROM tbl_enrollment WHERE academic_year_id = '.$active['id'].' AND status = "Drop" ';
  $execDropped = $conn->query($sqlDropped);
  $dropped = $execDropped->fetch_assoc();


  $sqlStudentCount1 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 1';
  $execStudent1 = $conn->query($sqlStudentCount1);
  $jan = $execStudent1->fetch_assoc();

  $sqlStudentCount2 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 2';
  $execStudent2 = $conn->query($sqlStudentCount2);
  $feb = $execStudent2->fetch_assoc();

  $sqlStudentCount3 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 3';
  $execStudent3 = $conn->query($sqlStudentCount3);
  $mar = $execStudent3->fetch_assoc();

  $sqlStudentCount4 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 4';
  $execStudent4 = $conn->query($sqlStudentCount4);
  $apr = $execStudent4->fetch_assoc();

  $sqlStudentCount5 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 5';
  $execStudent5 = $conn->query($sqlStudentCount5);
  $may = $execStudent5->fetch_assoc();

  $sqlStudentCount6 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 6';
  $execStudent6 = $conn->query($sqlStudentCount6);
  $jun = $execStudent6->fetch_assoc();

  $sqlStudentCount7 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 7';
  $execStudent7 = $conn->query($sqlStudentCount7);
  $jul = $execStudent7->fetch_assoc();

  $sqlStudentCount8 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 8';
  $execStudent8 = $conn->query($sqlStudentCount8);
  $aug = $execStudent8->fetch_assoc();

  $sqlStudentCount9 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 9';
  $execStudent9 = $conn->query($sqlStudentCount9);
  $sep = $execStudent9->fetch_assoc();

  $sqlStudentCount10 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 10';
  $execStudent10 = $conn->query($sqlStudentCount10);
  $oct = $execStudent10->fetch_assoc();

  $sqlStudentCount11 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 11';
  $execStudent11 = $conn->query($sqlStudentCount11);
  $nov = $execStudent11->fetch_assoc();

  $sqlStudentCount12 = ' SELECT COUNT(id) AS total_count FROM tbl_user WHERE user_type = "student" AND MONTH(date_created) = 12';
  $execStudent12 = $conn->query($sqlStudentCount12);
  $dec = $execStudent12->fetch_assoc();


 $sqlKinder = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Kinder" ';
  $execKinder = $conn->query($sqlKinder);
  $Kinder = $execKinder->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 1" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade1 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 2" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade2 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 3" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade3 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 4" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade4 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 5" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade5 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 6" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade6 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 7" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade7 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 8" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade8 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 9" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade9 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 10" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade10 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 11" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade11 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Grade 12" ';
  $execGrade = $conn->query($sqlGrade);
  $Grade12 = $execGrade->fetch_assoc();

 $sqlGrade = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "First Year" ';
  $execGrade = $conn->query($sqlGrade);
  $FirstYear = $execGrade->fetch_assoc();

 $sqlKinder = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Second Year" ';
  $execKinder = $conn->query($sqlKinder);
  $SecondYear = $execKinder->fetch_assoc();

 $sqlKinder = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Third Year" ';
  $execKinder = $conn->query($sqlKinder);
  $ThirdYear = $execKinder->fetch_assoc();

 $sqlKinder = ' SELECT COUNT(a.id) as total_enrolled_students FROM tbl_user a LEFT JOIN tbl_enrollment b ON b.student_id = a.id WHERE a.user_type = "student" AND b.status = "Enrolled" AND b.academic_year_id = '.$active['id'].' AND a.school_year = "Fourth Year" ';
  $execKinder = $conn->query($sqlKinder);
  $FourthYear = $execKinder->fetch_assoc();


  $year_qry = '';
  $gender_qry = '';

  $year_val = "All Year";
  $gender_val = "All Gender";

  if (isset($_POST['btn_search'])) 
  {
    if ($_POST['filter_year'] == "") 
    {
      $year_qry = "";
    }
    else
    {
      $year_qry = "AND school_year = '".$_POST['filter_year']."' ";
      $year_val = $_POST['filter_year'];
    }

    if ($_POST['filter_gender'] == "") 
    {
      $gender_qry = "";
    }
    else
    {
      $gender_qry = "AND gender = '".$_POST['filter_gender']."' ";
      $gender_val = $_POST['filter_gender'];
    }
  }


  // Acad Year
  $aa = 0;
  
  $selectAcadYear = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` ORDER BY academic_year ASC';
  $execAcadYear = $conn->query($selectAcadYear);
  while ($acad_years = $execAcadYear->fetch_assoc()) {

    $getStudAcad = ' SELECT count(id) as ttlstdnt FROM tbl_enrollment WHERE academic_year_id = '.$acad_years['id'].' '.$year_qry.' '.$gender_qry;
    $execStudAcad = $conn->query($getStudAcad);
    $rowStudAcad = $execStudAcad->fetch_assoc();

    $gg[$aa] = $acad_years['academic_year'];
    $hh[$aa] = $rowStudAcad['ttlstdnt'];
    $aa++;
  }
  // print_r($gg);
  // print_r($hh);
  // die();
  // $acad_years = $execAcadYear->fetch_assoc();

  // print_r($acad_years['academic_year']);

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
            <a href="" data-toggle="modal" data-target="#modal_view_teachers">
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
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="" data-toggle="modal" data-target="#modal_view_students">
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
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="" data-toggle="modal" data-target="#modal_view_enrolled">
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
            </a>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <a href="" data-toggle="modal" data-target="#modal_view_dropped">
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
            </a>
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
                  Academic Year Enrollees <i style="font-size: 13px;">(<?php echo $year_val; ?>, <?php echo $gender_val; ?>)</i>
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
                  <form action="" method="POST">
                    <ul class="nav nav-pills ml-auto">
                      <li class="nav-item">
                        <select class="nav-link" name="filter_year" id="filter_year">
                          <option value="" selected="">All Year</option>
                          <option value="Kinder">Kinder</option>
                          <option value="Grade 1">Grade 1</option>
                          <option value="Grade 2">Grade 2</option>
                          <option value="Grade 3">Grade 3</option>
                          <option value="Grade 4">Grade 4</option>
                          <option value="Grade 5">Grade 5</option>
                          <option value="Grade 6">Grade 6</option>
                          <option value="Grade 7">Grade 7</option>
                          <option value="Grade 8">Grade 8</option>
                          <option value="Grade 9">Grade 9</option>
                          <option value="Grade 10">Grade 10</option>
                          <option value="Grade 11">Grade 11</option>
                          <option value="Grade 12">Grade 12</option>
                          <option value="First Year">First Year</option>
                          <option value="Second Year">Second Year</option>
                          <option value="Third Year">Third Year</option>
                          <option value="Fourth Year">Fourth Year</option>
                        </select>
                      </li>
                      <li class="nav-item">
                        <select class="nav-link mx-1" name="filter_gender" id="filter_gender">
                          <option value="" selected="">All Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </li>
                    <li class="nav-item">
                      <button class="btn btn-sm nav-link active" type="submit" name="btn_search">Search</button>
                    </li>
                    </ul>
                  </form>
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
                    Newly Registered Students
                  </h3> <a href="print_student.php" target="_blank" class="btn btn-primary float-sm-right"><i class="fa fa-print"></i></a>
                </div>
                <div class="card-body">
                    <table id="example3" class="table table-bordered">
                      <thead>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Year & Section</th>
                        <th>Status</th>
                      </thead>
                      <tbody>
                        <?php 
                        $selectStudents = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE user_type = "student" ORDER BY id DESC LIMIT 5 ';
                        $execStudents = $conn->query($selectStudents);
                        while ($students = $execStudents->fetch_assoc()){

                         ?>
                        <tr>
                          <td><?php echo $students['id_number']; ?></td>
                          <td><?php echo $students['firstname']; ?> <?php echo $students['lastname']; ?></td>
                          <td><?php echo $students['school_year']; ?> | <?php echo $students['section']; ?></td>
                          <td><?php echo $students['student_status']; ?></td>
                        </tr>

                      <?php } ?>
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
              <div class="card" style="display: none;">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart mr-1"></i>
                    Newly Registered Teachers
                  </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                      <thead>
                        <th>ID Number</th>
                        <th>Name</th>
                        <th>Contact Number</th>
                        <th>Email</th>
                      </thead>
                      <tbody>
                        <?php 
                        $selectStudents = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE user_type = "teacher" ORDER BY id DESC LIMIT 5 ';
                        $execStudents = $conn->query($selectStudents);
                        while ($students = $execStudents->fetch_assoc()){

                         ?>
                        <tr>
                          <td><?php echo $students['id_number']; ?></td>
                          <td><?php echo $students['firstname']; ?> <?php echo $students['lastname']; ?></td>
                          <td><?php echo $students['contact_number']; ?></td>
                          <td><?php echo $students['email']; ?></td>
                        </tr>

                      <?php } ?>
                      </tbody>
                    </table>
                </div>
                <!-- /.card-body-->
              </div>
              <!-- /.card -->
        


              <!-- Map card -->
              <div class="card">
                <div class="card-header border-0">
                  <h3 class="card-title">
                    <i class="fas fa-chart mr-1"></i>
                    Enrolled by Student Year
                  </h3>
                </div>
                <div class="card-body">
                  <div class="tab-content p-0">
                    <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="student-chart" style="position: relative; height: 450px;">
                        <canvas id="student_year_chart" height="300" style="height: 300px;"></canvas>
                     </div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                      <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                    </div>
                  </div>
                </div>
                <!-- /.card-body-->
              </div>
              <!-- /.card -->


          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- modals -->
    <!-- Teachers -->
    <div class="modal fade" id="modal_view_teachers" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Teachers</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
                ?>
                  <tr style="font-size: 14px;">
                    <td><?php echo $row['id_number']; ?></td>
                    <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact_number']; ?></td>
                    <!-- <td><?php echo $row['birthdate']; ?></td> -->
                    <td><?php echo $row['house_no']; ?> <?php echo $barangay['brgyDesc']; ?> <?php echo $citymun['citymunDesc']; ?> <?php echo $province['provDesc']; ?></td>
                    <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td>
                  </tr>
                <?php } ?>

              </tbody>  

            </table>
          </div>
          <div class="modal-footer">
           <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Teachers -->

    <!-- Students -->
    <div class="modal fade" id="modal_view_students" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Students</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <table id="example4" class="table table-bordered table-striped">
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
              </tr>
              </thead>
              <tbody>

                <?php 
                  $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE user_type = "student" ';
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
                ?>
                  <tr style="font-size: 14px;">
                    <td><?php echo $row['id_number']; ?></td>
                    <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact_number']; ?></td>
                    <!-- <td><?php echo $row['birthdate']; ?></td> -->
                    <td><?php echo $row['house_no']; ?> <?php echo $barangay['brgyDesc']; ?> <?php echo $citymun['citymunDesc']; ?> <?php echo $province['provDesc']; ?></td>
                    <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td>
                  </tr>
                <?php } ?>

              </tbody>  

            </table>
          </div>
          <div class="modal-footer">
           <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- students -->

    <!-- Enrolled -->
    <div class="modal fade" id="modal_view_enrolled" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Students</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <table id="example5" class="table table-bordered table-striped">
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
              </tr>
              </thead>
              <tbody>

                <?php 

                  $sqlEnrolled = ' SELECT student_id FROM tbl_enrollment WHERE academic_year_id = '.$active['id'].' AND status = "Enrolled" ';
                  $execEnrolled = $conn->query($sqlEnrolled);
                  while ( $enrolled = $execEnrolled->fetch_assoc() ) {

                  $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$enrolled['student_id'].' ';
                  $exec = $conn->query($sql);
                  $row = $exec->fetch_assoc();


                  $selectProvince = ' SELECT provDesc FROM refprovince WHERE provCode = "'.$row['province'].'" ';
                  $execProvince = $conn->query($selectProvince);
                  $province = $execProvince->fetch_assoc();
                  
                  $selectCityMun = ' SELECT citymunDesc FROM refcitymun WHERE citymunCode = "'.$row['city'].'" ';
                  $execCityMun = $conn->query($selectCityMun);
                  $citymun = $execCityMun->fetch_assoc();

                  $selectBarangay = ' SELECT brgyDesc FROM refbrgy WHERE brgyCode = "'.$row['barangay'].'" ';
                  $execBarangay = $conn->query($selectBarangay);
                  $barangay = $execBarangay->fetch_assoc();
                ?>
                  <tr style="font-size: 14px;">
                    <td><?php echo $row['id_number']; ?></td>
                    <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact_number']; ?></td>
                    <!-- <td><?php echo $row['birthdate']; ?></td> -->
                    <td><?php echo $row['house_no']; ?> <?php echo $barangay['brgyDesc']; ?> <?php echo $citymun['citymunDesc']; ?> <?php echo $province['provDesc']; ?></td>
                    <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td>
                  </tr>
                <?php } ?>

              </tbody>  

            </table>
          </div>
          <div class="modal-footer">
           <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Enrolled -->

    <!-- Dropped -->
    <div class="modal fade" id="modal_view_dropped" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Students</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
           <table id="example6" class="table table-bordered table-striped">
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
              </tr>
              </thead>
              <tbody>

                <?php 

                  $sqlEnrolled = ' SELECT student_id FROM tbl_enrollment WHERE academic_year_id = '.$active['id'].' AND status = "Drop" ';
                  $execEnrolled = $conn->query($sqlEnrolled);
                  while ( $enrolled = $execEnrolled->fetch_assoc() ) {

                  $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$enrolled['student_id'].' ';
                  $exec = $conn->query($sql);
                  $row = $exec->fetch_assoc();


                  $selectProvince = ' SELECT provDesc FROM refprovince WHERE provCode = "'.$row['province'].'" ';
                  $execProvince = $conn->query($selectProvince);
                  $province = $execProvince->fetch_assoc();
                  
                  $selectCityMun = ' SELECT citymunDesc FROM refcitymun WHERE citymunCode = "'.$row['city'].'" ';
                  $execCityMun = $conn->query($selectCityMun);
                  $citymun = $execCityMun->fetch_assoc();

                  $selectBarangay = ' SELECT brgyDesc FROM refbrgy WHERE brgyCode = "'.$row['barangay'].'" ';
                  $execBarangay = $conn->query($selectBarangay);
                  $barangay = $execBarangay->fetch_assoc();
                ?>
                  <tr style="font-size: 14px;">
                    <td><?php echo $row['id_number']; ?></td>
                    <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['contact_number']; ?></td>
                    <!-- <td><?php echo $row['birthdate']; ?></td> -->
                    <td><?php echo $row['house_no']; ?> <?php echo $barangay['brgyDesc']; ?> <?php echo $citymun['citymunDesc']; ?> <?php echo $province['provDesc']; ?></td>
                    <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td>
                  </tr>
                <?php } ?>

              </tbody>  

            </table>
          </div>
          <div class="modal-footer">
           <!--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- Dropped -->

    <!-- modal end -->
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
<script>
   /* Chart.js Charts */
  // Sales chart
  var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');
  // const array_acad_year = ['a', 'b', 'c'];
  const array_acad_year = <?php echo json_encode($gg); ?>;
  const array_total_students = <?php echo json_encode($hh); ?>;
  var salesChartData = {
    // labels: ['January', 'February'],
    // labels: [],
    labels: array_acad_year,
    datasets: [
      {
        label: 'Enrolled Students',
        // backgroundColor: 'rgba(60,141,188,0.9)',
        backgroundColor: ['#ffc107','#28a745','#20c997','#6c757d','#dc3545','#6f42c1','#ffc107','#28a745','#20c997','#6c757d','#dc3545','#6f42c1'],
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: array_total_students
      }
      // {
      //   label: 'Electronics',
      //   backgroundColor: 'rgba(210, 214, 222, 1)',
      //   borderColor: 'rgba(210, 214, 222, 1)',
      //   pointRadius: false,
      //   pointColor: 'rgba(210, 214, 222, 1)',
      //   pointStrokeColor: '#c1c7d1',
      //   pointHighlightFill: '#fff',
      //   pointHighlightStroke: 'rgba(220,220,220,1)',
      //   data: [65, 59, 80, 81, 56, 55, 40]
      // }
    ]
  }
</script>

<script>
   /* Chart.js Charts */
  // Sales chart
  var studentChartCanvas = document.getElementById('student_year_chart').getContext('2d')
  // $('#revenue-chart').get(0).getContext('2d');

  var studentChartData = {
    labels: ['Kinder', 'Grade 1', 'Grade 2', 'Grade 3', 'Grade 4', 'Grade 5', 'Grade 6', 'Grade 7', 'Grade 8', 'Grade 9', 'Grade 10', 'Grade 11', 'Grade 12', 'First Year', 'Second Year', 'Third Year', 'Fourth Year'],
    datasets: [
      {
        label: 'Enrolled Students',
        // backgroundColor: 'rgba(60,141,188,0.9)',
        backgroundColor: ['#ffc107','#28a745','#20c997','#6c757d','#dc3545','#6f42c1','#ffc107','#28a745','#20c997','#6c757d','#dc3545','#6f42c1','#ffc107','#28a745','#20c997','#6c757d'],
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: [<?php echo $Kinder['total_enrolled_students']; ?>, <?php echo $Grade1['total_enrolled_students']; ?>, <?php echo $Grade2['total_enrolled_students']; ?>, <?php echo $Grade3['total_enrolled_students']; ?>, <?php echo $Grade4['total_enrolled_students']; ?>, <?php echo $Grade5['total_enrolled_students']; ?>, <?php echo $Grade6['total_enrolled_students']; ?>, <?php echo $Grade7['total_enrolled_students']; ?>, <?php echo $Grade8['total_enrolled_students']; ?>, <?php echo $Grade9['total_enrolled_students']; ?>, <?php echo $Grade10['total_enrolled_students']; ?>, <?php echo $Grade11['total_enrolled_students']; ?>, <?php echo $Grade12['total_enrolled_students']; ?>, <?php echo $FirstYear['total_enrolled_students']; ?>, <?php echo $SecondYear['total_enrolled_students']; ?>, <?php echo $ThirdYear['total_enrolled_students']; ?>, <?php echo $FourthYear['total_enrolled_students']; ?>]
      }
      // {
      //   label: 'Electronics',
      //   backgroundColor: 'rgba(210, 214, 222, 1)',
      //   borderColor: 'rgba(210, 214, 222, 1)',
      //   pointRadius: false,
      //   pointColor: 'rgba(210, 214, 222, 1)',
      //   pointStrokeColor: '#c1c7d1',
      //   pointHighlightFill: '#fff',
      //   pointHighlightStroke: 'rgba(220,220,220,1)',
      //   data: [65, 59, 80, 81, 56, 55, 40]
      // }
    ]
  }
</script>

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

    $("#example3").DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
    $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example4_wrapper .col-md-6:eq(0)');
    $("#example5").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example5_wrapper .col-md-6:eq(0)');
    $("#example6").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#example6_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
