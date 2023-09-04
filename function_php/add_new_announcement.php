<?php 
session_start();
require('conn.php');

$title = $_POST['title'];
$announcement = $_POST['announcement'];

$sql = ' INSERT INTO `tbl_announcement`( `title`, `announcement`, `date_created`) VALUES  ("'.$title.'", "'.$announcement.'", NOW()) ';
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Add!';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../admin/announcements.php');