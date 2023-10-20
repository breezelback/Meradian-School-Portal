<?php 
session_start();
require('conn.php');
$id = $_GET['id'];



$sql = ' DELETE FROM `tbl_scholarship` WHERE id = '.$id;
$exec = $conn->query($sql);

header('location: ../admin/scholarship.php');


$_SESSION['toastr']['title'] = 'Success';
$_SESSION['toastr']['message'] = 'Voucher Deleted!';
$_SESSION['toastr']['color'] = 'green';





