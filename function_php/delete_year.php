<?php 
require('conn.php');


$id = $_GET['id'];

$sql = ' DELETE FROM tbl_academic_year WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/academic_year.php');
 	