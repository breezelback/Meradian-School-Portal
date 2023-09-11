<?php 
require('conn.php');


$id = $_GET['id'];
$user_id = $_GET['user_id'];


$sql = ' DELETE FROM `tbl_student_schedule` WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/view_student_academic.php?id='.$user_id);
 	