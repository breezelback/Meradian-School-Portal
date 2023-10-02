<?php 
session_start();
require('conn.php');
$year_id = $_POST['year_id'];
$check_id = $_POST['check_id'];


if(empty($check_id))
{
	header('location: ../admin/student_liabilities.php');


	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = 'Please select student!';
	$_SESSION['toastr']['color'] = 'red';
}
else
{
	for ($i=0; $i < count($check_id); $i++) { 

		
		$sql = ' INSERT INTO `tbl_liabilities`(`student_id`, `academic_year_id`, `amount`, `date_created`)  VALUES ( '.$check_id[$i].', '.$year_id.', '.$_POST['liability'][$i].', NOW() ) ';
		$exec = $conn->query($sql);


	}

	header('location: ../admin/student_liabilities.php');


	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'User Liablities Added!';
	$_SESSION['toastr']['color'] = 'green';
}





