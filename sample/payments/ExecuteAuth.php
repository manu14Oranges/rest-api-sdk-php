<?php
// #Execute Payment Sample
// This sample shows how you can complete
// a payment that has been approved by
// the buyer by logging into paypal site.
// You can optionally update transaction
// information by passing in one or more transactions.
// API used: POST '/v1/payments/payment/<payment-id>/execute'.

require __DIR__ . '/../bootstrap.php';

$clientId = 'AYSq3RDGsmBLJE-otTkBtM-jBRd1TCQwFf9RGfwddNXWz0uFU9ztymylOhRS';
$clientSecret = 'EGnHDxD_qRPdaLdZz8iCr8N7_MzF-YHPTkjs6NKYQvQSBngp4PTTVWkPZRbL';

use PayPal\Api\ExecutePayment;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
session_start();
if(isset($_GET['success']) && $_GET['success'] == 'true') {


    $code = $_GET['code'];

    $params = array(
        'code' => $code,
        'redirect_uri' => getBaseUrl() . '/ExecuteAuth.php?success=true',
        'client_id' => $clientId,
        'client_secret' => $clientSecret
    );
    try {
        $accessToken = \PayPal\Auth\Openid\PPOpenIdTokeninfo::createFromAuthorizationCode($params, $clientId, $clientSecret, $apiContext);
    } catch (PayPal\Exception\PPConnectionException $ex) {
            echo "Exception: " . $ex->getMessage() . PHP_EOL;
            var_dump($ex->getData());
            exit(1);
    }
    echo $accessToken->toJSON(JSON_PRETTY_PRINT);

}
