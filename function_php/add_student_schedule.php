<?php 
session_start();
require('conn.php');
$student_id = $_POST['student_id'];
$check_id = $_POST['check_id'];

if(empty($check_id))
{
	header('location: ../admin/view_student_academic.php?id='.$student_id);


	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = 'Please add subject!';
	$_SESSION['toastr']['color'] = 'red';
}
else
{
	for ($i=0; $i < count($check_id); $i++) { 
		$sql = ' INSERT INTO `tbl_student_schedule`(`student_id`, `schedule_id`, `date_created`) VALUES ( '.$student_id.', '.$check_id[$i].', NOW() ) ';
		$exec = $conn->query($sql);
	}

	header('location: ../admin/view_student_academic.php?id='.$student_id);


	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'User Add!';
	$_SESSION['toastr']['color'] = 'green';
}





