<?php 
session_start();
require('conn.php');

$teacher_id = $_POST['teacher_id'];
$subject_id = $_POST['subject_id'];
// $teaching_day = $_POST['teaching_day'];
$teaching_day = '';
$teaching_time = $_POST['teaching_time'];
$teaching_time_to = $_POST['teaching_time_to'];
$monday = (isset($_POST['monday']) ? true : false);
$tuesday = (isset($_POST['tuesday']) ? true : false);
$wednesday = (isset($_POST['wednesday']) ? true : false);
$thursday = (isset($_POST['thursday']) ? true : false);
$friday = (isset($_POST['friday']) ? true : false);
$saturday = (isset($_POST['saturday']) ? true : false);
$sunday = (isset($_POST['sunday']) ? true : false);
$school_year = $_POST['school_year'];
$section = $_POST['section'];



if ($teaching_time_to < $teaching_time) {
	echo "Second time should be greater than first selected time.";
}
else
{
	$sql = ' INSERT INTO `tbl_schedule`(`teacher_id`, `subject_id`, `teaching_day`, `teaching_time`, `date_created`, `teaching_time_to`, `monday`, `tuesday`, `wednesday`, `thursday`, `friday`, `saturday`, `sunday`, `school_year`, `section`) VALUES ("'.$teacher_id.'", "'.$subject_id.'", "'.$teaching_day.'", "'.$teaching_time.'", NOW(), "'.$teaching_time_to.'" ,"'.$monday.'", "'.$tuesday.'", "'.$wednesday.'", "'.$thursday.'", "'.$friday.'", "'.$saturday.'", "'.$sunday.'", "'.$school_year.'", "'.$section.'") ';

	$exec = $conn->query($sql);


	$_SESSION['toastr']['title'] = 'Success';
	$_SESSION['toastr']['message'] = 'User Add!';
	$_SESSION['toastr']['color'] = 'green';
	 
	header('location: ../admin/view_teacher.php?id='.$teacher_id);
}

