<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Models\Transaction;
use CryptoPay\Binancepay\BinancePay;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Exception;


class BinancePayController extends Controller
{
    public function returnCallback(Request $request)
    {
        return $this->checkOrderStatus($request);
    }

    // GET /binancepay/cancelURL
    public function cancelCallback(Request $request)
    {
        return $this->checkOrderStatus($request);
    }

    private function checkOrderStatus(Request $request): RedirectResponse
    {
        $transactionId = $request->get('trx-id');
        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            return redirect()->route('error.route') // Define this route in your web.php
                             ->with('error', 'Transaction not found.');
        }

        try {
            $binancePay = new BinancePay("binancepay/openapi/v2/order/query");
            $order_status = $binancePay->query(['merchantTradeNo' => $transaction->merchant_trade_no]);

            if ($order_status['status'] === 'SUCCESS' && $order_status['data']['status'] === 'PAID') {
                $transaction->update(['status' => 'completed']);
                return redirect()->route('success.route') // Define this route in your web.php
                                 ->with('success', 'Payment completed successfully.');
            } else {
                $transaction->update(['status' => 'failed']);
                return redirect()->route('error.route') // Define this route in your web.php
                                 ->with('error', 'Payment failed or was cancelled.');
            }
        } catch (\Exception $e) {
            Log::error('Binance Pay error: ' . $e->getMessage());
            return redirect()->route('error.route') // Define this route in your web.php
                             ->with('error', 'An error occurred while processing your payment.');
        }
    }
}
