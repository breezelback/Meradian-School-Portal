<?php 
session_start();
require('conn.php');

$teacher_id = $_POST['teacher_id'];
$subject_id = $_POST['subject_id'];
$teaching_day = $_POST['teaching_day'];
$teaching_time = $_POST['teaching_time'];

$sql = ' INSERT INTO `tbl_schedule`(`teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `date_created`) VALUES ("'.$teacher_id.'", "'.$subject_id.'", "'.$teaching_day.'", "'.$teaching_time.'", NOW()) ';
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Add!';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../admin/view_teacher.php?id='.$teacher_id);