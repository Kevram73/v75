@extends('layouts.app2')

@section('title', 'V75 Pro - Mes Commissions')

@section('page-title', 'COMMISSIONS')
@section('page-subtitle', 'MES COMMISSIONS')

@section('content')

<div class="space-y-6">
    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white border-2 border-gray-300 p-4">
            <p class="text-xs text-gray-500 font-mono mb-1">TOTAL COMMISSIONS</p>
            <p class="text-2xl font-bold text-gray-900">${{ number_format(auth('client')->user()->wallet->total_commissions ?? 0, 2) }}</p>
        </div>
        <div class="bg-white border-2 border-gray-300 p-4">
            <p class="text-xs text-gray-500 font-mono mb-1">FILLEULS</p>
            <p class="text-2xl font-bold text-gray-900">{{ auth('client')->user()->referrals()->count() }}</p>
        </div>
        <div class="bg-white border-2 border-gray-300 p-4">
            <p class="text-xs text-gray-500 font-mono mb-1">COMMISSION MOYENNE</p>
            <p class="text-2xl font-bold text-gray-900">8%</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-3">
            <h3 class="text-sm font-bold text-gray-900 uppercase">HISTORIQUE DES COMMISSIONS</h3>
        </div>
        <div class="p-4">
            <table class="w-full text-xs">
                <thead>
                    <tr class="border-b-2 border-gray-300">
                        <th class="text-left py-2 font-mono text-gray-500">#</th>
                        <th class="text-left py-2 font-mono text-gray-500">FILLEUL</th>
                        <th class="text-left py-2 font-mono text-gray-500">INVESTISSEMENT</th>
                        <th class="text-left py-2 font-mono text-gray-500">COMMISSION</th>
                        <th class="text-left py-2 font-mono text-gray-500">NIVEAU</th>
                        <th class="text-left py-2 font-mono text-gray-500">DATE</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($commissions ?? [] as $commission)
                        <tr class="border-b border-gray-200">
                            <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                            <td class="py-2 text-gray-900">{{ $commission->client->first_name ?? 'N/A' }} {{ $commission->client->last_name ?? '' }}</td>
                            <td class="py-2 text-gray-500 font-mono">${{ number_format($commission->amount ?? 0, 2) }}</td>
                            <td class="py-2 text-gray-900 font-bold">${{ number_format($commission->amount ?? 0, 2) }}</td>
                            <td class="py-2">
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1">NIVEAU {{ $commission->level ?? 1 }}</span>
                            </td>
                            <td class="py-2 text-gray-500 font-mono">{{ $commission->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-500 font-mono text-xs">AUCUNE COMMISSION</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
