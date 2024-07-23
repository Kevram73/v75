<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;
use App\Http\Controllers\Client\BinancePayController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'welcome']);
Route::get('/binance-pay/form', function () {
    return view('binance');
});


Route::get('policy', function () {
    return view('policy');
});

Route::post('/binance-pay/create-order', [BinancePayController::class, 'createOrder']);
Route::post('/send/money', [ClientHomeController::class, 'send_money'])->name('send_money');

Route::prefix('admin/')->name('admin.')->group(function () {

    // Auth
    Route::get('login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthController::class, 'auth_login'])->name('auth_login');
    Route::post('logout', [AdminAuthController::class, 'auth_logout'])->name('auth_logout');
    Route::post('change/password', [AdminAuthController::class, 'change_password'])->name('change_password');

    // Accounts CRUD
    Route::resource('accounts', AccountController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('messages', MessageController::class);

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('admin/profile', [HomeController::class, 'profile'])->name('profile');
    Route::get('admin/stats', [HomeController::class, 'stats'])->name('stats');


    Route::get('accounts/activated/{id}', [AccountController::class, 'on_off'])->name('account_activated');

    Route::get('client/liste/disabled', [ClientController::class, 'clients_disabled'])->name('client_liste_disabled');
    Route::get('clients/disactivate/{id}', [ClientController::class, 'client_disactivate'])->name('client.disactivate');
    Route::get('clients/activate/{id}', [ClientController::class, 'client_activate'])->name('client.activate');
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

    Route::get('dashboard', [ClientHomeController::class, 'index'])->name('dashboard');
    Route::get('profile', [ClientHomeController::class, 'clientProfile'])->name('clientProfile');
    Route::get('deposits', [ClientHomeController::class, 'deposits'])->name('deposits');
    Route::get('withdrawals', [ClientHomeController::class, 'withdrawals'])->name('withdrawals');
    Route::get('actualites', [ClientHomeController::class, 'actualites'])->name('actualites');
    Route::get('message', [ClientHomeController::class, 'messageCreate'])->name('message');
    Route::get('service/client', [ClientHomeController::class, 'service_client'])->name('service_client');
    Route::get('account', [ClientHomeController::class, 'account'])->name('account');
    Route::post('account/details', [ClientHomeController::class, 'change_account_details'])->name('change_account_details');
    Route::post('message/send', [ClientHomeController::class, 'messageStore'])->name('message_send');
    Route::post('usdt/account', [ClientHomeController::class, 'change_usdt_account'])->name('account_usdt');

    Route::get('invest/deposit', [ClientHomeController::class, 'send'])->name('invest_deposit');
    Route::get('invest/withdrawal', [ClientHomeController::class, 'receive'])->name('invest_withdrawal');
    Route::post('/binance/deposit', [ClientHomeController::class, 'createOrder'])->name("create_order_deposit");



    Route::post('/create-payment', 'PaymentController@create')->name('payment.create');
    Route::post('/payment-callback', 'PaymentController@callback')->name('payment.callback');
    // Route::get('dashboard', [ClientAuthController::class, 'auth_register'])->name('dashboard');

});

Route::get('/binancepay/returnURL', [BinancePayController::class, 'returnCallback'])->name("returnCallback");
Route::get('/binancepay/cancelURL', [BinancePayController::class, 'cancelCallback'])->name("cancelCallback");
