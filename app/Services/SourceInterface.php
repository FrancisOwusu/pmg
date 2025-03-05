<?php

namespace App\Services;

interface SourceInterface
{
    public function sendPaymentRequest(array $data);
    public function verifyPayment($reference);
    public static function getEndPoint();

    public static function checkTxnStatus($gatewayPayId);


    public static function paymentNotification(array $request);

    public static function notifyClient($txn);


    public static function makePayout($request=[]);


    public static function payoutNotification($request=[]);


}
