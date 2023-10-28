<?php 
session_start();
require('conn.php');
date_default_timezone_set('Asia/Manila');
$date_today = date("Y-m-d");

$schedule_id = $_GET['schedule_id'];
$academic_year_id = $_GET['academic_year_id'];
$teacher_id = $_SESSION['id'];

// $sql = ' INSERT INTO `tbl_dtr`(`schedule_id`, `teacher_id`, `time_out`, `academic_year_id`) VALUES ('.$schedule_id.', '.$teacher_id.', NOW(), '.$academic_year_id.') ';
$sql = ' UPDATE `tbl_dtr` SET `time_out` = NOW() WHERE schedule_id = '.$schedule_id.' AND teacher_id = '.$teacher_id.' AND academic_year_id = '.$academic_year_id.' AND time_in LIKE "'.$date_today.'%" ';

$exec = $conn->query($sql);


if ($exec->num_rows > 0) 
{
	$_SESSION['toastr']['title'] = 'Looking Good!';
	$_SESSION['toastr']['message'] = 'Successfully Logged out.';
	$_SESSION['toastr']['color'] = 'green';
}
else
{
	$_SESSION['toastr']['title'] = 'Error!';
	$_SESSION['toastr']['message'] = 'Missing Time in.';
	$_SESSION['toastr']['color'] = 'red';
}


header('location: ../teacher/teacher_dtr.php');