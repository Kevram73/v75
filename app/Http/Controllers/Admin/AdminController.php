<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
        $admins = Admin::orderBy('created_at', 'desc')->paginate(20);
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Compte admin créé avec succès !');
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
        $admin = Admin::findOrFail($id);
        return view('admin.admins.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $admin = Admin::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'name' => $request->name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin mis à jour avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $admin = Admin::findOrFail($id);
        
        // Empêcher la suppression du super admin
        if ($admin->email === 'admin@v75pro.com') {
            return redirect()->route('admin.admins.index')
                ->with('error', 'Impossible de supprimer le super administrateur !');
        }

        $admin->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'Admin supprimé avec succès !');
    }
}
