@extends('layouts.app')

@section('title', 'V75 Pro - Retraits')

@section('page-title', 'RETRAITS')
@section('page-subtitle', 'LISTE DES RETRAITS')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">LISTE DES RETRAITS</h3>
    </div>
    <div class="p-4">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-mono text-gray-500">#</th>
                    <th class="text-left py-2 font-mono text-gray-500">CLIENT</th>
                    <th class="text-left py-2 font-mono text-gray-500">MONTANT</th>
                    <th class="text-left py-2 font-mono text-gray-500">DATE</th>
                    <th class="text-left py-2 font-mono text-gray-500">STATUS</th>
                    <th class="text-left py-2 font-mono text-gray-500">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($withdrawals ?? [] as $withdrawal)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                        <td class="py-2 text-gray-900">
                            @if($withdrawal->client)
                                {{ $withdrawal->client->first_name ?? '' }} {{ $withdrawal->client->last_name ?? '' }}
                                <br>
                                <span class="text-xs text-gray-500 font-mono">{{ $withdrawal->client->email ?? '' }}</span>
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="py-2 text-gray-900 font-bold">${{ number_format($withdrawal->amount, 2) }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $withdrawal->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2">
                            @if($withdrawal->status == 'PENDING' || $withdrawal->status == 'pending')
                                <span class="font-mono text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">EN ATTENTE</span>
                            @elseif($withdrawal->status == 'COMPLETED' || $withdrawal->status == 'done')
                                <span class="font-mono text-xs bg-green-100 text-green-800 px-2 py-1 rounded">EFFECTUÉ</span>
                            @elseif($withdrawal->status == 'CANCELLED')
                                <span class="font-mono text-xs bg-red-100 text-red-800 px-2 py-1 rounded">ANNULÉ</span>
                            @else
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1 rounded">{{ strtoupper($withdrawal->status) }}</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <a href="{{ route('admin.transactions.show', $withdrawal->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300 rounded">
                                VOIR
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUN RETRAIT</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if(isset($withdrawals) && method_exists($withdrawals, 'links'))
            <div class="mt-4">
                {{ $withdrawals->links() }}
            </div>
        @endif
    </div>
</div>

@endsection
