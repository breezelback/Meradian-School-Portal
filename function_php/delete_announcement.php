<?php 
session_start();
require('conn.php');


$id = $_GET['id'];

$sql = ' DELETE FROM tbl_announcement WHERE id = '.$id;
$exec = $conn->query($sql);

$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Announcement Deleted!';
$_SESSION['toastr']['color'] = 'green';

header('location: ../admin/announcements.php');
 	