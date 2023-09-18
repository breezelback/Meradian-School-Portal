<?php 
session_start();
require('conn.php');
$id = $_GET['id'];



$sql = ' UPDATE `tbl_enrollment` SET `status` = "Enrolled", `date_created` = NOW() WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/student_academic_data.php');


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Enrolled!';
$_SESSION['toastr']['color'] = 'green';





