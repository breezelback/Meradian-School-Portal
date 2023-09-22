<?php 
session_start();
require('conn.php');


$id = $_GET['id'];

$sql = ' DELETE FROM tbl_academic_year WHERE id = '.$id;
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Academic Year Deleted!';
$_SESSION['toastr']['color'] = 'green';


header('location: ../admin/academic_year.php');
 	