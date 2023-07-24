<?php 
require('conn.php');


$id = $_GET['id'];

$sql = ' DELETE FROM tbl_user WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/	students.php');
 	