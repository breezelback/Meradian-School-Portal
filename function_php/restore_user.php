<?php 
session_start();
require('conn.php');


$id = $_GET['id'];
// $user_type = $_GET['user_type'];


$insertLogs = ' INSERT INTO tbl_user SELECT * FROM tbl_logs WHERE id = '.$id;
$conn->query($insertLogs);

$sql = ' DELETE FROM tbl_logs WHERE id = '.$id;
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Restored!';
$_SESSION['toastr']['color'] = 'green';


// if ($user_type == "student") 
// {
// 	header('location: ../admin/students.php');
// }
// else
// {
// 	header('location: ../admin/teachers.php');
// }	

$deleteLia = ' DELETE FROM `tbl_liabilities` WHERE student_id = '.$id;
$conn->query($deleteLia);

$deleteVou = ' DELETE FROM `tbl_scholarship` WHERE student_id = '.$id;
$conn->query($deleteVou);

$deleteEnr = ' DELETE FROM `tbl_enrollment` WHERE student_id = '.$id;
$conn->query($deleteEnr);

$deleteSched = ' DELETE FROM `tbl_student_schedule` WHERE student_id = '.$id;
$conn->query($deleteSched);



echo "<script>javascript:history.go(-1)</script>";