<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
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

        // Last active clients
        $activeClients = Client::where('is_active', true)->limit(5)->get();

        // Total deposits (investments)
        $totalDeps = Transaction::where('type', 'INVESTMENT')
            ->where('status', 'COMPLETED')
            ->sum('amount');

        // Total withdrawals
        $totalRec = Transaction::where('type', 'WITHDRAWAL')
            ->where('status', 'COMPLETED')
            ->sum('amount');

        // List of active accounts
        $activeAccounts = Account::where('is_active', true)->get();

        // List of inactive accounts
        $inactiveAccounts = Account::where('is_active', false)->get();

        // Total transactions of the day
        $totalTransactionsToday = Transaction::whereDate('created_at', today())
            ->where('status', 'COMPLETED')
            ->sum('amount');

        // Last transactions
        $lastTransactions = Transaction::with('client')
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        // Transactions grouped by month
        $transactionsByMonth = Transaction::select(
            DB::raw('SUM(amount) as total'),
            DB::raw('MONTH(created_at) as month')
        )
        ->where('status', 'COMPLETED')
        ->groupBy('month')
        ->get();

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

    public function stats()
    {
        // Get investment service for stats
        $investmentService = app(\App\Services\InvestmentService::class);
        $commissionService = app(\App\Services\CommissionService::class);

        // Client statistics
        $activeClientsCount = Client::where('is_active', true)->count();
        $clientsCount = Client::whereNull('deleted_at')->count();
        $adminsCount = Admin::whereNull('deleted_at')->count();

        // Investment statistics
        $investmentStats = $investmentService->getAdminInvestmentStats();
        
        // Commission statistics
        $commissionStats = $commissionService->getAdminCommissionStats();

        // Transaction statistics
        $totalDeps = Transaction::where('type', 'INVESTMENT')
            ->where('status', 'COMPLETED')
            ->sum('amount');
        
        $totalRec = Transaction::where('type', 'WITHDRAWAL')
            ->where('status', 'COMPLETED')
            ->sum('amount');

        $countdeps = Transaction::where('type', 'INVESTMENT')
            ->where('status', 'COMPLETED')
            ->count();
        
        $countrecs = Transaction::where('type', 'WITHDRAWAL')
            ->where('status', 'COMPLETED')
            ->count();

        // Account statistics
        $activeAccounts = Account::where('is_active', true)->get();
        $inactiveAccounts = Account::where('is_active', false)->get();
        $actives = $activeAccounts->count();
        $inactives = $inactiveAccounts->count();

        // Transaction statistics
        $totalTransactionsToday = Transaction::whereDate('created_at', today())
            ->where('status', 'COMPLETED')
            ->sum('amount');

        $totalTransactions = Transaction::where('status', 'COMPLETED')->sum('amount');
        $numberOfTransactions = Transaction::count();

        // Transactions grouped by month
        $transactionsByMonth = Transaction::select(
            DB::raw('SUM(amount) as total'),
            DB::raw('MONTH(created_at) as month')
        )
        ->where('status', 'COMPLETED')
        ->groupBy('month')
        ->get();

        // Total balance of all clients
        $retrieve_all = Account::sum('balance');

        return view('admin.stats', compact(
            'activeClientsCount',
            'clientsCount',
            'adminsCount',
            'investmentStats',
            'commissionStats',
            'totalDeps',
            'totalRec',
            'countdeps',
            'countrecs',
            'activeAccounts',
            'inactiveAccounts',
            'actives',
            'inactives',
            'totalTransactionsToday',
            'transactionsByMonth',
            'numberOfTransactions',
            'totalTransactions',
            'retrieve_all'
        ));
    }
}
