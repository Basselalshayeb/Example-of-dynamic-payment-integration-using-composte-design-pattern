<?php

namespace App\Http\Services\PaymentMethods;

use App\Http\Requests\TransactionRequest;
use Illuminate\Support\Facades\Log;

class PaypalPayment extends AbstractPaymentMethod
{

    private $paymentObjectToStore = [];
    public $serviceName = 'PayPal';

    public function __construct()
    {
        // prepare the payment service object
        $this->paymentObjectToStore['auth_key'] = config('paypal.auth_key');
    }

    public function pay(TransactionRequest $request)
    {
        return array_merge($request->convertToStoreObject(), $this->paymentObjectToStore);
    }

    public function withdraw(TransactionRequest $request)
    {
        return array_merge($request->convertToStoreObject(), $this->paymentObjectToStore);
    }
}
