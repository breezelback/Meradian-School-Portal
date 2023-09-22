<?php 
session_start();
require('conn.php');


$usertype = $_GET['usertype'];

$profile_picture = $_POST['profile_picture'];
$id_number = $_POST['id_number'];
$firstname = $_POST['firstname'];
$middlename = $_POST['middlename'];
$lastname = $_POST['lastname'];
$suffix = $_POST['suffix'];
$gender = $_POST['gender'];
$email = $_POST['email'];
$contact_number = $_POST['contact_number'];
$telephone = $_POST['telephone'];
$birthdate = $_POST['birthdate'];
$province = $_POST['province'];
$city = $_POST['city'];
$barangay = $_POST['barangay'];
$house_no = $_POST['house_no'];
$school_year = $_POST['school_year'];
$section = $_POST['section'];
$password = $_POST['password'];
$student_status = $_POST['student_status'];
// $enrollment_status = $_POST['enrollment_status'];
$enrollment_status = "Not Enrolled";

$sql = ' INSERT INTO tbl_user (id_number, firstname, middlename, lastname, suffix, gender, email, contact_number, telephone, birthdate, province, city, barangay, house_no, school_year, section, password, user_type, date_created, student_status, enrollment_status) VALUES ("'.$id_number.'", "'.$firstname.'", "'.$middlename.'", "'.$lastname.'", "'.$suffix.'", "'.$gender.'", "'.$email.'", "'.$contact_number.'", "'.$telephone.'", "'.$birthdate.'", "'.$province.'", "'.$city.'", "'.$barangay.'", "'.$house_no.'", "'.$school_year.'", "'.$section.'", "'.$password.'", "'.$usertype.'", NOW(), "'.$student_status.'", "'.$enrollment_status.'") ';

$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Add!';
$_SESSION['toastr']['color'] = 'green';
 

if ($usertype == "student") 
{
	header('location: ../admin/students.php');
}
else
{
	header('location: ../admin/teachers.php');
}