<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class CheckTransactionStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transaction;

    /**
     * Create a new job instance.
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $txId = $this->transaction->trx_id;

        // API configuration (Etherscan or TronScan, replace with your API key)
        $apiUrl = "https://api.tronscan.org/api/transaction-info";
        $response = Http::get($apiUrl, [
            'hash' => $txId,
        ]);

        if ($response->successful()) {
            $status = $response->json();

            if (isset($status['confirmed']) && $status['confirmed'] === true) {
                // Update transaction status to confirmed
                $this->transaction->update([
                    'status' => 'confirmed',
                ]);
            } elseif (isset($status['confirmed']) && $status['confirmed'] === false) {
                // Update transaction status to failed
                $this->transaction->update([
                    'status' => 'failed',
                ]);
            }
        } else {
            // Log error if API fails
            \Log::error("Failed to fetch transaction status for TxID: {$txId}");
        }
    }
}
