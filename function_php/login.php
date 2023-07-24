<?php 
session_start();
require('conn.php');


$id_number = $_POST['id_number'];
$password = $_POST['password'];

$sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `usert_type`, `status`, `date_created` FROM `tbl_user` WHERE id_number = "'.$id_number.'" AND password = "'.$password.'" ';
$exec = $conn->query($sql);


if ($exec->num_rows > 0) 
{
	$row = $exec->fetch_assoc();

	$profile_picture = $row['profile_picture'];
	$id_number = $row['id_number'];
	$firstname = $row['firstname'];
	$middlename = $row['middlename'];
	$lastname = $row['lastname'];
	$suffix = $row['suffix'];
	$gender = $row['gender'];
	$email = $row['email'];
	$contact_number = $row['contact_number'];
	$telephone = $row['telephone'];
	$birthdate = $row['birthdate'];
	$province = $row['province'];
	$city = $row['city'];
	$barangay = $row['barangay'];
	$house_no = $row['house_no'];
	$school_year = $row['school_year'];
	$section = $row['section'];
	$usert_type = $row['usert_type'];

	if ($usert_type == 'admin') {
		header('location: ../admin/');	

		$_SESSION['toastr']['title'] = 'Success';
		$_SESSION['toastr']['message'] = 'Admin Login';
		$_SESSION['toastr']['color'] = 'green';
	}
}
else
{
	header('location: ../index.php');

	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = 'User not found!';
	$_SESSION['toastr']['color'] = 'red';
}


 