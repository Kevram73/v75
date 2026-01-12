<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\MultiLevelCommission;
use App\Services\CommissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommissionController extends Controller
{
    protected $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->middleware('auth.client');
        $this->commissionService = $commissionService;
    }

    /**
     * Display a listing of commissions.
     */
    public function index()
    {
        $client = Auth::guard('client')->user();
        
        // Get all commissions earned by this client with pagination
        $commissions = MultiLevelCommission::where('referrer_id', $client->id)
            ->with('client')
            ->orderByDesc('created_at')
            ->paginate(20);

        return view('client.commissions.index', compact('commissions'));
    }

    /**
     * Get commission percentage for a level.
     */
    private function getCommissionPercentage(int $level): float
    {
        $percentages = [
            1 => 8.0,
            2 => 3.0,
            3 => 1.0,
            4 => 0.5,
            5 => 0.5,
        ];

        return $percentages[$level] ?? 0.0;
    }
}

