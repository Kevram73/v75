@extends('layouts.app')

@section('title', 'V75 Pro - Demandes de Retrait')

@section('page-title', 'DEMANDES RETRAIT')
@section('page-subtitle', 'GESTION DES DEMANDES')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">DEMANDES DE RETRAIT</h3>
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
                @forelse($requests ?? [] as $request)
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                        <td class="py-2 text-gray-900">{{ $request->client->first_name ?? 'N/A' }} {{ $request->client->last_name ?? '' }}</td>
                        <td class="py-2 text-gray-900 font-bold">${{ number_format($request->amount ?? 0, 2) }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $request->created_at->format('d/m/Y H:i') }}</td>
                        <td class="py-2">
                            @if($request->status == 'pending')
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1">EN ATTENTE</span>
                            @elseif($request->status == 'approved')
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1">APPROUVÉ</span>
                            @else
                                <span class="font-mono text-xs bg-gray-200 px-2 py-1">{{ strtoupper($request->status) }}</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.retrieve_requests.approve', $request->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300">APPROUVER</a>
                                <a href="{{ route('admin.retrieve_requests.reject', $request->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300">REJETER</a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUNE DEMANDE</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

