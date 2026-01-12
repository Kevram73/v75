@extends('layouts.app')

@section('title', 'V75 Pro - Admin Dashboard')

@section('page-title', 'DASHBOARD')
@section('page-subtitle', 'OVERVIEW')

@section('content')

<div class="space-y-6">
    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">TOTAL ENTRÉES</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($totalDeps ?? 0, 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-arrow-down text-white text-sm"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">TOTAL REVERSÉ</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($totalRec ?? 0, 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-arrow-up text-white text-sm"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">TOTAL JOURNALIERS</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($totalTransactionsToday ?? 0, 2) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-chart-line text-white text-sm"></i>
                </div>
            </div>
        </div>
        
        <div class="bg-white border-2 border-gray-300 p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-500 font-mono mb-1">CLIENTS ACTIFS</p>
                    <p class="text-2xl font-bold text-gray-900">{{ count($activeClients ?? []) }}</p>
                </div>
                <div class="w-12 h-12 bg-gray-800 flex items-center justify-center">
                    <i class="fas fa-users text-white text-sm"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tables -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Derniers clients -->
        <div class="bg-white border-2 border-gray-300">
            <div class="border-b-2 border-gray-300 p-3">
                <h3 class="text-sm font-bold text-gray-900 uppercase">DERNIERS CLIENTS</h3>
            </div>
            <div class="p-4">
                <table class="w-full text-xs">
                    <thead>
                        <tr class="border-b border-gray-300">
                            <th class="text-left py-2 font-mono text-gray-500">NOM</th>
                            <th class="text-left py-2 font-mono text-gray-500">EMAIL</th>
                            <th class="text-left py-2 font-mono text-gray-500">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($activeClients ?? [] as $client)
                            <tr class="border-b border-gray-200">
                                <td class="py-2 text-gray-900">{{ $client->first_name }} {{ $client->last_name }}</td>
                                <td class="py-2 text-gray-500 font-mono">{{ $client->email }}</td>
                                <td class="py-2">
                                    @if($client->is_active)
                                        <span class="font-mono text-xs bg-gray-200 px-2 py-1">ACTIF</span>
                                    @else
                                        <span class="font-mono text-xs bg-gray-300 px-2 py-1">INACTIF</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUN CLIENT</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Dernières transactions -->
        <div class="bg-white border-2 border-gray-300">
            <div class="border-b-2 border-gray-300 p-3">
                <h3 class="text-sm font-bold text-gray-900 uppercase">DERNIÈRES TRANSACTIONS</h3>
            </div>
            <div class="p-4">
                <div class="space-y-3">
                    @forelse ($lastTransactions ?? [] as $transaction)
                        <div class="border-l-2 border-gray-800 pl-3 py-2">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-xs font-bold text-gray-900">{{ $transaction->type }}</p>
                                    <p class="text-xs text-gray-500 font-mono">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-bold text-gray-900">${{ number_format($transaction->amount, 2) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500 font-mono text-xs">AUCUNE TRANSACTION</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('home')
    <script src="{{asset('/assets/vendor_components/datatable/datatables.min.js')}}"></script>
    <script src="{{asset('/src/js/pages/data-table.js')}}"></script>
@endpush
