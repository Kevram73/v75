<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Models\Client;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
         $this->middleware('auth.admin');
    }

    public function index()
    {
        // Number of active clients
        $activeClientsCount = Client::where('is_active', true)->count();

        // 3 last active clients
        $activeClients = Client::where('is_active', true)->limit(5)->get();

        $totalDeps = 0;
        $depTrans = Transaction::where('receiver_id', 0)->where('trx_id', 2)->get();
        foreach($depTrans as $trans){
            $totalDeps += $trans->amount;
        }

        $totalRec = 0;
        $recTrans = Transaction::where('sender_id', 0)->where('trx_id', 2)->get();
        foreach ($recTrans as $rectran){
            $totalRec += $rectran->amount;
        }

        // List of active accounts
        $activeAccounts = Account::where('is_active', true)->get();

        // List of inactive accounts and their balance
        $inactiveAccounts = Account::where('is_active', false)->get();

        // Total transactions of the day
        $totalTransactionsToday = Transaction::whereDate('created_at', today())->where('trx_id', 2)->sum('amount');

        // 7 lasts transactions
        $lastTransactions = Transaction::orderByDesc('created_at')->limit(5)->get();

        // Transactions grouped by month and their total amounts
        $transactionsByMonth = Transaction::select(
            DB::raw('sum(amount) as total'),
            DB::raw('MONTH(created_at) as month')
        )->groupBy('month')->get();

        return view('admin.home', compact(
            'activeClientsCount',
            'activeClients',
            'totalDeps',
            'totalRec',
            'activeAccounts',
            'inactiveAccounts',
            'totalTransactionsToday',
            'transactionsByMonth',
            'lastTransactions'
        ));
    }

    public function profile(Request $request){
        return view('admin.profile');
    }

    public function stats(){
        // Number of active clients
        $activeClientsCount = Client::where('is_active', true)->count();

        // Total clients number
        $clientsCount = Client::where('deleted_at', null)->count();

        // Total admin number of clients
        $adminsCount = Admin::where('deleted_at', null)->count();

        // Total balance of all clients (assuming clients have a 'balance' attribute)
        $totalDeps = 0;
        $depTrans = Transaction::where('receiver_id', 0)->where('trx_id', 2)->get();
        foreach($depTrans as $trans){
            $totalDeps += $trans->amount;
        }
        $countdeps = count($depTrans);


        $totalRec = 0;
        $recTrans = Transaction::where('sender_id', 0)->where('trx_id', 2)->get();
        foreach ($recTrans as $rectran){
            $totalRec += $rectran->amount;
        }
        $countrecs = count($recTrans);
        // List of active accounts
        $activeAccounts = Account::where('is_active', true)->get();

        // List of inactive accounts and their balance
        $inactiveAccounts = Account::where('is_active', false)->get();

        // Total transactions of the day
        $totalTransactionsToday = Transaction::whereDate('created_at', today())->sum('amount');

        // all transactions
        $numberOfTransactions = Transaction::count();

        // Transactions grouped by month and their total amounts
        $transactionsByMonth = Transaction::select(
            DB::raw('sum(amount) as total'),
            DB::raw('MONTH(created_at) as month')
        )->groupBy('month')->get();

        // Transactions grouped by month and their total amounts
        $lastMonthTotalTransactions = Transaction::select(
            DB::raw('sum(amount) as total'),
            DB::raw('MONTH(created_at) as month')
        )->groupBy('month')->limit(1)->get();

        return view('admin.stats', compact(
            'activeClientsCount',
            'totalDeps',
            'totalRec',
            'countdeps',
            'countrecs',
            'activeAccounts',
            'inactiveAccounts',
            'totalTransactionsToday',
            'transactionsByMonth',
            'numberOfTransactions',
            'clientsCount',
            'adminsCount',
            'lastMonthTotalTransactions'
        ));
    }
}
