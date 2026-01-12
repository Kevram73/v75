@extends('layouts.app2')

@section('title', 'V75 Pro - Détails Investissement')

@section('page-title', 'DÉTAILS INVESTISSEMENT')
@section('page-subtitle', 'INFORMATIONS DÉTAILLÉES')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">DÉTAILS DE L'INVESTISSEMENT</h3>
    </div>
    <div class="p-4">
        <div class="space-y-4">
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">MONTANT</p>
                <p class="text-lg font-bold text-gray-900">${{ number_format($investment->amount ?? 0, 2) }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">DATE DE DÉBUT</p>
                <p class="text-sm text-gray-900 font-mono">{{ $investment->start_date ? \Carbon\Carbon::parse($investment->start_date)->format('d/m/Y H:i') : 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">DATE DE FIN</p>
                <p class="text-sm text-gray-900 font-mono">{{ $investment->end_date ? \Carbon\Carbon::parse($investment->end_date)->format('d/m/Y H:i') : 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">PROFIT</p>
                <p class="text-lg font-bold text-green-600">${{ number_format($investment->profit ?? 0, 2) }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">STATUS</p>
                <p class="text-sm text-gray-900 font-mono">{{ strtoupper($investment->status ?? 'N/A') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection

