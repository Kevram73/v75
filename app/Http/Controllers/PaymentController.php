<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;

class PaymentController extends Controller
{
    public function getAvailableCurrencies()
    {
        $url = "https://api.nowpayments.io/v1/currencies";

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-api-key: ' . env('NOWPAYMENTS_API_KEY'),
        ]);

        $response = curl_exec($ch);

        if(curl_errno($ch)){
            $error_msg = curl_error($ch);
        }

        curl_close($ch);

        if(isset($error_msg)){
            return response()->json(['error' => $error_msg], 500);
        }

        $currencies = json_decode($response, true);

        return response()->json($currencies);
    }

    public function createInvoice(Request $request)
    {
        $url = 'https://api.nowpayments.io/v1/invoice';

        $data = [
            'price_amount' => $request->input('price_amount'),
            'price_currency' => $request->input('price_currency'),
            'order_id' => Uuid::uuid4()->toString(),
            'order_description' => "For investment",
            'partially_paid_url' => $request->input('partially_paid_url'),

        ];

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'x-api-key: ' . env('NOWPAYMENTS_API_KEY'),
            'Content-Type: application/json'
        ]);

        $response = curl_exec($ch);

        if(curl_errno($ch)) {
            $error_msg = curl_error($ch);
        }

        curl_close($ch);

        if(isset($error_msg)) {
            return response()->json(['error' => $error_msg], 500);
        }

        $invoice = json_decode($response, true);

        return response()->json($invoice);
    }

    public function getPaymentStatus($paymentId)
{
    $url = "https://api.nowpayments.io/v1/payment/{$paymentId}";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'x-api-key: ' . env('NOWPAYMENTS_API_KEY')
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }

    curl_close($ch);

    if (isset($error_msg)) {
        return response()->json(['error' => $error_msg], 500);
    }

    $status = json_decode($response, true);

    return response()->json($status);
}

public function listPayments()
{
    $url = "https://api.nowpayments.io/v1/payment";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'x-api-key: ' . env('NOWPAYMENTS_API_KEY')
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
    }

    curl_close($ch);

    if (isset($error_msg)) {
        return response()->json(['error' => $error_msg], 500);
    }

    $payments = json_decode($response, true);

    return response()->json($payments);
}

}
