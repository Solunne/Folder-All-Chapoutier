<?php
/**
 * Created by PhpStorm.
 * User: adelannoy
 * Date: 01/06/16
 * Time: 15:11
 */
include "include.php";
//include 'examples/arraySet/payment.php';
//include 'examples/arraySet/bankAccountData.php';
//include 'examples/arraySet/card.php';
//include 'examples/arraySet/order.php';
//include 'examples/arraySet/buyer.php';
//include 'examples/arraySet/owner.php';
//include 'examples/arraySet/privateDataList.php';
//include 'examples/arraySet/authentication3DSecure.php';



    // create an instance
    $paylineSDK = getPaylineSDK();
    var_dump($paylineSDK->enableWallet(array(
        "contractNumber" => CONTRACT_NUMBER,
        "walletId" => "1"
    )));
    var_dump(addCardWallet($_POST));

    // Authorization Request parameters.
//    $array = array();
//    // Payment
//    $array['version'] = '3';
//    $array['payment']['amount'] = 10000000; // this value has to be an integer amount is sent in cents
//    $array['payment']['currency'] = 978; // ISO 4217 code for euro
//    $array['payment']['action'] = 101; // 101 stand for "authorization+capture"
//    $array['payment']['mode'] = 'CPT'; // one shot payment
//    $array['payment']['contractNumber'] = '1234567';
//    // Card
//    $array['card']['number'] = $_POST['cardNumber'];
//    $array['card']['expirationDate'] = $_POST['cardExpirationDate'];
//    $array['card']['cvx'] = $_POST['cardCvx'];
//    $array['card']['type'] = $_POST['cardType'];
//    // Order
//    $array['order']['ref'] = 'myOrderRef_' . time(); // the reference of your order
//    $array['order']['amount'] = 10000000; // may differ from payment.amount if currency is different
//    $array['order']['currency'] = 978; // ISO 4217 code for euro
//    $array['order']['date'] = date('d/m/Y H:i'); // the reference of your order
//    // Wallet.
//    $array['wallet']['walletId'] = 1;
//    $array['wallet']['lastName'] = 'Dupond';
//    $array['wallet']['firstName'] = 'Jean';
//    $array['wallet']['card']['number'] = $_POST['cardNumber'];
//    $array['wallet']['card']['expirationDate'] = $_POST['cardExpirationDate'];
//    $array['wallet']['card']['cvx'] = $_POST['cardCvx'];
//    $array['wallet']['card']['type'] = $_POST['cardType'];
//    // Call the doAuthorization method.
//    $response = $paylineSDK->doAuthorization($array);

//    var_dump($_POST, $response);



//    // call a web service, for example doWebPayment
//    $doWebPaymentRequest = array();
//
//    // PAYMENT
//    $doWebPaymentRequest['payment']['amount'] = 1000; // this value has to be an integer amount is sent in cents
//    $doWebPaymentRequest['payment']['currency'] = 978; // ISO 4217 code for euro
//    $doWebPaymentRequest['payment']['action'] = 101; // 101 stand for "authorization+capture"
//    $doWebPaymentRequest['payment']['mode'] = 'CPT'; // one shot payment
//
//    // ORDER
//    $doWebPaymentRequest['order']['ref'] = 'myOrderRef_' . time(); // the reference of your order
//    $doWebPaymentRequest['order']['amount'] = 1000; // may differ from payment.amount if currency is different
//    $doWebPaymentRequest['order']['currency'] = 978; // ISO 4217 code for euro
//
//    // CONTRACT NUMBERS
//    $doWebPaymentRequest['payment']['contractNumber'] = '1234567';
//
//    $doWebPaymentResponse = $paylineSDK->doWebPayment($doWebPaymentRequest);
//
//var_dump($doWebPaymentResponse);


function getPaylineSDK() {
    $paylineSDK = new PaylineSDK(MERCHANT_ID, ACCESS_KEY, PROXY_HOST, PROXY_PORT, PROXY_LOGIN, PROXY_PASSWORD, ENVIRONMENT);
    $paylineSDK->returnURL = RETURN_URL;
    $paylineSDK->cancelURL = CANCEL_URL;
    $paylineSDK->notificationURL = NOTIFICATION_URL;

    return $paylineSDK;
}

function addCardWallet($card) {
    $paylineSDK = getPaylineSDK();

    $array['version'] = '4';
    // Wallet.
    $array['wallet']['walletId'] = 1;
    $array['wallet']['lastName'] = 'Dupond';
    $array['wallet']['firstName'] = 'Jean';
    $array['wallet']['card']['number'] = $card['cardNumber'];
    $array['wallet']['card']['expirationDate'] = $card['cardExpirationDate'];
    $array['wallet']['card']['cvx'] = $card['cardCvx'];
    $array['wallet']['card']['type'] = $card['cardType'];

    return $paylineSDK->createWallet($array);
}