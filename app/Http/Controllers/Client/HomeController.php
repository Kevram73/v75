<?php

namespace App\Http\Controllers\Client;

use App\Models\Payment;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Account;
use App\Models\Message;
use App\Models\Transaction;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use App\Models\RetrieveRequest;

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
        $account = Account::where('client_id', $user->id)->get()->first();

        $deposits = Transaction::where('sender_id', $user->id)->get();
        $withdrawals = Transaction::where('sender_id', $user->id)->get();
        $deposit_total = 0;
        $withdrawal_total = 0;
        foreach($deposits as $dep){
            $deposit_total += $dep->amount;
        }
        foreach($withdrawals as $wit){
            $withdrawal_total += $dep->amount;
        }

        return view('client.dashboard', compact('user', 'deposit_total', 'withdrawal_total', 'account'));
    }

    public function clientProfile(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::guard('client')->user();

        return view('client.clientProfile', compact('user'));
    }

    public function deposits(Request $request): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::guard('client')->user();
        $account = Account::where('client_id', $user->id)->get()->first();
        $this->get_done_transactions();
        $deposits = Transaction::where('sender_id', $user->id)->orderByDesc('created_at')->get();

        return view('client.deposits', compact('deposits', 'account'));
    }

    public function withdrawals(Request $request)
    {
        $user = Auth::guard('client')->user();

        // Retrieve the client's account
        $account = Account::where('client_id', $user->id)->first();

        // Fetch all withdrawal requests (RetrieveRequests) made by this client
        $withdrawals = RetrieveRequest::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->get();

        // Return the view with the withdrawals and account data
        return view('client.withdrawals', compact('withdrawals', 'account'));
    }


    public function actualites(Request $request){
        $announcements = Announcement::orderByDesc('updated_at')->get();
        return view('client.announces', compact('announcements'));
    }

    public function messageCreate()
    {
        return view('client.message_create');
    }

    public function messageStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'object' => 'required|string|max:255',
            'content' => 'required|string',
            // 'date_sent' => 'required|date',
            // 'sender_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = new Message([
            'object' => $request->object,
            'date_sent' => Carbon::now(),
            'sender_id' => Auth::guard('client')->user()->id
        ]);

        $message->save();

        return redirect()->route('client.service_client')->with('success', 'Message sended successfully!');
    }

    public function service_client(Request $request){
        $messages = Message::where('sender_id', Auth::guard('client')->user()->id)->get();
        return view('client.service_client', compact('messages'));
    }

    public function account(Request $request){
        $this->get_done_transactions();
        $user = Auth::guard('client')->user();
        $account = Account::where('client_id', $user->id)->get()->first();
        $totalDeposits = Transaction::where('sender_id', $user->id)->sum('amount');
        $totalWithdrawals = Transaction::where('receiver_id', $user->id)->sum('amount');

        return view('client.account', compact('account', 'totalDeposits', 'totalWithdrawals', 'user'));
    }

    public function change_account_details(Request $request){
        $user = Auth::guard('client')->user();
        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
        ]);


        return redirect()->route("client.clientProfile")->with('success', 'Compte mis à jour avec succès');
    }

    public function send(){

        $user = Auth::guard('client')->user();
        return view('client.send', compact('user'));
    }

    public function confirm_trans($transaction_id){
        $user = Auth::guard('client')->user();
        $trans = Transaction::where('id', $transaction_id)->get()->first();
        $usdtAccount = "TSxu5NpBKAsEWipRuxgJwsRLUbG78G9Nf3";
        return view('client.confirm_trans', compact('user', 'trans', 'usdtAccount'));
    }

    public function receive(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $user = Auth::guard('client')->user();
        return view('client.receive', compact('user'));
    }

    public function change_usdt_account(Request $request){
        $client_id = Auth::guard('client')->user()->id;
        $account = Account::where('client_id', $client_id)->get()->first();
        $account->usdt_account = $request->code;
        $account->save();
        return redirect()->back()->with('success', 'Compte USDT mis à jour');
    }

    public function change_btc_account(Request $request){
        $client_id = Auth::guard('client')->user()->id;
        $account = Account::where('client_id', $client_id)->get()->first();
        $account->btc_account = $request->code;
        $account->save();
        return redirect()->back()->with('success', 'Compte BTC mis à jour');
    }


    /**
     * Envoie la requête à l'API NowPayments pour créer un paiement.
     */


    public function register_deposit(Request $request)
    {
        $priceAmount = $request->input('price_amount');
        $priceCurrency = $request->input('price_currency');

        $transaction = new Transaction();
        $transaction->amount = $priceAmount;
        $transaction->merchant_trade_no = "";
        $transaction->date_sent = now();
        $transaction->sender_id = Auth::guard('client')->user()->id;
        $transaction->type = 'deposit';
        $transaction->status = "No confirmed";
        $transaction->trx_id = 1;
        $transaction->receiver_id = 0;
        $transaction->save();

        return redirect()->route('client.confirm_trans', ['transaction_id' => $transaction->id])->with('success', 'Transaction non confirmée');


    }

    public function confirmation(Request $request){
        $transaction = Transaction::where('id', $request->transaction_id)->get()->first();
        $transaction->merchant_trade_no = $request->transaction_number;
        $transaction->status = "En attente";
        $transaction->save();
        return redirect()->route('client.deposits')->with('success', 'Transaction en attente de confirmation');
    }

