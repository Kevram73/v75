<?php

namespace App\Http\Controllers\Admin;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnnouncementController extends Controller
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
        $announcements = Announcement::all();
        return view('announcements.index', compact('announcements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('announcements.create');
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

        $announcement = new Announcement([
            'title' => $request->title,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
            'admin_id' => $request->admin_id
        ]);

        $announcement->save();

        return redirect()->route('announcements.index')->with('success', 'Announcement created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $announcement = Announcement::find($id);
        return view('announcements.show', compact('announcement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $announcement = Announcement::find($id);
        return view('announcements.edit', compact('announcement'));
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

        $announcement = Announcement::find($id);
        $announcement->update([
            'title' => $request->title,
            'content' => $request->content,
            'publish_date' => $request->publish_date,
            'admin_id' => $request->admin_id
        ]);

        return redirect()->route('announcements.index')->with('success', 'Announcement successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $announcement = Announcement::find($id);
        $announcement->delete();
        return redirect()->route('announcements.index')->with('success', 'Announcement successfully deleted!');
    }
}
