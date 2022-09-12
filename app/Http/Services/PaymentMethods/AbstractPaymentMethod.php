<?php

namespace App\Http\Services\PaymentMethods;

interface AbstractPaymentMethod
{
    public const support_payment_methods = ['Visa', 'PayPal'];

    public function pay();
    public function withdraw();
}
