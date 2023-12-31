<?php 
  require('../function_php/conn.php'); 
  $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$_GET['id'].' ';
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
    @media only screen and (min-width: 800px) {
      .table-responsive
      {
        display: revert;
      }
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
            <h1 class="m-0">View Academic Record</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">View Academic Record</li>
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
                  <a class="nav-link btn btn-warning text-white" href="students.php"><i class="fa fa-arrow-left"></i> Back</a>  
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  
                    <div class="row">
                      <div class="col-md-2">
                        <img src="../images/user_image.jpg" alt="" width="100">
                      </div>
                      <div class="col-sm-3 form-group">
                        ID Number: <label for="name-f"><?php echo $row['id_number']; ?></label><br>
                        Name:<label for="name-f"> <?php echo $row['firstname'].' '.$row['lastname']; ?></label><br>
                        Address:<label for="name-f"> <?php echo $row['house_no'].' '.$barangay['brgyDesc'].' '.$citymun['citymunDesc'].' '.$province['provDesc']; ?></label>
                      </div>
                      <div class="col-sm-3 form-group">
                        Contact Number:<label for="name-f"> <?php echo $row['contact_number']; ?></label><br>
                        Email:<label for="name-f"> <?php echo $row['email']; ?></label><br>
                        Gender:<label for="name-f"> <?php echo $row['gender']; ?></label><br>
                      </div>
                      <div class="col-sm-3 form-group">
                        Date of Birth:<label for="name-f"> <?php echo $row['birthdate']; ?></label><br>
                        Year | Section :<label for="name-f"> <?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></label><br>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                      <button type="button" class="btn btn-primary text-white float-sm-right" data-toggle="modal" data-target="#modal_add_schedule">Add New Schedule &nbsp;<i class="fa fa-plus"></i></button>
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-md-12">
                        <h3>Current Academic Year: <span style="color: darkred; font-weight: bold;"><?php if(!empty($active['academic_year'])) { echo $active['academic_year'];} else {echo "";}  ?></span></h3>
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                          <thead>
                          <tr>
                            <th><center>CODE</center></th>
                            <th><center>SUBJECT NAME</center></th>
                            <th><center>PROFESSOR</center></th>
                            <th><center>SCHEDULE</center></th>
                            <th><center>ACTION</center></th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php 
                              $sql = ' 
                              SELECT 
                                    x.id as sched_id,
                                    x.student_id,
                                    x.schedule_id,
                                    a.id, 
                                    a.teacher_id, 
                                    a.subject_id, 
                                    a.teaching_day, 
                                    a.teaching_time, 
                                    a.schedule_code, 
                                    a.status,
                                    a.date_created , 
                                    a.teaching_time_to, 
                                    a.monday,
                                    a.tuesday,
                                    a.wednesday,
                                    a.thursday,
                                    a.friday,
                                    a.saturday,
                                    a.sunday,
                                    b.subject_name,
                                    b.subject_code,
                                    c.id_number,
                                    c.firstname,
                                    c.lastname,
                                    c.middlename
                                FROM tbl_student_schedule x
                                LEFT JOIN tbl_schedule a ON a.id = x.schedule_id
                                LEFT JOIN tbl_subject b ON b.id = a.subject_id
                                LEFT JOIN tbl_user c ON c.id = a.teacher_id
                                WHERE student_id = '.$_GET['id'].' AND academic_year_id = '.$active['id'].' ';
                              $exec = $conn->query($sql);
                              while ( $sub = $exec->fetch_assoc() ) {
                            ?>
                              <tr style="font-size: 14px;">
                                <td><center><?php echo $sub['subject_code']; ?></center></td>
                                <td><center><?php echo $sub['subject_name']; ?></center></td>
                                <td><center><?php echo $sub['firstname']; ?> <?php echo $sub['lastname']; ?></center></td>
                                <td><center>

                                    <?php echo ($sub['monday'] == true ? "<span class='schedule_day'>Monday</span>" : "" ); ?>
                                    <?php echo ($sub['tuesday'] == true ? "<span class='schedule_day'>Tuesday</span>" : "" ); ?> 
                                    <?php echo ($sub['wednesday'] == true ? "<span class='schedule_day'>Wednesday</span>" : "" ); ?> 
                                    <?php echo ($sub['thursday'] == true ? "<span class='schedule_day'>Thursday</span>" : "" ); ?> 
                                    <?php echo ($sub['friday'] == true ? "<span class='schedule_day'>Friday</span>" : "" ); ?> 
                                    <?php echo ($sub['saturday'] == true ? "<span class='schedule_day'>Saturday</span>" : "" ); ?> 
                                    <?php echo ($sub['sunday'] == true ? "<span class='schedule_day'>Sunday</span>" : "" ); ?> 

                                | <?php echo date('h:i A', strtotime($sub['teaching_time'])); ?> - <?php echo date('h:i A', strtotime($sub['teaching_time_to'])); ?></center></td>
                                <td><center>
                                  <div class="btn-group">
                                    <!-- <a href="edit_user.php?id=<?php echo $sub['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> -->
                                    <a href="../function_php/delete_student_schedule.php?id=<?php echo $sub['sched_id']; ?>&user_id=<?php echo $_GET['id']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>

                                    <!-- <a href="view_teacher.php?id=<?php echo $sub['id']; ?>" class="btn btn-warning btn-sm text-white"><i class="fa fa-cog"></i></a> -->
                                  </div></center>
                                </td>
                              </tr>
                            <?php } ?>

                          </tbody>  

                        </table>
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

        <!-- Table Grades -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <p><b>Grading</b></p>
                      <a class="nav-link btn-warning text-white float-right" target="_blank" href="../student/student_print_grades.php?academic_year_id=<?php echo $active['id']; ?>&student_id=<?php echo $_GET['id']; ?>">Print Grade Report &nbsp;<i class="fa fa-print"></i></a>
                </h3>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                    <div class="row">
                      <div class="col-md-12">
                        <table id="example1" class="table table-bordered table-striped table-responsive">
                          <thead>
                          <tr>
                            <th>CODE</th>
                            <th>SUBJECT</th>
                            <th>1ST</th>
                            <th>2ND</th>
                            <th>3RD</th>
                            <th>4TH</th>
                            <th>AVERAGE</th>
                          </tr>
                          </thead>
                    <tbody>

                      <?php   

                       

                          $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id` FROM `tbl_student_schedule` WHERE student_id = '.$_GET['id'].' AND academic_year_id = '.$active['id'];
                          $execStudSched = $conn->query($selectStudSched);
                          while ($stud = $execStudSched->fetch_assoc() ) {

                            $selectSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE id = '.$stud['schedule_id'];
                            $execSched = $conn->query($selectSched);
                            $sched = $execSched->fetch_assoc();

                            $selectSub = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE id = '.$sched['subject_id'];
                            $execSub = $conn->query($selectSub);
                            $subject = $execSub->fetch_assoc();

                            $selectSched = ' SELECT `id`, `stud_schedule_id`, `first`, `second`, `third`, `fourth`, `average`, `academic_year_id`, `date_created` FROM tbl_grades WHERE stud_schedule_id = '.$stud['id'];
                            $execSched = $conn->query($selectSched);
                            $rowGrade = $execSched->fetch_assoc();

                            $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$stud['student_id'];
                            $exec = $conn->query($sql);
                            $row = $exec->fetch_assoc();
                           
                      ?>
                        <tr style="font-size: 14px;">
                         <!--  <td><?php echo $row['id_number']; ?></td>
                          <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                          <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td> -->
                          <td><?php echo $subject['subject_code']; ?></td>
                          <td><?php echo $subject['subject_name']; ?></td>
                          <td><?php echo (empty($rowGrade['first']) ? 0 : $rowGrade['first']); ?></td>
                          <td><?php echo (empty($rowGrade['second']) ? 0 : $rowGrade['second']); ?></td>
                          <td><?php echo (empty($rowGrade['third']) ? 0 : $rowGrade['third']); ?></td>
                          <td><?php echo (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth']); ?></td>

                          <td>
                            <b>
                              <?php if ( empty($rowGrade['first']) || empty($rowGrade['second']) || empty($rowGrade['third']) || empty($rowGrade['fourth']) ): ?>
                                <?php echo 0; ?>
                              <?php else: ?>
                                <?php echo ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; ?>
                              <?php endif ?>
                                
                            </b> 
                          </td>

                          <!-- <td>
                            <center>
                              <div class="btn-group">
                                <a href="view_student_grade.php?id=<?php echo $row['id']; ?>&sched_id=<?php echo $stud['id']; ?>" class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-placement="bottom" title="View Grades"><i class="fa fa-sync-alt"></i></a>
                              </div>
                            </center>
                          </td> -->
                        </tr>
                      <?php  }  ?>

                    </tbody>  

                        </table>
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


    <!-- Previous -->

    <section class="col-lg-12">
      <!-- Custom tabs (Charts with tabs)-->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <i class="fas fa-list"></i>
            All Grades
          </h3>
          <div class="card-tools">
            <ul class="nav nav-pills ml-auto">
              <li class="nav-item">
                <a class="nav-link btn-success text-white" target="_blank" href="../student/print_all_grades.php?student_id=<?php echo $_GET['id']; ?>">Print All Records &nbsp;<i class="fa fa-print"></i></a>
              </li>
            </ul>
          </div>
        </div><!-- /.card-header -->
        <div class="card-body">
          <div class="tab-content p-0">

            <?php 
              $sqlAcadYears = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` ORDER BY id ASC ';
              $execAcadYears = $conn->query($sqlAcadYears);
              while ($acadyears = $execAcadYears->fetch_assoc()) {
            ?>
                <h5><span style="color: darkred; font-weight: bold;"><?php echo $acadyears['academic_year']; ?></span></h5>
                <table id="example1" class="table table-bordered table-striped table-responsive">
                  <thead>
                  <tr>
                    <th>CODE</th>
                    <th>SUBJECT</th>
                    <th>1ST</th>
                    <th>2ND</th>
                    <th>3RD</th>
                    <th>4TH</th>
                    <th>AVERAGE</th>
                  </tr>
                  </thead>
                    <tbody>

                      <?php   
                      $counter = 0;
                      $average_sum = 0;

                       

                          // $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id` FROM `tbl_student_schedule` WHERE student_id = '.$_SESSION['id'].' AND academic_year_id = '.$active['id'];
                          $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id` FROM `tbl_student_schedule` WHERE student_id = '.$_GET['id'].' AND academic_year_id = '.$acadyears['id'];
                          $execStudSched = $conn->query($selectStudSched);
                          while ($stud = $execStudSched->fetch_assoc() ) {

                            $selectSched = ' SELECT `id`, `teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `schedule_code`, `status`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section` FROM `tbl_schedule` WHERE id = '.$stud['schedule_id'];
                            $execSched = $conn->query($selectSched);
                            $sched = $execSched->fetch_assoc();

                            $selectSub = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE id = '.$sched['subject_id'];
                            $execSub = $conn->query($selectSub);
                            $subject = $execSub->fetch_assoc();

                            $selectSched = ' SELECT `id`, `stud_schedule_id`, `first`, `second`, `third`, `fourth`, `average`, `academic_year_id`, `date_created` FROM tbl_grades WHERE stud_schedule_id = '.$stud['id'];
                            $execSched = $conn->query($selectSched);
                            $rowGrade = $execSched->fetch_assoc();

                            $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, DATE_FORMAT(birthdate, "%M %d, %Y") AS birthdate, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id = '.$stud['student_id'];
                            $exec = $conn->query($sql);
                            $row = $exec->fetch_assoc();
                           
                      ?>
                        <tr style="font-size: 14px;">
                         <!--  <td><?php echo $row['id_number']; ?></td>
                          <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                          <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td> -->
                          <td><?php echo $subject['subject_code']; ?></td>
                          <td><?php echo $subject['subject_name']; ?></td>
                          <td><?php echo (empty($rowGrade['first']) ? 0 : $rowGrade['first']); ?></td>
                          <td><?php echo (empty($rowGrade['second']) ? 0 : $rowGrade['second']); ?></td>
                          <td><?php echo (empty($rowGrade['third']) ? 0 : $rowGrade['third']); ?></td>
                          <td><?php echo (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth']); ?></td>


                          <td><b>
                          <?php if ( empty($rowGrade['first']) || empty($rowGrade['second']) || empty($rowGrade['third']) || empty($rowGrade['fourth']) ): ?>
                            <?php echo 0; ?>
                          <?php else: ?>
                            <?php echo ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; ?>
                          <?php endif ?>
                          </b> </td>


                         <!--  <td><b><?php echo ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; ?></b> </td> -->
                          <!-- <td>
                            <center>
                              <div class="btn-group">
                                <a href="view_student_grade.php?id=<?php echo $row['id']; ?>&sched_id=<?php echo $stud['id']; ?>" class="btn btn-success btn-sm text-white" data-toggle="tooltip" data-placement="bottom" title="View Grades"><i class="fa fa-sync-alt"></i></a>
                              </div>
                            </center>
                          </td> -->
                        </tr>
                      <?php 
                         if ( empty($rowGrade['first']) || empty($rowGrade['second']) || empty($rowGrade['third']) || empty($rowGrade['fourth']) ){
                       
                              $average_sum = 0;
                            }
                            else
                            {
                              $average_sum = $average_sum + ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; 
                            }

                        $counter++; }  
                      ?>

                    </tbody>   
                    <tfoot>
                      <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><b>General Average:</b></td>
                        <?php if ($counter == 0): ?>
                          <td>0</td>
                        <?php else: ?>
                          <td><span style="color: darkred; font-weight: bold;"><?php echo number_format((float)$average_sum / $counter, 2, '.', ''); ?></span></td>
                        <?php endif ?>
                      </tr>
                    </tfoot>

                </table>

            <?php } ?>
          </div>
        </div><!-- /.card-body -->
      </div>
      <!-- /.card -->
      <!-- /.card -->
    </section>
  </div>
  <!-- /.content-wrapper -->

   <!-- Modal -->
  <form action="../function_php/add_student_schedule.php" method="POST">
    <div class="modal fade" id="modal_add_schedule" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Subject Schedule </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!--             <input disabled="" type="text" class="form-control" name="subject_code" id="subject_code" placeholder="<?php echo $row['id_number']; ?> | <?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?>">
            <label for="name-l" style="color: grey;">Subject</i></label>
            <input type="hidden" name="teacher_id" value="<?php echo $row['id']; ?>">
            <select class="form-control" name="subject_id" id="subject_id">
              <?php 
                $sql = ' SELECT `id`, `subject_name`, `subject_code`, `date_created` FROM `tbl_subject` ';
                $exec = $conn->query($sql);
                while ($sub = $exec->fetch_assoc()) {
               ?>
               <option value="<?php echo $sub['id']; ?>"><?php echo $sub['subject_name']; ?></option>

              <?php } ?>
            </select>
            <label for="name-l" style="color: grey;">Day</i></label>
            <select class="form-control" name="teaching_day" id="teaching_day">
              <option value="Monday">Monday</option>
              <option value="Tuesday">Tuesday</option>
              <option value="Wednesday">Wednesday</option>
              <option value="Thursday">Thursday</option>
              <option value="Friday">Friday</option>
              <option value="Saturday">Saturday</option>
              <option value="Sunday">Sunday</option>
            </select>
            <label for="name-l" style="color: grey;">Time</i></label>
            <input type="time" class="form-control" name="teaching_time"> -->
            <input type="hidden" value="<?php echo $row['id']; ?> " name="student_id">
            <table id="example1" class="table table-bordered table-striped table-responsive">
              <thead>
                <tr>
                  <th><center></center></th>
                  <th><center>CODE</center></th>
                  <th><center>SUBJECT NAME</center></th>
                  <th><center>PROFESSOR</center></th>
                  <th><center>SCHEDULE</center></th>
                  <th><center>YEAR & SECTION</center></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    $sql = ' 
                    SELECT a.id, 
                          a.teacher_id, 
                          a.subject_id, 
                          a.teaching_day, 
                          a.teaching_time, 
                          a.schedule_code, 
                          a.status,
                          a.date_created , 
                          a.teaching_time_to, 
                          a.monday,
                          a.tuesday,
                          a.wednesday,
                          a.thursday,
                          a.friday,
                          a.saturday,
                          a.sunday,
                          a.school_year,
                          b.subject_name,
                          b.subject_code,
                          c.id_number,
                          c.firstname,
                          c.lastname,
                          c.middlename,
                          d.section
                      FROM tbl_schedule a
                      LEFT JOIN tbl_subject b ON b.id = a.subject_id
                      LEFT JOIN tbl_user c ON c.id = a.teacher_id
                      LEFT JOIN tbl_section d ON d.id = c.section 
                      WHERE a.school_year = "'.$row['school_year'].'" AND a.id NOT IN (SELECT schedule_id FROM tbl_student_schedule WHERE student_id = '.$_GET['id'].' AND academic_year_id = '.$active['id'].')
                      ';
                    $exec = $conn->query($sql);
                    while ( $sub = $exec->fetch_assoc() ) {
                  ?>
                    <tr style="font-size: 14px;">
                      <!-- <td><center><input type="checkbox" value="<?php echo $sub['id']; ?>" name="check_id[<?php echo $sub['teacher_id']; ?>][]"> <input type="hidden" value="<?php echo $active['id']; ?>" name="academic_year_id"></center></td> -->
                      <td><center><input type="checkbox" value="<?php echo $sub['teacher_id']; ?>" name="check_id[<?php echo $sub['id']; ?>]"> <input type="hidden" value="<?php echo $active['id']; ?>" name="academic_year_id"></center></td>
                      <input type="hidden" value="<?php echo $sub['teacher_id']; ?>" name="teacher_id">
                      <td><center><?php echo $sub['subject_code']; ?></center></td>
                      <td><center><?php echo $sub['subject_name']; ?></center></td>
                      <td><center><?php echo $sub['firstname']; ?> <?php echo $sub['lastname']; ?></center></td>
                      <td><center>
                          <?php echo ($sub['monday'] == true ? "<span class='schedule_day'>Monday</span>" : "" ); ?>
                          <?php echo ($sub['tuesday'] == true ? "<span class='schedule_day'>Tuesday</span>" : "" ); ?> 
                          <?php echo ($sub['wednesday'] == true ? "<span class='schedule_day'>Wednesday</span>" : "" ); ?> 
                          <?php echo ($sub['thursday'] == true ? "<span class='schedule_day'>Thursday</span>" : "" ); ?> 
                          <?php echo ($sub['friday'] == true ? "<span class='schedule_day'>Friday</span>" : "" ); ?> 
                          <?php echo ($sub['saturday'] == true ? "<span class='schedule_day'>Saturday</span>" : "" ); ?> 
                          <?php echo ($sub['sunday'] == true ? "<span class='schedule_day'>Sunday</span>" : "" ); ?> 

                      | <?php echo date('h:i A', strtotime($sub['teaching_time'])); ?> - <?php echo date('h:i A', strtotime($sub['teaching_time_to'])); ?></center></td>
                      <td><center><?php echo $sub['school_year']; ?> | <?php echo $sub['section']; ?></center></td>
                    </tr>
                  <?php } ?>

                </tbody>  

              </table>

            <!-- modalbodyend -->
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
</script>

</body>
</html>
