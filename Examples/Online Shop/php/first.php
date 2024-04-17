<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader
require '../lib/PayPal-PHP-SDK/autoload.php';

// 2. Provide your Secret Key. Replace the given one with your app clientId, and Secret
// https://developer.paypal.com/webapps/developer/applications/myapps
$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AasRW4RV6E-BdQz4SCwI4C4tnc5TeRC9Br3N6T8n2wkbg7soXkiPd4Rrk3PUPDbx1GZrGLULpz9yJZMO',     // ClientID
        'EHZ_WTnqGbReNUKVAhAM_H3OOwaQRdv4FhXZGoFpEZm44eLFuv46IirtE2YryGF6hC0KVw06B5MwPIKn'      // ClientSecret
    )
);

// 3. Lets try to create a Payment
// https://developer.paypal.com/docs/api/payments/#payment_create
$payer = new \PayPal\Api\Payer();
$payer->setPaymentMethod('paypal');

$amount = new \PayPal\Api\Amount();
$amount->setTotal('1.00');
$amount->setCurrency('USD');

$transaction = new \PayPal\Api\Transaction();
$transaction->setAmount($amount);

$redirectUrls = new \PayPal\Api\RedirectUrls();
$redirectUrls->setReturnUrl("https://brandewynhosting.co.za/Examples/Online%20Shop/php/paid.php")
    ->setCancelUrl("https://brandewynhosting.co.za/Examples/Online%20Shop/php/pFailed.php");

$payment = new \PayPal\Api\Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions(array($transaction))
    ->setRedirectUrls($redirectUrls);

// 4. Make a Create Call and print the values
try {
    $payment->create($apiContext);
    echo $payment;

    echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
}
catch (\PayPal\Exception\PayPalConnectionException $ex) {
    // This will print the detailed information on the exception.
    //REALLY HELPFUL FOR DEBUGGING
    echo $ex->getData();
}