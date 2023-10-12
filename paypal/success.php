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
 
        $sql = sprintf("INSERT INTO payments(payment_id, payer_id, payer_email, amount, currency, payment_status) VALUES('%s', '%s', '%s', '%s', '%s', '%s')", $payment_id, $payer_id, $payer_email, $amount, $currency, $payment_status);
        $db->query($sql);
 
        echo "Payment is successful. Your transaction id is: ". $payment_id;
    } else {
        echo $response->getMessage();
    }
} else {
    echo 'Transaction is declined';
}