@extends('layouts.app')

@section('title', 'V75 Pro - Éditer Compte')

@section('page-title', 'ÉDITER COMPTE')
@section('page-subtitle', 'MODIFIER LE COMPTE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">ÉDITER LE COMPTE</h3>
    </div>
    <div class="p-4 md:p-6">
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

        <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4">
            <div class="flex items-start">
                <i class="fas fa-info-circle text-blue-600 mr-2 mt-1"></i>
                <div class="text-xs text-gray-700">
                    <p class="font-semibold mb-1">Informations du compte:</p>
                    <p><strong>Client:</strong> {{ $account->client->first_name ?? '' }} {{ $account->client->last_name ?? '' }} ({{ $account->client->email ?? 'N/A' }})</p>
                    <p><strong>Numéro de compte:</strong> {{ $account->account_num ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.accounts.update', $account->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="balance" class="block text-xs font-medium text-gray-700 mb-2">
                    <i class="fas fa-dollar-sign mr-1"></i>SOLDE ($)
                </label>
                <input type="number" 
                       id="balance"
                       name="balance" 
                       value="{{ old('balance', $account->balance ?? 0) }}" 
                       step="0.01"
                       min="0"
                       class="w-full px-3 py-2 border-2 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 @error('balance') border-red-500 @enderror">
                @error('balance')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="is_active" class="flex items-center">
                    <input type="checkbox" 
                           id="is_active"
                           name="is_active" 
                           value="1"
                           {{ ($account->is_active ?? false) ? 'checked' : '' }}
                           class="h-4 w-4 text-gray-800 focus:ring-gray-800 border-gray-300 rounded">
                    <span class="ml-2 text-xs font-medium text-gray-700">Compte actif</span>
                </label>
            </div>
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.accounts.index') }}" class="text-xs font-medium text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-1"></i>RETOUR
                </a>
                <button type="submit" class="text-xs font-medium bg-gray-800 text-white px-6 py-2 hover:bg-gray-900 transition-colors">
                    <i class="fas fa-save mr-2"></i>ENREGISTRER
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

