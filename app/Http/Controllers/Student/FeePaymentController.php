<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Services\PayStack\PayStackServiceImpl;
use App\Util\Common;
use App\Util\PaymentUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Yoeunes\Toastr\Facades\Toastr;

class FeePaymentController extends Controller
{
    public function processPayment(Request $request, PayStackServiceImpl $impl)
    {
        $user = Student::where('id', Auth::guard('student')->user()->id)->firstOrFail();
        $amount_paid = (int)$request->input('amount_paid');

        $totalAmount = $amount_paid + Common::calculate_percentage(Common::PERCENTAGE_CHARGE, $amount_paid);
        $data = [
            'email' => ($user) ? $user->email : "",
            'user' => $user->student_id,
            'amount' => $totalAmount * 100,
            'currency' => "GHS"
        ];

        $data['callback_url'] = route('student_fees.callback');
        $res = $impl->sendPaymentRequest($data);
        if (in_array($res['status'], ['200', '201'])) {
            $payment = [
                'fee_id' => $request->input('fee_id'),
                'amount' => $totalAmount,
                'transaction_status' => PaymentUtil::STATUS_PENDING,
                'transaction_ref_no' => $res['data']['reference'],
                'transaction_id' => $res['data']['access_code'],
                'payment_source' => 'web',
                'created_by' => $data['user'],
            ];
            PaymentUtil::save($payment);
            return \redirect()->away($res['data']['authorization_url']);
        }
        logger($res);
        toastr()->error('An error has occurred please try again later.');

        return back();
    }

    public function paymentResponse(Request $request)
    {
        logger($request->all());
        return response()->json($request->all());

    }
}
