<?php

namespace App\Http\Controllers\Admin;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $messages = Message::orderByDesc('created_at')->get();
        return view('admin.messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('messages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'object' => 'required|string|max:255',
            'content' => 'required|string',
            'date_sent' => 'required|date',
            'sender_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = new Message([
            'object' => $request->object,
            'content' => $request->content,
            'date_sent' => $request->date_sent,
            'sender_id' => $request->sender_id
        ]);

        $message->save();

        return redirect()->route('messages.index')->with('success', 'Message created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $message = Message::find($id);
        return view('messages.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $message = Message::find($id);
        return view('messages.edit', compact('message'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'object' => 'required|string|max:255',
            'content' => 'required|string',
            'date_sent' => 'required|date',
            'sender_id' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = Message::find($id);
        $message->update([
            'object' => $request->object,
            'content' => $request->content,
            'date_sent' => $request->date_sent,
            'sender_id' => $request->sender_id
        ]);

        return redirect()->route('messages.index')->with('success', 'Message successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect()->route('messages.index')->with('success', 'Message successfully deleted!');
    }
}
