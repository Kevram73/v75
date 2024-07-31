<?php

namespace App\Http\Controllers\Client;

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
use App\Services\BinancePayService;
use Illuminate\Support\Facades\Redirect;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    protected $binancePayService;

    public function __construct(BinancePayService $binancePayService)
    {
        $this->binancePayService = $binancePayService;
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

        $deposit_total = Transaction::where('sender_id', $account->account_num)->get()->sum();
        $withdrawal_total = Transaction::where('sender_id', $account->account_num)->get()->sum();


        return view('client.dashboard', compact('user', 'deposit_total', 'withdrawal_total', 'account'));
    }

    public function clientProfile(){
        // $adminConnected = Auth::admin()->id;
        // $admin = Admin::find($adminConnected);
        // return view('admin.profile', compact('admin'));
        $user = Auth::guard('client')->user();

        return view('client.clientProfile', compact('user'));
    }

    public function deposits(Request $request){
        $user = Auth::guard('client')->user();
        $account = Account::where('client_id', $user->id)->get()->first();
        $this->get_done_transactions();
        $deposits = Transaction::where('sender_id', $account->account_num)->orderByDesc('created_at')->get();

        return view('client.deposits', compact('deposits', 'account'));
    }

    public function withdrawals(Request $request){
        $user = Auth::guard('client')->user();
        $this->get_done_transactions();
        $account = Account::where('client_id', $user->id)->get()->first();

        $withdrawals = Transaction::where('receiver_id', $account->account_num)->orderByDesc('created_at')->get();

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
        $totalDeposits = Transaction::where('sender_id', $account->account_num)->sum('amount');
        $totalWithdrawals = Transaction::where('receiver_id', $account->account_num)->sum('amount');

        return view('client.account', compact('account', 'totalDeposits', 'totalWithdrawals'));
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

    public function receive(){

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

    public function createOrder(Request $request)
    {
        $amount = $request->input('amount');
        $currency = $request->input('currency', 'USDT');

        $goods = [
            "goodsType" => "01",
            "goodsCategory" => "Tron-V75",
            "referenceGoodsId" => Uuid::uuid4()->toString(),
            "goodsName" => "Hot Things",
            "goodsDetail" => "For my website"
        ];

        $transaction = new Transaction();
        $transaction->amount = $amount;
        $transaction->date_sent = Carbon::now();
        $transaction->sender_id = Auth::guard('client')->user()->id;
        $transaction->receiver_id = 0;
        $transaction->type = 'deposit';
        $transaction->save();


        $response = $this->binancePayService->createOrder($amount, $currency, $goods);

        if ($response['status'] === 'SUCCESS') {
            // Redirection avec données pour affichage de QR code
            return view('client.qr', ['qrLink' => $response['data']['qrcodeLink']]);
        }

        return back()->with('error', 'Payment failed');
    }

    public function send_money(Request $request) {
        $amount = $request->amount;
        $client_id = Auth::guard('client')->user()->id;
        $account = Account::where('client_id', $client_id)->first();

        if ($request->currency == 'USDT' && empty($account->usdt_account)) {
            return back()->with('error', "Veuillez renseigner votre compte USDT");
        }

        if ($request->currency == 'BTC' && empty($account->btc_account)) {
            return back()->with('error', "Veuillez renseigner votre compte BTC");
        }

        switch ($request->currency) {
            case 'USDT':
                $coin = 195;
                $address = "TSxu5NpBKAsEWipRuxgJwsRLUbG78G9Nf3";
                break;
            case 'BTC':
                $coin = 0;
                $address = "bc1qamgfs4cknh7rqtsndr7hhwzeguns2v6vqht0cw";
                break;
            default:
                return response()->json(['error' => 'Unsupported cryptocurrency type'], 400);
        }

        $uid = Uuid::uuid4()->toString();

        $transaction = new Transaction();
        $transaction->sender_id = $client_id;
        $transaction->receiver_id = 0;
        $transaction->amount = $amount;
        $transaction->date_sent = now();
        $transaction->type = $request->currency;
        $transaction->merchant_trade_no = $uid;
        $transaction->trx_id = 1; // 1: En attente, 2: Success, 0: Annulée
        $transaction->save();

        $link = "trust://send?address=" . urlencode($address) . "&coin=" . urlencode($coin) . "&amount=" . urlencode($amount) . "&txid=" . urlencode($uid);

        return redirect($link);
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
    }

    private function handle_api_error($response) {
        \Log::error("API request failed: " . $response->body());
    }


}
