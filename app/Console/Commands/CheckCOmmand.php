<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckCOmmand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info("Starting to check received transactions...");

        // Adresse USDT à surveiller
        $receiverAddress = "TSxu5NpBKAsEWipRuxgJwsRLUbG78G9Nf3";

        // Appeler l'API Tronscan pour récupérer les transactions
        $response = Http::get("https://apilist.tronscan.org/api/token_trc20/transfers", [
            'relatedAddress' => $receiverAddress,
            'limit' => 100, // Nombre maximum de transactions à récupérer
        ]);

        if (!$response->successful()) {
            $this->error("Failed to fetch transactions from Tronscan.");
            Log::error("Failed to fetch transactions from Tronscan", ['address' => $receiverAddress]);
            return;
        }

        $data = $response->json();
        $transactions = $data['token_transfers'] ?? [];

        if (empty($transactions)) {
            $this->info("No transactions found for the specified account.");
            return;
        }

        foreach ($transactions as $tx) {
            $this->processTransaction($tx, $receiverAddress);
        }

        $this->info("Finished checking received transactions.");
    }

    /**
     * Process a single transaction and update account balance if conditions are met.
     *
     * @param array $tx Transaction data
     * @param string $receiverAddress The account address being checked
     */
    private function processTransaction(array $tx, string $receiverAddress)
    {
        $transactionHash = $tx['transaction_id'] ?? null;
        $fromAddress = $tx['from_address'] ?? null;
        $toAddress = $tx['to_address'] ?? null;
        $amount = isset($tx['quant']) ? $tx['quant'] / 1e6 : 0; // Montant en USDT
        $confirmed = $tx['confirmed'] ?? false;
        $timestamp = $tx['block_ts'] ?? null;

        // Vérifier si la transaction est reçue par le compte
        if ($toAddress === $receiverAddress && $confirmed) {
            $this->info("Received transaction confirmed:");
            $this->info("  Transaction ID: $transactionHash");
            $this->info("  From: $fromAddress");
            $this->info("  Amount: $amount USDT");

            // Rechercher une transaction correspondante dans la base de données
            $transaction = Transaction::where('merchant_trade_no', $transactionHash)
                ->where('amount', $amount)
                ->whereDate('created_at', '=', date('Y-m-d', $timestamp / 1000))
                ->first();

            if (!$transaction) {
                $this->error("Transaction not found in the database.");
                Log::error("Transaction mismatch", [
                    'transaction_id' => $transactionHash,
                    'expected_amount' => $amount,
                    'expected_date' => date('Y-m-d', $timestamp / 1000),
                ]);
                return;
            }

            // Mettre à jour le solde du compte
            $this->updateAccountBalance($transaction->sender_id, $amount);

            // Marquer la transaction comme confirmée
            $transaction->update(['status' => 'Confirmed']);
            $this->info("Transaction {$transactionHash} marked as confirmed.");
        }
    }

    /**
     * Update the balance of the account.
     *
     * @param int $clientId Client ID linked to the account
     * @param float $amount Amount to add to the account balance
     */
    private function updateAccountBalance(int $clientId, float $amount)
    {
        $account = Account::where('client_id', $clientId)->first();

        if (!$account) {
            $this->error("Account not found for client ID: {$clientId}");
            Log::error("Account not found", ['client_id' => $clientId]);
            return;
        }

        // Augmenter le solde
        $account->balance += $amount;
        $account->save();

        $this->info("Account balance updated for client ID {$clientId}. New balance: {$account->balance} USDT.");
    }
}
