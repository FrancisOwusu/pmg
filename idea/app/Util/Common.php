<?php

namespace App\Util;

use App\Models\Fee;
use App\Models\Payment;

class Common
{
    public const PERCENTAGE_CHARGE = 2;


    public static function calculate_percentage($percentage, $amount)
    {
        try {
            $calculate = $percentage / 100;
            return $calculate * $amount;
        } catch (\Exception $ex) {
            return 0;
        }
    }

    public function calculateFeeBalance(Fee $fee)
    {
        $fee_balance = 0;
        if ($fee) {
            $fee_balance = abs(($fee->fee_amount - $fee->discount_amount) + $fee->fine_amount);
            return $fee_balance;
        }
        return $fee_balance;
    }

    public function getPaymentByFees(int $fee_id)
    {
        $payments = Payment::where("fee_id", $fee_id)
            ->where("transaction_status", "SUCCESS")->sum('amount');
        return $payments;
    }

}
