<?php 
session_start();
require('conn.php');


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

$sql = ' UPDATE tbl_user SET id_number = "'.$id_number.'", firstname = "'.$firstname.'", middlename = "'.$middlename.'", lastname = "'.$lastname.'", suffix = "'.$suffix.'", gender = "'.$gender.'", email = "'.$email.'", contact_number = "'.$contact_number.'", telephone = "'.$telephone.'", birthdate = "'.$birthdate.'", province = "'.$province.'", city = "'.$city.'", barangay = "'.$barangay.'", house_no = "'.$house_no.'", school_year = "'.$school_year.'", section = "'.$section.'" WHERE id = '.$_GET['id'].' ';

$exec = $conn->query($sql);

if ($exec) {
	echo "Data Sucessfully Updated!";
}


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'User Updated!';
$_SESSION['toastr']['color'] = 'green';


//header('location: ../admin/students.php');
echo "<script>javascript:history.go(-1)</script>";