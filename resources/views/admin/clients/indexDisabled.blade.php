@extends('layouts.app')

@section('title', 'V75 Pro - Clients Désactivés')

@section('page-title', 'CLIENTS DÉSACTIVÉS')
@section('page-subtitle', 'LISTE DES CLIENTS DÉSACTIVÉS')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">LISTE DES CLIENTS DÉSACTIVÉS</h3>
    </div>
    <div class="p-4">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-mono text-gray-500">NOM</th>
                    <th class="text-left py-2 font-mono text-gray-500">PRÉNOM</th>
                    <th class="text-left py-2 font-mono text-gray-500">EMAIL</th>
                    <th class="text-left py-2 font-mono text-gray-500">TÉLÉPHONE</th>
                    <th class="text-left py-2 font-mono text-gray-500">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clients ?? [] as $client)
                    <tr class="border-b border-gray-200">
                        <td class="py-2 text-gray-900">{{ $client->last_name }}</td>
                        <td class="py-2 text-gray-900">{{ $client->first_name }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $client->email }}</td>
                        <td class="py-2 text-gray-500 font-mono">{{ $client->phone_number }}</td>
                        <td class="py-2">
                            <a href="{{ route('admin.clients.activate', $client->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300">ACTIVER</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUN CLIENT DÉSACTIVÉ</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

