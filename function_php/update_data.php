<?php 
session_start();
require('conn.php');


// $profile_picture = $_POST['profile_picture'];
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

$error_message = "";
//initialize image upload
$target_dir = "../images/user/";
$path = $_FILES['profile_picture']['name']; 
$ext = pathinfo($path, PATHINFO_EXTENSION);
$filename = time().'.'.$ext;

$target_file = $target_dir . $filename;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


if ($path == "") 
{

	$sql = ' UPDATE tbl_user SET id_number = "'.$id_number.'", firstname = "'.$firstname.'", middlename = "'.$middlename.'", lastname = "'.$lastname.'", suffix = "'.$suffix.'", gender = "'.$gender.'", email = "'.$email.'", contact_number = "'.$contact_number.'", telephone = "'.$telephone.'", birthdate = "'.$birthdate.'", province = "'.$province.'", city = "'.$city.'", barangay = "'.$barangay.'", house_no = "'.$house_no.'", school_year = "'.$school_year.'", section = "'.$section.'" WHERE id = '.$_GET['id'].' ';

	$exec = $conn->query($sql);
	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'User Updated!';
	$_SESSION['toastr']['color'] = 'green';
}
else
{
	// Check file size
	if ($_FILES["profile_picture"]["size"] > 5000000) {
		$error_message = "Sorry, your file is too large. Maximum of 5MB filesize.";
	  $uploadOk = 0;
	}

	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	  $uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	  // echo "Sorry, your file was not uploaded.";

		$_SESSION['toastr']['title'] = 'Error';
		$_SESSION['toastr']['message'] = $error_message;
		$_SESSION['toastr']['color'] = 'red';

	// if everything is ok, try to upload file
	} else {

		move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file);

		$sql = ' UPDATE tbl_user SET id_number = "'.$id_number.'", firstname = "'.$firstname.'", middlename = "'.$middlename.'", lastname = "'.$lastname.'", suffix = "'.$suffix.'", gender = "'.$gender.'", email = "'.$email.'", contact_number = "'.$contact_number.'", telephone = "'.$telephone.'", birthdate = "'.$birthdate.'", province = "'.$province.'", city = "'.$city.'", barangay = "'.$barangay.'", house_no = "'.$house_no.'", school_year = "'.$school_year.'", section = "'.$section.'", profile_picture = "'.$filename.'" WHERE id = '.$_GET['id'].' ';

		$exec = $conn->query($sql);


		$_SESSION['toastr']['title'] = 'Success';
		$_SESSION['toastr']['message'] = 'User Updated!';
		$_SESSION['toastr']['color'] = 'green';

	}	
}







//header('location: ../admin/students.php');
echo "<script>javascript:history.go(-1)</script>";