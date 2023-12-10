<?php 
session_start();
require('conn.php');

$school_year = $_GET['school_year'];

$selectSubject = 'SELECT `id`, `subject_name`, `subject_code`, `date_created`, `school_year` FROM `tbl_subject` WHERE school_year = "'.$school_year.'"';
$execSubject = $conn->query($selectSubject);
$array_subject = array();
if ($execSubject->num_rows > 0) 
{
	while ($subject = $execSubject->fetch_assoc())
	{
	
		$array_subject[$subject['id']] = $subject['subject_name'];
	}
		
		echo json_encode($array_subject);
}
else
{
	echo "";
}




