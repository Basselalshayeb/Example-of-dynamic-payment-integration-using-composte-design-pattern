<?php

namespace App\Http\Requests;

use App\Http\Services\PaymentMethods\AbstractPaymentMethod;
use App\Http\Services\PaymentMethods\PaypalPayment;
use App\Http\Services\PaymentMethods\VisaPayment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use function PHPUnit\Framework\matches;

class TransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'payment_method' => ['required', Rule::in(AbstractPaymentMethod::support_payment_methods)],
            'amount' => 'required|numeric',
            'productId' => 'required|integer'
        ];
    }

    public function getPaymentObject()
    {
        return match ($this->payment_method) {
            AbstractPaymentMethod::support_payment_methods[0] => new VisaPayment(),
            AbstractPaymentMethod::support_payment_methods[1] => new PaypalPayment(),
            default => new VisaPayment()
        };
    }

    public function convertToStoreObject()
    {
        return [
            'transaction_id' => $this->bigNumber(),
            'transaction_status' => rand(0, 1),
            'amount' => $this->amount,
            'other_data' => $this->only(['payment_method', 'productId']),
        ];
    }

    public function bigNumber()
    {
        # prevent the first number from being 0
        $output = rand(1, 9);

        for ($i = 0; $i < 9; $i++) {
            $output .= rand(0, 9);
        }

        return $output;
    }

}
