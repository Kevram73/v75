<?php

namespace App\Http\Controllers\Client;

use Carbon\Carbon;
use App\Models\Client;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth.client');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::guard('client')->user();
        $account = $user->wallet;

        // Get investment statistics
        $investmentService = app(\App\Services\InvestmentService::class);
        $investmentStats = $investmentService->getClientInvestmentStats($user);

        // Calculate totals from transactions
        $deposit_total = Transaction::where('client_id', $user->id)
            ->where('type', 'INVESTMENT')
            ->where('status', 'COMPLETED')
            ->sum('amount');
        
        $withdrawal_total = Transaction::where('client_id', $user->id)
            ->where('type', 'WITHDRAWAL')
            ->where('status', 'COMPLETED')
            ->sum('amount');

        return view('client.dashboard', compact('user', 'deposit_total', 'withdrawal_total', 'account', 'investmentStats'));
    }

    public function clientProfile(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::guard('client')->user();

        return view('client.profile', compact('user'));
    }

    public function deposits(Request $request)
    {
        $user = Auth::guard('client')->user();
        $account = $user->wallet;
        
        // Get deposit transactions with pagination
        $deposits = Transaction::where('client_id', $user->id)
            ->where('type', 'DEPOSIT')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('client.deposits', compact('deposits', 'account'));
    }
    
    public function transactions(Request $request)
    {
        $user = Auth::guard('client')->user();
        
        $query = Transaction::where('client_id', $user->id);
        
        // Filter by type
        if ($request->has('type')) {
            $query->where('type', $request->type);
        }
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
        
        $transactions = $query->orderByDesc('created_at')->paginate(20)->withQueryString();

        return view('client.transactions', compact('transactions'));
    }

    public function withdrawals(Request $request)
    {
        $user = Auth::guard('client')->user();
        $account = $user->wallet;

        // Fetch all withdrawal transactions with pagination
        $withdrawals = Transaction::where('client_id', $user->id)
            ->where('type', 'WITHDRAWAL')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('client.withdrawals', compact('withdrawals', 'account'));
    }


    /**
     * Show announcements page.
     */
    public function announces()
    {
        $announcements = \App\Models\Announcement::whereNull('deleted_at')
            ->orderByDesc('publish_date')
            ->orderByDesc('created_at')
            ->get();
        
        return view('client.announces', compact('announcements'));
    }

    /**
     * Show messages and responses page.
     */
    public function response()
    {
        $client = Auth::guard('client')->user();
        $messages = \App\Models\Message::where('client_id', $client->id)
            ->whereNull('deleted_at')
            ->orderByDesc('created_at')
            ->get();
        
        return view('client.response', compact('messages'));
    }

    /**
     * Show message create form.
     */
    public function messageCreate()
    {
        return view('client.message_create');
    }

    /**
     * Store a new message.
     */
    public function messageStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Auth::guard('client')->user();

        $message = new \App\Models\Message([
            'subject' => $request->subject,
            'message' => $request->message,
            'content' => $request->message, // Keep for backward compatibility
            'object' => $request->subject, // Keep for backward compatibility
            'client_id' => $client->id,
            'sender_id' => $client->id,
            'date_sent' => now(),
        ]);

        $message->save();

        return redirect()->route('client.response')
            ->with('success', 'Message envoyé avec succès!');
    }

    public function account(Request $request)
    {
        $user = Auth::guard('client')->user();
        $account = $user->wallet;
        
        if (!$account) {
            $account = $user->wallet()->create([
                'balance' => 0.00,
                'total_deposited' => 0.00,
                'total_withdrawn' => 0.00,
                'total_invested' => 0.00,
                'total_profits' => 0.00,
                'total_commissions' => 0.00,
                'account_num' => 'ACC-' . time() . '-' . $user->id,
                'is_active' => true,
            ]);
        }

        $totalDeposits = Transaction::where('client_id', $user->id)
            ->whereIn('type', ['INVESTMENT', 'DEPOSIT'])
            ->where('status', 'COMPLETED')
            ->sum('amount');
        
        $totalWithdrawals = Transaction::where('client_id', $user->id)
            ->where('type', 'WITHDRAWAL')
            ->where('status', 'COMPLETED')
            ->sum('amount');

        return view('client.account', compact('account', 'totalDeposits', 'totalWithdrawals', 'user'));
    }

    public function change_account_details(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . Auth::guard('client')->id(),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('client')->user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return redirect()->route('client.profile')
            ->with('success', 'Compte mis à jour avec succès');
    }

    public function send()
    {
        $user = Auth::guard('client')->user();
        $account = $user->wallet;
        return view('client.send', compact('user', 'account'));
    }

    public function confirm_trans($transaction_id)
    {
        $user = Auth::guard('client')->user();
        $trans = Transaction::where('id', $transaction_id)
            ->where('client_id', $user->id)
            ->firstOrFail();
        
        // Get USDT account from config or environment
        $usdtAccount = config('app.usdt_account', env('USDT_ACCOUNT', 'TSxu5NpBKAsEWipRuxgJwsRLUbG78G9Nf3'));
        
        return view('client.confirm_trans', compact('user', 'trans', 'usdtAccount'));
    }

    public function receive()
    {
        $user = Auth::guard('client')->user();
        $account = $user->wallet;
        return view('client.receive', compact('user', 'account'));
    }

    public function change_usdt_account(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'usdt_address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('client')->user();
        $user->usdt_address = $request->usdt_address;
        $user->save();
        
        return redirect()->back()->with('success', 'Adresse USDT mise à jour');
    }

    public function change_btc_account(Request $request)
    {
        $user = Auth::guard('client')->user();
        $account = $user->wallet;
        
        if (!$account) {
            return redirect()->back()->with('error', 'Compte introuvable');
        }

        $account->btc_account = $request->code;
        $account->save();
        
        return redirect()->back()->with('success', 'Compte BTC mis à jour');
    }


    /**
     * Envoie la requête à l'API NowPayments pour créer un paiement.
     */


    public function register_deposit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price_amount' => 'required|numeric|min:10',
            'price_currency' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('client')->user();
        
        $transaction = Transaction::create([
            'client_id' => $user->id,
            'amount' => $request->input('price_amount'),
            'merchant_trade_no' => '',
            'date_sent' => now(),
            'type' => 'DEPOSIT',
            'status' => 'PENDING',
            'description' => 'Dépôt en attente de confirmation',
        ]);

        return redirect()->route('client.confirm_trans', ['transaction_id' => $transaction->id])
            ->with('success', 'Transaction créée. Veuillez confirmer le paiement.');
    }

    public function confirmation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'transaction_id' => 'required|exists:transactions,id',
            'transaction_number' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = Auth::guard('client')->user();
        $transaction = Transaction::where('id', $request->transaction_id)
            ->where('client_id', $user->id)
            ->firstOrFail();

        $transaction->merchant_trade_no = $request->transaction_number;
        $transaction->status = 'PENDING';
        $transaction->save();

        return redirect()->route('client.deposits')
            ->with('success', 'Transaction en attente de confirmation');
    }

    // Removed get_done_transactions and related methods - these should be handled by a job/queue system
    // Transaction verification should be done asynchronously, not in the controller

    // Removed request_retrieve - now handled by TransactionController

    public function cancel_deposit($transaction_id)
    {
        $user = Auth::guard('client')->user();
        $transaction = Transaction::where('id', $transaction_id)
            ->where('client_id', $user->id)
            ->where('status', 'PENDING')
            ->firstOrFail();

        $transaction->status = 'CANCELLED';
        $transaction->save();

        return response()->json([
            'success' => true,
            'message' => 'Transaction annulée avec succès.'
        ]);
    }



}
