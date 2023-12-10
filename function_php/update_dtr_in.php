<?php 
session_start();
require('conn.php');


$id = $_GET['id'];

$sql = ' UPDATE tbl_dtr1 SET time_in = NOW() WHERE id = '.$id;
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Looking Good!';
$_SESSION['toastr']['message'] = 'Successfully Logged in.';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../teacher/teacher_dtr.php');