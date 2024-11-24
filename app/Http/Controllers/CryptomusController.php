<?php

namespace App\Http\Controllers;






use Illuminate\Http\Request;
use Cryptomus\Api\Client;

class CryptomusController extends Controller
{
    protected $paymentClient;
    protected $payoutClient;

    public function __construct()
    {
        // Initialize the Cryptomus API clients
        $this->paymentClient = Client::payment(env('CRYPTOMUS_PAYMENT_KEY'), "79a3afa3-2efb-4921-a98c-052a3c0791a4");
        $this->payoutClient = Client::payout(env('CRYPTOMUS_PAYOUT_KEY'), "79a3afa3-2efb-4921-a98c-052a3c0791a4");
    }

    public function createPayment(Request $request)
    {
        $data = [
            'amount' => $request->amount,
            'currency' => $request->currency,
            'network' => $request->network,
            'order_id' => $request->order_id,
            'url_return' => $request->url_return,
            'url_callback' => $request->url_callback,
            'is_payment_multiple' => $request->is_payment_multiple ?? false,
            'lifetime' => $request->lifetime ?? 7200,
            'to_currency' => $request->to_currency ?? $request->currency
        ];

        try {
            $result = $this->paymentClient->create($data);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentInfo(Request $request)
    {
        $data = ['uuid' => $request->uuid];

        try {
            $result = $this->paymentClient->info($data);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function createPayout(Request $request)
    {
        $data = [
            'amount' => $request->amount,
            'currency' => $request->currency,
            'network' => $request->network,
            'order_id' => $request->order_id,
            'address' => $request->address,
            'is_subtract' => $request->is_subtract ?? '1',
            'url_callback' => $request->url_callback
        ];

        try {
            $result = $this->payoutClient->create($data);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function payoutInfo(Request $request)
    {
        $data = ['uuid' => $request->uuid];

        try {
            $result = $this->payoutClient->info($data);
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function paymentServices()
    {
        try {
            $result = $this->paymentClient->services();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
