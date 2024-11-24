<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Transaction;
use Illuminate\Support\Facades\Http;

class CheckTransactionStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:check-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check the status of all transactions with status "En attente"';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Récupérer toutes les transactions "En attente"
        $pendingTransactions = Transaction::where('status', 'En attente')->where('type', 'deposit')->get();

        if ($pendingTransactions->isEmpty()) {
            $this->info("No pending transactions found.");
            return;
        }

        foreach ($pendingTransactions as $transaction) {

            // Appeler l'API TRONScan pour vérifier l'état de la transaction
            $response = Http::get("https://apilist.tronscan.org/api/transaction-info", [
                'hash' => $transaction->merchant_trade_no, // Identifiant de la transaction
            ]);

            if ($response->successful()) {
                $data = $response->json();

                // Vérifier l'envoyeur et le receveur
                $client_id = $transaction->sender_id;
                $account = Account::where('client_id', $client_id)->first();
                $transactionSender = $account->usdt_account; // Adresse de l'envoyeur
                $transactionReceiver = "TSxu5NpBKAsEWipRuxgJwsRLUbG78G9Nf3";

                $apiSender = $data['from'];
                $apiReceiver = $data['to'];  // Adresse receveur depuis l'API

                if ($transactionSender === $apiSender && $transactionReceiver === $apiReceiver) {
                    if (isset($data['confirmed']) && $data['confirmed'] === true) {
                        // Si la transaction est confirmée, mettre à jour le statut
                        $transaction->update(['status' => 'Confirmed']);
                        $this->info("Transaction  has been confirmed.");
                    } else {
                        $this->info("Transaction is still pending.");
                    }
                } else {
                    $this->error("Transaction sender or receiver mismatch.");
                }
            } else {
                $this->error("Failed to fetch status for transaction.");
            }
        }

        $this->info("Transaction status check completed.");
    }
}
