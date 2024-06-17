<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;
use App\Http\Controllers\Client\HomeController as ClientHomeController;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin/')->name('admin.')->group(function () {

    // Auth
    Route::get('login', [AdminAuthController::class, 'login'])->name('login');
    Route::post('login', [AdminAuthController::class, 'auth_login'])->name('auth_login');
    Route::post('logout', [AdminAuthController::class, 'auth_logout'])->name('auth_logout');

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
    Route::get('clients/activated/{id}', [ClientController::class, 'on_off'])->name('client_activated');
    Route::get('clients/disabled', [ClientController::class, 'clients_disabled'])->name('clients_disabled');

});

Route::prefix('client/')->name('client.')->group(function () {

    // Auth
    Route::get('login', [ClientAuthController::class, 'login'])->name('login');
    Route::post('login', [ClientAuthController::class, 'auth_login'])->name('auth_login');
    Route::get('register', [ClientAuthController::class, 'register'])->name('register');
    Route::post('register', [ClientAuthController::class, 'auth_register'])->name('auth_register');
    Route::get('forgot-password', [ClientAuthController::class, 'forgot_password'])->name('password.request');
    Route::post('forgot-password', [ClientAuthController::class, 'reset_password'])->name('password.email');
    Route::post('logout', [ClientAuthController::class, 'auth_logout'])->name('auth_logout');

    Route::get('dashboard', [ClientHomeController::class, 'index'])->name('dashboard');
    Route::get('client/profile', [ClientHomeController::class, 'clientProfile'])->name('clientProfile');

    // Route::get('dashboard', [ClientAuthController::class, 'auth_register'])->name('dashboard');

});
