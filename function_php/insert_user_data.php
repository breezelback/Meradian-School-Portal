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

$error_message = "";
//initialize image upload
$target_dir = "../images/user/";
$path = $_FILES['profile_picture']['name']; 
$ext = pathinfo($path, PATHINFO_EXTENSION);
$filename = time().'.'.$ext;

$target_file = $target_dir . $filename;

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


//---------password encryption-------
$simple_string = $password;
 
$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = "GeeksforGeeks";
$encryption = openssl_encrypt($simple_string, $ciphering,
$encryption_key, $options, $encryption_iv);
// Display the encrypted string
// echo "Encrypted String: " . $encryption;
$password = $encryption;
$decryption_iv = '1234567891011121';
$decryption_key = "GeeksforGeeks";
$decryption=openssl_decrypt ($encryption, $ciphering, 
$decryption_key, $options, $decryption_iv);
// Display the decrypted string
// echo "Decrypted String: " . $decryption;

//---------password encryption-------

if ($path == "") 
{

	$sql = ' INSERT INTO tbl_user (id_number, firstname, middlename, lastname, suffix, gender, email, contact_number, telephone, birthdate, province, city, barangay, house_no, school_year, section, password, user_type, date_created, student_status, enrollment_status) VALUES ("'.$id_number.'", "'.$firstname.'", "'.$middlename.'", "'.$lastname.'", "'.$suffix.'", "'.$gender.'", "'.$email.'", "'.$contact_number.'", "'.$telephone.'", "'.$birthdate.'", "'.$province.'", "'.$city.'", "'.$barangay.'", "'.$house_no.'", "'.$school_year.'", "'.$section.'", "'.$password.'", "'.$usertype.'", NOW(), "'.$student_status.'", "'.$enrollment_status.'") ';

	$exec = $conn->query($sql);


	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'User Add!';
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

		$sql = ' INSERT INTO tbl_user (id_number, firstname, middlename, lastname, suffix, gender, email, contact_number, telephone, birthdate, province, city, barangay, house_no, school_year, section, profile_picture, password, user_type, date_created, student_status, enrollment_status) VALUES ("'.$id_number.'", "'.$firstname.'", "'.$middlename.'", "'.$lastname.'", "'.$suffix.'", "'.$gender.'", "'.$email.'", "'.$contact_number.'", "'.$telephone.'", "'.$birthdate.'", "'.$province.'", "'.$city.'", "'.$barangay.'", "'.$house_no.'", "'.$school_year.'", "'.$section.'", "'.$filename.'", "'.$password.'", "'.$usertype.'", NOW(), "'.$student_status.'", "'.$enrollment_status.'") ';

		$exec = $conn->query($sql);


		$_SESSION['toastr']['title'] = 'Success';
		$_SESSION['toastr']['message'] = 'User Add!';
		$_SESSION['toastr']['color'] = 'green';

	}	
}


if ($usertype == "student") 
{
	header('location: ../admin/students.php');
}
else
{
	header('location: ../admin/teachers.php');
}