<?php 
session_start();
require('conn.php');


$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];


if ($new_password == $confirm_password) 
{
	//---------password encryption-------
	$simple_string = $new_password;
	 
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

	$sql = ' UPDATE tbl_user SET password = "'.$password.'" WHERE id = '.$_SESSION['id'];
	$exec = $conn->query($sql);


	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'Password Successfully Updated!';
	$_SESSION['toastr']['color'] = 'green';
}
else
{
	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = 'Password do not match!';
	$_SESSION['toastr']['color'] = 'red';	
}



header('location: ../admin/update_password.php');
 	