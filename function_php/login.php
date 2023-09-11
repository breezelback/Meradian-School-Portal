<?php 
session_start();
require('conn.php');


$id_number = $_POST['id_number'];
$password = $_POST['password'];

$sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id_number = "'.$id_number.'" AND password = "'.$password.'" ';
$exec = $conn->query($sql);


if ($exec->num_rows > 0) 
{
	$row = $exec->fetch_assoc();

	$_SESSION['id'] = $row['id'];
	$_SESSION['profile_picture'] = $row['profile_picture'];
	$_SESSION['id_number'] = $row['id_number'];
	$_SESSION['firstname'] = $row['firstname'];
	$_SESSION['middlename'] = $row['middlename'];
	$_SESSION['lastname'] = $row['lastname'];
	$_SESSION['suffix'] = $row['suffix'];
	$_SESSION['gender'] = $row['gender'];
	$_SESSION['email'] = $row['email'];
	$_SESSION['contact_number'] = $row['contact_number'];
	$_SESSION['telephone'] = $row['telephone'];
	$_SESSION['birthdate'] = $row['birthdate'];
	$_SESSION['province'] = $row['province'];
	$_SESSION['city'] = $row['city'];
	$_SESSION['barangay'] = $row['barangay'];
	$_SESSION['house_no'] = $row['house_no'];
	$_SESSION['school_year'] = $row['school_year'];
	$_SESSION['section'] = $row['section'];
	$_SESSION['user_type'] = $row['user_type'];

	if ($row['user_type'] == 'student') {
		$_SESSION['toastr']['title'] = 'Looks Good!';
		$_SESSION['toastr']['message'] = 'Successfully Login as Student';
		$_SESSION['toastr']['color'] = 'green';
		header('location: ../student/');
	}
	else if ($row['user_type'] == 'teacher') {
		$_SESSION['toastr']['title'] = 'Looks Good!';
		$_SESSION['toastr']['message'] = 'Successfully Login as Teacher';
		$_SESSION['toastr']['color'] = 'green';
		header('location: ../teacher/');
	}
	else
	{
		header('location: ../admin/');	
	}

	// $_SESSION['toastr']['title'] = 'Looks Good!';
	// $_SESSION['toastr']['message'] = 'Successfully Login';
	// $_SESSION['toastr']['color'] = 'green';
}
else
{
	header('location: ../index.php');

	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = 'User not found!';
	$_SESSION['toastr']['color'] = 'red';
}


 