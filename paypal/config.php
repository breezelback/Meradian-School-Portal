<?php
require_once "vendor/autoload.php";

use Omnipay\Omnipay;

define('CLIENT_ID', 'AWhjxdN8zynTWANOWE-QJtLKq_BMdjnlbg51iOZ2CUaApEOFa8fg2kyxBp3YpUuFdFrGFB_061Vc39C2');
define('CLIENT_SECRET', 'EOODRAF5TZFkzsbrWaEOK2nYgXlyDKLL3EKSSJIYjDAnir_MekdROEI5FuXPUswBUrLyUrRL8Cs4LgcV');

define('PAYPAL_RETURN_URL', 'http://localhost/paypal/success.php');
define('PAYPAL_CANCEL_URL', 'http://localhost/paypal/cancel.php');
define('PAYPAL_CURRENCY', 'PHP'); // set your currency here

// Connect with the database
$db = new mysqli('localhost', 'root', '', 'paypal'); 

if ($db->connect_errno) {
    die("Connect failed: ". $db->connect_error);
}

$gateway = Omnipay::create('PayPal_Rest');
$gateway->setClientId(CLIENT_ID);
$gateway->setSecret(CLIENT_SECRET);
$gateway->setTestMode(true); //set it to 'false' when go live