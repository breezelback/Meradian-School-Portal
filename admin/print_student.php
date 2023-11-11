<?php 
require('../function_php/conn.php'); 
//$_GET['academic_year_id'];
//$_GET['student_id'];
$sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` ';
$exec = $conn->query($sql);
$student = $exec->fetch_assoc();


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
			<div class="col-md-12 mt-2">
				<center>
					<!-- <img src="../images/logo.jpg" alt="" width="100"> -->
					<h4>The Meradian School Inc.</h4>
					<h5>City Park Avenue, Brgy. Sabang Lipa City, Batangas</h5>
          <!-- <h5>Academic Year <?php echo $active['academic_year']; ?></h5> -->
				</center>
			</div>
		</div>
		<div class="row mt-2">
			<div class="col-md-12">
        
				  <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th><center>ID NUMBER</center></th>
              <th width="140"><center>NAME</center></th>
              <th><center>GENDER</center></th>
              <th><center>EMAIL</center></th>
              <th><center>CONTACT NUMBER</center></th>
              <th><center>BIRTHDATE</center></th>
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
                  <!-- <td><img src="../images/user/<?php echo $row['profile_picture']; ?>" width="30" height="30" style="border-radius: 50px; border: 1px solid grey;">  &nbsp;<?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td> -->
                  <td><?php echo $row['firstname']; ?> <?php echo $row['lastname']; ?></td>
                  <td><?php echo $row['gender']; ?></td>
                  <td><?php echo $row['email']; ?></td>
                  <td><?php echo $row['contact_number']; ?></td>
                  <td><?php echo $row['birthdate']; ?></td>
                  <td><?php echo $row['house_no']; ?> <?php echo $barangay['brgyDesc']; ?> <?php echo $citymun['citymunDesc']; ?> <?php echo $province['provDesc']; ?></td>
                  <td><?php echo $row['school_year']; ?> | <?php echo $row['section']; ?></td>
                </tr>
              <?php } ?>

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