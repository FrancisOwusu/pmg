<?php

namespace App\Services;

class Source implements SourceInterface
{
    public static $BASE_URL;
    public static $LIVE_URL ;
    public static $TEST_URL ;
    public static $CLIENT_ID;
    public static $CLIENT_SECRET;
    public static $USER_NAME ;
    public static $PASSWORD;

    public function sendPaymentRequest($data)
    {
        // TODO: Implement sendPaymentRequest() method.
    }

    public function verifyPayment($reference)
    {
        // TODO: Implement verifyPayment() method.
    }

    public static function createToken($response = [])
    {
        // TODO: Implement createToken() method.
    }

    public static function authTokenRequest()
    {
        // TODO: Implement authTokenRequest() method.
    }

    public static function getAuthToken()
    {
        // TODO: Implement getAuthToken() method.
    }

    public static function debitWallet(array $request)
    {
        // TODO: Implement debitWallet() method.
    }

    public static function checkTxnStatus($gatewayPayId)
    {
        // TODO: Implement checkTxnStatus() method.
    }

    public static function paymentNotification(array $request)
    {
        // TODO: Implement paymentNotification() method.
    }

    public static function notifyClient($txn)
    {
        // TODO: Implement notifyClient() method.
    }

    public static function makePayout($request = [])
    {
        // TODO: Implement makePayout() method.
    }

    public static function payoutNotification($request = [])
    {
        // TODO: Implement payoutNotification() method.
    }

    public static function getEndPoint()
    {
        // TODO: Implement getEndPoint() method.
    }
}
