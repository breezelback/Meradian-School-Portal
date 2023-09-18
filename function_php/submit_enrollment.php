<?php 
session_start();
require('conn.php');
$id = $_GET['id'];
$academic_year_id = $_GET['academic_year_id'];



$sql = ' INSERT INTO `tbl_enrollment`(`academic_year_id`, `student_id`, `status`, `date_created`) VALUES ('.$academic_year_id.', '.$id.', "Pending", NOW()) ';
$exec = $conn->query($sql);

header('location: ../student/');


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Enrollment Application';
$_SESSION['toastr']['color'] = 'green';





