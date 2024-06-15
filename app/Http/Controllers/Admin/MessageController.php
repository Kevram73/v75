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
        $messages = Message::all();
        return view('messages.index', compact('messages'));
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_date' => 'required|date',
            'admin_id' => 'required|exists:admins,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = new Message([
            'title' => $request->title,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
            'admin_id' => $request->admin_id
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
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'publish_date' => 'required|date',
            'admin_id' => 'required|exists:admins,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $message = Message::find($id);
        $message->update([
            'title' => $request->title,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
            'admin_id' => $request->admin_id
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
