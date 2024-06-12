<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

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

        // Total balance of all clients (assuming clients have a 'balance' attribute)
        $totalClientsBalance = Account::sum('balance');

        // List of active accounts
        $activeAccounts = Account::where('is_active', true)->get();

        // List of inactive accounts and their balance
        $inactiveAccounts = Account::where('is_active', false)->get();

        // Total transactions of the day
        $totalTransactionsToday = Transaction::whereDate('created_at', today())->sum('amount');

        // Transactions grouped by month and their total amounts
        $transactionsByMonth = Transaction::select(
            DB::raw('sum(amount) as total'),
            DB::raw('MONTH(created_at) as month')
        )->groupBy('month')->get();

        return view('admin.home', compact(
            'activeClientsCount',
            'totalClientsBalance',
            'activeAccounts',
            'inactiveAccounts',
            'totalTransactionsToday',
            'transactionsByMonth'
        ));
    }
}
