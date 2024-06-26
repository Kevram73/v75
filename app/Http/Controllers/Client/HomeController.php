<?php

namespace App\Http\Controllers\Client;

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
        $account = Account::where('client_id', $user->id)->get()->first();

        $deposit_total = Transaction::where('sender_id', $account->account_num)->get()->sum();
        $withdrawal_total = Transaction::where('sender_id', $account->account_num)->get()->sum();


        return view('client.dashboard', compact('user', 'deposit_total', 'withdrawal_total', 'account'));
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

        $deposits = Transaction::where('sender_id', $account->account_num)->orderByDesc('created_at')->get();

        return view('client.deposits', compact('deposits', 'account'));
    }

    public function withdrawals(Request $request){
        $user = Auth::guard('client')->user();
        $account = Account::where('client_id', $user->id)->get()->first();

        $withdrawals = Transaction::where('receiver_id', $account->account_num)->orderByDesc('created_at')->get();

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
            'content' => $request->content,
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
        $user = Auth::guard('client')->user();
        $account = Account::where('client_id', $user->id)->get()->first();
        $totalDeposits = Transaction::where('sender_id', $account->account_num)->sum('amount');
        $totalWithdrawals = Transaction::where('receiver_id', $account->account_num)->sum('amount');

        return view('client.account', compact('account', 'totalDeposits', 'totalWithdrawals'));
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

    public function receive(){

        $user = Auth::guard('client')->user();
        return view('client.receive', compact('user'));
    }
}
