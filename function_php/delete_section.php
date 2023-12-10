<?php 
session_start();
require('conn.php');


$id = $_GET['id'];

$sql = ' DELETE FROM tbl_section WHERE id = '.$id;
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Section Deleted!';
$_SESSION['toastr']['color'] = 'green';


header('location: ../admin/sections.php');
 	