<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\InvestmentController;
use App\Http\Controllers\Client\CommissionController;
use App\Http\Controllers\Client\TransactionController as ClientTransactionController;


// Public routes
Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');
Route::get('policy', function () {
    return view('policy');
})->name('policy');


Route::prefix('admin/')->name('admin.')->group(function () {

    // Auth
    Route::get('login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthController::class, 'auth_login'])->name('auth_login');
    Route::post('logout', [AdminAuthController::class, 'auth_logout'])->name('auth_logout');
    Route::post('change/password', [AdminAuthController::class, 'change_password'])->name('change_password');

    // Resources
    Route::resource('accounts', AccountController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('transactions', TransactionController::class);

    // Dashboard and stats
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('stats', [HomeController::class, 'stats'])->name('stats');

    // Account management
    Route::get('accounts/activated/{id}', [AccountController::class, 'on_off'])->name('account_activated');

    // Client management - MUST be before resource route to avoid route conflicts
    Route::get('clients/disabled', [ClientController::class, 'clients_disabled'])->name('clients.disabled');
    Route::get('clients/{id}/deactivate', [ClientController::class, 'client_disactivate'])->name('clients.deactivate');
    Route::get('clients/{id}/activate', [ClientController::class, 'client_activate'])->name('clients.activate');
    
    // Client resource route (must be after specific routes)
    Route::resource('clients', ClientController::class);

    // Transaction management
    Route::get('deposits', [TransactionController::class, 'list_deposits'])->name('deposits');
    Route::get('withdrawals', [TransactionController::class, 'list_withdrawals'])->name('withdrawals');
    // Note: transactions.index is created by the resource route above
    
    // Announcements
    Route::resource('announcements', \App\Http\Controllers\Admin\AnnouncementController::class);
    
    // Messages
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class);
});

Route::prefix('client/')->name('client.')->group(function () {

    // Auth
    Route::get('login', [ClientAuthController::class, 'login'])->name('login');
    Route::post('login', [ClientAuthController::class, 'auth_login'])->name('auth_login');
    Route::get('register/', [ClientAuthController::class, 'register'])->name('register');
    Route::get('register/{fellow}', [ClientAuthController::class, 'register'])->name('register.fellow');
    Route::post('register', [ClientAuthController::class, 'auth_register'])->name('auth_register');
    Route::get('forgot-password', [ClientAuthController::class, 'forgot_password'])->name('password.request');
    Route::post('forgot-password', [ClientAuthController::class, 'reset_password'])->name('password.email');
    Route::post('logout', [ClientAuthController::class, 'auth_logout'])->name('auth_logout');

    // Dashboard
    Route::get('dashboard', [ClientHomeController::class, 'index'])->name('dashboard');
    Route::post('profile', [ClientHomeController::class, 'change_account_details'])->name('profile.update');
    Route::get('account', [ClientHomeController::class, 'account'])->name('account');
    Route::post('usdt/account', [ClientHomeController::class, 'change_usdt_account'])->name('account_usdt');
    Route::post('btc/account', [ClientHomeController::class, 'change_btc_account'])->name('account_btc');

    // Investments
    Route::get('investments', [InvestmentController::class, 'index'])->name('investments.index');
    Route::get('investments/create', [InvestmentController::class, 'create'])->name('investments.create');
    Route::post('investments', [InvestmentController::class, 'store'])->name('investments.store');
    Route::get('investments/{id}', [InvestmentController::class, 'show'])->name('investments.show');

    // Commissions
    Route::get('commissions', [CommissionController::class, 'index'])->name('commissions.index');

    // Transactions
    Route::get('transactions', [ClientHomeController::class, 'transactions'])->name('transactions');
    Route::get('transactions/{id}', [ClientTransactionController::class, 'show'])->name('transactions.show');
    
    // Profile
    Route::get('profile', [ClientHomeController::class, 'clientProfile'])->name('profile');
    
    // Deposits
    Route::get('deposit', [ClientTransactionController::class, 'createDeposit'])->name('deposit');
    Route::post('deposit', [ClientTransactionController::class, 'storeDeposit'])->name('deposit.store');
    Route::get('deposits', [ClientHomeController::class, 'deposits'])->name('deposits');
    
    // Withdrawals
    Route::get('withdrawal', [ClientTransactionController::class, 'createWithdrawal'])->name('withdrawal');
    Route::post('withdrawal', [ClientTransactionController::class, 'storeWithdrawal'])->name('withdrawal.store');
    Route::get('withdrawals', [ClientHomeController::class, 'withdrawals'])->name('withdrawals');
    
    // Withdrawal password
    Route::get('withdrawal-password/setup', [ClientTransactionController::class, 'showWithdrawalPasswordSetup'])->name('withdrawal.password.setup');
    Route::post('withdrawal-password/setup', [ClientTransactionController::class, 'storeWithdrawalPassword'])->name('withdrawal.password.store');
    Route::get('withdrawal-password/change', [ClientTransactionController::class, 'showWithdrawalPasswordChange'])->name('withdrawal.password.change');
    Route::post('withdrawal-password/change', [ClientTransactionController::class, 'updateWithdrawalPassword'])->name('withdrawal.password.update');
    
    // Transfer
    Route::get('transfer', [ClientTransactionController::class, 'showTransfer'])->name('transfer');
    Route::post('transfer', [ClientTransactionController::class, 'processTransfer'])->name('transfer.process');
    Route::get('api/search-user', [ClientTransactionController::class, 'searchUser'])->name('api.search-user');
    
    // Announcements
    Route::get('announces', [ClientHomeController::class, 'announces'])->name('announces');
    
    // Messages
    Route::get('response', [ClientHomeController::class, 'response'])->name('response');
    Route::get('message/create', [ClientHomeController::class, 'messageCreate'])->name('message.create');
    Route::post('message/send', [ClientHomeController::class, 'messageStore'])->name('message_send');

});

// Payment success page
Route::get('/payment-success', function () {
    return view('success');
})->name('payment.success');



