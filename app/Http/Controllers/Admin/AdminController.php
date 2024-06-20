<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
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
        $admins = Admin::all();
        return view('admin.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'email' => 'required',
        ]);

        $existant_username = Admin::where('username', $request->username)->get();
        $existant_email = Admin::where('email', $request->email)->get();


        if (count($existant_email) > 0) {
            return redirect()->back()->with('error', "Cet nom d'utilisateur est déjà pris");
        }

        if (count($existant_email) > 0) {
            return redirect()->back()->with('error', "Un compte avec cet email existe déjà");
        }

        $admin = new Admin([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $admin->save();

        return redirect()->route('admins.index')->with('success', 'Compte admin créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $admin = Admin::find($id);
        return view('admins.show', compact('admin'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $admin = Admin::find($id);
        return view('admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255|unique:admins,username,' . $id,
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'user_id' => 'required|exists:users,id'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $admin = Admin::find($id);
        $admin->update([
            'username' => $request->username,
            'email' => $request->email,
            'user_id' => $request->user_id
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $admin = Admin::find($id);
        $admin->delete();
        return redirect()->route('admins.index')->with('success', 'Admin successfully deleted!');
    }
}
