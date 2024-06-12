<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accounts = Account::all();
        return view('accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('accounts.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'account_num' => 'required|string|max:255|unique:accounts',
            'balance' => 'required|numeric',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $account = new Account([
            'user_id' => $request->user_id,
            'account_num' => $request->account_num,
            'balance' => $request->balance,
            'is_active' => $request->is_active
        ]);

        $account->save();

        return redirect()->route('accounts.index')->with('success', 'Compte créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $account = Account::find($id);
        return view('accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $account = Account::find($id);
        $clients = Client::all();
        return view('accounts.edit', compact('account', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'account_num' => 'required|string|max:255|unique:accounts,account_num,' . $account->id,
            'balance' => 'required|numeric',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $account = Account::find($id);
        $account->update([
            'user_id' => $request->user_id,
            'account_num' => $request->account_num,
            'balance' => $request->balance,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('accounts.index')->with('success', 'Account successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $account = Account::find($id);
        $account->delete();
        return redirect()->route('accounts.index')->with('success', 'Account successfully deleted!');
    }

    public function on_off(int $id){
        $account = Account::find($id);
        $account->is_active = !$account->is_active;
        $account->save();
        return redirect()->route('accounts.index')->with('success', 'Account status changed');
    }
}
