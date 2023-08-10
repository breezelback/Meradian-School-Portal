<?php 
require('conn.php');


$id = $_GET['id'];
$user_type = $_GET['user_type'];

$sql = ' DELETE FROM tbl_user WHERE id = '.$id;
$exec = $conn->query($sql);

if ($user_type == "student") 
{
	header('location: ../admin/students.php');
}
else
{
	header('location: ../admin/teachers.php');
}	