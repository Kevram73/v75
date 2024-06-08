<?php

namespace App\Http\Controllers\Admin;

use App\Models\Transaction;
use App\Models\Client;  // Changed from User to Client
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $transactions = Transaction::with(['sender', 'receiver'])->get();
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();  // Changed from User to Client
        return view('transactions.create', compact('clients'));  // Changed variable name
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'date_sent' => 'required|date',
            'sender_id' => 'required|exists:clients,id',  // Changed from users to clients
            'receiver_id' => 'required|exists:clients,id',  // Changed from users to clients
            'type' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $transaction = new Transaction([
            'amount' => $request->amount,
            'date_sent' => $request->date_sent,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'type' => $request->type
        ]);

        $transaction->save();

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $transaction = Transaction::with(['sender', 'receiver'])->find($id);
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $transaction = Transaction::find($id);
        $clients = Client::all();  // Changed from User to Client
        return view('transactions.edit', compact('transaction', 'clients'));  // Changed variable name
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric',
            'date_sent' => 'required|date',
            'sender_id' => 'required|exists:clients,id',  // Changed from users to clients
            'receiver_id' => 'required|exists:clients,id',  // Changed from users to clients
            'type' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $transaction = Transaction::find($id);
        $transaction->update([
            'amount' => $request->amount,
            'date_sent' => $request->date_sent,
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'type' => $request->type
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction successfully deleted!');
    }
}
