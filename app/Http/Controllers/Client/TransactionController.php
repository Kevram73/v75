<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Client;
use App\Models\Account;
use App\Models\WithdrawalPassword;
use App\Services\NowPaymentsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.client');
    }

    /**
     * Show deposit form.
     */
    public function createDeposit()
    {
        $client = Auth::guard('client')->user();
        $account = $client->wallet;
        
        return view('client.deposit', compact('account'));
    }

    /**
     * Store deposit.
     */
    public function storeDeposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:10|max:10000',
            'transaction_hash' => 'nullable|string|max:255',
            'deposit_type' => 'nullable|string|in:AUTOMATIC,MANUAL',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Auth::guard('client')->user();

        // Utiliser le hash de transaction comme référence, ou l'adresse USDT de l'utilisateur, ou une valeur par défaut
        $reference = $request->transaction_hash 
            ?? $client->usdt_address 
            ?? 'DEP-' . $client->id . '-' . time();

        Transaction::create([
            'client_id' => $client->id,
            'type' => 'DEPOSIT',
            'amount' => $request->amount,
            'status' => 'PENDING',
            'description' => 'Dépôt ' . ($request->deposit_type === 'AUTOMATIC' ? 'automatique' : 'manuel') . ' - En attente de confirmation',
            'payment_method' => 'USDT',
            'reference' => $reference,
            'merchant_trade_no' => 'DEP-' . $client->id . '-' . time(),
        ]);

        return redirect()->route('client.deposits')
            ->with('success', 'Dépôt soumis. En attente de confirmation par l\'administrateur.');
    }

    /**
     * Show withdrawal form.
     */
    public function createWithdrawal()
    {
        $client = Auth::guard('client')->user();
        $account = $client->wallet;
        $hasPassword = $client->withdrawalPassword !== null;
        
        return view('client.withdrawal', compact('account', 'hasPassword'));
    }

    /**
     * Store withdrawal request.
     */
    public function storeWithdrawal(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:10',
            'usdt_address' => 'required|string|max:255',
            'withdrawal_password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Auth::guard('client')->user();
        $account = $client->wallet;

        if (!$account || $account->balance < $request->amount) {
            return redirect()->back()->with('error', 'Solde insuffisant.')->withInput();
        }

        // Vérifier le mot de passe de retrait
        $withdrawalPassword = $client->withdrawalPassword;
        if (!$withdrawalPassword || !$withdrawalPassword->verifyPassword($request->withdrawal_password)) {
            return redirect()->back()->with('error', 'Mot de passe de retrait incorrect.')->withInput();
        }

        // Vérifier les conditions de retrait (basé sur le nombre de retraits et directs actifs)
        $withdrawalsCount = Transaction::where('client_id', $client->id)
            ->where('type', 'WITHDRAWAL')
            ->where('status', 'COMPLETED')
            ->count();

        $activeDirects = $client->referrals()->where('is_active', true)->count();

        // Conditions de retrait (simplifiées par rapport à pretconnectfinance)
        if ($withdrawalsCount >= 1 && $activeDirects < 1) {
            return redirect()->back()
                ->with('error', 'Pour effectuer des retraits supplémentaires, vous devez avoir au moins 1 direct actif.')
                ->withInput();
        }

        try {
            DB::beginTransaction();

            $account->subtractBalance($request->amount);
            $account->addWithdrawal($request->amount);

            Transaction::create([
                'client_id' => $client->id,
                'type' => 'WITHDRAWAL',
                'amount' => $request->amount,
                'status' => 'PENDING',
                'description' => 'Retrait vers USDT TRC20',
                'payment_method' => 'USDT',
                'reference' => $request->usdt_address,
            ]);

            DB::commit();

            return redirect()->route('client.withdrawals')
                ->with('success', 'Demande de retrait soumise avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors du traitement du retrait.')->withInput();
        }
    }

    /**
     * Show withdrawal password setup form.
     */
    public function showWithdrawalPasswordSetup()
    {
        $client = Auth::guard('client')->user();
        $hasPassword = $client->withdrawalPassword !== null;
        
        return view('client.withdrawal-password.setup', compact('hasPassword'));
    }

    /**
     * Store withdrawal password.
     */
    public function storeWithdrawalPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'withdrawal_password' => 'required|string|min:6',
            'withdrawal_password_confirmation' => 'required|same:withdrawal_password',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Auth::guard('client')->user();

        try {
            WithdrawalPassword::createOrUpdate(
                $client->id,
                $client->email,
                $request->withdrawal_password
            );

            return redirect()->route('client.withdrawal')
                ->with('success', 'Mot de passe de retrait défini avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la définition du mot de passe.')->withInput();
        }
    }

    /**
     * Show withdrawal password change form.
     */
    public function showWithdrawalPasswordChange()
    {
        $client = Auth::guard('client')->user();
        $withdrawalPassword = $client->withdrawalPassword;
        
        if (!$withdrawalPassword) {
            return redirect()->route('client.withdrawal.password.setup');
        }
        
        return view('client.withdrawal-password.change');
    }

    /**
     * Update withdrawal password.
     */
    public function updateWithdrawalPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_withdrawal_password' => 'required|string',
            'withdrawal_password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Auth::guard('client')->user();
        $withdrawalPassword = $client->withdrawalPassword;

        if (!$withdrawalPassword || !$withdrawalPassword->verifyPassword($request->old_withdrawal_password)) {
            return redirect()->back()->with('error', 'Mot de passe actuel incorrect.')->withInput();
        }

        try {
            $withdrawalPassword->password = $request->withdrawal_password; // Sera hashé automatiquement par le mutator
            $withdrawalPassword->save();

            return redirect()->route('client.withdrawal')
                ->with('success', 'Mot de passe de retrait modifié avec succès.');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la modification.')->withInput();
        }
    }

    /**
     * Show transfer form.
     */
    public function showTransfer()
    {
        $client = Auth::guard('client')->user();
        $account = $client->wallet;
        
        return view('client.transfer', compact('account'));
    }

    /**
     * Process transfer between clients.
     */
    public function processTransfer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|exists:clients,email',
            'amount' => 'required|numeric|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Auth::guard('client')->user();
        $account = $client->wallet;

        if ($request->email === $client->email) {
            return redirect()->back()->with('error', 'Vous ne pouvez pas vous transférer de l\'argent à vous-même.')->withInput();
        }

        if (!$account || $account->balance < $request->amount) {
            return redirect()->back()->with('error', 'Solde insuffisant pour effectuer ce transfert.')->withInput();
        }

        // Conditions de transfert membre à membre
        $transfersCount = $client->getTransfersCount();
        $activeDirects = $client->getActiveDirectsCount();

        // 1er transfert : avoir un compte actif
        if ($transfersCount == 0) {
            if (!$client->isActive()) {
                return redirect()->back()
                    ->with('error', 'Vous devez avoir un compte actif pour effectuer votre premier transfert.')
                    ->withInput();
            }
        }
        // 2ème transfert : avoir 1 direct actif
        elseif ($transfersCount == 1) {
            if ($activeDirects < 1) {
                return redirect()->back()
                    ->with('error', 'Pour effectuer votre 2ème transfert, vous devez avoir au moins 1 direct actif. Vous en avez actuellement ' . $activeDirects . '.')
                    ->withInput();
            }
        }
        // 5ème transfert et suivants : avoir 2 directs pour continuer le transfert permanent
        elseif ($transfersCount >= 4) {
            if ($activeDirects < 2) {
                return redirect()->back()
                    ->with('error', 'Pour continuer les transferts permanents, vous devez avoir au moins 2 directs actifs. Vous en avez actuellement ' . $activeDirects . '.')
                    ->withInput();
            }
        }

        $recipient = Client::where('email', $request->email)->firstOrFail();
        $recipientAccount = $recipient->wallet;

        if (!$recipientAccount) {
            return redirect()->back()->with('error', 'Le destinataire n\'a pas de compte actif.')->withInput();
        }

        try {
            DB::beginTransaction();

            $account->subtractBalance($request->amount);
            $recipientAccount->addBalance($request->amount);

            Transaction::create([
                'client_id' => $client->id,
                'sender_id' => $client->id,
                'receiver_id' => $recipient->id,
                'type' => 'TRANSFER_OUT',
                'amount' => $request->amount,
                'status' => 'COMPLETED',
                'description' => 'Transfert vers ' . $recipient->email . ($request->description ? ': ' . $request->description : ''),
                'reference' => 'TRANSFER-' . $client->id . '-' . $recipient->id . '-' . time(),
            ]);

            Transaction::create([
                'client_id' => $recipient->id,
                'sender_id' => $client->id,
                'receiver_id' => $recipient->id,
                'type' => 'TRANSFER_IN',
                'amount' => $request->amount,
                'status' => 'COMPLETED',
                'description' => 'Transfert reçu de ' . $client->email . ($request->description ? ': ' . $request->description : ''),
                'reference' => 'TRANSFER-' . $client->id . '-' . $recipient->id . '-' . time(),
            ]);

            DB::commit();

            return redirect()->route('client.deposits')
                ->with('success', 'Transfert de $' . number_format($request->amount, 2) . ' effectué avec succès.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Erreur lors du transfert.')->withInput();
        }
    }

    /**
     * Show transaction details.
     */
    public function show($id)
    {
        $client = Auth::guard('client')->user();
        $transaction = Transaction::where('id', $id)
            ->where('client_id', $client->id)
            ->firstOrFail();

        return view('client.transactions.show', compact('transaction'));
    }

    /**
     * Search user for transfer.
     */
    public function searchUser(Request $request)
    {
        $email = $request->get('email');
        
        $client = Client::where('email', $email)->first(['id', 'email', 'first_name', 'last_name']);

        return response()->json(['user' => $client]);
    }
}

