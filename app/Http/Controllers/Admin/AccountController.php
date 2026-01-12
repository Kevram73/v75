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
        $accounts = Account::with('client')->orderByDesc('created_at')->paginate(20);
        return view('admin.accounts.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::whereDoesntHave('wallet')->get();
        return view('admin.accounts.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|exists:clients,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Vérifier que le client n'a pas déjà un compte
        $existingAccount = Account::where('client_id', $request->client_id)->first();
        if ($existingAccount) {
            return redirect()->back()->withErrors(['client_id' => 'Ce client a déjà un compte.'])->withInput();
        }

        $account = new Account([
            'client_id' => $request->client_id,
            'account_num' => 'ACC-' . time() . '-' . $request->client_id,
            'balance' => 0.00,
            'is_active' => true
        ]);

        $account->save();

        return redirect()->route('admin.accounts.index')->with('success', 'Compte créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string|int $id)
    {
        $account = Account::with('client')->findOrFail((int) $id);
        return view('admin.accounts.show', compact('account'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string|int $id)
    {
        $account = Account::with('client')->findOrFail((int) $id);
        return view('admin.accounts.edit', compact('account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string|int $id)
    {
        $validator = Validator::make($request->all(), [
            'balance' => 'nullable|numeric|min:0',
            'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $account = Account::findOrFail((int) $id);
        $updateData = [];
        
        if ($request->has('balance')) {
            $updateData['balance'] = $request->balance;
        }
        
        if ($request->has('is_active')) {
            $updateData['is_active'] = $request->is_active;
        }
        
        $account->update($updateData);

        return redirect()->route('admin.accounts.index')->with('success', 'Compte mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        $account = Account::find((int) $id);
        $account->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Compte supprimé avec succès!');
    }

    public function on_off(string|int $id){
        $account = Account::findOrFail((int) $id);
        $account->is_active = !$account->is_active;
        $account->save();
        return redirect()->route('admin.accounts.index')->with('success', 'Statut du compte modifié');
    }
}
