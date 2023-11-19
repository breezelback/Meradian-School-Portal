<?php require('../function_php/conn.php'); 
  $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
  $exec1 = $conn->query($sql1);
  $active = $exec1->fetch_assoc();


  $selectActiveYear = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` ORDER BY academic_year ASC ';
  $execActiveYear = $conn->query($selectActiveYear);


  $selectSubject = ' SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` ORDER BY subject_name ASC ';
  $execSubject = $conn->query($selectSubject);


  $selectTeacher = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE user_type = "teacher" ORDER BY lastname ASC ';
  $execTeacher = $conn->query($selectTeacher);

  $main_query = ' WHERE sched.id != "" ';
  $query_text = '';

  if (isset($_POST['btn_search'])) 
  {
    $select_main = $_POST['select_main'];
    $select_school_year = $_POST['select_school_year'];
    $select_year_level = $_POST['select_year_level'];
    $select_subject = $_POST['select_subject'];
    $select_teacher = $_POST['select_teacher'];
    $select_grading = $_POST['select_grading'];
    $select_gender = $_POST['select_gender'];

    if ($select_school_year != '') 
    {
      $main_query .= ' AND sched.academic_year_id = '.$select_school_year;
      $query_text = '';
    }

    if ($select_year_level != '') 
    {
      $main_query .= ' AND stud.school_year = "'.$select_year_level.'"';
    }

    if ($select_subject != '') 
    {
      $main_query .= ' AND sub.id = '.$select_subject;
    }

    if ($select_teacher != '') 
    {
      $main_query .= ' AND teach.id = '.$select_teacher;
    }

    if ($select_gender != '') 
    {
      $main_query .= ' AND stud.gender = "'.$select_gender.'"';
    }

    if ($select_grading != '') 
    {
      $main_query .= ' AND stud.student_status = "'.$select_grading.'"';
    }


  }

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
            <h1 class="m-0">Filter</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Filter</li>
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
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <!-- <i class="fas fa-print"></i> -->
                  Search
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <form action="" method="POST">
                  <div class="row">
                    <div class="col-sm-4">
                       Query Options:
                      <select name="select_main" id="select_main" class="form-control my-1">
                        <option value="Enrollees">Enrollees</option>
                        <!-- <option value="GWA">GWA</option> -->
                        <!-- <option value="Grades">Grades</option> -->
                      </select>
                      School Year
                      <select name="select_school_year" id="select_school_year" class="form-control my-1">
                        <option value="">All</option>
                        <?php while($activeYear = $execActiveYear->fetch_assoc()){ ?>
                          <option value="<?php echo $activeYear['id']; ?>"><?php echo $activeYear['academic_year']; ?></option>
                        <?php } ?>
                      </select>
                      Year Level
                      <select name="select_year_level" id="select_year_level" class="form-control my-1">
                        <option value="">All</option>
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
                    </div>
                    <div class="col-sm-4">
                      Subject
                      <select name="select_subject" id="select_subject" class="form-control my-1">
                        <option value="">All</option>
                        <?php while($subject = $execSubject->fetch_assoc()){ ?>
                          <option value="<?php echo $subject['id']; ?>"><?php echo $subject['subject_name']; ?></option>
                        <?php } ?>
                      </select>
                      Teacher
                      <select name="select_teacher" id="select_teacher" class="form-control my-1">
                        <option value="">All</option>
                      </select>
                      Student Type
                      <select name="select_grading" id="select_grading" class="form-control my-1">
                        <option value="">All</option>
                        <option value="New">New</option>
                        <option value="Transferee">Transferee</option>
                      </select>
                    </div>
                    <div class="col-sm-4">
                      Gender
                      <select name="select_gender" id="select_gender" class="form-control my-1">
                        <option value="">All</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                      <center>
                        <button class="btn btn-lg btn-primary mt-4" name="btn_search">Apply Query <i class="fa fa-search"></i></button>
                      </center>
                    </div>
                  </div>
                  </form>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-print"></i>
                  Print Result
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <!-- <li class="nav-item">
                      <a class="nav-link btn-success text-white" href="add_user.php?usertype=student">Add New Student &nbsp;<i class="fa fa-user-plus"></i></a>
                    </li> -->
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                      <th><center>#</center></th>
                      <th><center>ID NUMBER</center></th>
                      <th width="140"><center>NAME</center></th>
                      <th><center>YEAR LEVEL</center></th>
                      <th><center>GENDER</center></th>
                      <th><center>SUBJECT</center></th>
                      <th><center>TEACHER</center></th>
                      <th><center>1ST</center></th>
                      <th><center>2ND</center></th>
                      <th><center>3RD</center></th>
                      <th><center>4TH</center></th>
                      <th><center>GWA</center></th>
                    </tr>
                    </thead>
                    <tbody>

                      <?php 
                      $counter = 1;

                      $sql = '
                      SELECT 
                        sched.id AS schedule_id,
                        sched.student_id AS student_id,
                        sched.schedule_id AS stud_schedule_id,
                        sched.academic_year_id AS academic_year_id,
                        sched.teacher_id AS teacher_id,
                        sched_main.id AS sched_main_id,
                        sched_main.subject_id AS subject_id,
                        sub.id AS subject_id,
                        sub.subject_code AS subject_code,
                        sub.subject_name AS subject_name,
                        grade.id AS grade_id,
                        grade.first AS first,
                        grade.second AS second,
                        grade.third AS third,
                        grade.fourth AS fourth,
                        stud.id AS stud_id,
                        stud.id_number AS id_number,
                        stud.firstname AS firstname,
                        stud.middlename AS middlename,
                        stud.lastname AS lastname,
                        stud.suffix AS suffix,
                        stud.gender AS gender,
                        stud.email AS email,
                        stud.contact_number AS contact_number,
                        stud.telephone AS telephone,
                        stud.birthdate AS birthdate,
                        stud.province AS province,
                        stud.city AS city,
                        stud.barangay AS barangay,
                        stud.house_no AS house_no,
                        stud.school_year AS school_year,
                        stud.section AS section,
                        stud.profile_picture AS profile_picture,
                        stud.username AS username,
                        stud.password AS password,
                        stud.user_type AS user_type,
                        stud.status AS status,
                        stud.date_created AS date_created,
                        stud.student_status AS student_status,
                        teach.firstname AS teacher_firstname,
                        teach.middlename AS teacher_middlename,
                        teach.lastname AS teacher_lastname
                        FROM tbl_student_schedule sched
                        LEFT JOIN tbl_schedule sched_main ON sched_main.id = sched.schedule_id
                        LEFT JOIN tbl_subject sub ON sub.id = sched_main.subject_id
                        LEFT JOIN tbl_grades grade ON grade.stud_schedule_id = sched.id
                        LEFT JOIN tbl_user stud ON stud.id = sched.student_id
                        LEFT JOIN tbl_user teach ON teach.id = sched_main.teacher_id
                      '.$main_query;
                      $execMain = $conn->query($sql);
                      while ($data = $execMain->fetch_assoc()) {
                        if(empty($data['first'])) {$data['first'] = 0;}
                        if(empty($data['second'])) {$data['second'] = 0;}
                        if(empty($data['third'])) {$data['third'] = 0;}
                        if(empty($data['fourth'])) {$data['fourth'] = 0;}
                        ?>
                          <tr style="font-size: 14px;">
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $data['id_number'] ?></td>
                            <td><?php echo $data['firstname'] ?> <?php echo $data['lastname'] ?></td>
                            <td><?php echo $data['school_year'] ?></td>
                            <td><?php echo $data['gender'] ?></td>
                            <td><?php echo $data['subject_name'] ?></td>
                            <td><?php echo $data['teacher_firstname'] ?> <?php echo $data['teacher_lastname'] ?></td>
                            <td><?php echo $data['first'] ?></td>
                            <td><?php echo $data['second'] ?></td>
                            <td><?php echo $data['third'] ?></td>
                            <td><?php echo $data['fourth'] ?></td>
                            <td><?php echo ($data['first'] + $data['second'] + $data['third'] + $data['fourth']) / 4 ?></td>
                          </tr>
                      <?php $counter++; } ?>

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


  $('#select_main').on('change', function(){

    if ($(this).val() == "GWA")
    {
      $("#select_grading").val("");
      $('#select_grading').prop('disabled', true);
    }
    else
    {
      $('#select_grading').prop('disabled', false);
    }
  });

  $('#select_subject').on('change', function(){
    let subject_id = $(this).val();
    $.ajax({  
      url:"../function_php/fetch_teacher.php?subject_id="+subject_id, 
      method:"POST",  
      contentType:false,
      cache:false,
      processData:false,

      beforeSend:function() {
      }, 

      success:function(data){  
        $('#select_teacher').empty();
        $('#select_teacher')
          .append($("<option></option>")
          .attr("value", "")
          .text("All")); 

        if (data != '') 
        {
          var jsArray = JSON.parse(data);
          $.each(jsArray, function(key, value) {   
            $('#select_teacher')
            .append($("<option></option>")
            .attr("value", key)
            .text(value)); 
          });
        }
      }

    });  
 
  });


  // $('#select_teacher').on('change', function(){
  //   alert($(this).val());
  // });

</script>
</body>
</html>
