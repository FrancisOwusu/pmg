<?php

namespace App\Models;

use App\Util\Common;
use App\Util\PaymentUtil;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_enroll_id', 'category_id', 'fee_amount', 'fine_amount', 'discount_amount', 'paid_amount', 'assign_date', 'due_date', 'pay_date', 'payment_method', 'note', 'status', 'created_by', 'updated_by',
    ];

    public function studentEnroll()
    {
        return $this->belongsTo(StudentEnroll::class, 'student_enroll_id');
    }

    public function category()
    {
        return $this->belongsTo(FeesCategory::class, 'category_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'fee_id', 'id')
            ->where('transaction_status', PaymentUtil::STATUS_SUCCESS);
    }

    public function getSelfPaymentsAttribute()
    {
        return Payment::where("fee_id", $this->id)
            ->where("transaction_status", "SUCCESS")->sum('amount');
    }

    public function getfeeBalanceAttribute()
    {
        $self_paid = self::getSelfPaymentsAttribute();
        return abs(($this->fee_amount + $this->fine_amount) - ($this->discount_amount + $self_paid + $this->attributes['paid_amount']));
    }

    public function getPayments()
    {
        return self::getSelfPaymentsAttribute();
    }

    public function getPaidAmountAttribute()
    {
        $self_paid = self::getSelfPaymentsAttribute();
        $sumAmount = $this->attributes['paid_amount'] + $self_paid;
        if (isset($setting->decimal_place)) {
            $response = number_format((float)$sumAmount, $setting->decimal_place, '.', '');
        } else {
            $response = number_format((float)$sumAmount, 2, '.', '');
        }
        return $response;
    }

    public function getFeeStatusAttribute()
    {
        $checkOverPaid = ($this->fee_amount + $this->fine_amount) - ($this->discount_amount + self::getSelfPaymentsAttribute() + $this->attributes['paid_amount']);
        $status = 'Pending';
        if (self::getfeeBalanceAttribute() == 0) {
            $status = PaymentUtil::FULL_PAYMENT;
        } elseif (self::getfeeBalanceAttribute() == $this->fee_amount) {
            $status = $status;
        } elseif ($checkOverPaid < 0) {
            $status = PaymentUtil::OVER_PAID;
        } elseif (self::getPaidAmountAttribute() > 0) {
            $status = PaymentUtil::PARTIAL_PAYMENT;
        }


        return $status;
    }
}
