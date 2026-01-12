@extends('layouts.app')

@section('title', 'V75 Pro - Transactions')

@section('page-title', 'TRANSACTIONS')
@section('page-subtitle', 'TOUTES LES TRANSACTIONS')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-4 flex justify-between items-center">
        <h3 class="text-sm font-bold text-gray-900 uppercase">TOUTES LES TRANSACTIONS</h3>
        <div class="flex gap-2">
            <a href="{{ route('admin.deposits') }}" class="text-xs font-mono bg-gray-200 px-3 py-1 hover:bg-gray-300 rounded">
                DÉPÔTS
            </a>
            <a href="{{ route('admin.withdrawals') }}" class="text-xs font-mono bg-gray-200 px-3 py-1 hover:bg-gray-300 rounded">
                RETRAITS
            </a>
        </div>
    </div>
    <div class="p-4 overflow-x-auto">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-mono text-gray-500">#</th>
                    <th class="text-left py-2 font-mono text-gray-500">TYPE</th>
                    <th class="text-left py-2 font-mono text-gray-500">CLIENT</th>
                    <th class="text-left py-2 font-mono text-gray-500">MONTANT</th>
                    <th class="text-left py-2 font-mono text-gray-500">DATE</th>
                    <th class="text-left py-2 font-mono text-gray-500">STATUS</th>
                    <th class="text-left py-2 font-mono text-gray-500">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions ?? [] as $transaction)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                        <td class="py-2">
                            <span class="font-mono text-xs bg-gray-200 px-2 py-1 rounded">{{ $transaction->type }}</span>
                        </td>
                        <td class="py-2 text-gray-900">
                            @if($transaction->client)
                                {{ $transaction->client->first_name ?? '' }} {{ $transaction->client->last_name ?? '' }}
                                <br>
                                <span class="text-xs text-gray-500 font-mono">{{ $transaction->client->email ?? '' }}</span>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="py-2 text-gray-900 font-bold">${{ number_format($transaction->amount, 2) }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $transaction->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2">
                            @if($transaction->status == 'PENDING' || $transaction->status == 'pending')
                                <span class="font-mono text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">EN ATTENTE</span>
                            @elseif($transaction->status == 'COMPLETED' || $transaction->status == 'done')
                                <span class="font-mono text-xs bg-green-100 text-green-800 px-2 py-1 rounded">EFFECTUÉ</span>
                            @elseif($transaction->status == 'CANCELLED')
                                <span class="font-mono text-xs bg-red-100 text-red-800 px-2 py-1 rounded">ANNULÉ</span>
                            @else
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1 rounded">{{ strtoupper($transaction->status) }}</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <a href="{{ route('admin.transactions.show', $transaction->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300 rounded">
                                VOIR
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUNE TRANSACTION</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if(isset($transactions) && method_exists($transactions, 'links'))
            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
