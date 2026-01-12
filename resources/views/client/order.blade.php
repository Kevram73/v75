@extends('layouts.app2')

@section('title', 'V75 Pro - Commande')

@section('page-title', 'COMMANDE')
@section('page-subtitle', 'DÉTAILS DE LA COMMANDE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">DÉTAILS DE LA COMMANDE</h3>
    </div>
    <div class="p-4">
        <div class="space-y-4">
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">MONTANT</p>
                <p class="text-lg font-bold text-gray-900">${{ number_format($order->amount ?? 0, 2) }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">STATUS</p>
                <p class="text-sm text-gray-900 font-mono">{{ strtoupper($order->status ?? 'N/A') }}</p>
            </div>
        </div>
    </div>
</div>

@endsection

