@extends('layouts.app2')

@section('title', 'V75 Pro - Nouvel Investissement')

@section('page-title', 'NOUVEL INVESTISSEMENT')
@section('page-subtitle', 'CRÉER UN INVESTISSEMENT')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-chart-line mr-2"></i>Créer un investissement
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
                        <li>• Minimum d'investissement : <strong>10$</strong></li>
                        <li>• Profit quotidien : <strong>1,5%</strong> par jour</li>
                        <li>• L'investissement génère des profits quotidiens automatiquement</li>
                        <li>• Vous pouvez retirer vos profits à tout moment</li>
                    </ul>
                </div>

                <form method="POST" action="{{ route('client.investments.store') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="amount" class="block text-xs font-medium text-gray-700 mb-2">Montant de l'investissement ($)</label>
                        <input type="number" class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('amount') border-red-500 @enderror" 
                               id="amount" name="amount" value="{{ old('amount', '10') }}" 
                               min="10" max="{{ $account->balance ?? 0 }}" step="0.01" required>
                        @error('amount')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                        <small class="text-xs text-gray-500 mt-1">
                            <i class="fas fa-info-circle mr-1"></i>
                            Montant minimum: $10, Solde disponible: ${{ number_format($account->balance ?? 0, 2) }}
                        </small>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-xs font-medium text-gray-700 mb-2">Description (optionnel)</label>
                        <textarea class="w-full px-3 py-2 border-2 border-gray-300 rounded-md text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('description') border-red-500 @enderror" 
                                  id="description" name="description" rows="4" 
                                  placeholder="Ajoutez une description pour cet investissement">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4 bg-green-50 border-l-4 border-green-500 p-4">
                        <h6 class="text-sm font-bold text-gray-900 mb-2">Calcul du profit</h6>
                        <div class="text-xs text-gray-700">
                            <p>Montant investi : <strong id="investAmount">$10.00</strong></p>
                            <p>Profit quotidien (1,5%) : <strong id="dailyProfit" class="text-green-600">$0.15</strong></p>
                            <p>Profit mensuel estimé : <strong id="monthlyProfit" class="text-green-600">$4.50</strong></p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-green-600 text-white px-4 py-2 rounded-md text-sm font-bold hover:bg-green-700 transition-colors">
                        <i class="fas fa-check mr-2"></i>Créer l'investissement
                    </button>
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
                <div class="text-center mb-4">
                    <h4 class="text-2xl font-bold text-green-600 mb-1">${{ number_format($account->balance ?? 0, 2) }}</h4>
                    <small class="text-xs text-gray-500">Solde disponible</small>
                </div>
                <div class="space-y-2 text-xs">
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total investi :</span>
                        <strong class="text-gray-900">${{ number_format($account->total_invested ?? 0, 2) }}</strong>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-600">Total profits :</span>
                        <strong class="text-green-600">${{ number_format($account->total_profits ?? 0, 2) }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="border-b-2 border-gray-300 p-4">
                <h5 class="text-sm font-bold text-gray-900 uppercase tracking-tight">
                    <i class="fas fa-info-circle mr-2"></i>Comment ça fonctionne
                </h5>
            </div>
            <div class="p-6 space-y-3 text-xs text-gray-600">
                <div>
                    <h6 class="font-bold text-gray-900 mb-1">1. Investissez</h6>
                    <p>Choisissez le montant que vous souhaitez investir (minimum $10).</p>
                </div>
                <div>
                    <h6 class="font-bold text-gray-900 mb-1">2. Recevez des profits</h6>
                    <p>Vous recevrez 1,5% de profit chaque jour sur votre investissement.</p>
                </div>
                <div>
                    <h6 class="font-bold text-gray-900 mb-1">3. Retirez</h6>
                    <p>Vous pouvez retirer vos profits à tout moment depuis votre portefeuille.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const amountInput = document.getElementById('amount');
    const investAmountSpan = document.getElementById('investAmount');
    const dailyProfitSpan = document.getElementById('dailyProfit');
    const monthlyProfitSpan = document.getElementById('monthlyProfit');
    
    function updateProfit() {
        const amount = parseFloat(amountInput.value) || 0;
        const dailyProfit = amount * 0.015; // 1.5%
        const monthlyProfit = dailyProfit * 30;
        
        investAmountSpan.textContent = '$' + amount.toFixed(2);
        dailyProfitSpan.textContent = '$' + dailyProfit.toFixed(2);
        monthlyProfitSpan.textContent = '$' + monthlyProfit.toFixed(2);
    }
    
    amountInput.addEventListener('input', updateProfit);
    updateProfit();
});
</script>
@endsection
