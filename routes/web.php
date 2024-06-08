<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Client\AuthController as ClientAuthController;

Route::get('/', function () {
    return view('welcome');
});



Route::prefix('admin/')->name('admin.')->group(function () {

    // Auth
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'auth_login'])->name('auth_login');
    Route::post('logout', [AuthController::class, 'auth_logout'])->name('auth_logout');

    // Accounts CRUD
    Route::resource('accounts', AccountController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('announcements', AnnouncementController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('transactions', TransactionController::class);

    Route::get('home', [HomeController::class, 'index'])->name('home');

    Route::get('accounts/activated/{id}', [AccountController::class, 'on_off'])->name('account_activated');
    Route::get('clients/activated/{id}', [ClientController::class, 'on_off'])->name('client_activated');
});

Route::prefix('client/')->name('client.')->group(function () {

    // Auth
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::post('login', [AuthController::class, 'auth_login'])->name('auth_login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('register', [AuthController::class, 'auth_register'])->name('auth_register');
    Route::get('forgot-password', [AuthController::class, 'forgot_password'])->name('password.request');
    Route::post('forgot-password', [AuthController::class, 'reset_password'])->name('password.email');
    Route::post('logout', [AuthController::class, 'auth_logout'])->name('auth_logout');
});
