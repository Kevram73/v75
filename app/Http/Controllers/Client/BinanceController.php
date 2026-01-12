<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Models\Transaction;
use App\Models\Account;
use CryptoPay\Binancepay\BinancePay;
use App\Http\Controllers\Controller;

class BinancePayController extends Controller
{
    /**
     * Handle return callback from Binance Pay.
     */
    public function returnCallback(Request $request): RedirectResponse
    {
        return $this->checkOrderStatus($request);
    }

    /**
     * Handle cancel callback from Binance Pay.
     */
    public function cancelCallback(Request $request): RedirectResponse
    {
        return $this->checkOrderStatus($request);
    }

    /**
     * Check order status and update transaction.
     */
    private function checkOrderStatus(Request $request): RedirectResponse
    {
        $transactionId = $request->get('trx-id');
        $transaction = Transaction::find($transactionId);

        if (!$transaction) {
            return redirect()->route('client.dashboard')
                ->with('error', 'Transaction introuvable.');
        }

        try {
            $binancePay = new BinancePay("binancepay/openapi/v2/order/query");
            $order_status = $binancePay->query(['merchantTradeNo' => $transaction->merchant_trade_no]);

            if ($order_status['status'] === 'SUCCESS' && $order_status['data']['status'] === 'PAID') {
                $transaction->status = 'COMPLETED';
                $transaction->save();

                // Update account balance if it's a deposit
                if ($transaction->type === 'DEPOSIT' && $transaction->client_id) {
                    $account = Account::where('client_id', $transaction->client_id)->first();
                    if ($account) {
                        $account->addBalance($transaction->amount);
                        $account->addDeposit($transaction->amount);
                    }
                }

                return redirect()->route('payment.success')
                    ->with('success', 'Paiement effectué avec succès.');
            } else {
                $transaction->status = 'FAILED';
                $transaction->save();

                return redirect()->route('client.dashboard')
                    ->with('error', 'Le paiement a échoué ou a été annulé.');
            }
        } catch (\Exception $e) {
            Log::error('Binance Pay error: ' . $e->getMessage());
            return redirect()->route('client.dashboard')
                ->with('error', 'Une erreur est survenue lors du traitement du paiement.');
        }
    }
}
