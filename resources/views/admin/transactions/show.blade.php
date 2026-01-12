@extends('layouts.app')

@section('title', 'V75 Pro - Détails Transaction')

@section('page-title', 'DÉTAILS TRANSACTION')
@section('page-subtitle', 'INFORMATIONS DÉTAILLÉES')

@section('content')

<div class="space-y-6">
    <!-- Informations de la transaction -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">INFORMATIONS DE LA TRANSACTION</h3>
        </div>
        <div class="p-4 md:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">TYPE</p>
                    <p class="text-sm text-gray-900 font-medium">
                        <span class="font-mono bg-gray-200 px-2 py-1 rounded">{{ $transaction->type ?? 'N/A' }}</span>
                    </p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">STATUS ACTUEL</p>
                    <p class="text-sm">
                        @if($transaction->status == 'PENDING' || $transaction->status == 'pending')
                            <span class="font-mono bg-yellow-100 text-yellow-800 px-2 py-1 rounded">EN ATTENTE</span>
                        @elseif($transaction->status == 'COMPLETED' || $transaction->status == 'done')
                            <span class="font-mono bg-green-100 text-green-800 px-2 py-1 rounded">EFFECTUÉ</span>
                        @elseif($transaction->status == 'CANCELLED')
                            <span class="font-mono bg-red-100 text-red-800 px-2 py-1 rounded">ANNULÉ</span>
                        @else
                            <span class="font-mono bg-gray-200 px-2 py-1 rounded">{{ strtoupper($transaction->status ?? 'N/A') }}</span>
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">CLIENT</p>
                    <p class="text-sm text-gray-900 font-medium">
                        @if($transaction->client)
                            {{ $transaction->client->first_name ?? '' }} {{ $transaction->client->last_name ?? '' }}
                            <br>
                            <span class="text-xs text-gray-500 font-mono">{{ $transaction->client->email ?? '' }}</span>
                        @else
                            N/A
                        @endif
                    </p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">MONTANT</p>
                    <p class="text-2xl font-bold text-gray-900">${{ number_format($transaction->amount ?? 0, 2) }}</p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">DATE DE CRÉATION</p>
                    <p class="text-sm text-gray-900 font-mono">{{ $transaction->created_at->format('d/m/Y à H:i') }}</p>
                </div>
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">TRANSACTION ID</p>
                    <p class="text-sm text-gray-900 font-mono">
                        {{ $transaction->trx_id ?? $transaction->merchant_trade_no ?? $transaction->reference ?? '#' . $transaction->id }}
                    </p>
                </div>
                @if($transaction->reference && ($transaction->trx_id || $transaction->merchant_trade_no))
                <div>
                    <p class="text-xs font-mono text-gray-500 mb-1">RÉFÉRENCE</p>
                    <p class="text-sm text-gray-900 font-mono">{{ $transaction->reference }}</p>
                </div>
                @endif
                @if($transaction->description)
                <div class="md:col-span-2">
                    <p class="text-xs font-mono text-gray-500 mb-1">DESCRIPTION</p>
                    <p class="text-sm text-gray-700 bg-gray-50 p-3 border border-gray-200 rounded">{{ $transaction->description }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modification du statut -->
    <div class="bg-white border-2 border-gray-300">
        <div class="border-b-2 border-gray-300 p-4">
            <h3 class="text-sm font-bold text-gray-900 uppercase">
                <i class="fas fa-edit mr-2"></i>MODIFIER LE STATUT
            </h3>
        </div>
        <div class="p-4 md:p-6">
            <form method="POST" action="{{ route('admin.transactions.update', $transaction->id) }}">
                @csrf
                @method('PUT')
                
                @if(session('success'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-600 p-3 border border-green-200">
                        <div class="flex items-center">
                            <span class="text-green-600 mr-2 font-mono">[OK]</span>
                            <p class="text-xs font-medium text-gray-900">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-4 bg-red-50 border-l-4 border-red-600 p-3 border border-red-200">
                        <div class="flex items-start">
                            <span class="text-red-600 mr-2 font-mono">[ERR]</span>
                            <div>
                                <p class="text-xs font-medium text-gray-900 mb-1">Erreurs de validation:</p>
                                <ul class="list-disc list-inside text-xs text-gray-700">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="mb-4">
                    <label for="status" class="block text-xs font-medium text-gray-700 mb-2">
                        <i class="fas fa-tag mr-1"></i>NOUVEAU STATUT
                    </label>
                    <select id="status"
                            name="status" 
                            required 
                            class="w-full px-3 py-2 border-2 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 @error('status') border-red-500 @enderror">
                        <option value="PENDING" {{ $transaction->status == 'PENDING' ? 'selected' : '' }}>EN ATTENTE</option>
                        <option value="COMPLETED" {{ $transaction->status == 'COMPLETED' ? 'selected' : '' }}>EFFECTUÉ</option>
                        <option value="CANCELLED" {{ $transaction->status == 'CANCELLED' ? 'selected' : '' }}>ANNULÉ</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                    @if(($transaction->type === 'DEPOSIT' || $transaction->type === 'INVESTMENT') && $transaction->status !== 'COMPLETED')
                        <p class="mt-2 text-xs text-blue-600">
                            <i class="fas fa-info-circle mr-1"></i>
                            En passant à "EFFECTUÉ", le compte du client sera crédité automatiquement.
                        </p>
                    @endif
                </div>

                <div class="flex items-center justify-between">
                    <a href="{{ route('admin.transactions.index') }}" class="text-xs font-medium text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left mr-1"></i>RETOUR À LA LISTE
                    </a>
                    <button type="submit" class="text-xs font-medium bg-gray-800 text-white px-6 py-2 hover:bg-gray-900 transition-colors">
                        <i class="fas fa-save mr-2"></i>METTRE À JOUR
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

