<?php 
require('conn.php');


$id = $_GET['id'];

$sql = ' UPDATE tbl_academic_year SET status = "Inactive" ';
$exec = $conn->query($sql);

$sql = ' UPDATE tbl_academic_year SET status = "Active" WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/academic_year.php');
 	