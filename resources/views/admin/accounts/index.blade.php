@extends('layouts.app')

@section('title', 'V75 Pro - Comptes')

@section('page-title', 'COMPTES')
@section('page-subtitle', 'GESTION DES COMPTES')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3 flex justify-between items-center">
        <h3 class="text-sm font-bold text-gray-900 uppercase">LISTE DES COMPTES</h3>
        <a href="{{ route('admin.accounts.create') }}" class="text-xs font-mono bg-gray-800 text-white px-3 py-1 hover:bg-gray-900">
            CRÉER UN COMPTE
        </a>
    </div>
    <div class="p-4">
        <table class="w-full text-xs">
            <thead>
                <tr class="border-b-2 border-gray-300">
                    <th class="text-left py-2 font-mono text-gray-500">#</th>
                    <th class="text-left py-2 font-mono text-gray-500">CLIENT</th>
                    <th class="text-left py-2 font-mono text-gray-500">NUMÉRO DE COMPTE</th>
                    <th class="text-left py-2 font-mono text-gray-500">SOLDE</th>
                    <th class="text-left py-2 font-mono text-gray-500">STATUS</th>
                    <th class="text-left py-2 font-mono text-gray-500">ACTION</th>
                </tr>
            </thead>
            <tbody>
                @forelse($accounts ?? [] as $account)
                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                        <td class="py-2 text-gray-900 font-mono">{{ $loop->index + 1 }}</td>
                        <td class="py-2 text-gray-900">
                            @if($account->client)
                                {{ $account->client->first_name ?? '' }} {{ $account->client->last_name ?? '' }}
                                <br>
                                <span class="text-xs text-gray-500 font-mono">{{ $account->client->email ?? '' }}</span>
                            @else
                                <span class="text-gray-400">Client supprimé</span>
                            @endif
                        </td>
                        <td class="py-2 text-gray-500 font-mono">{{ $account->account_num ?? 'N/A' }}</td>
                        <td class="py-2 text-gray-900 font-bold">${{ number_format($account->balance ?? 0, 2) }}</td>
                        <td class="py-2">
                            @if($account->is_active ?? false)
                                <span class="font-mono text-xs bg-green-100 text-green-800 px-2 py-1 rounded">ACTIF</span>
                            @else
                                <span class="font-mono text-xs bg-red-100 text-red-800 px-2 py-1 rounded">INACTIF</span>
                            @endif
                        </td>
                        <td class="py-2">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.accounts.edit', $account->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300 rounded">ÉDITER</a>
                                <a href="{{ route('admin.account_activated', $account->id) }}" class="text-xs font-mono bg-gray-200 px-2 py-1 hover:bg-gray-300 rounded">
                                    {{ $account->is_active ? 'DÉSACTIVER' : 'ACTIVER' }}
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="py-4 text-center text-gray-500 font-mono text-xs">AUCUN COMPTE</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        @if(isset($accounts) && method_exists($accounts, 'links'))
            <div class="mt-4">
                {{ $accounts->links() }}
            </div>
        @endif
    </div>
</div>

@endsection

