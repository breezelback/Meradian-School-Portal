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

$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];


if ($password != $confirm_password) 
{
	
	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = "Password do not match!";
	$_SESSION['toastr']['color'] = 'red';
}//end password
else
{
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

		$sql = ' UPDATE tbl_user SET id_number = "'.$id_number.'", firstname = "'.$firstname.'", middlename = "'.$middlename.'", lastname = "'.$lastname.'", suffix = "'.$suffix.'", gender = "'.$gender.'", email = "'.$email.'", contact_number = "'.$contact_number.'", telephone = "'.$telephone.'", birthdate = "'.$birthdate.'", province = "'.$province.'", city = "'.$city.'", barangay = "'.$barangay.'", house_no = "'.$house_no.'", school_year = "'.$school_year.'", section = "'.$section.'", password = "'.$password.'" WHERE id = '.$_GET['id'].' ';

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

			$sql = ' UPDATE tbl_user SET id_number = "'.$id_number.'", firstname = "'.$firstname.'", middlename = "'.$middlename.'", lastname = "'.$lastname.'", suffix = "'.$suffix.'", gender = "'.$gender.'", email = "'.$email.'", contact_number = "'.$contact_number.'", telephone = "'.$telephone.'", birthdate = "'.$birthdate.'", province = "'.$province.'", city = "'.$city.'", barangay = "'.$barangay.'", house_no = "'.$house_no.'", school_year = "'.$school_year.'", section = "'.$section.'", profile_picture = "'.$filename.'", password = "'.$password.'" WHERE id = '.$_GET['id'].' ';

			$exec = $conn->query($sql);


			$_SESSION['toastr']['title'] = 'Success';
			$_SESSION['toastr']['message'] = 'User Updated!';
			$_SESSION['toastr']['color'] = 'green';

		}	
	}



}//else password match



//header('location: ../admin/students.php');
echo "<script>javascript:history.go(-1)</script>";