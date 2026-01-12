@extends('layouts.app')

@section('title', 'V75 Pro - Détails Client')

@section('page-title', 'DÉTAILS CLIENT')
@section('page-subtitle', 'INFORMATIONS CLIENT')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">INFORMATIONS CLIENT</h3>
    </div>
    <div class="p-4">
        <div class="space-y-4">
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">NOM</p>
                <p class="text-sm text-gray-900">{{ $client->last_name }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">PRÉNOM</p>
                <p class="text-sm text-gray-900">{{ $client->first_name }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">EMAIL</p>
                <p class="text-sm text-gray-900 font-mono">{{ $client->email }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">TÉLÉPHONE</p>
                <p class="text-sm text-gray-900 font-mono">{{ $client->phone_number }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">STATUS</p>
                <p class="text-sm text-gray-900 font-mono">{{ $client->is_active ? 'ACTIF' : 'INACTIF' }}</p>
            </div>
            <div>
                <p class="text-xs font-mono text-gray-500 mb-1">SOLDE</p>
                <p class="text-lg font-bold text-gray-900">${{ number_format($client->wallet->balance ?? 0, 2) }}</p>
            </div>
        </div>
        <div class="mt-6 flex space-x-2">
            @if($client->is_active)
                <a href="{{ route('admin.clients.deactivate', $client->id) }}" class="text-xs font-mono bg-gray-200 text-gray-900 px-4 py-2 hover:bg-gray-300">
                    DÉSACTIVER
                </a>
            @else
                <a href="{{ route('admin.clients.activate', $client->id) }}" class="text-xs font-mono bg-gray-200 text-gray-900 px-4 py-2 hover:bg-gray-300">
                    ACTIVER
                </a>
            @endif
            <a href="{{ route('admin.clients.index') }}" class="text-xs font-mono bg-gray-800 text-white px-4 py-2 hover:bg-gray-900">
                RETOUR
            </a>
        </div>
    </div>
</div>

@endsection

