<?php 
session_start();
require('conn.php');

$section = $_POST['section'];
$school_year = $_POST['school_year'];

$sql = ' INSERT INTO `tbl_section`(`school_year`, `section`, `date_created`) VALUES ("'.$school_year.'", "'.$section.'", NOW()) ';
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Section Added!';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../admin/sections.php');