public function get_done_transactions() {
        $client_id = Auth::guard('client')->user()->id;
        $transactions = Transaction::where('sender_id', $client_id)
                                    ->where('trx_id', 1)
                                    ->get();

        foreach ($transactions as $transaction) {
            if ($transaction->type == "USDT") {
                $this->check_usdt_transaction($transaction);
            } else if ($transaction->type == "BTC") {
                $this->check_btc_transaction($transaction);
            }
        }
    }

    private function check_usdt_transaction($transaction) {
        $wallet_address = $transaction->wallet_address;
        $url = "https://apilist.tronscan.org/api/token_trc20/transfers?relatedAddress={$wallet_address}&limit=20&start=0";

        $response = Http::get($url);

        if ($response->successful()) {
            $transactions = $response->json();
            foreach ($transactions['token_transfers'] as $tx) {
                if ($tx['transaction_id'] == $transaction->merchant_trade_no && $tx['finalResult'] == "SUCCESS") {
                    $this->mark_transaction_as_valid($transaction);
                }
            }
        } else {
            $this->handle_api_error($response);
        }
    }

    private function check_btc_transaction($transaction) {
        $wallet_address = $transaction->wallet_address;
        $url = "https://blockchain.info/rawaddr/{$wallet_address}";

        $response = Http::get($url);

        if ($response->successful()) {
            $transactions = $response->json();
            foreach ($transactions['txs'] as $tx) {
                if ($tx['hash'] == $transaction->merchant_trade_no) {
                    $this->mark_transaction_as_valid($transaction);
                }
            }
        } else {
            $this->handle_api_error($response);
        }
    }

    private function mark_transaction_as_valid($transaction) {
        $transaction->trx_id = 2; // Mark as success
        $transaction->save();
        $account = Account::where('client_id', Auth::guard('client')->user()->id)->get()->first();
        $account->balance += $transaction->amount;
        $account->save();
    }

    private function handle_api_error($response) {
        \Log::error("API request failed: " . $response->body());
    }

    public function request_retrieve(Request $request){
        try {
            $user = Auth::guard('client')->user();

            RetrieveRequest::create([
                'user_id' => $user->id,
                'price_amount' => $request->amount,
                'price_currency' => $request->devise,
                'status' => 'En attente',
                'to_account' => $request->account
            ]);

            return redirect()->back()->with('success', 'Demande de retrait envoyée');
        } catch (\Exception $e) {
            \Log::error('Error in withdrawal request: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Une erreur est survenue lors de l\'envoi de la demande de retrait. Veuillez réessayer.');
        }
    }

    public function cancel_deposit($transaction_id)
{
    $transaction = Transaction::find($transaction_id);

    if (!$transaction) {
        return response()->json(['success' => false, 'message' => 'Transaction introuvable.'], 404);
    }

    $transaction->status = "canceled";
    $transaction->save();

    return response()->json(['success' => true, 'message' => 'Transaction annulée avec succès.']);
}



}
