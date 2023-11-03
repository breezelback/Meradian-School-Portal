<?php 
session_start();
require('conn.php');


$sql = ' UPDATE tbl_dtr_availability SET active = false ';
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Online Daily Time Record Disabled!';
$_SESSION['toastr']['color'] = 'green';

// header('location: ../admin/academic_year.php');
echo "<script>javascript:history.go(-1)</script>";
 	