@extends('layouts.app')

@section('title', 'V75 Pro - Statistiques')

@section('page-title', 'STATISTIQUES')
@section('page-subtitle', 'ANALYSE DES DONNÉES')

@section('content')

<div class="space-y-6">
    <!-- Statistiques Générales -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-white border-2 border-gray-300">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-mono text-gray-500 mb-1">CLIENTS ACTIFS</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($activeClientsCount ?? 0) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border-2 border-gray-300">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-mono text-gray-500 mb-1">TOTAL CLIENTS</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($clientsCount ?? 0) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-friends text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border-2 border-gray-300">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-mono text-gray-500 mb-1">ADMINS</p>
                        <p class="text-2xl font-bold text-gray-900">{{ number_format($adminsCount ?? 0) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-shield text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white border-2 border-gray-300">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-mono text-gray-500 mb-1">SOLDE TOTAL</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($retrieve_all ?? 0, 2) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-wallet text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des Investissements -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">STATISTIQUES DES INVESTISSEMENTS</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">TOTAL INVESTI</p>
                    <p class="text-xl font-bold text-gray-900">${{ number_format($investmentStats['total_investments'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">INVESTISSEMENTS ACTIFS</p>
                    <p class="text-xl font-bold text-green-600">${{ number_format($investmentStats['active_investments'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">INVESTISSEMENTS TERMINÉS</p>
                    <p class="text-xl font-bold text-blue-600">${{ number_format($investmentStats['completed_investments'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">PROFITS GÉNÉRÉS</p>
                    <p class="text-xl font-bold text-purple-600">${{ number_format($investmentStats['total_profits'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">NOMBRE ACTIFS</p>
                    <p class="text-xl font-bold text-gray-900">{{ number_format($investmentStats['active_count'] ?? 0) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">NOMBRE TERMINÉS</p>
                    <p class="text-xl font-bold text-gray-900">{{ number_format($investmentStats['completed_count'] ?? 0) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">PROFIT QUOTIDIEN TOTAL</p>
                    <p class="text-xl font-bold text-green-600">${{ number_format($investmentStats['daily_profit'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">PROFITS PAYÉS</p>
                    <p class="text-xl font-bold text-blue-600">${{ number_format($investmentStats['total_profits_paid'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">PROFITS CALCULÉS</p>
                    <p class="text-xl font-bold text-purple-600">${{ number_format($investmentStats['total_profits_calculated'] ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des Commissions -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">STATISTIQUES DES COMMISSIONS</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">TOTAL COMMISSIONS</p>
                    <p class="text-xl font-bold text-gray-900">${{ number_format($commissionStats['total_amount'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">COMMISSIONS PAYÉES</p>
                    <p class="text-xl font-bold text-green-600">${{ number_format($commissionStats['completed_amount'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">COMMISSIONS EN ATTENTE</p>
                    <p class="text-xl font-bold text-yellow-600">${{ number_format($commissionStats['pending_amount'] ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">NOMBRE DE COMMISSIONS</p>
                    <p class="text-xl font-bold text-gray-900">{{ number_format($commissionStats['total_count'] ?? 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des Transactions -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">STATISTIQUES DES TRANSACTIONS</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">TOTAL DÉPÔTS</p>
                    <p class="text-xl font-bold text-green-600">${{ number_format($totalDeps ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ number_format($countdeps ?? 0) }} transaction(s)</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">TOTAL RETRAITS</p>
                    <p class="text-xl font-bold text-red-600">${{ number_format($totalRec ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ number_format($countrecs ?? 0) }} transaction(s)</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">TRANSACTIONS AUJOURD'HUI</p>
                    <p class="text-xl font-bold text-blue-600">${{ number_format($totalTransactionsToday ?? 0, 2) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">TOTAL TRANSACTIONS</p>
                    <p class="text-xl font-bold text-gray-900">${{ number_format($totalTransactions ?? 0, 2) }}</p>
                    <p class="text-xs text-gray-500 mt-1">{{ number_format($numberOfTransactions ?? 0) }} transaction(s)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques des Comptes -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">STATISTIQUES DES COMPTES</h3>
        </div>
        <div class="p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">COMPTES ACTIFS</p>
                    <p class="text-2xl font-bold text-green-600">{{ number_format($actives ?? 0) }}</p>
                </div>
                <div class="border-2 border-gray-200 p-3">
                    <p class="text-xs font-mono text-gray-500 mb-1">COMPTES INACTIFS</p>
                    <p class="text-2xl font-bold text-red-600">{{ number_format($inactives ?? 0) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Graphique des Transactions par Mois -->
    @if(isset($transactionsByMonth) && $transactionsByMonth->count() > 0)
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">TRANSACTIONS PAR MOIS</h3>
        </div>
        <div class="p-4">
            <div class="space-y-2">
                @php
                    $months = ['', 'Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
                    $maxAmount = $transactionsByMonth->max('total');
                @endphp
                @foreach($transactionsByMonth as $monthData)
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-xs font-mono text-gray-700">{{ $months[$monthData->month] ?? 'Mois ' . $monthData->month }}</span>
                            <span class="text-xs font-bold text-gray-900">${{ number_format($monthData->total, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $maxAmount > 0 ? ($monthData->total / $maxAmount * 100) : 0 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>

@endsection
