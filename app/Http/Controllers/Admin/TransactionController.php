<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;  // Changed from User to Client
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
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
        $transactions = Transaction::with('client')->orderByDesc('created_at')->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.transactions.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'client_id' => 'required|exists:clients,id',
            'type' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $transaction = new Transaction([
            'amount' => $request->amount,
            'client_id' => $request->client_id,
            'type' => $request->type,
            'status' => 'PENDING'
        ]);

        $transaction->save();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction créée avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string|int $id)
    {
        $transaction = Transaction::with('client')->findOrFail((int) $id);
        return view('admin.transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string|int $id)
    {
        $transaction = Transaction::findOrFail((int) $id);
        $clients = Client::all();
        return view('admin.transactions.edit', compact('transaction', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string|int $id)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required|string|in:PENDING,COMPLETED,CANCELLED',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $transaction = Transaction::findOrFail((int) $id);
        
        // Si on valide un dépôt ou investissement, créditer le compte
        if (($transaction->type === 'DEPOSIT' || $transaction->type === 'INVESTMENT') && 
            $request->status === 'COMPLETED' && 
            $transaction->status !== 'COMPLETED') {
            
            $client = $transaction->client;
            if ($client && $client->wallet) {
                $client->wallet->addBalance($transaction->amount);
            }
        }
        
        $transaction->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.transactions.show', $transaction->id)->with('success', 'Statut de la transaction mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        $transaction = Transaction::find((int) $id);
        $transaction->delete();
        return redirect()->route('admin.transactions.index')->with('success', 'Transaction supprimée avec succès!');
    }

    public function list_deposits(Request $request)
    {
        $deposits = Transaction::with('client')
            ->whereIn('type', ['DEPOSIT', 'INVESTMENT'])
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.deposits', compact('deposits'));
    }

    public function list_withdrawals(Request $request)
    {
        $withdrawals = Transaction::with('client')
            ->where('type', 'WITHDRAWAL')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('admin.withdrawals', compact('withdrawals'));
    }

}
