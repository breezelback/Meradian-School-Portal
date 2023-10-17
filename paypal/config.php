<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'AXcYCPkTzbQ0Xzuy6_19T4bmFBdLVMW4BWG3Dv2m5mrEt4WRjTHQjeG43fxkwSwrvK0MvIjf-sf-TAYV');

define('PAYPAL_RETURN_URL', 'http://localhost/Meradian%20School%20Portal/paypal/success.php?pay_id='.$_POST['pay_id'].'&student_id='.$_POST['student_id'].'&academic_year_id='.$_POST['academic_year_id']);
define('PAYPAL_CANCEL_URL', 'http://localhost/Meradian%20School%20Portal/paypal/cancel.php');
define('PAYPAL_CURRENCY', 'PHP'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'db_meradian'); 

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId('AXcYCPkTzbQ0Xzuy6_19T4bmFBdLVMW4BWG3Dv2m5mrEt4WRjTHQjeG43fxkwSwrvK0MvIjf-sf-TAYV');
$gateway->setSecret('EHxINdYMelPJ0Anjqe_jw3QdxqsWvwwsYSbr8Jp0IJ1Tg770Ydv4Fxx5KJSF13mNloUdiLQeFVXOyKqT');
$gateway->setTestMode(true); //set it to 'false' when go live