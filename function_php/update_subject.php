<?php 
session_start();
require('conn.php');

$subject_name = $_POST['subject_name'];
$subject_code = $_POST['subject_code'];
$school_year = $_POST['school_year'];
$id = $_POST['id'];

$sql = ' UPDATE tbl_subject SET subject_name = "'.$subject_name.'", subject_code = "'.$subject_code.'", school_year = "'.$school_year.'" WHERE id = '.$id;
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Subject Updated!';
$_SESSION['toastr']['color'] = 'green';
 
header('location: ../admin/subjects.php');