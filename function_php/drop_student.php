<?php 
session_start();
require('conn.php');
$id = $_GET['id'];



$sql = ' UPDATE `tbl_enrollment` SET `status` = "Drop", `date_drop` = NOW() WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/student_academic_data.php');


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Drop!';
$_SESSION['toastr']['color'] = 'green';





