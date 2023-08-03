<?php 
session_start();
require('conn.php');

$subject_name = $_POST['subject_name'];
$subject_code = $_POST['subject_code'];
$school_year = $_POST['school_year'];

$sql = ' INSERT INTO tbl_subject(subject_name, subject_code, date_created) VALUES ("'.$subject_name.'", "'.$subject_code.'", NOW()) ';
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Add!';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../admin/subjects.php');