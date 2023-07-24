<?php 
require('conn.php');


$id = $_GET['id'];

$sql = ' DELETE FROM tbl_subject WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/subjects.php');
 	