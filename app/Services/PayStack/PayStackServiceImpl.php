<?php

namespace App\Services\PayStack;

use App\Exceptions\PaymentException;
use App\Models\PaymentProvider;
use App\Services\Source;
use Illuminate\Support\Facades\Http;
use function Symfony\Component\String\s;

class PayStackServiceImpl extends Source
{
    protected static $PAYMENT_KEY = null;
    public static $BASE_URL = "https://api.paystack.co/transaction";

    /**
     * @throws PaymentException
     */
    public function sendPaymentRequest($data): array
    {
        while (config('services.paystack.enabled')) {
            if (config('services.paystack.status') == 'sandbox') {
                self::$PAYMENT_KEY = config('services.paystack.api_secrete_key_test');
            }
            if (config('services.paystack.status') == 'live') {
                self::$PAYMENT_KEY = config('services.paystack.api_secrete_key_live');
            }

            $response = Http::withToken(self::$PAYMENT_KEY)
                ->post(self::$BASE_URL . '/initialize', $data);
            $body = $response->json();
            logger('pay stack request ' . $response->status());
            $body['status'] = $response->status();

            if (!$body['status']) {
                throw new \Exception();
            }
            return $body;

        }
        return ['status' => 400, 'message' => 'Service is inactive'];

    }

    public
    function verifyPayment($reference): bool
    {
        while (config('services.paystack.enabled')) {
            if (config('services.paystack.status') == 'sandbox') {
                self::$PAYMENT_KEY = config('services.paystack.api_secrete_key_test');
            }
            if (config('services.paystack.status') == 'live') {
                self::$PAYMENT_KEY = config('services.paystack.api_secrete_key_live');
            }
            $response = Http::withToken(self::$PAYMENT_KEY)
                ->get(self::$BASE_URL . '/verify/' . $reference)
                ->json();

            if (strtolower($response['data']['status']) == 'success') {
                return true;
            }

            return false;
        }
        return  false;
    }
}
