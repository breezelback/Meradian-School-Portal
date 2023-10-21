<?php 
session_start();
require('conn.php');
require 'sendMail.php';

$id_number = $_POST['id_number'];
$email = $_POST['email'];

function randText(){
	$txt="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
	$str="";
	for($i=0;$i<7;$i++)
	{
		$index=rand(0,strlen($txt)-1);
		$str.=$txt[$index];
	}
	return $str;
}
$new_password=randText();

$select = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE id_number = "'.$id_number.'" AND email = "'.$email.'" ';
$execSelect = $conn->query($select);

if ($execSelect->num_rows > 0) 
{
	$row = $execSelect->fetch_assoc();
	$sql = ' UPDATE tbl_user SET password = "'.$new_password.'" WHERE id = '.$row['id'];
	$conn->query($sql);

	send_mail_admin($email, 'PASSWORD RESET', 'Dear User, <br><br> Please be informed that your password reset has been completed successfully. <br>Your new password is <b>'.$new_password.'</b><br><br><br>-----<i>This is a system generated email.</i>-----');

	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'Your new password has been sent to <b>'.$email.'</b>';
	$_SESSION['toastr']['color'] = 'green';
}
else
{
	
	$_SESSION['toastr']['title'] = 'Error';
	$_SESSION['toastr']['message'] = 'ID Number and Email do not match!';
	$_SESSION['toastr']['color'] = 'red';	
}





header('location: ../index.php');