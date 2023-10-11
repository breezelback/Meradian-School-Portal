<?php 
require('../function_php/conn.php'); 
//$_GET['academic_year_id'];
//$_GET['student_id'];
$sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE id = '.$_GET['student_id'];
$exec = $conn->query($sql);
$student = $exec->fetch_assoc();

 $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
  $exec1 = $conn->query($sql1);
  $active = $exec1->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<?php include '_include_header.php'; ?>
    <style>
      body {
        background-image: url('../images/print_bg.jpg');
        background-repeat: no-repeat;
        /*background-attachment: fixed;*/
        background-size: 50% 100%;
        background-position: center;
      }
    </style>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-2">
				<center>
					<!-- <img src="../images/logo.jpg" alt="" width="100"> -->
					<h4>The Meradian School Inc.</h4>
					<h5>City Park Avenue, Brgy. Sabang Lipa City, Batangas</h5>
          <h5>Academic Year <?php echo $active['academic_year']; ?></h5>
				</center>
			</div>
		</div>
		<hr>
		<div class="row mt-5">
			<div class="col-md-4">
				<p>First Name: <b><?php echo $student['firstname']; ?></b></p>
				<p>Middle Name: <b><?php echo $student['middlename']; ?></b></p>
				<p>Last Name: <b><?php echo $student['lastname']; ?></b></p>
			</div>
			<div class="col-md-4">
				<p>Gender: <b><?php echo $student['gender']; ?></b></p>
				<p>Email: <b><?php echo $student['email']; ?></b></p>
				<p>Contact Number: <b><?php echo $student['contact_number']; ?></b></p>
			</div>
			<div class="col-md-4">
				<p>Student Number: <b><?php echo $student['id_number']; ?></b></p>
				<p>School Year: <b><?php echo $student['school_year']; ?></b></p>
				<p>Section: <b><?php echo $student['section']; ?></b></p>
			</div>
		</div>
		<hr>
		<div class="row mt-2">
			<div class="col-md-12">
				  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <!-- <th><center>ID NUMBER</center></th>
                      <th><center>NAME</center></th>
                      <th><center>YEAR & SECTION</center></th> -->
                      <th>CODE</th>
                      <th>SUBJECT</th>
                      <th>1ST</th>
                      <th>2ND</th>
                      <th>3RD</th>
                      <th>4TH</th>
                      <th>AVERAGE</th>
                      <!-- <th><center>ACTION</center></th> -->
                    </tr>
                    </thead>
                    <tbody>

                      <?php   

                       

                          $selectStudSched = ' SELECT `id`, `student_id`, `schedule_id`, `date_created`, `academic_year_id` FROM `tbl_student_schedule` WHERE student_id = '.$_GET['student_id'].' AND academic_year_id = '.$_GET['academic_year_id'];
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
                        
                          <td><?php echo $subject['subject_code']; ?></td>
                          <td><?php echo $subject['subject_name']; ?></td>
                          <td><?php echo (empty($rowGrade['first']) ? 0 : $rowGrade['first']); ?></td>
                          <td><?php echo (empty($rowGrade['second']) ? 0 : $rowGrade['second']); ?></td>
                          <td><?php echo (empty($rowGrade['third']) ? 0 : $rowGrade['third']); ?></td>
                          <td><?php echo (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth']); ?></td>
                          <td><b><?php echo ((empty($rowGrade['first']) ? 0 : $rowGrade['first']) + (empty($rowGrade['second']) ? 0 : $rowGrade['second']) + (empty($rowGrade['third']) ? 0 : $rowGrade['third']) + (empty($rowGrade['fourth']) ? 0 : $rowGrade['fourth'])) / 4; ?></b> </td>
                        
                        </tr>
                      <?php  }  ?>

                    </tbody>  
                  </table>
			</div>
		</div>
	</div>							
	
	<?php include'_include_footer.php'; ?>
	<script>
		window.print();
	</script>
</body>
</html>