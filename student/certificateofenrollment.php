
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

	<?php include '_include_header.php'; ?>
  <?php 
    require('../function_php/conn.php'); 
    //$_GET['academic_year_id'];
    //$_GET['student_id'];
    $sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE id = '.$_SESSION['id'];
    $exec = $conn->query($sql);
    $student = $exec->fetch_assoc();

   $sql1 = ' SELECT `id`, `academic_year`, `status`, `date_created` FROM `tbl_academic_year` WHERE status = "Active" ';
    $exec1 = $conn->query($sql1);
    $active = $exec1->fetch_assoc();
    ?>
    <style>
      body {
        background-image: url('../images/print_bg.jpg');
        background-repeat: no-repeat;
        /*background-attachment: fixed;*/
        background-size: 50% 100%;
        background-position: center;
      }
      @media print {
      body {
          background-size: 70% 50%;
        }
      }
    </style>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12 mt-5">
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

			<div class="col-md-12">
        <center>
          <p>This is to certify that <b><?php echo $student['firstname']; ?></b> <b><?php echo $student['lastname']; ?></b> is currently enrolled for academic year <b><?php echo $active['academic_year']; ?></b>.</p>
        </center>
			</div>
		
		</div>
	</div>							
	
	<?php include'_include_footer.php'; ?>
	<script>
		// window.print();
	</script>
</body>
</html>