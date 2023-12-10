<?php 
session_start();
require('conn.php');

$school_year = $_GET['school_year'];

$selectSection = 'SELECT `id`, `school_year`, `section`, `status`, `date_created` FROM `tbl_section` WHERE school_year = "'.$school_year.'"';
$execSection = $conn->query($selectSection);
$array_section = array();
if ($execSection->num_rows > 0) 
{
	while ($section = $execSection->fetch_assoc())
	{
	
		$array_section[$section['id']] = $section['section'];
	}
		
		echo json_encode($array_section);
}
else
{
	echo "";
}




