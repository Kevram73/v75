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


        // $response = $this->binancePayService->createOrder($amount, $currency, $goods);

        if ($response['status'] === 'SUCCESS') {
            // Redirection avec données pour affichage de QR code
            return view('client.qr', ['qrLink' => $response['data']['qrcodeLink']]);
        }

        return back()->with('error', 'Payment failed');
    }


    /**
     * Envoie la requête à l'API NowPayments pour créer un paiement.
     */
    public function sendMoney(Request $request)
    {
        // Récupérer les données du formulaire
        $priceAmount = $request->input('price_amount');
        $priceCurrency = $request->input('price_currency');
        $payCurrency = $request->input('pay_currency');
        $orderId = $request->input('order_id');
        $orderDescription = $request->input('order_description');
        $ipnCallbackUrl = $request->input('ipn_callback_url');

        // API key NowPayments (à configurer dans .env)
        $apiKey = env('NOWPAYMENTS_API_KEY');

        // Préparation des données à envoyer dans la requête
        $data = [
            'price_amount' => $priceAmount,
            'price_currency' => $priceCurrency,
            'pay_currency' => $payCurrency,
            'ipn_callback_url' => $ipnCallbackUrl,
            'order_id' => $orderId,
            'order_description' => $orderDescription,
        ];

        try {
            // Envoie de la requête POST à l'API NowPayments
            $response = Http::withHeaders([
                'x-api-key' => $apiKey,
                'Content-Type' => 'application/json',
            ])->post('https://api.nowpayments.io/v1/payment', $data);

            // Vérification du succès de la requête
            if ($response->successful()) {
                // Traitement de la réponse
                $paymentData = $response->json();

                $paymentLink = "https://nowpayments.io/payment/?iid={$paymentData['purchase_id']}&paymentId={$paymentData['payment_id']}";

                Payment::create([
                    'payment_id' => $paymentData['payment_id'] ?? null,
                    'payment_status' => $paymentData['payment_status'] ?? 'waiting',
                    'pay_address' => $paymentData['pay_address'] ?? null,
                    'price_amount' => $paymentData['price_amount'] ?? 0,
                    'price_currency' => $paymentData['price_currency'] ?? 'usd',
                    'pay_amount' => $paymentData['pay_amount'] ?? 0,
                    'pay_currency' => $paymentData['pay_currency'] ?? 'btc',
                    'order_id' => $paymentData['order_id'] ?? null,
                    'order_description' => $paymentData['order_description'] ?? null,
                    'ipn_callback_url' => $paymentData['ipn_callback_url'] ?? null,
                    'purchase_id' => $paymentData['purchase_id'] ?? null,
                    'amount_received' => $paymentData['amount_received'] ?? 0,
                    'payin_extra_id' => $paymentData['payin_extra_id'] ?? null,
                    'smart_contract' => $paymentData['smart_contract'] ?? null,
                    'network' => $paymentData['network'] ?? 'btc',
                    'network_precision' => $paymentData['network_precision'] ?? 8,
                    'expiration_estimate_date' => isset($paymentData['expiration_estimate_date'])
                        ? Carbon::parse($paymentData['expiration_estimate_date'])->format('Y-m-d H:i:s')
                        : null, // Conversion de la date
                    'burning_percent' => $paymentData['burning_percent'] ?? null,
                    'is_fixed_rate' => $paymentData['is_fixed_rate'] ?? false,
                    'is_fee_paid_by_user' => $paymentData['is_fee_paid_by_user'] ?? false,
                    'valid_until' => isset($paymentData['valid_until'])
                        ? Carbon::parse($paymentData['valid_until'])->format('Y-m-d H:i:s')
                        : null, // Conversion de la date
                    'type' => $paymentData['type'] ?? 'crypto2crypto',
                    'product' => $paymentData['product'] ?? 'api',
                    'origin_ip' => $paymentData['origin_ip'] ?? null,
                ]);



                return view('client.success', ['paymentData' => $paymentData, "payment_link" => $paymentLink]);

            } else {
                // En cas d'échec, afficher le message d'erreur
                $errorMessage = $response->json()['message'] ?? 'Erreur lors de la création du paiement.';
                Session::flash('error', $errorMessage);
                return back();
            }
        } catch (\Exception $e) {
            // Gestion des exceptions
            Session::flash('error', 'Une erreur est survenue : ' . $e->getMessage());
            return back();
        }
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


}
