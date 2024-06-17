<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.client');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('client.dashboard');
    }

    public function clientProfile(){
        // $adminConnected = Auth::admin()->id;
        // $admin = Admin::find($adminConnected);
        // return view('admin.profile', compact('admin'));

        return view('client.clientProfile');
    }
}
