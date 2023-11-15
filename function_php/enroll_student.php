<?php 
session_start();
require('conn.php');
$year_id = $_POST['year_id'];
$check_id = $_POST['check_id'];


if(empty($check_id))
{
	header('location: ../admin/student_academic_data.php');


	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = 'Please select student!';
	$_SESSION['toastr']['color'] = 'red';
}
else
{
	for ($i=0; $i < count($check_id); $i++) { 

		$sql1 = ' SELECT id FROM tbl_enrollment WHERE academic_year_id = '.$year_id.' AND student_id = '.$check_id[$i].' AND status = "Drop" ';
		$exec1 = $conn->query($sql1);

		if ($exec1->num_rows > 0) 
		{
			$sql = ' UPDATE `tbl_enrollment` SET `status` = "Enrolled", `date_created` = NOW() WHERE student_id = '.$check_id[$i].' AND academic_year_id = '.$year_id.' ';
			$exec = $conn->query($sql);
		}
		else
		{
			$getYear = 'SELECT school_year, gender FROM tbl_user WHERE id = '.$check_id[$i];
			$execYear = $conn->query($getYear);
			$stud_info = $execYear->fetch_assoc();

			$sql = ' INSERT INTO `tbl_enrollment`(`academic_year_id`, `student_id`, `status`, `date_created`, `school_year`, `gender`) VALUES ( '.$year_id.', '.$check_id[$i].', "Enrolled", NOW(), "'.$stud_info['school_year'].'", "'.$stud_info['gender'].'" ) ';
			$exec = $conn->query($sql);
		}


	}

	header('location: ../admin/student_academic_data.php');


	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'User Enrolled!';
	$_SESSION['toastr']['color'] = 'green';
}





