@extends('layouts.app2')

@section('title', 'V75 Pro - Tableau de bord')

@section('page-title', 'DASHBOARD')
@section('page-subtitle', 'OVERVIEW')

@section('content')

<div class="space-y-6">
    @php
        $account = auth('client')->user()->wallet;
        $stats = isset($investmentStats) ? $investmentStats : [
            'total_invested' => 0,
            'active_investments' => 0,
            'completed_investments' => 0,
            'total_profits' => 0,
            'active_count' => 0,
            'completed_count' => 0,
            'daily_profit' => 0
        ];
    @endphp

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">SOLDE DISPONIBLE</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($account->balance ?? 0, 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-wallet text-white text-sm"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">TOTAL INVESTI</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($stats['total_invested'] ?? ($account->total_invested ?? 0), 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-sm"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">TOTAL PROFITS</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($stats['total_profits'] ?? ($account->total_profits ?? 0), 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-gift text-white text-sm"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">COMMISSIONS</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($account->total_commissions ?? 0, 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-hand-holding-usd text-white text-sm"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-3">
            <h3 class="text-sm font-bold text-gray-900 uppercase">ACTIONS RAPIDES</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                <a href="{{ route('client.investments.create') }}" class="border-2 border-gray-300 p-3 hover:bg-gray-100 text-center">
                    <i class="fas fa-chart-line text-gray-800 mb-2"></i>
                    <p class="text-xs font-bold text-gray-900 uppercase">INVESTIR</p>
                </a>
                <a href="{{ route('client.investments.index') }}" class="border-2 border-gray-300 p-3 hover:bg-gray-100 text-center">
                    <i class="fas fa-briefcase text-gray-800 mb-2"></i>
                    <p class="text-xs font-bold text-gray-900 uppercase">MES INVESTISSEMENTS</p>
                </a>
                <a href="{{ route('client.commissions.index') }}" class="border-2 border-gray-300 p-3 hover:bg-gray-100 text-center">
                    <i class="fas fa-hand-holding-usd text-gray-800 mb-2"></i>
                    <p class="text-xs font-bold text-gray-900 uppercase">COMMISSIONS</p>
                </a>
                <a href="{{ route('client.deposits') }}" class="border-2 border-gray-300 p-3 hover:bg-gray-100 text-center">
                    <i class="fas fa-arrow-down text-gray-800 mb-2"></i>
                    <p class="text-xs font-bold text-gray-900 uppercase">DÉPOSER</p>
                </a>
                <a href="{{ route('client.withdrawals') }}" class="border-2 border-gray-300 p-3 hover:bg-gray-100 text-center">
                    <i class="fas fa-arrow-up text-gray-800 mb-2"></i>
                    <p class="text-xs font-bold text-gray-900 uppercase">RETIRER</p>
                </a>
                <a href="{{ route('client.transactions') }}" class="border-2 border-gray-300 p-3 hover:bg-gray-100 text-center">
                    <i class="fas fa-history text-gray-800 mb-2"></i>
                    <p class="text-xs font-bold text-gray-900 uppercase">HISTORIQUE</p>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

@push('home')
<script>
  feather.replace();
</script>
@endpush
