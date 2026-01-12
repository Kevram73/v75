@extends('layouts.app')

@section('title', 'V75 Pro - Créer Compte')

@section('page-title', 'CRÉER COMPTE')
@section('page-subtitle', 'NOUVEAU COMPTE')

@section('content')

<div class="bg-white border-2 border-gray-300">
    <div class="border-b-2 border-gray-300 p-3">
        <h3 class="text-sm font-bold text-gray-900 uppercase">CRÉER UN COMPTE</h3>
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

        <form method="POST" action="{{ route('admin.accounts.store') }}">
            @csrf
            <div class="mb-4">
                <label for="client_id" class="block text-xs font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-1"></i>CLIENT
                </label>
                <select id="client_id" name="client_id" required class="w-full px-3 py-2 border-2 border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 @error('client_id') border-red-500 @enderror">
                    <option value="">Sélectionner un client</option>
                    @foreach($clients ?? [] as $client)
                        <option value="{{ $client->id }}" {{ old('client_id') == $client->id ? 'selected' : '' }}>
                            {{ $client->first_name }} {{ $client->last_name }} ({{ $client->email }})
                        </option>
                    @endforeach
                </select>
                @error('client_id')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-xs text-gray-500">
                    <i class="fas fa-info-circle mr-1"></i>
                    Seuls les clients sans compte sont affichés
                </p>
            </div>
            <div class="flex items-center justify-between">
                <a href="{{ route('admin.accounts.index') }}" class="text-xs font-medium text-gray-600 hover:text-gray-900">
                    <i class="fas fa-arrow-left mr-1"></i>RETOUR
                </a>
                <button type="submit" class="text-xs font-medium bg-gray-800 text-white px-6 py-2 hover:bg-gray-900 transition-colors">
                    <i class="fas fa-plus mr-2"></i>CRÉER LE COMPTE
                </button>
            </div>
        </form>
    </div>
</div>

@endsection

