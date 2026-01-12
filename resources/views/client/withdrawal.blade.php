@extends('layouts.app2')

@section('title', 'V75 Pro - Retrait')

@section('page-title', 'RETRAIT')
@section('page-subtitle', 'FAIRE UN RETRAIT')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-money-bill-wave mr-2"></i>Effectuer un retrait
                </h3>
            </div>
            <div class="p-6">
                @if(session('success'))
                    <div class="mb-4 bg-green-50 border-l-4 border-green-600 p-3 border border-green-200">
                        <div class="flex items-center">
                            <span class="text-green-600 mr-2 font-mono">[OK]</span>
                            <p class="text-xs font-medium text-gray-900">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-4 bg-red-50 border-l-4 border-red-600 p-3 border border-red-200">
                        <div class="flex items-center">
                            <span class="text-red-600 mr-2 font-mono">[ERR]</span>
                            <p class="text-xs font-medium text-gray-900">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

                <div class="mb-6 bg-blue-50 border-l-4 border-blue-400 p-4">
                    <h6 class="text-sm font-bold text-gray-900 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>Informations importantes
                    </h6>
                    <ul class="text-xs text-gray-700 space-y-1">
                        <li>• Minimum de retrait : <strong>3$</strong></li>
                        <li>• Maximum de retrait : <strong>100,000$</strong></li>
                        <li>• Votre retrait sera traité par l'administrateur</li>
                        <li>• Les fonds seront débités de votre portefeuille une fois validés</li>
                    </ul>
                </div>

                @if(!$hasPassword)
                    <div class="mb-6 bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <h6 class="text-sm font-bold text-gray-900 mb-2">
                            <i class="fas fa-exclamation-triangle mr-2"></i>Mot de passe de retrait requis
                        </h6>
                        <p class="text-xs text-gray-700 mb-3">
                            Vous devez configurer un mot de passe de retrait avant de pouvoir effectuer des retraits.
                        </p>
                        <a href="{{ route('client.withdrawal.password.setup') }}" class="inline-block bg-yellow-600 text-white px-4 py-2 rounded-md text-xs font-bold hover:bg-yellow-700">
                            <i class="fas fa-key mr-2"></i>Configurer le mot de passe
                        </a>
                    </div>
                @endif

                <form method="POST" action="{{ route('client.withdrawal.store') }}" @if(!$hasPassword) onsubmit="return false;" @endif>
                    @csrf
                    
                    <div class="mb-4">
                        <label for="amount" class="block text-xs font-medium text-gray-700 mb-2">Montant du retrait ($)</label>
                        <input type="number" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('amount') border-red-500 @enderror" 
                               id="amount" name="amount" value="{{ old('amount') }}" 
                               min="3" max="{{ $account->balance ?? 0 }}" step="0.01" required>
                        @error('amount')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            Solde disponible : <strong>${{ number_format($account->balance ?? 0, 2) }}</strong>
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="payment_method" class="block text-xs font-medium text-gray-700 mb-2">Méthode de retrait</label>
                        <select class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('payment_method') border-red-500 @enderror" 
                                id="payment_method" name="payment_method" required>
                            <option value="USDT" selected>USDT TRC20 (Seule méthode disponible)</option>
                        </select>
                        @error('payment_method')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Les retraits ne sont possibles qu'en USDT TRC20
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="usdt_address" class="block text-xs font-medium text-gray-700 mb-2">Adresse de votre wallet</label>
                        <input type="text" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm font-mono focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('usdt_address') border-red-500 @enderror" 
                               id="usdt_address" name="usdt_address" value="{{ old('usdt_address', auth('client')->user()->usdt_address ?? '') }}" 
                               placeholder="Entrez l'adresse de votre wallet" required>
                        @error('usdt_address')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Assurez-vous que l'adresse correspond à la méthode de retrait sélectionnée
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="withdrawal_password" class="block text-xs font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock mr-1"></i>Mot de passe de retrait
                        </label>
                        <input type="password" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('withdrawal_password') border-red-500 @enderror" 
                               id="withdrawal_password" name="withdrawal_password" 
                               placeholder="Entrez votre mot de passe de retrait" required>
                        @error('withdrawal_password')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-shield-alt mr-1"></i>
                            Ce mot de passe confirme votre identité pour le retrait
                        </small>
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('client.withdrawal.password.change') }}" class="text-xs text-gray-600 hover:text-gray-900">
                            <i class="fas fa-key mr-1"></i>Modifier le mot de passe
                        </a>
                        <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-md text-sm font-bold hover:bg-green-700 transition-colors" @if(!$hasPassword) disabled @endif>
                            <i class="fas fa-paper-plane mr-2"></i>Soumettre le retrait
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h5 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-wallet mr-2"></i>Votre portefeuille
                </h5>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-4 text-center">
                    <div class="border-r-2 border-gray-300">
                        <h4 class="text-xl font-bold text-green-600 mb-1">${{ number_format($account->balance ?? 0, 2) }}</h4>
                        <small class="text-xs text-gray-500">Solde actuel</small>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold text-yellow-600 mb-1">${{ number_format($account->total_withdrawn ?? 0, 2) }}</h4>
                        <small class="text-xs text-gray-500">Total retiré</small>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h5 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-chart-pie mr-2"></i>Statistiques
                </h5>
            </div>
            <div class="p-6 space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-600">Total déposé :</span>
                    <strong class="text-xs text-gray-900">${{ number_format($account->total_deposited ?? 0, 2) }}</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-600">Total investi :</span>
                    <strong class="text-xs text-gray-900">${{ number_format($account->total_invested ?? 0, 2) }}</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-600">Total profits :</span>
                    <strong class="text-xs text-green-600">${{ number_format($account->total_profits ?? 0, 2) }}</strong>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-xs text-gray-600">Total commissions :</span>
                    <strong class="text-xs text-blue-600">${{ number_format($account->total_commissions ?? 0, 2) }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
