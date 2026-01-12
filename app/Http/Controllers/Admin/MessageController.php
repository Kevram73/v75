<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
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
        // Get all messages from clients
        // Include messages with client_id OR sender_id (for backward compatibility)
        $messages = Message::where(function($query) {
                $query->whereNotNull('client_id')
                      ->orWhereNotNull('sender_id');
            })
            ->whereNull('deleted_at') // Exclude soft deleted messages
            ->orderByDesc('created_at')
            ->paginate(20);
            
        // Load clients - for messages without client_id, use sender_id
        $messages->load('client');
        
        // For messages without client_id, manually load client using sender_id
        foreach ($messages as $message) {
            if (!$message->client && $message->sender_id) {
                $message->setRelation('client', \App\Models\Client::find($message->sender_id));
            }
        }
        
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = new Message([
            'subject' => $request->subject,
            'message' => $request->message,
            'client_id' => $request->client_id ?? null,
        ]);

        $message->save();

        return redirect()->route('admin.messages.index')->with('success', 'Message créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string|int $id)
    {
        $message = Message::with('client')->findOrFail((int) $id);
        return view('admin.messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string|int $id)
    {
        $message = Message::findOrFail((int) $id);
        return view('admin.messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string|int $id)
    {
        $validator = Validator::make($request->all(), [
            'response' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = Message::findOrFail((int) $id);
        $message->update([
            'response' => $request->response,
            'response_date' => now(),
        ]);

        return redirect()->route('admin.messages.show', $message->id)->with('success', 'Réponse envoyée avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string|int $id)
    {
        $message = Message::findOrFail((int) $id);
        $message->delete();
        return redirect()->route('admin.messages.index')->with('success', 'Message supprimé avec succès!');
    }
}
