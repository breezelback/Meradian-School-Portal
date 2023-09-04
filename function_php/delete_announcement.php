<?php 
require('conn.php');


$id = $_GET['id'];

$sql = ' DELETE FROM tbl_announcement WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/announcements.php');
 	