<?php 
require('conn.php');


$schedule_id = $_GET['id'];
$teacher_id = $_GET['user_id'];

$sql = ' DELETE FROM tbl_schedule WHERE id = '.$schedule_id;
$exec = $conn->query($sql);

header('location: ../admin/view_teacher.php?id='.$teacher_id);
 	