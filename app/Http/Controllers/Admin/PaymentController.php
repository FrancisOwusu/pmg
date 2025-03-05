<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\PrintSetting;
use App\Services\PayStack\PayStackServiceImpl;
use App\Util\PaymentUtil;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('module_payments', 1);
        $this->route = 'admin.payments';
        $this->view = 'admin.payments';
        $this->path = 'payments';
        $this->access = 'payment';


        $this->middleware('permission:' . $this->access . '-view', ['only' => ['index', 'show']]);
        $this->middleware('permission:' . $this->access . '-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:' . $this->access . '-report', ['only' => ['report']]);
        $this->middleware('permission:' . $this->access . '-print', ['only' => ['report', 'print']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;
        $this->access = ['payment'];


        // Filter Fees

        $payment = PaymentUtil::getInstance();
        $payments = $payment->getPaymentData()
            ->where("transaction_status", PaymentUtil::STATUS_SUCCESS)
            ->orderBy('created_at', 'desc')
//            ->groupBy('fee_id')
            ->get();

        $data['rows'] = $payments;

        return view($this->view . '.index', $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function print($id)
    {
        //
        $data['title'] = trans_choice('module_payment', 1);
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = 'print-setting';

        // View
        $data['print'] = PrintSetting::where('slug', 'fees-receipt')->firstOrFail();
        $data['row'] = Payment::where('id', $id)->firstOrFail();


        return view($this->view . '.print', $data);
    }

    public function checkPaymentStatus(string $reference)
    {
        if (!is_null($reference)) {
          return  PayStackServiceImpl::verifyPayment($reference);
        }
    }

}
