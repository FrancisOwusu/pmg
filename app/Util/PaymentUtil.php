<?php

namespace App\Util;

use App\Models\Faculty;
use App\Models\Fee;
use App\Models\FeesCategory;
use App\Models\Payment;
use App\Models\PrintSetting;
use App\Models\Program;
use App\Models\Semester;
use App\Models\Session;
use Lcobucci\JWT\Exception;

class PaymentUtil
{
    public const STATUS_PENDING = 'PENDING';
    public const STATUS_SUCCESS = 'SUCCESS';
    public const STATUS_FAILED = 'FAILED';

    public const TRANSACTION_STATUS_PENDING = "PENDING";
    public const TRANSACTION_STATUS_SUCCESS = "SUCCESS";
    public const TRANSACTION_STATUS_FAILED = "FAILED";

    public const USSD_PAYMENT_STATUS = "ussd";
    public const WEB_PAYMENT_STATUS = "web";
    public const MOBILE_PAYMENT_STATUS = "mobile";
    public const FULL_PAYMENT = 'Full Payment';
    public const PARTIAL_PAYMENT = 'Partial Payment';
    public const OVER_PAID = 'Over Paid';
    private static $instance = null;

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new PaymentUtil();
        }

        return self::$instance;
    }

    public static function save(array $data): Payment
    {
        try {
            return Payment::create($data);
        } catch (Exception $exception) {
            return collect([]);
        }
    }

    public function calculateFeeBalance(Fee $fee)
    {
        $fee_balance = 0;
        $self_paid = self::getPayments($fee->id);
        if ($fee) {
            $fee_balance = abs(($fee->fee_amount - $fee->discount_amount - $self_paid) + $fee->fine_amount);
            return $fee_balance;
        }

        return $fee_balance;
    }

    public function getPayments(int $fee_id)
    {
        $payments = Payment::where("fee_id", $fee_id)
            ->where("transaction_status", "SUCCESS")->sum('amount');
        return $payments;
    }

    public function getPaymentData($id = null,)
    {
        try {

            return Payment::query()
                ->with('fee.studentEnroll.student')
                ->when(!empty($id), function ($qry) use ($id) {
                    $qry->where("id", $id);
                });



        } catch (\Exception $ex) {
            logger($ex->getMessage() . "line " . $ex->getLine());
            return collect([]);
        }
    }

    public function getPendingPayments()
    {
        try {
            return Payment::where("transaction_status", self::STATUS_PENDING)
                ->query();
        } catch (\Exception $ex) {

        }
    }

    public function getFailedPayments()
    {
        try {
            return Payment::where("transaction_status", self::STATUS_FAILED)
                ->query();
        } catch (\Exception $ex) {

        }
    }
}
