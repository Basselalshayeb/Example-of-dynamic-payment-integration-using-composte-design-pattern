<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TransactionController extends Controller
{
    //

    public function pay(TransactionRequest $request)
    {
        // take request and added to array of json in file
        $paymentService = $request->getPaymentObject();
        $appendToJson = $paymentService->pay($request);
        $this->appendToJsonFile($paymentService->serviceName, $appendToJson);
        Transaction::create([
            'transaction_id' => $appendToJson['transaction_id'],
            'transaction_status' => $appendToJson['transaction_status'],
            'transaction_info' => $appendToJson['other_data'],
        ]);
        return response()->success($appendToJson['transaction_status']);
    }

    public function withdraw(TransactionRequest $request)
    {
        // take request and added to array of json in file
        $paymentService = $request->getPaymentObject();
        $appendToJson = $paymentService->withdraw($request);
        $this->appendToJsonFile($paymentService->serviceName, $appendToJson);
        Transaction::create([
            'transaction_id' => $appendToJson['transaction_id'],
            'transaction_status' => $appendToJson['transaction_status'],
            'transaction_info' => $appendToJson['other_data'],
        ]);
        return response()->success($appendToJson['transaction_status']);
    }

    public function appendToJsonFile($fileName, $data)
    {
        $oldData = array_merge([], json_decode(Storage::disk('public')->get("$fileName.json")) ?? []);
        array_push($oldData, $data);
        Storage::disk('public')->put("$fileName.json", json_encode($oldData));

    }
}
