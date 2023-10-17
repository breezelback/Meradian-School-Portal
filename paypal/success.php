<?php
require_once 'config.php';
 
// Once the transaction has been approved, we need to complete it.
if (array_key_exists('paymentId', $_GET) && array_key_exists('PayerID', $_GET)) {
    $transaction = $gateway->completePurchase(array(
        'payer_id'             => $_GET['PayerID'],
        'transactionReference' => $_GET['paymentId'],
    ));
    $response = $transaction->send();
 
    if ($response->isSuccessful()) {
        // The customer has successfully paid.
        $arr_body = $response->getData();

        $payment_id = $db->real_escape_string($arr_body['id']);
        $payer_id = $db->real_escape_string($arr_body['payer']['payer_info']['payer_id']);
        $payer_email = $db->real_escape_string($arr_body['payer']['payer_info']['email']);
        $amount = $db->real_escape_string($arr_body['transactions'][0]['amount']['total']);
        $currency = PAYPAL_CURRENCY;
        $payment_status = $db->real_escape_string($arr_body['state']);
 
        $sql = sprintf("INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status, student_id, academic_year_id) VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')", $payment_id, $payer_id, $payer_email, $amount, $currency, $payment_status, $_GET['student_id'], $_GET['academic_year_id']);
        $db->query($sql);

        $sql1 = ' UPDATE `tbl_liabilities` SET status = 1, pay_date = NOW() WHERE id = '.$_GET['pay_id'];
        $db->query($sql1);

 
        // echo "Payment is successful. Your transaction id is: ". $payment_id;
        header('location: ../student/student_liabilities.php');
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}