<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Client;
use App\Models\Transaction;
use App\Models\Account;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        return view('client.dashboard', compact('user'));
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

        $deposits = Transaction::where('sender_id', $account->account_num)->get();

        return view('client.deposits', compact('deposits'));
    }

    public function withdrawals(Request $request){
        $user = Auth::guard('client')->user();
        $account = Account::where('client_id', $user->id)->get()->first();

        $withdrawals = Transaction::where('receiver_id', $account->account_num)->get();

        return view('client.withdrawals', compact('withdrawals'));
    }

    public function actualites(Request $request){
        $announcements = Announcement::all();
        return view('client.announces', compact('announcements'));
    }

    public function service_client(Request $request){
        $messages = Message::where('client_id', Auth::guard('client')->user()->id)->get();
        return view('client.service_client', compact('messages'));
    }

    public function account(Request $request){
        $account = Account::where('client_id', $user->id)->get()->first();
        $deposits = Transaction::where('sender_id', $account->account_num)->get();
        $withdrawals = Transaction::where('receiver_id', $account->account_num)->get();

        return view('client.account', compact('account', 'deposits', 'withdrawals'));
    }
}
