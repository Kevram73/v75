<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    public function welcome()
    {
        $user = Auth::guard('client')->user();
        $announcements = Announcement::orderByDesc('updated_at')->limit(3)->get();

        return view('welcome', compact('user', 'announcements'));
    }
}
