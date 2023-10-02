<?php 
session_start();
require('conn.php');
$id = $_GET['id'];



$sql = ' DELETE FROM `tbl_liabilities` WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/student_liabilities.php');


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Liability Cleared!';
$_SESSION['toastr']['color'] = 'green';





