<?php 
session_start();
require('conn.php');

$subject_id = $_GET['subject_id'];

$selectSched = ' SELECT DISTINCT(`teacher_id`) FROM `tbl_schedule` WHERE subject_id = '.$subject_id;
$execSched = $conn->query($selectSched);
$array_teacher = array();
if ($execSched->num_rows > 0) 
{
	while ($sched = $execSched->fetch_assoc())
	{
	
		$selectTeacher = ' SELECT `id`, `id_number`, `firstname`, `middlename`, `lastname`, `suffix`, `gender`, `email`, `contact_number`, `telephone`, `birthdate`, `province`, `city`, `barangay`, `house_no`, `school_year`, `section`, `profile_picture`, `username`, `password`, `user_type`, `status`, `date_created`, `student_status`, `enrollment_status` FROM `tbl_user` WHERE id = '.$sched['teacher_id'];
		$execTeacher = $conn->query($selectTeacher);
		$teacher = $execTeacher->fetch_assoc();
			
		$array_teacher[$teacher['id']] = $teacher['lastname'].', '.$teacher['firstname'];
	}
		// print_r($array_teacher);
		echo json_encode($array_teacher);
}
else
{
	echo "";
}




