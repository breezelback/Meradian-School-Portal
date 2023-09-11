<?php 
session_start();
require('conn.php');

$academic_year = $_POST['academic_year'];

$sql = ' INSERT INTO `tbl_academic_year`(`academic_year`, `date_created`) VALUES ("'.$academic_year.'", NOW()) ';
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Add!';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../admin/academic_year.php');