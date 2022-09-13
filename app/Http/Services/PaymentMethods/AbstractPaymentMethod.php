<?php

namespace App\Http\Services\PaymentMethods;

use App\Http\Requests\TransactionRequest;

abstract class AbstractPaymentMethod
{
    public $serviceName = '';

    public const support_payment_methods = ['Visa', 'PayPal'];

    public abstract function pay(TransactionRequest $request);

    public abstract function withdraw(TransactionRequest $request);


}
