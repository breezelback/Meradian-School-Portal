<?php 
session_start();
require('conn.php');


$id_number = $_POST['id_number'];
$password = $_POST['password'];
$captcha_code = $_POST['captcha_code'];

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

$decryption_iv = '1234567891011121';
$decryption_key = "GeeksforGeeks";
$decryption=openssl_decrypt ($encryption, $ciphering, 
$decryption_key, $options, $decryption_iv);
// Display the decrypted string
// echo "Decrypted String: " . $decryption;
$password = $encryption;
//---------password encryption-------


if ($captcha_code == $_SESSION['captcha']) {


	$sql = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `user_type`, `status`, `date_created` FROM `tbl_user` WHERE id_number = "'.$id_number.'" AND password = "'.$password.'" ';
	$exec = $conn->query($sql);




	if ($exec->num_rows > 0) 
	{
		$row = $exec->fetch_assoc();


	    $selectSection = 'SELECT `id`, `school_year`, `section`, `status`, `date_created` FROM `tbl_section` WHERE id = '.$row['section'];
	    $execSection = $conn->query($selectSection);
	    $section = $execSection->fetch_assoc();
    
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
		$_SESSION['section'] = $section['section'];
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
		else if ($row['user_type'] == 'admin') {
			$_SESSION['toastr']['title'] = 'Looks Good!';
			$_SESSION['toastr']['message'] = 'Successfully Login as Administrator';
			$_SESSION['toastr']['color'] = 'green';
			header('location: ../admin/');
		}
		else
		{
			header('location: ../student/');	
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

}
else
{

		$_SESSION['toastr']['title'] = 'Error';
		$_SESSION['toastr']['message'] = 'Please type correct CAPTCHA!';
		$_SESSION['toastr']['color'] = 'red';
		header('location: ../index.php');
}
