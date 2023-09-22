<?php 
session_start();
require('conn.php');


$id = $_GET['id'];
// $user_type = $_GET['user_type'];

$sql = ' DELETE FROM tbl_user WHERE id = '.$id;
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Deleted!';
$_SESSION['toastr']['color'] = 'green';


// if ($user_type == "student") 
// {
// 	header('location: ../admin/students.php');
// }
// else
// {
// 	header('location: ../admin/teachers.php');
// }	

echo "<script>javascript:history.go(-1)</script>";