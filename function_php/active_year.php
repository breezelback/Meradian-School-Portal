<?php 
session_start();
require('conn.php');

$id = $_GET['id'];

$stud = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE user_type = "student" ';
$execStud = $conn->query($stud);
while ($row = $execStud->fetch_assoc()) {
	if ($row['school_year'] == "Kinder") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 1" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 1") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 2" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 2") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 3" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 3") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 4" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 4") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 5" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 5") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 6" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 6") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 7" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 7") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 7" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 8") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 8" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 9") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 9" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 10") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 11" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 11") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Grade 12" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Grade 12") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "First Year" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "First Year") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Second Year" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Second Year") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Third Year" WHERE id = '.$row['id'];
	}
	else if ($row['school_year'] == "Third Year") 
	{
		$sqlUpdate = ' UPDATE tbl_user SET school_year = "Fourth Year" WHERE id = '.$row['id'];
	}

	$conn->query($sqlUpdate);
}



$sql = ' UPDATE tbl_academic_year SET status = "Inactive" ';
$exec = $conn->query($sql);

$sql = ' UPDATE tbl_academic_year SET status = "Active" WHERE id = '.$id;
$exec = $conn->query($sql);


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Academic Year Updated!';
$_SESSION['toastr']['color'] = 'green';

header('location: ../admin/academic_year.php');
 	