<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth.admin');
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with(['account'])->get();
        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = new Client([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'is_active' => $request->is_active
        ]);

        $client->save();

        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $client = Client::with(['account', 'transactions'])->find($id);
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $client = Client::find($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'is_active' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::find($id);
        $client->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'is_active' => $request->is_active
        ]);

        return redirect()->route('clients.index')->with('success', 'Client successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client successfully deleted !');
    }

    public function on_off(int $id){
        $client = Client::find($id);
        $client->is_active = !$client->is_active;
        $client->save();
        return redirect()->route('admin.clients.index')->with('success', 'Client status changed');
    }


    public function clients_disabled()
    {
        $clients = Client::where('is_active', false)->with(['account', 'transactions'])->get();
        return view('admin.clients.indexDisabled', compact('clients'));
    }
}
