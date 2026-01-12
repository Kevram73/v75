<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Investment;
use App\Models\Plan;
use App\Services\InvestmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class InvestmentController extends Controller
{
    protected $investmentService;

    public function __construct(InvestmentService $investmentService)
    {
        $this->middleware('auth.client');
        $this->investmentService = $investmentService;
    }

    /**
     * Display a listing of investments.
     */
    public function index()
    {
        $client = Auth::guard('client')->user();
        $investments = $client->investments()->orderByDesc('created_at')->paginate(20);

        return view('client.investments.index', compact('investments'));
    }

    /**
     * Show the form for creating a new investment.
     */
    public function create()
    {
        $client = Auth::guard('client')->user();
        $account = $client->wallet;

        return view('client.investments.create', compact('account'));
    }

    /**
     * Store a newly created investment.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:10',
            'description' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $client = Auth::guard('client')->user();
        $account = $client->wallet;

        if (!$account || $account->balance < $request->amount) {
            return redirect()->back()->with('error', 'Solde insuffisant pour cet investissement.')->withInput();
        }

        try {
            $investment = $this->investmentService->createInvestment($client, null, $request->amount);
            return redirect()->route('client.investments.index')->with('success', 'Investissement créé avec succès !');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la création de l\'investissement: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified investment.
     */
    public function show($id)
    {
        $client = Auth::guard('client')->user();
        $investment = Investment::where('client_id', $client->id)
            ->findOrFail($id);

        return view('client.investments.show', compact('investment'));
    }
}

