<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\Client;

class AuthController extends Controller
{
    public function login()
    {
        return view('client.login');
    }

    public function register()
    {
        return view('client.register');
    }

    public function auth_register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $client = new Client();
        $client->first_name = $request->first_name;
        $client->last_name = $request->last_name;
        $client->phone_number = $request->phone_number;
        $client->email = $request->email;
        $client->password = Hash::make($request->password);
        $client->is_active = true;
        $client->save();

        return redirect()->route('client.login');
    }

    public function auth_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('client')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('client/dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }



    public function forgot_password()
    {
        return view('client.passwords.email');
    }

    public function reset_password(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $status = Password::broker('clients')->sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with(['status' => __($status)])
            : back()->withErrors(['email' => __($status)]);
    }

    public function auth_logout(Request $request)
    {
        Auth::guard('client')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/client/login');
    }
}
