<?php

namespace App\Http\Controllers\Admin;

use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
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
        $clients = Client::where('is_active', true)->orderByDesc('created_at')->paginate(20);
        return view('admin.clients.index', compact('clients'));
    }

    public function client_disabled()
    {
        $clients = Client::where('is_active', false)->get();
        return view('admin.clients.indexDisabled', compact('clients'));
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
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'password' => \Hash::make($request->password),
            'is_active' => true
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string|int $id)
    {
        $client = Client::with(['wallet', 'transactions'])->findOrFail((int) $id);
        return view('admin.clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string|int $id)
    {
        $client = Client::findOrFail((int) $id);
        return view('admin.clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string|int $id)
    {
        $id = (int) $id;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'email' => 'required|email|unique:clients,email,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Client::findOrFail($id);
        $client->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.clients.index')->with('success', 'Client mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        $client = Client::find((int) $id);
        $client->delete();
        return redirect()->route('admin.clients.index')->with('success', 'Client successfully deleted !');
    }

    public function on_off(string|int $id){
        $client = Client::find((int) $id);
        $client->is_active = !$client->is_active;
        $client->save();
        return redirect()->route('admin.clients.index')->with('success', 'Client status changed');
    }


    public function clients_disabled()
    {
        $clients = Client::where('is_active', 0)->orderByDesc('created_at')->paginate(20);
        return view('admin.clients.indexDisabled', compact('clients'));
    }

    public function client_disactivate(Request $request, string|int $id)
    {
        $client_user = Client::find((int) $id);
        $client_user->is_active = 0;
        $client_user->save();

        return back()->with('success', "Votre client a bien été désactivé");
    }

    public function client_activate(Request $request, string|int $id)
    {
        $client_user = Client::find((int) $id);
        $client_user->is_active = 1;
        $client_user->save();

        return back()->with('success', "Votre client a bien été activé");
    }
}
