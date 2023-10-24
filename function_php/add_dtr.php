<?php 
session_start();
require('conn.php');


$schedule_id = $_GET['schedule_id'];
$academic_year_id = $_GET['academic_year_id'];
$teacher_id = $_SESSION['id'];

$sql = ' INSERT INTO `tbl_dtr`(`schedule_id`, `teacher_id`, `time_in`, `academic_year_id`) VALUES ('.$schedule_id.', '.$teacher_id.', NOW(), '.$academic_year_id.') ';
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Looking Good!';
$_SESSION['toastr']['message'] = 'Successfully Logged in.';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../teacher/teacher_dtr.php');