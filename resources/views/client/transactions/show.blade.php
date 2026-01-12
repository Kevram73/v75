@extends('layouts.app2')

@section('title', 'V75 Pro - Détails Transaction')

@section('page-title', 'DÉTAILS TRANSACTION')
@section('page-subtitle', 'INFORMATIONS DÉTAILLÉES')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">DÉTAILS DE LA TRANSACTION</h3>
    </div>
    <div class="p-4">
        <div class="space-y-4">
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">TYPE</p>
                <p class="text-sm text-gray-900 font-mono">{{ $transaction->type ?? 'N/A' }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">MONTANT</p>
                <p class="text-lg font-bold text-gray-900">${{ number_format($transaction->amount ?? 0, 2) }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">DATE</p>
                <p class="text-sm text-gray-900 font-mono">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">TRANSACTION ID</p>
                <p class="text-sm text-gray-900 font-mono">
                    {{ $transaction->trx_id ?? $transaction->merchant_trade_no ?? $transaction->reference ?? '#' . $transaction->id }}
                </p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">STATUS</p>
                <p class="text-sm text-gray-900 font-mono">{{ strtoupper($transaction->status ?? 'N/A') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection

