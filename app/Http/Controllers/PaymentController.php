<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Make a deposit for a client account.
     */
    public function make_deposit(Request $request)
    {
        try{
        $data = $request->all();
        $user_id = $data->client_id;
        $amount = $data->amount;
        $devise = $data->devise;

        $transaction = new Transaction();
        $transaction->amount = $amount;
        $transaction->date_sent = now();
        $transaction->sender_id = $user_id;
        $transaction->receiver_id = 0;
        $transaction->type = 'deposit';
        $transaction->merchant_trade_no = uniqid('MTN_');
        $transaction->trx_id = '';
        $transaction->status = 'pending';
        $transaction->save();

        return redirect()->back()->with('success', 'Transaction en cours de traitement.');
        }catch(\Exception $e){
            return redirect()->back()->with('error', 'Erreur lors de la transaction.');
        }
    }


    /**
     * List all deposits for a specific client.
     */
    public function list_deposit_client(Request $request)
    {
        $deposits = Transaction::where('sender_id', Auth::guard('client')->user()->id)
            ->where('type', 'deposit')
            ->orderBy('date_sent', 'desc')
            ->get();

        return view('client.deposits', compact('deposits'));
    }

    /**
     * Get all transactions in the system.
     */
    public function get_all_transactions(Request $request)
    {
        $transactions = Transaction::with(['sender', 'receiver'])
            ->orderBy('date_sent', 'desc')
            ->get();

        return response()->json(['transactions' => $transactions], 200);
    }
}
