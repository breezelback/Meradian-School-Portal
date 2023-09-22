<?php 
session_start();
require('conn.php');
$id = $_GET['id'];
$first = $_POST['first'];
$second = $_POST['second'];
$third = $_POST['third'];
$fourth = $_POST['fourth'];

$sql = ' UPDATE `tbl_grades` SET `first`= '.$first.',`second`= '.$second.',`third`= '.$third.',`fourth`= '.$fourth.' WHERE id = '.$id;
$exec = $conn->query($sql);

// header('location: ../admin/student_academic_data.php');


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Grades Updated!';
$_SESSION['toastr']['color'] = 'green';


echo "<script>javascript:history.go(-1)</script>";



